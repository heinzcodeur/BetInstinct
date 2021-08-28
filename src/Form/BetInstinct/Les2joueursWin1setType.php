<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\Les2joueursWin1set;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Les2joueursWin1setType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('affiche')
            ->add('oui')
            ->add('non')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Les2joueursWin1set::class,
        ]);
    }
}
