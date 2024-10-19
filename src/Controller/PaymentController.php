<?php

namespace App\Controller;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Factory\Fixture\OrderFactory;
use App\Factory\Payment\PaymentProcessorFactoryInterface;
use App\Form\Type\PaymentPurchaseType;
use App\Manager\PaymentProcessorManagerInterface;
use App\Model\Payment\PaymentPurchaseParameters;
use App\Model\Product\ProductPriceCalculatorInterface;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PaymentController extends AbstractController
{
    public function __construct(private PaymentProcessorFactoryInterface $paymentProcessorFactory,
                                private PaymentProcessorManagerInterface $paymentProcessorManager,
                                private FormFactoryInterface             $formFactory,
                                private ProductPriceCalculatorInterface  $priceCalculator,
                                private EntityManagerInterface           $objectManager)
    {}
    #[Route('/purchase', name: 'purchase', methods: ['POST'])]
    public function purchase(Request $request): JsonResponse
    {
        $paymentPurchaseParameters = new PaymentPurchaseParameters();
        $form = $this->formFactory->create(PaymentPurchaseType::class, $paymentPurchaseParameters);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $productId = $paymentPurchaseParameters->getProductId();
            $taxNumber = $paymentPurchaseParameters->getTaxNumber();
            $couponCode = $paymentPurchaseParameters->getCouponCode();

            $product = $this->getProductRepository()->find($productId);
            $coupon = $this->getCouponRepository()->findOneBy(['code' => $couponCode]);

            $price = $this->priceCalculator->calculate($product, $taxNumber, $coupon);

            $paymentType = $paymentPurchaseParameters->getPaymentType();

            $paymentProcessor = $this->paymentProcessorFactory->create($paymentType);

            $this->paymentProcessorManager->setProcessor($paymentProcessor);
            $this->paymentProcessorManager->pay($price);

            OrderFactory::create($this->objectManager,
                $product,
                $coupon,
                $paymentType,
                $paymentPurchaseParameters->getTaxNumber(),
                $price
            );
            return $this->json(['message' => 'Purchase successful.']);
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
