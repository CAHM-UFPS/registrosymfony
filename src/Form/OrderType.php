<?php

namespace App\Form;

use App\Document\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sendAddress')
            ->add('orderDetails', CollectionType::class, [
                'entry_type' => OrderDetailType::class,
                'by_reference' => false,
                'allow_add' => true
            ])
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
