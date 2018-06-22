<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, ['required' => false])
            ->add('surname',TextType::class, ['required' => false] )
            ->add('email',EmailType::class, ['required' => false])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password'],
                'mapped' => false,
                'constraints' => [new NotBlank(), new Regex("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/"),  new Length(['min' => 8]),]
               ])
            ->add('termsAccepted', CheckboxType::class, array('mapped' => false, 'constraints' => new IsTrue(),
                )
            );
    }
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => User::class,
//        ));
//    }
}