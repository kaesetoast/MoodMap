<?php

namespace MoodMap\MapBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RecommendationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('image')
        ;
    }

    public function getName()
    {
        return 'moodmap_mapbundle_recommendationtype';
    }
}
