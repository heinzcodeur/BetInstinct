<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\Bet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('affiche')
            ->add('TypedePari')
            ->add('cote1')
            ->add('cote2')
            ->add('cote3')
            ->add('cote4')
            ->add('cote5')
            ->add('cote6')
            ->add('cote7')
            ->add('cote8')
            ->add('cote9')
            ->add('cote10')
            ->add('cote11')
            ->add('cote12')
            ->add('cote13')
            ->add('cote14')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bet::class,
        ]);
    }
}