<?php

namespace App\Form;

use App\Entity\Options;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class OptionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir l'intitule",
                    ]),
                ],
            ])
            ->add('descriptif', TextareaType::class, [
                'required' => false,
            ])
            ->add('prix', IntegerType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir un prix",
                    ]),
                    new Positive([
                        'message' => "un prix c'est positif bouffon"
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Options::class,
        ]);
    }
}
