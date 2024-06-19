<?php

namespace App\Form;
// Définit l'espace de nommage pour le formulaire de contact.

use App\Entity\Contact;
// Importe la classe Contact pour la configuration des options du formulaire.

use Symfony\Component\Form\AbstractType;
// Importe la classe de base AbstractType pour la création du formulaire.

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
// Importe les types de champs de formulaire nécessaires.

use Symfony\Component\Form\FormBuilderInterface;
// Importe l'interface FormBuilderInterface pour la construction du formulaire.

use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;  // Importation des contraintes de validation

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', TextType::class, [
                'label' => 'Nom de la marque/du créateur',
                'attr' => ['class' => 'w3-input w3-border'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le nom de la marque/du créateur est obligatoire.'])
                ]
            ])
            ->add('website', UrlType::class, [
                'label' => 'Site web (si applicable)',
                'required' => false,
                'attr' => ['class' => 'w3-input w3-border']
            ])
            ->add('socialMedia', TextType::class, [
                'label' => 'Réseaux sociaux',
                'attr' => ['class' => 'w3-input w3-border']
            ])
            ->add('collectionDescription', TextareaType::class, [
                'label' => 'Description de la collection',
                'attr' => ['class' => 'w3-input w3-border']
            ])
            ->add('desiredDates', DateTimeType::class, [
                'label' => 'Date(s) souhaitée(s) pour le défilé',
                'widget' => 'single_text',
                 // Utilisation des contrôles HTML5
                'attr' => ['class' => 'w3-input w3-border'], // Assurez-vous de spécifier le type correct
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date doit être aujourd\'hui ou une date future.'
                    ])
                ]
            ])
            ->add('concept', TextareaType::class, [
                'label' => 'Thème ou concept du défilé',
                'attr' => ['class' => 'w3-input w3-border']
            ])
            ->add('outfitCount', IntegerType::class, [
                'label' => 'Nombre approximatif de tenues à présenter',
                'attr' => ['class' => 'w3-input w3-border'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Veuillez indiquer le nombre de tenues.'])
                ]
            ])
            ->add('technicalRequirements', TextareaType::class, [
                'label' => 'Exigences techniques',
                'required' => false,
                'attr' => ['class' => 'w3-input w3-border']
            ])
            ->add('budget', IntegerType::class, [
                'label' => 'Budget estimé pour le défilé virtuel',
                'attr' => ['class' => 'w3-input w3-border']
            ])
            ->add('additionalInformation', TextareaType::class, [
                'label' => 'Autres informations',
                'required' => false,
                'attr' => ['class' => 'w3-input w3-border']
            ])
            ->add('consent', CheckboxType::class, [
                'label' => 'J\'accepte que mes informations soient utilisées pour le traitement de ma demande.',
                'required' => true,
                'constraints' => [
                    new Assert\IsTrue(['message' => 'Vous devez accepter les conditions pour continuer.'])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
