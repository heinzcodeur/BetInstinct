<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\Athlete;
use App\Entity\BetInstinct\Classement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AthleteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('birthdate', DateType::class,['widget' => 'single_text'])
            ->add('birth_place')
            ->add('taille')
            ->add('genre',ChoiceType::class,[
                'choices'=>[
                    'dame'=>'dame','homme'=>'homme'
                ]
            ])
            ->add('pays')
            ->add('origine')
            ->add('ranking')
            ->add('avatar', FileType::class,array('data_class'=>null,'required'=>false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Athlete::class,
        ]);
    }
}
