<?php

namespace MoodMap\MapBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TagType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('recommendations')
        ;
    }

    public function getName()
    {
        return 'moodmap_mapbundle_tagtype';
    }
}
