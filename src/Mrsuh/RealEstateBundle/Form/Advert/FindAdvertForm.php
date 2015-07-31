<?php namespace Mrsuh\RealEstateBundle\Form\Advert;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FindAdvertForm extends AbstractType
{

    private $advert;

    public function __construct($advert)
    {
        $this->advert = $advert;
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


        $builder->add('submit', 'submit', array('label' => 'Поиск'));
    }

    public function getName()
    {
        return 'findAdvert';
    }
}
