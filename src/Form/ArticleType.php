<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr'=> [
                    'placeholder' => "Titre de l'article",
                ]
                ])

            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
                'attr'=> [
                    'placeholder' => "Categorie de l'article",
                ]
            ])

            ->add('content', TextType::class,[
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Nombre de caractere insuffisants {{ limit }}'
                    ])
                    ],
                'attr'=> [
                    'placeholder' => "Contenu de l'article"
                    ]
                
            ])

            ->add('image', FileType::class,[
               // 'data_class' => null,
                'label' => 'Image (jpg, png, gif)',
                'attr'=> [
                    'placeholder' => "Photo de l'article"
                    ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
