<?php


namespace App\Form;

use App\Entity\Example;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ExampleType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'firstName',
                TextType::class,
                [
                    'constraints' => [new NotBlank()],
                ]
            )
            ->add(
                'lastName',
                TextType::class,
                [
                    'constraints' => [new NotBlank()],
                ]
            )
            ->add(
                'username',
                TextType::class,
                [
                    'required' => true,
                    'constraints' => [
                        new Length(['min' => 4, 'max' => 40])
                    ]
                ]
            )
            ->add(
                'password',
                PasswordType::class,
                [
                    'required' => true,
                    'constraints' => [
                        new Length(['min' => 4])
                    ]
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'required' => true,
                    'constraints' => [
                        new NotBlank(),
                        new Email()
                    ]
                ]
            );
    }

    public function getCustomConfigureOptions()
    {
        return [
            'data_class' => Example::class,
        ];
    }
}
