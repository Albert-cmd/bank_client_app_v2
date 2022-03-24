<?php

namespace App\Form;

use App\Entity\Usuari;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\Client;

class ClientType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add('id',TextType::class)
            ->add('dni', TextType::class)
            ->add('nom', TextType::class)
            ->add('dataN', TextType::class)
            ->add('compte', EntityType::class)
            ->add('usuari', EntityType::class,array('class' => Usuari::class,'choice_label' => 'username'))

            ->add('client', EntityType::class, array('class' => Client::class,'choice_label' => 'nom'))
            ->add('save', SubmitType::class, array('label' => $options['submit']))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults([
            // Configure your form options here
            'submit' => 'Enviar',
        ]);

    }


}

