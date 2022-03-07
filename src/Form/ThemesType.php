<?php

namespace App\Form;

use App\Entity\Themes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;


class ThemesType extends AbstractType
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
            ->add('descriptif', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir l'intitule",
                    ]),
                ],
            ])
            ->add('duree', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir l'intitule",
                    ]),
                ],
            ])
            ->add('prix', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir l'intitule",
                    ]),
                ],
            ])
            ->add('age_min', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir l'intitule",
                    ]),
                    new LessThan(age_max)
                ],
            ])
            ->add('age_max', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir l'intitule",
                    ]),
                    new GreaterThan(age_min)
                ],
            ])
            ->add('nbenfant_min', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir l'intitule",
                    ]),
                ],
            ])
            ->add('nbenfant_max', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir l'intitule",
                    ]),
                ],
            ])
            ->add('image', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir l'intitule",
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Themes::class,
        ]);
    }
}
