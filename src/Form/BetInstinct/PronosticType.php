<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\Pronostic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PronosticType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('affiche')
            ->add('bet')
            ->add('choix')
            ->add('game2')
            ->add('game1')
            ->add('affiche')
            ->add('isValid')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pronostic::class,
        ]);
    }
}
