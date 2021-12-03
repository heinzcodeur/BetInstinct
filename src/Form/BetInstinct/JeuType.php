<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\Jeu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JeuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mise')
            ->add('formule')
            ->add('pronostic')
            ->add('pronostic2')
            ->add('pronostic3')
            ->add('parieur')
            ->add('resultat',ChoiceType::class,[
                'choices'=>[
                    'en attente'=>1,
                    'perdant'=>2,
                    'gagnant'=>3
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Jeu::class,
        ]);
    }
}
