<?php

namespace App\Form;

use App\Entity\Addresses;
use App\Entity\Clients;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroAddresse')
            ->add('rue')
            ->add('ville')
            ->add('postal')
            ->add('pays')
            ->add('complementAddresse')
            ->add('clients', EntityType::class, [
                'class' => Clients::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Addresses::class,
        ]);
    }
}
