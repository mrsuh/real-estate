<?php

namespace Mrsuh\RealEstateBundle\Entity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return $builder->add("file", "file");
    }

    public function getName()
    {
        return "filetype";
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mrsuh\RealEstateBundle\Entity\Advert\AdvertImage',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'intention' => 'file'
        ));
    }
}