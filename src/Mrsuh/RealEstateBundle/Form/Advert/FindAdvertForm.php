<?php namespace Mrsuh\RealEstateBundle\Form\Advert;

use Mrsuh\RealEstateBundle\C;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FindAdvertForm extends AbstractType
{

    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('price_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от']]);
        $builder->add('price_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до']]);

        $builder->add('meter_price_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'] ]);
        $builder->add('meter_price_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'] ]);

        $builder->add('room_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'] ]);
        $builder->add('room_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'] ]);

        $builder->add('common_area_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'] ]);
        $builder->add('common_area_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'] ]);

        $builder->add('live_area_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'] ]);
        $builder->add('live_area_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'] ]);

        $builder->add('kitchen_area_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'] ]);
        $builder->add('kitchen_area_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'] ]);

        $builder->add('section_area_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'] ]);
        $builder->add('section_area_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'] ]);

        $builder->add('floor_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'] ]);
        $builder->add('floor_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'] ]);

        $builder->add('floors_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'] ]);
        $builder->add('floors_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'] ]);

        $builder->add('build_year_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'] ]);
        $builder->add('build_year_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'] ]);

        $builder->add('search_string_type', 'choice', ['choices' => [C::OBJECT_NUMBER => 'Номер объекта', C::PHONE_NUMBER => 'Номер телефона', C::STREET_NAME => 'Улица', C::LANDMARK  => 'Ориентир', C::DESCRIPTION => 'Описание' ]]);
        $builder->add('search_string_string', 'text', ['required' => false, 'attr' => ['placeholder' => 'введите строку для поиска'] ]);

        $builder->add('object_type', 'choice', ['choices' => $this->params['object_type'], 'multiple' => true, 'expanded' => true, 'required' => false]);
        $builder->add('object_state', 'choice', ['choices' => $this->params['object_state'], 'multiple' => true, 'expanded' => true, 'required' => false]);
        $builder->add('object_wall', 'choice', ['choices' => $this->params['object_wall'], 'multiple' => true, 'expanded' => true, 'required' => false]);

        $builder->add('object_city', 'choice', ['choices' => $this->params['object_city'], 'required' => false, 'placeholder' => 'Город']);

        $builder->add('object_region_city', 'collection', [
            'type'   =>  'checkbox',
            'label' => false,
            'allow_add'    => true,
            'allow_delete' => true,
            'data' => [],
            'required' => false
        ]);

        $builder->add('not_first_floor', 'checkbox', ['required' => false]);
        $builder->add('not_last_floor', 'checkbox',['required' => false]);

        $builder->add('pagination_items_on_page', 'choice', ['choices' => [20 => 20, 50 => 50, 100 => 100], 'required' => true]);
        $builder->add('pagination_page', 'hidden', ['data' => 1]);

        $builder->add('advert_type', 'choice', ['choices' => $this->params['advert_type'], 'required' => false, 'placeholder' => 'Тип объявления']);
        $builder->add('advert_user', 'choice', ['choices' => $this->params['advert_user'], 'required' => false, 'placeholder' => 'Автор']);
        $builder->add('advert_status', 'choice', ['choices' => [C::STATUS_ADVERT_ACTIVE => 'активно', C::STATUS_ADVERT_NOT_ACTIVE => 'не активно', C::STATUS_ADVERT_DELETED => 'архив', C::STATUS_ADVERT_NO_RESPONSE => 'нет связи', C::STATUS_ADVERT_RECALL => 'перезвонить'], 'placeholder' => 'Cтатус', 'required' => false]);

        $builder->add('order_field', 'hidden');
        $builder->add('order_type', 'hidden', ['data' => C::ORDER_TYPE_DESC]);

        $builder->add('search', 'submit', array('label' => 'Искать'));
    }

    public function getName()
    {
        return 'findAdvert';
    }
}
