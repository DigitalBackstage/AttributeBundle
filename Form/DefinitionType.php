<?php

namespace Padam87\AttributeBundle\Form;

use Padam87\AttributeBundle\Entity\Definition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DefinitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
        ));
        $builder->add('description', 'textarea', array(
            'required' => false
        ));
        $builder->add('type', 'choice', array(
            'choices' => array(
                Definition::TYPE_TEXT => 'Text',
                Definition::TYPE_TEXTAREA => 'Textarea',
                Definition::TYPE_CHOICE => 'Select',
                Definition::TYPE_CHECKBOX => 'Checkbox',
                Definition::TYPE_RADIO => 'Radio'
            )
        ));
        $builder->add('options', 'collection', array(
                        'type'          => new OptionType(),
                        'allow_add'     => true,
                        'allow_delete'  => true,
                        'prototype'     => true,
                        'by_reference'  => false,
                        'options'       => array()));
        $builder->add('unit', 'text', array(
            'required' => false
        ));
        $builder->add('required', 'checkbox', array(
            'required' => false
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Padam87\AttributeBundle\Entity\Definition',
        ));
    }

    public function getName()
    {
        return 'definition';
    }
}
