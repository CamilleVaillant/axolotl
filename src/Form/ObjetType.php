<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Objet;
use App\Entity\Special;
use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ObjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        

        $builder
            ->add('name')
            ->add('valeur')
            ->add('description')
            ->add('date', \Symfony\Component\Form\Extension\Core\Type\DateType::class, [
                'widget' => 'single_text', // Utilisation correcte de l'option widget
                'attr' => [
                    'class' => 'form-control', // Ajoute une classe CSS
                ],
            ])
            ->add('special', EntityType::class, [
                'class' => Special::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('imageFile', FileType::class, [
                'required' => false,
                'mapped' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' =>[
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader une image valide (JPEG, PNG, GIF,JPG).',
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Objet::class,
            
        ]);
    }
}
