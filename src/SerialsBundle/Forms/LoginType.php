<?php
/**
 * Created by PhpStorm.
 * User: NASA
 * Date: 2017-12-23
 * Time: 20:32
 */

namespace SerialsBundle\Forms;

use Symfony\Component\Form\AbstractType;
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
            ->add('submit',SubmitType::class,array(
                'label' => 'Submit'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }


}