<?php

namespace App\Form;

use App\Document\Order;
use App\Document\Products;
use App\Document\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', User::class)
            ->add('products', Products::class)
            ->add('sendAddress')
            ->add('totalOrder')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => Order::class
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
