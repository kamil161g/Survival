<?php


namespace App\Form;


use App\Entity\Village;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateNewVillageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nazwa wioski :',
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Stwórz Wioskę'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver
            ->setDefaults([
                'data_class' => Village::class
            ]);
    }


}