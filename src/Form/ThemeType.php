<?php

namespace App\Form;

use App\Entity\Themes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ThemeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule', TextType::class,[
                'label'=> 'Nom de l\'activité d\'anniversaire',
                'attr' => ['placeholder' => 'Tapez le nom de l\'activité']
            ])
            ->add('descriptif', TextareaType::class, [
                'label'=> 'Description de l\'activité',
                'attr' => ['placeholder' => 'Tapez la description de l\'activité']
            ])
            ->add('duree', TextType::class, [
                'label'=> 'Durée de l\'activité',
                'attr' => ['placeholder' => 'Tapez le temsp']
            ])
            ->add('prix', MoneyType::class,[
                'label'=> 'Prix du Theme',
                'attr' => ['placeholder' => 'Tapez la prix']
            ])
            ->add('age_min', TextType::class, [
                'label'=> 'Nombre d\'enfants mini',
                'attr' => ['placeholder' => 'Enfants Min']
            ])
            ->add('age_max', TextType::class, [
                'label'=> 'Nombre d\'enfants mini',
                'attr' => ['placeholder' => 'Enfants Min']
            ])
            ->add('nbenfant_min', TextType::class, [
                'label'=> 'Age d\'enfants mini',
                'attr' => ['placeholder' => 'Age Min']
            ])
            ->add('nbenfant_max', TextType::class, [
                'label'=> 'Age d\'enfants min',
                'attr' => ['placeholder' => 'Age Max']
            ])
            ->add('image' , TextType::class, [
                'label'=> 'Nom de l\'image (changer)',
                'attr' => ['placeholder' => 'Img']
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
