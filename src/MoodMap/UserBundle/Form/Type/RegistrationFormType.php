<?php
namespace MoodMap\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType {
    public function buildForm(FormBuilder $builder, array $options) {
        $builder
            ->add('username', null, array('label' => 'Penis'))
            ->add('email', 'email', array('label' => 'Hure'))
            ->add('plainPassword', 'repeated', array('type' => 'password', 'label' => 'Lurch'));
    }

    public function getName() {
        return 'moodmap_user_registration';
    }
}
