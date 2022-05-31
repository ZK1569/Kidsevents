<?php

namespace App\Form;

use App\Entity\Purchase;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartConfirmationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => "Nom complet",
                'attr' => [
                    'placeholder' => 'Nom du réservant'
                ]
            ])
            ->add('PhoneNbr', TextType::class, [
                'label' => "Numéro de téléphone",
                'attr' => [
                    'placeholder' => 'Numéro à contacter'
                ]
            ])
            ->add('address', TextareaType::class, [
                'label' => 'Adresse complète',
                'attr' => [
                    'placeholder' => 'Adresse de la réservation'
                ]
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Code postal',
                'attr' => [
                    'placeholder' => 'Ex: 75000'
                ]
            ])
            ->add('reserve_for', DateType::class, [
                'label' => 'Date de reservation :',
                'format' => 'dd/MM/yyyy',
                'data' => new \DateTime("now"),
            ])
            ->add('reserve_time', TimeType::class, [
                'label' => 'Heure de reservation :',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Purchase::class
        ]);
    }
}
