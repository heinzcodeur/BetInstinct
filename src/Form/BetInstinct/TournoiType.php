<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\Tournoi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TournoiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debut',DateType::class,[                'widget' => 'single_text',
            ])
            ->add('fin',DateType::class,[                'widget' => 'single_text',
            ])
            ->add('date_creation',DateType::class,[                'widget' => 'single_text',
            ])
            ->add('siteweb')
            ->add('dotation')
            ->add('city')
            ->add('surface')
            ->add('tenant_titre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tournoi::class,
        ]);
    }
}
