<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\Email;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse Email',
                'attr'=> [
                'placeholder' => "Email",
                ],
                'constraints' => [
                    new Email(),
                    
                ],
                    
                
            ])

            ->add('username', TextType::class, [
                'label' => 'Nom d\'utilisateur',
                'attr'=> [
                'placeholder' => "Nom d'utilisateur",
                ],
            ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => new NotBlank(),
                'first_options'  => array('label' => 'Mot de passe', 'attr' => ['placeholder' => "Mot de passe"]),
                'second_options' => array('label' => 'Répéter le mot de passe', 'attr'=> [
                    'placeholder' => "Répétez votre mot de passe"]),
                'invalid_message' => 'Vous n\'avez pas le même mot de passe.',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
