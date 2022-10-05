<?php

namespace App\Form;

use App\Document\OrderDetail;
use App\Document\Products;
use Doctrine\Bundle\MongoDBBundle\Form\Type\DocumentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Positive;

class OrderDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', DocumentType::class, [
                'class' => Products::class,
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('quantity', IntegerType::class, [
                'constraints' => [
                    new Positive(),
                    new NotNull()
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => OrderDetail::class
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}