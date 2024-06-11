<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Species;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('createdAt', DateTimeType::class, [
                'label' => 'Création',
                'widget' => 'single_text',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description'
            ])
            ->add('sixMonthsDate', DateTimeType::class, [
                'label' => 'Maturité',
                'widget' => 'single_text',
            ])
            ->add('espece', EntityType::class, [
                'class' => Species::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
