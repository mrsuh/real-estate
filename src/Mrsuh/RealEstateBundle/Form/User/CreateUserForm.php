<?php namespace Mrsuh\RealEstateBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateUserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text');
        $builder->add('first_name', 'text', ['required' => false]);
        $builder->add('last_name', 'text', ['required' => false]);
        $builder->add('middle_name', 'text', ['required' => false]);
        $builder->add('phone', 'text', ['required' => false]);
        $builder->add('email', 'text');

        $builder->add('submit', 'submit', array('label' => 'Создать',));
    }

    public function getName()
    {
        return 'createUser';
    }
}
