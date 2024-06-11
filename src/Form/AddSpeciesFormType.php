<?php

namespace App\Form;

use App\Entity\Species;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddSpeciesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', ChoiceType::class, [
                'choices' => [
                    'Coq' => 'coq',
                    'Poule' => 'poule',
                    'Poulet' => 'poulet',
                    'Poussin' => 'poussin',
                    'Jars' => 'jars',
                    'Oie' => 'oie',
                    'Oison' => 'oison',
                    'Canard' => 'canard',
                    'Canne' => 'canard',
                    'Caneton' => 'caneton',
                ],
                'label' => 'Espèce :'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Species::class,
        ]);
    }
}
