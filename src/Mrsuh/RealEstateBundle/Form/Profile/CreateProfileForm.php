<?php namespace Mrsuh\RealEstateBundle\Form\Profile;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EditProfileForm extends AbstractType
{

    private $profile;

    public function __construct($profile)
    {
        $this->profile = $profile;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text');
        $builder->add('first_name', 'text');
        $builder->add('last_name', 'text');
        $builder->add('middle_name', 'text');
        $builder->add('phone', 'text');
        $builder->add('email', 'text');
        $builder->add('password', 'password');

        $builder->add('submit', 'submit', array('label' => 'Сохранить',));
    }

    public function getName()
    {
        return 'editProfile';
    }
}
