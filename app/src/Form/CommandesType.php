<?php

namespace App\Form;

use App\Entity\Addresses;
use App\Entity\Clients;
use App\Entity\Commandes;
use App\Entity\Recettes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateCommandes')
            ->add('status')
            ->add('clients', EntityType::class, [
                'class' => Clients::class,
                'choice_label' => 'id',
            ])
            ->add('recettes', EntityType::class, [
                'class' => Recettes::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('addresses', EntityType::class, [
                'class' => Addresses::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commandes::class,
        ]);
    }
}
