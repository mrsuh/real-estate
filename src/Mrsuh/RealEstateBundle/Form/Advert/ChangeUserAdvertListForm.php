<?php namespace Mrsuh\RealEstateBundle\Form\Advert;

use Mrsuh\RealEstateBundle\C;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ChangeUserAdvertListForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('order_field', 'hidden');
        $builder->add('order_type', 'hidden', ['data' => C::ORDER_TYPE_DESC]);

        $builder->add('search', 'submit', array('label' => 'Искать'));
    }

    public function getName()
    {
        return 'changeUserAdvertList';
    }
}
