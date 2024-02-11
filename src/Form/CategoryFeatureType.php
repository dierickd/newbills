<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Feature;
use App\Repository\CategoryRepository;
use App\Repository\FeatureRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryFeatureType extends AbstractType
{
    public function __construct(private readonly FeatureRepository $featureRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', EntityType::class, [
                'label' => 'Catégorie',
                'label_attr' => ['class' => 'form-label'],
                'class' => Category::class,
                'choice_label' => 'name',
                'query_builder' => function (CategoryRepository $categoryRepository) {
                    return $categoryRepository->findAllOrderedByAscNameQueryBuilder();
                },
                'required' => false,
                'placeholder' => 'Selectionner une catégorie',
                'attr' => [
                    'class' => 'form-select'
                ],
            ]);

        $formModifier = function (FormInterface $form, Category $category = null) {
            $features = $category === null ? [] : $this->featureRepository->findByFeatureOrderedByAscName($category);

            $form->add('name', EntityType::class, [
                'class' => Feature::class,
                'choice_label' => 'name',
                'label' => 'Fonctionnalité',
                'label_attr' => ['class' => 'form-label'],
                'disabled' => empty($features),
                'placeholder' => empty($features) ? 'Aucune fonctionnalités trouvées' : 'Selectionner une fonctionnalité',
                'choices' => $features,
                'attr' => [
                    'placeholder' => 'Fonctionnalité',
                    'class' => 'form-select'
                ]
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();
                $formModifier($event->getForm(), $data->getCategory());
            });

        $builder->get('category')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $category = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $category);
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Feature::class,
        ]);
    }
}
