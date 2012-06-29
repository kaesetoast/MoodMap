<?php

namespace MoodMap\MapBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MoodWordType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('word')
            ->add('colors')
        ;
    }

    public function getName()
    {
        return 'moodmap_mapbundle_moodwordtype';
    }
}
