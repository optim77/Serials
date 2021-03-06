<?php
/**
 * Created by PhpStorm.
 * User: NASA
 * Date: 2017-12-23
 * Time: 20:32
 */

namespace SerialsBundle\Forms;

use SerialsBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{

    public function getBlockPrefix()
    {
        return null;
    }

    public function getName(){
        return 'lognType';
    }

    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username',TextType::class,array(
                'label' => 'Username'
            ))
            ->add('_password',PasswordType::class,array(
                'label' => 'Password'
            ))
            ->add('_remember_me',CheckboxType::class,array(
                'label' => 'Remember me',
                'required' => false
            ))
            ->add('submit',SubmitType::class,array(
                'label' => 'Log in'
            ));
    }

    public function setDefaultOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => User::class
        ));
    }


}