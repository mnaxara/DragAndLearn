<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('label' => '<Email>', 'label_attr' => ['class' => 'balise']))
            ->add('username', TextType::class, array('label' => '<Pseudo>', 'label_attr' => ['class' => 'balise']))
            ->add('plainPassword', RepeatedType::class, [
                'type'              => PasswordType::class,
                'invalid_message'   => 'Password non confirmé',
                'first_options'      => ['label' => '<Mot de passe>', 'label_attr' => ['class' => 'balise']],
                'second_options'     => ['label' => '<Confirmer le mot de passe>', 'label_attr' => ['class' => 'balise']],
            ])
            // ->add('S\'inscrire', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
