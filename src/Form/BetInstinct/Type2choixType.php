<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\Type2choix;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Type2choixType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('sport')
            ->add('choix1')
            ->add('choix2')
            ->add('choix3')
            ->add('choix4')
            ->add('choix5')
            ->add('choix6')
            ->add('choix7')
            ->add('choix8')
            ->add('choix9')
            ->add('choix10')
            ->add('choix11')
            ->add('choix12')
            ->add('choix13')
            ->add('choix14')
            ->add('choix15')
            ->add('choix16')
            ->add('choix17')
            ->add('choix18')
            ->add('choix19')
            ->add('choix20')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Type2choix::class,
        ]);
    }
}
