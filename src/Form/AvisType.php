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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('users', EntityType::class,[
                'class' => TypesUsers::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'attr' => [
                    'class' => 'form-select form-select-lg w-50'
                ] 
            ])
            ->add('repas', EntityType::class,[
                'class' => TypesRepas::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'attr' => [
                    'class' => 'form-select form-select-lg w-50'
                ] 
                
            ])
                ->add('commentary', TextareaType::class,[
                    'required' => false,
                    'attr' => [
                        'id' => 'textarea',
                        'placeholder' => 'Commentaire (Facultatif)',
                        'maxlength' => '255',
                        
                    ]
                ])
                ->add('submit',SubmitType::class,[
                    'label' => 'Envoyer',
                    'attr' => [
                    'class' => 'btn-lg'
                ]])
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
