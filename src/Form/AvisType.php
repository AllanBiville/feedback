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

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('users', EntityType::class,[
                'class' => TypesUsers::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                
            ])
            ->add('repas', EntityType::class,[
                'class' => TypesRepas::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                
            ])
                ->add('commentary')
                ->add('submit',SubmitType::class)
                ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
