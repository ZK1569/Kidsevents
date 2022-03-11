<?php

namespace App\Form;

use App\Entity\Themes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;


class ThemesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //dump($options);
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
                    // new LessThan([
                    //     'value' => 
                    // ])
                ],
            ])
            ->add('age_max', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir l'intitule",
                    ]),
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
            ->add('image', FileType::class, [
                'data_class' => null,
                'constraints' => [
                    new NotBlank([
                        'message' => "Sélectionner une image",
                    ]),
                    new Image([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                            'image/webp',
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
