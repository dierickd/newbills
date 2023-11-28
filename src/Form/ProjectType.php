<?php

namespace App\Form;

use App\Entity\Application;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
//            ->add('created_at')
            ->add('description')
//            ->add('status')
//            ->add('expert')
//            ->add('confirmed')
//            ->add('junior')
//            ->add('selected')
//            ->add('slug')
            ->add('application', EntityType::class, ['class' => Application::class, 'choice_label' => 'name'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
