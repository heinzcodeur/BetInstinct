<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\Affiche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AfficheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('schedule', DateType::class,['widget'=>'single_text'])
            ->add('score')
            ->add('cote_favorite')
            ->add('cote_outsider')
            ->add('tournoi')
            ->add('favori')
            ->add('challenger')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Affiche::class,
        ]);
    }
}
