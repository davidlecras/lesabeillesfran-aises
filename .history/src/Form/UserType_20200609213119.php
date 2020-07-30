<?php

namespace App\Form;

use App\Entity\User;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add(
        'name',
        TextType::class,
        [
          'label' => 'Votre prénom',
          'attr' => [
            'placeholder' => 'Indiquez votre prénom'
          ]
        ]
      )
      ->add(
        'surname',
        TextType::class,
        [
          'label' => 'Votre nom de famille',
          'attr' => [
            'placeholder' => 'Indiquez votre nom de famille'
          ]
        ]
      )
      ->add(
        'email',
        EmailType::class,
        [
          'label' => 'Votre e-mail',
          'attr' => [
            'placeholder' => 'Indiquez votre adresse e-mail'
          ]
        ]
      )
      ->add(
        'password',
        PasswordType::class,
        [
          'label' => 'Mot de passe',
          'attr' => [
            'placeholder' => 'Indiquez le même mot de passe'
          ]
        ]
      )
      ->add(
        'verifPassword',
        PasswordType::class,
        [
          'label' => 'Confirmation mot de passe',
          'attr' => [
            'placeholder' => 'Indiquez le même mot de passe'
          ]
        ]
      )
      ->add(
        'hasAcceptedThermsAndConditionsOfUse',
        CheckboxType::class,
        [
          'label' => 'J\'accepte les conditions d\'utilisation'
        ]
      )
      ->add('captchaCode', CaptchaType::class, array(
        'captchaConfig' => 'ExampleCaptchaUserRegistration',
        'constraints' => [
          new ValidCaptcha([
            'message' => 'Vous avez échoué. Veuillez réessayer',
          ]),
        ],
      ));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => User::class,
    ]);
  }
}
