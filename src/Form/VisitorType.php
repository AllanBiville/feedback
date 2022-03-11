<?php

namespace App\Form;

use App\Entity\Avis;
use App\Entity\TypesRepas;
use App\Entity\TypesUsers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VisitorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('id_2', EntityType::class,[
            'class' => TypesUsers::class,
            'choice_label' => 'name',
            'choice_value' => 'id',
            
        ])
        ->add('id_1', EntityType::class,[
            'class' => TypesRepas::class,
            'choice_label' => 'name',
            'choice_value' => 'id',
        ])
            ->add('commentary')
            ->add('date')
            ->add('submit',SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
