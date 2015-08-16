<?php namespace Mrsuh\RealEstateBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EditUserForm extends AbstractType
{

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', ['attr' =>['value' => $this->user->getUsername(), 'placeholder' => 'username']]);
        $builder->add('first_name', 'text', ['attr' =>['value' => $this->user->getFirstName(), 'placeholder' => 'Имя'], 'required' => false]);
        $builder->add('last_name', 'text', ['attr' =>['value' => $this->user->getlastName(), 'placeholder' => 'Фамилия'], 'required' => false]);
        $builder->add('middle_name', 'text', ['attr' =>['value' => $this->user->getMiddleName(), 'placeholder' => 'Отчество'], 'required' => false]);
        $builder->add('phone', 'text', ['attr' =>['value' => $this->user->getPhone(), 'placeholder' => '8 999 214 43 42'], 'required' => false]);
        $builder->add('email', 'text', ['attr' =>['value' => $this->user->getEmail(), 'placeholder' => 'mrsuh6@gmail.com']]);
        $builder->add('password', 'password', ['required' => false, 'attr' => ['placeholder' => '******']]);

        $builder->add('user_save', 'submit', array('label' => 'Сохранить',));
        $builder->add('user_delete', 'submit', array('label' => 'Удалить',));
    }

    public function getName()
    {
        return 'editUser';
    }
}
