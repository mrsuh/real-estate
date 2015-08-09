<?php namespace Mrsuh\RealEstateBundle\Form\Client;

use Mrsuh\RealEstateBundle\C;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FindClientForm extends AbstractType
{
    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('status', 'choice', ['choices' => [
            C::STATUS_CLIENT_IN_WORK => 'В работе',
            C::STATUS_CLIENT_TEMPORARY_SUSPENDED => 'Временно приостановил поиск',
            C::STATUS_CLIENT_BOUGHT_WITH_US => 'Купил в нашем агенстве',
            C::STATUS_CLIENT_BOUGHT_HIMSELF => 'Купил самостоятельно',
            C::STATUS_CLIENT_BLACK_LIST => 'Черный список'
        ], 'required' => false, 'placeholder' => 'Статус']);

        $builder->add('user', 'choice', ['choices' => $this->params['user'], 'required' => false, 'placeholder' => 'Специалист']);
        $builder->add('phone', 'text', ['required' => false, 'attr' => ['placeholder' => 'телефон']]);

        $builder->add('pagination_items_on_page', 'choice', ['choices' => [2 => 2, 20 => 20, 50 => 50, 100 => 100], 'required' => true]);
        $builder->add('pagination_page', 'hidden', ['data' => 1]);

        $builder->add('order_field', 'hidden');
        $builder->add('order_type', 'hidden', ['data' => C::ORDER_TYPE_DESC]);

        $builder->add('submit', 'submit', array('label' => 'Поиск'));
    }

    public function getName()
    {
        return 'findClient';
    }
}
