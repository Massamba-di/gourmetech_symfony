<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Commandes;
use App\Entity\Difficulte;
use App\Entity\Recettes;
use App\Entity\TempsDePreparations;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecettesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class,[])
            ->add('description',TextType::class,[])
            ->add('prix',NumberType::class,[
                'label'=> 'Prix(€)',
                'scale'=> 2,])
            ->add('tempsDePreparations',EntityType::class,[
                'class' => TempsDePreparations::class,
                'choice_label' => 'name',
            ])
            ->add('Difficulte',EntityType::class,[
                'class' => Difficulte::class,
                'choice_label' => 'name',
            ])
            ->add('images',FileType::class,[
                'mapped' => false,
            ])
            ->add('ingredients',TextareaType::class,[])


            ->add('categories', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recettes::class,
        ]);
    }
}
