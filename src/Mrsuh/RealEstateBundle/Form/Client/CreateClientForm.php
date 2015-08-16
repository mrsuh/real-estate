<?php namespace Mrsuh\RealEstateBundle\Form\Client;

use Mrsuh\RealEstateBundle\C;
use Mrsuh\RealEstateBundle\Entity\Advert\AdvertImage;
use Symfony\Component\Form\AbstractType;
use Mrsuh\RealEstateBundle\Entity\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateClientForm extends AbstractType
{
    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name1', 'text', ['required' => true, 'attr' => ['value' => null, 'placeholder' => 'Фамилия Имя Отчество']]);
        $builder->add('name2', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'Фамилия Имя Отчество']]);
        $builder->add('name3', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'Фамилия Имя Отчество']]);
        $builder->add('phone1', 'text', ['required' => true, 'attr' => ['value' => null, 'placeholder' => '8 999 214 43 42']]);
        $builder->add('phone2', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => '8 999 214 43 42']]);
        $builder->add('phone3', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => '8 999 214 43 42']]);

        $builder->add('comment', 'textarea', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'Комментарий']]);
        $builder->add('object_type', 'choice', ['choices' => $this->params['object_type']]);

        $builder->add('price_from', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'от']]);
        $builder->add('price_to', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'до']]);

        $builder->add('room_from', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'от']]);
        $builder->add('room_to', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'до']]);

        $builder->add('common_area_from', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'от']]);
        $builder->add('common_area_to', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'до']]);

        $builder->add('live_area_from', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'от']]);
        $builder->add('live_area_to', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'до']]);

        $builder->add('kitchen_area_from', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'от']]);
        $builder->add('kitchen_area_to', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'до']]);

        $builder->add('section_area_from', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'от']]);
        $builder->add('section_area_to', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'до']]);

        $builder->add('floor_from', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'от']]);
        $builder->add('floor_to', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'до']]);

        $builder->add('floors_from', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'от']]);
        $builder->add('floors_to', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => 'до']]);

        $builder->add('birth_day', 'text', ['required' => false, 'attr' => ['value' => null, 'placeholder' => '10.04.1991']]);
        $builder->add('status', 'choice', ['choices' => [
            C::STATUS_CLIENT_IN_WORK => 'В работе',
            C::STATUS_CLIENT_TEMPORARY_SUSPENDED => 'Временно приостановил поиск',
            C::STATUS_CLIENT_BOUGHT_WITH_US => 'Купил в нашем агенстве',
            C::STATUS_CLIENT_BOUGHT_HIMSELF => 'Купил самостоятельно',
            C::STATUS_CLIENT_BLACK_LIST => 'Черный список'
        ]]);

        $builder->add('mortgage', 'choice', ['choices' => [1 => 'да', 0 => 'нет']]);
        $builder->add('hot', 'choice', ['choices' => [1 => 'да', 0 => 'нет']]);

        $builder->add('city', 'choice', ['choices' => $this->params['city']]);

        $builder->add('region_city', 'collection', [
            'type'   =>  'checkbox',
            'label' => false,
            'allow_add'    => true,
            'allow_delete' => true,
            'data' => [],
            'required' => false
        ]);

        $builder->add('submit', 'submit', array('label' => 'Создать'));
    }

    public function getName()
    {
        return 'createClient';
    }
}
