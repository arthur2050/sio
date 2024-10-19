<?php

namespace App\Form\Type;

use App\Model\Payment\PaymentPurchaseParameters;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;

class PaymentPurchaseType extends AbstractType
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager entity manager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productId', IntegerType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Positive(),
                    new Callback([$this, 'validateProduct']),
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
            ->add('paymentType', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
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
            'data_class' => PaymentPurchaseParameters::class,
            'method'     => 'POST',
            'action'     => '/purchase',
        ]);
    }

    /**
     * @param $value
     * @param ExecutionContextInterface $context context
     *
     * @return void
     */
    public function validateProduct($value, ExecutionContextInterface $context)
    {
        $product = $this->entityManager->getRepository(Product::class)->find($value);
        if (!$product) {
            $context->buildViolation('Product does not exist.')
                ->atPath('productId')
                ->addViolation();
        }
    }
}
