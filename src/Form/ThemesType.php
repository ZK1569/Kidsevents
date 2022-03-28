<?php

namespace App\Form;

use App\Entity\Themes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class ThemesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // dump($options);
        $builder
            ->add('intitule', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir l'intitule",
                    ]),
                ],
            ])
            ->add('descriptif', TextareaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir le descriptif",
                    ]),
                ],
            ])
            ->add('duree', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir une durée",
                    ]),
                ],
            ])
            ->add('prix', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir un prix",
                    ]),
                    new Positive([
                        'message' => "un prix c'est positif bouffon"
                    ])
                ],
            ])
            ->add('age_min', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir un age minimum",
                    ]),
                    // new LessThan([
                    //     'value' => 
                    // ])
                ],
            ])
            ->add('age_max', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir un age maximum",
                    ]),
                ],
            ])
            ->add('nbenfant_min', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir un nombre d'enfant minimum",
                    ]),
                ],
            ])
            ->add('nbenfant_max', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir un nombre d'enfants maximum",
                    ]),
                ],
            ])
            ->add('image', FileType::class, [
                'data_class' => null,
                'required' => false,
                'constraints' => $options['data']->getId()
                    ? []
                    : [
                        new NotBlank(),
                        new Image([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => "Format d'image incorrect",
                    ]),
                ],
            ]);
        }
   public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Themes::class,
        ]);
    }
}
