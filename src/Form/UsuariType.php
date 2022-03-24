<?php

namespace App\Form;

use App\Entity\Usuari;
use Doctrine\DBAL\Types\BooleanType;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuariType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('username', TextType::class)
            ->add('password', TextType::class)
            ->add('validat', CheckboxType::class,array('required' => false))

            ->add('save', SubmitType::class, array('label' => $options['submit']));

    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults([
            // Configure your form options here
            'submit' => 'Enviar',
        ]);

    }


}

