<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\Vainqueur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VainqueurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('favori')
            ->add('outsider')
            ->add('name')
            ->add('affiche')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vainqueur::class,
        ]);
    }
}
