<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\TypoPari;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypoPariType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('affiche')
            ->add('nom')
            ->add('score_2_0')
            ->add('score_2_1')
            ->add('score_0_2')
            ->add('score_1_2')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TypoPari::class,
        ]);
    }
}
