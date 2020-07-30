<?php

namespace App\Form;

use App\Entity\Beekeeper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BeekeeperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom de l'appiculteur",
                'attr' => [
                    'placeholder' => 'Entrer le nom de l\'appiculteur'
                ]
            ])
            ->add('region', TextType::class, [
                'label' => "Région",
                'attr' => [
                    'placeholder' => 'Entrer le département et la région'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => "Description",
            ])
            ->add('imageFile', FileType::class, [
                'required' => false,
                'label' => "Ajouter une image"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Beekeeper::class,
        ]);
    }
}
