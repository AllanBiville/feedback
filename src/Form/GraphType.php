<?php

namespace App\Form;

use App\Entity\TypesRepas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GraphType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',                
                ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('repas', EntityType::class, [
                'class' => TypesRepas::class,
                'choice_label' => 'name',
                'choice_value' => 'name',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Afficher',
                'attr' => [
                    'class' => 'btn btn-info'
                ],
            ])
            ;
        ;
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
