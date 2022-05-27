<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('name', TextType::class,[
                    'label'=> 'Nom de l\'activité d\'anniversaire',
                    'attr' => ['placeholder' => 'Tapez le nom de l\'activité']
                ])
            ->add('short_description', TextareaType::class, [
                'label'=> 'Description de l\'activité',
                'attr' => ['placeholder' => 'Tapez la description de l\'activité']
            ])
            ->add('time', TextType::class, [
                'label'=> 'Durée de l\'activité',
                'attr' => ['placeholder' => 'Tapez le temsp']
            ])
            ->add('price', MoneyType::class,[
                'label'=> 'Prix du Theme',
                'attr' => ['placeholder' => 'Tapez la prix']
            ])
            ->add('age_min', TextType::class, [
                'label'=> 'Age min',
                'attr' => ['placeholder' => 'Age Min']
            ])
            ->add('age_max', TextType::class, [
                'label'=> 'Age max',
                'attr' => ['placeholder' => 'Age Man']
            ])
            ->add('min_kids', TextType::class, [
                'label'=> 'Nombre enfants min',
                'attr' => ['placeholder' => 'Nombre enfants Min']
            ])
            ->add('max_kids', TextType::class, [
                'label'=> 'Nombre enfants max',
                'attr' => ['placeholder' => 'Nombre enfants Max']
            ])
            ->add('main_picture' , FileType::class, [
                'data_class' => null,
                'required' => true,
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
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
