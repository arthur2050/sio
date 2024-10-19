<?php

namespace App\Controller;

use App\Form\Type\PaymentPurchaseType;
use App\Form\Type\ProductCalculatePriceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'main')]
    public function index()
    {
        $calculatePriceForm = $this->createForm(ProductCalculatePriceType::class);
        $purchaseForm = $this->createForm(PaymentPurchaseType::class);

        return $this->render('main/index.html.twig',[
            'calculate_price_form' => $calculatePriceForm->createView(),
            'purchase_form' => $purchaseForm->createView()
        ]);
    }
}
