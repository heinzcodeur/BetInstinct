<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\Affiche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AfficheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('schedule', DateTimeType::class,['widget'=>'single_text'])
            ->add('score')
            ->add('cote_favorite')
            ->add('cote_match_null')
            ->add('cote_outsider')
            ->add('tournoi')
            ->add('favori')
            ->add('equipeA')
            ->add('EquipeB')
            ->add('challenger')
            ->add('archived')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Affiche::class,
        ]);
    }
}
