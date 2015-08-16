<?php namespace Mrsuh\RealEstateBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateUserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', ['attr' => ['placeholder' => 'username']]);
        $builder->add('first_name', 'text', ['required' => false, 'attr' => ['placeholder' => 'Имя']]);
        $builder->add('last_name', 'text', ['required' => false,'attr' => ['placeholder' => 'Фамилия']]);
        $builder->add('middle_name', 'text', ['required' => false, 'attr' => ['placeholder' => 'Отчество']]);
        $builder->add('phone', 'text', ['required' => false, 'attr' => ['placeholder' => '8 999 214 43 42']]);
        $builder->add('email', 'text', ['attr' => ['placeholder' => 'mrsuh6@gmail.com']]);

        $builder->add('submit', 'submit', array('label' => 'Создать',));
    }

    public function getName()
    {
        return 'createUser';
    }
}
