<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;  // Importation des contraintes de validation
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;



class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TextType::class, [
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le prénom est obligatoire.']),
                new Regex([
                    'pattern' => '/^[a-zA-Z]+$/', 
                    'message' => 'Utilisez uniquement des lettres.'
                ])
            ],
            'label' => 'Prénom',
            'attr' => ['class' => 'w3-input w3-border']
        ])
            ->add('name', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le nom est obligatoire.']),
                    new Assert\Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Le nom doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères.'
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z]+$/', 
                        'message' => 'Utilisez uniquement des lettres.'
                    ])
                ],
                'label' => 'Nom',
                'attr' => ['class' => 'w3-input w3-border']
            ])
            ->add('email', TextType::class, [
                'label' => 'Adresse e-mail',
                'attr' => ['class' => 'w3-input w3-border'],
                'constraints' => [
                    new Assert\Email(['message' => 'Veuillez entrer une adresse e-mail valide.']),
                    new Assert\NotBlank(['message' => 'L\'adresse e-mail est obligatoire.'])
                ]
            ])
            ->add('adress', TextType::class, [
                'label' => 'Adresse',
                'attr' => ['class' => 'w3-input w3-border'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'L\'adresse est obligatoire.'])
                ]
            ])
            ->add('phoneNumber', IntegerType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => ['class' => 'w3-input w3-border'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le numéro de téléphone est obligatoire.']),
                    new Assert\Regex([
                        'pattern' => '/^\+?[0-9]{7,15}$/',
                        'message' => 'Veuillez entrer un numéro de téléphone valide.'
                    ])
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe',
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
