<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [

                'label' => 'Role',
                'choices'  => [
                    // Libellé => Valeur
                    'Utilisateur' => 'ROLE_USER',
                    'Gestionnaire' => 'ROLE_MANAGER',
                    'Administrateur' => 'ROLE_ADMIN',
                ],
                // Choix multiple => Tableau 
                'multiple' => true,
                // On veut des checkboxes 
                'expanded' => true,
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
            ])
            ->add('postal_code', TextType::class, [
                'label' => 'Code Postal',
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
            ])
            ->add('phone_number', TextType::class, [
                'label' => 'Téléphone',
            ])
            ->add('newsletter')
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
                // ici on recupere le form depuis l'event (car on va bosser avec)
                $form = $event->getForm();
                // ici on recupere le user mappé sur le form depuis l'event 
                $user = $event->getData();
                if ($user->getId() !== NULL) {
                    // Edit
                    $form->add('password', PasswordType::class, [
                        'mapped' => false,
                        'attr' => [
                            'placeholder' => 'Laissez vide si inchangé'
                        ],
                        ]);
                } else {
                    // New
                    $form->add('password', null, [
                        // En cas d'erreur du type
                        // Expected argument of type "string", "null" given at property path "password".
                        // (notamment à l'edit en cas de passage d'une valeur existante à vide)
                        'empty_data' => '',
                        'help' => 'Make sure it\'s at least 8 characters including a number and a lowercase letter and a special character.',
                        // On déplace les contraintes de l'entité vers le form d'ajout
                        'constraints' => [
                            new NotBlank(),
                            new Regex(
                                "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"
                            ),
                        ],
                    ]);
                }
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
