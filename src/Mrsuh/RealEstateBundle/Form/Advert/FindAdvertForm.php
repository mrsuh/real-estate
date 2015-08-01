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
        $builder->add('price_from', 'text', ['required' => false ]);
        $builder->add('price_to', 'text', ['required' => false ]);

        $builder->add('meter_price_from', 'text', ['required' => false ]);
        $builder->add('meter_price_to', 'text', ['required' => false ]);

        $builder->add('room_from', 'text', ['required' => false ]);
        $builder->add('room_to', 'text', ['required' => false ]);

        $builder->add('common_area_from', 'text', ['required' => false ]);
        $builder->add('common_area_to', 'text', ['required' => false ]);

        $builder->add('live_area_from', 'text', ['required' => false ]);
        $builder->add('live_area_to', 'text', ['required' => false ]);

        $builder->add('kitchen_area_from', 'text', ['required' => false ]);
        $builder->add('kitchen_area_to', 'text', ['required' => false ]);

        $builder->add('section_area_from', 'text', ['required' => false ]);
        $builder->add('section_area_to', 'text', ['required' => false ]);

        $builder->add('floor_from', 'text', ['required' => false ]);
        $builder->add('floor_to', 'text', ['required' => false ]);

        $builder->add('floors_from', 'text', ['required' => false ]);
        $builder->add('floors_to', 'text', ['required' => false ]);

        $builder->add('build_year_from', 'text', ['required' => false ]);
        $builder->add('build_year_to', 'text', ['required' => false ]);

        $builder->add('period_from', 'text', ['required' => false ]);
        $builder->add('period_to', 'text', ['required' => false ]);

        $builder->add('period_all_time', 'choice', ['choices' => [1 => 'да', 0 => 'нет']]);


        $builder->add('search_string_type', 'choice', ['choices' => [C::HOUSE_NUMBER => 'Номер объекта', C::PHONE_NUMBER => 'Номер телефона', C::STREET_NAME => 'Улица', C::LANDMARK  => 'Ориентир', C::DESCRIPTION => 'Описание' ], 'multiple' => true, 'expanded' => false]);
        $builder->add('search_string_string', 'text', ['required' => false ]);

        $builder->add('object_type', 'choice', ['choices' => $this->params['object_type'], 'multiple' => true, 'expanded' => false]);
        $builder->add('object_state', 'choice', ['choices' => $this->params['object_state'], 'multiple' => true, 'expanded' => false]);
        $builder->add('object_wall', 'choice', ['choices' => $this->params['object_wall'], 'multiple' => true, 'expanded' => false]);

        $builder->add('object_region', 'choice', ['choices' => $this->params['object_region']]);
        $builder->add('object_city', 'choice', ['choices' => $this->params['object_city']]);
        $builder->add('object_region_city', 'choice', ['choices' => $this->params['object_region_city'], 'multiple' => true, 'expanded' => false]);

        $builder->add('object_not_first_floor', 'choice', ['choices' => [1 => 'да', 0 => 'нет']]);
        $builder->add('object_not_last_floor', 'choice', ['choices' => [1 => 'да', 0 => 'нет']]);

        $builder->add(C::SEARCH_STRING, 'submit', array('label' => 'Искать'));
        $builder->add(C::SEARCH_EXTENSION, 'submit', array('label' => 'Искать'));
        $builder->add(C::SEARCH_PERIOD, 'submit', array('label' => 'Искать'));
    }

    public function getName()
    {
        return 'findAdvert';
    }
}
