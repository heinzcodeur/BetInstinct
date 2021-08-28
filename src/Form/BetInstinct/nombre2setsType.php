<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\nombre2sets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class nombre2setsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nb2set')
            ->add('nb3set')
            ->add('nb4set')
            ->add('nb5set')
            ->add('affiche')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => nombre2sets::class,
        ]);
    }
}
