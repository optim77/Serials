<?php
/**
 * Created by PhpStorm.
 * User: NASA
 * Date: 2017-12-24
 * Time: 12:16
 */

namespace SerialsBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use SerialsBundle\Entity\User;

class RegisterType extends AbstractType
{

    public function getBlockPrefix()
    {
        return null;
    }

    public function getName(){
        return 'registryType';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',TextType::class,array(
                'label' => 'Email'
            ))
            ->add('username', TextType::class,array(
                'label' => 'Username'
            ))
            ->add('plainPassword',RepeatedType::class,array(
                'type'=> PasswordType::class,
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat password')
            ))
            ->add('submit',SubmitType::class,array(
                'label' => 'Sing in'
            ));
    }

    public function setDefaultOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => User::class
        ));
    }

}