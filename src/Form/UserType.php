<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['data'] ?? null;
        $isEdit = $user && $user->getId();

        $builder
            ->add('firstname', null, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-control',
                ],
                'disabled' => $isEdit,
            ])
            ->add('lastname', null, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control',
                ],
                'disabled' => $isEdit,
            ])
            ->add('email', null, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control',
                ],
                'disabled' => $isEdit,
            ]);

        if (!$isEdit) {
            $builder->add('password', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'label' => '******'
                ],
                ]);
        }

        $builder->add('roles', ChoiceType::class, [
            'multiple' => true,
            'expanded' => true,
            'choices' => [
                'Admin' => 'ROLE_ADMIN',
            ],
            'label' => 'Roles de l\'utilisateur',
            'attr' => [
                'class' => 'form-control',
            ],
        ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => function (Location $location) {
                    return sprintf(
                        '%s - %s - %s',
                        $location->getCity(),
                        $location->getCountry(),
                        $location->getDistrict()
                    );
                },
                'label' => 'Emplacement',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
