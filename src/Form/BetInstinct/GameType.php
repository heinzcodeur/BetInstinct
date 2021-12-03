<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\Formule;
use App\Entity\BetInstinct\Game;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('formule',EntityType::class,[
                'class'=>Formule::class
            ])
            ->add('pronos')
            ->add('resultat',ChoiceType::class,[
                'choices'=>[
                    'en attente'=>1,
                    'gagnant'=>2,
                    'perdant'=>3
                ]
            ])
            ->add('mise')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
