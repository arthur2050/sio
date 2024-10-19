<?php

namespace App\Controller;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Form\Type\ProductCalculatePriceType;
use App\Model\Product\ProductPriceCalculatorInterface;
use App\Model\Product\ProductCalculatePriceParameters;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    public function __construct(private FormFactoryInterface             $formFactory,
                                private ProductPriceCalculatorInterface  $priceCalculator,
                                private EntityManagerInterface           $objectManager)
    {}
    #[Route('/calculate-price', name: 'calculate_price', methods: ['POST'])]
    public function calculatePrice(Request $request): JsonResponse
    {
        $productCalculatePriceParameters = new ProductCalculatePriceParameters();
        $form = $this->formFactory->create(ProductCalculatePriceType::class, $productCalculatePriceParameters);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $productId = $productCalculatePriceParameters->getProductId();
            $taxNumber = $productCalculatePriceParameters->getTaxNumber();
            $couponCode = $productCalculatePriceParameters->getCouponCode();

            $product = $this->getProductRepository()->find($productId);
            $coupon = $this->getCouponRepository()->findOneBy(['code' => $couponCode]);
            $price = $this->priceCalculator->calculate($product, $taxNumber, $coupon);

            return $this->json(['price' => $price, 'productName' => $product->getName()]);
        }

        return $this->json(['errors' => (string) $form->getErrors(true)], 422);
    }

    private function getProductRepository(): ProductRepository
    {
        return $this->objectManager->getRepository(Product::class);
    }

    private function getCouponRepository(): CouponRepository
    {
        return $this->objectManager->getRepository(Coupon::class);
    }
}
