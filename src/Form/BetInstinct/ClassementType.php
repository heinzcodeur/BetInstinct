<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\Association;
use App\Entity\BetInstinct\Classement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClassementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('association',EntityType::class,[
                'class'=>Association::class
            ])
            ->add('ranking')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Classement::class,
        ]);
    }
}
