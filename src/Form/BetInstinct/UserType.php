<?php

namespace App\Form\BetInstinct;

use App\Entity\BetInstinct\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            //->add('roles')
           // ->add('password')
            //->add('isVerified')
            ->add('nom')
            ->add('prenom')
            ->add('birth_date',DateType::class,['widget'=>'single_text','required'=>false])
            ->add('profession')
            ->add('nickname')
            ->add('solde')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
