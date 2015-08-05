<?php namespace Mrsuh\RealEstateBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EditUserForm extends AbstractType
{

    private $profile;

    public function __construct($profile)
    {
        $this->profile = $profile;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', ['attr' =>['value' => $this->profile['username']]]);
        $builder->add('first_name', 'text', ['attr' =>['value' => $this->profile['first_name']]]);
        $builder->add('last_name', 'text', ['attr' =>['value' => $this->profile['last_name']]]);
        $builder->add('middle_name', 'text', ['attr' =>['value' => $this->profile['middle_name']]]);
        $builder->add('phone', 'text', ['attr' =>['value' => $this->profile['phone']]]);
        $builder->add('email', 'text', ['attr' =>['value' => $this->profile['email']]]);
        $builder->add('password', 'password', ['required' => false]);

        $builder->add('submit', 'submit', array('label' => 'Сохранить',));
    }

    public function getName()
    {
        return 'editUser';
    }
}
