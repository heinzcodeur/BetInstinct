<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\Type2Pari;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Type2PariType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('choix2')
            ->add('choix3')
            ->add('choix4')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Type2Pari::class,
        ]);
    }
}
