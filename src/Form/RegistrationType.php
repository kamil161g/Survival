<?php


namespace App\Form;


use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('login', TextType::class,
                ['label' => 'Login',
                    'constraints' => new NotBlank([
                    'message' => 'To pole nie może być puste.']),

                'constraints' => new Length([
                    'min' => 3,
                    'minMessage' => 'Minimalna ilość znaków to 3.',
                    'max' => 21,
                    'maxMessage' => 'Maksymalna ilość znaków to 21.'])

            ])
            ->add('password', RepeatedType::class, array(
                'invalid_message' => 'Hasła nie są takie same.',
                'type' => PasswordType::class,
                'first_options'  => array('constraints'=> new NotBlank(['message' => 'Wypełnij pole Hasło.']),
                    'constraints' => new Length([
                        'min' => 8,
                        'minMessage' => 'Hasło nie może być krótsze niż 8 znaków.',
                        'max' => 24,
                        'maxMessage' => 'Haslo nie może być dłuższe niż 24 znaki.'
                    ]),
                    'label' => 'Hasło'),
                'second_options' => array(
                    'constraints'=> new NotBlank(['message' => 'Wypełnij pole Hasło.']),
                    'label' => 'Powtórz hasło'),
            ))
            ->add('email', EmailType::class,['label' => 'Email'])

            ->add('submit', SubmitType::class);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Users::class
            ]);
    }

}