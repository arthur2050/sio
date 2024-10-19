<?php

namespace App\Form\Type;

use App\Model\Product\ProductCalculatePriceParameters;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;

class ProductCalculatePriceType extends AbstractType
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager entity manager
     */
    public function __construct(EntityManagerInterface $entityManager,)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productId', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name', // or any other field to display in the form
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('taxNumber', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^(DE\d{9}|IT\d{11}|GR\d{9}|FR[A-Z]{2}\d{9})$/',
                        'message' => 'Tax number format is invalid.',
                    ]),
                ],
            ])
            ->add('couponCode', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 2, 'max' => 10]),
                ],
            ])
            ->add('button', SubmitType::class)
        ;

    }

    /**
     * @param OptionsResolver $resolver resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductCalculatePriceParameters::class,
            'method'     => 'POST',
            'action'     => '/calculate-price',
        ]);
    }
}
