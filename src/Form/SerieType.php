<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Title',
                    'required' => true,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'overview',
                null,
                [
                    'required' => false,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'status',
                ChoiceType::class,
                [
                    'choices' => [
                        'Cancelled' => 'Cancelled',
                        'Ended' => 'Ended',
                        'Returning' => 'Returning'
                    ],
                    'multiple' => false,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add('vote', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('popularity', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('genre', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add(
                'firstAirDate',
                DateTimeType::class,
                [
                    'html5' => true,
                    'widget' => 'single_text',
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'lastAirDate',
                DateTimeType::class,
                [
                    'html5' => true,
                    'widget' => 'single_text',
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add('backdrop', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('poster', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('tmdbId', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
