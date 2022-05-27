<?php

namespace App\Form;

use App\Entity\Supplement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SupplementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label'=> 'Nom du supplement',
                'attr' => ['placeholder' => 'Tapez le nom du supplement']
            ])
            ->add('short_description', TextareaType::class, [
                'label'=> 'Description du supplement',
                'attr' => ['placeholder' => 'Tapez la description du supplement']
            ])
            ->add('price', MoneyType::class,[
                'label'=> 'Prix du supplement',
                'attr' => ['placeholder' => 'Tapez la prix']
            ])
            ->add('main_picture', FileType::class, [
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Supplement::class,
        ]);
    }
}
