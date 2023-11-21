<?php

namespace App\Form;

use App\DTO\SearchDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('search', SearchType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher un projet',
                    'class' => 'form-control search-input',
                ]
            ])
            ->add('active', CheckboxType::class, [
                'required' => false,
                'label' => 'Projets actifs',
                'attr' => [
                    'class' => 'form-check-input',
                    'id' => 'active'
                ]
            ])
            ->add('closed', CheckboxType::class, [
                'required' => false,
                'label' => 'Projets fermés',
                'attr' => [
                    'class' => 'form-check-input',
                    'id' => 'closed'
                ]
            ])
            ->add('archived', CheckboxType::class, [
                'required' => false,
                'label' => 'Projets archivés',
                'attr' => [
                    'class' => 'form-check-input',
                    'id' => 'archived'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchDTO::class,
        ]);
    }
}
