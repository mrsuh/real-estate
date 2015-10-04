<?php namespace Mrsuh\RealEstateBundle\Form\Advert;

use Mrsuh\RealEstateBundle\C;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FindAdvertByClientForm extends AbstractType
{

    private $params;
    private $client;

    public function __construct($params, $client)
    {
        $this->params = $params;
        $this->client = $client;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('price_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'], 'data' => $this->client->getPriceFrom()]);
        $builder->add('price_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'], 'data' => $this->client->getPriceTo()]);

        $builder->add('meter_price_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от']]);
        $builder->add('meter_price_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до']]);

        $builder->add('room_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'], 'data' => $this->client->getRoomFrom() ]);
        $builder->add('room_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'], 'data' => $this->client->getRoomTo() ]);

        $builder->add('common_area_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'], 'data' => $this->client->getCommonAreaFrom() ]);
        $builder->add('common_area_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'], 'data' => $this->client->getCommonAreaTo() ]);

        $builder->add('live_area_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'], 'data' => $this->client->getLiveAreaFrom() ]);
        $builder->add('live_area_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'], 'data' => $this->client->getLiveAreaTo() ]);

        $builder->add('kitchen_area_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'], 'data' => $this->client->getKitchenAreaFrom() ]);
        $builder->add('kitchen_area_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'], 'data' => $this->client->getKitchenAreaTo() ]);

        $builder->add('section_area_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'], 'data' => $this->client->getSectionAreaFrom() ]);
        $builder->add('section_area_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'], 'data' => $this->client->getSectionAreaTo() ]);

        $builder->add('floor_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'], 'data' => $this->client->getFloorFrom() ]);
        $builder->add('floor_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'], 'data' => $this->client->getFloorTo() ]);

        $builder->add('floors_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'], 'data' => $this->client->getFloorsFrom() ]);
        $builder->add('floors_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'], 'data' => $this->client->getFloorsTo() ]);

        $builder->add('build_year_from', 'text', ['required' => false, 'attr' => ['placeholder' => 'от'] ]);
        $builder->add('build_year_to', 'text', ['required' => false, 'attr' => ['placeholder' => 'до'] ]);

        $builder->add('object_type', 'choice', ['choices' => $this->params['object_type'], 'multiple' => true, 'expanded' => true, 'required' => false, 'data' => [$this->client->getObjectType()->getId()]]);
        $builder->add('object_state', 'choice', ['choices' => $this->params['object_state'], 'multiple' => true, 'expanded' => true, 'required' => false ]);
        $builder->add('object_wall', 'choice', ['choices' => $this->params['object_wall'], 'multiple' => true, 'expanded' => true, 'required' => false ]);

        $builder->add('object_city', 'choice', ['choices' => $this->params['object_city'], 'required' => false, 'placeholder' => 'Город', 'data' => $this->client->getCity()->getId()]);

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

        $builder->add('order_field', 'hidden');
        $builder->add('order_type', 'hidden', ['data' => C::ORDER_TYPE_DESC]);

        $builder->add('advert_type', 'choice', ['choices' => $this->params['advert_type'], 'required' => false, 'placeholder' => 'Тип объявления']);
        $builder->add('advert_user', 'choice', ['choices' => $this->params['advert_user'], 'required' => false, 'placeholder' => 'Автор']);
        $builder->add('advert_status', 'choice', ['choices' => [C::STATUS_ADVERT_ACTIVE => 'активно', C::STATUS_ADVERT_NOT_ACTIVE => 'не активно', C::STATUS_ADVERT_DELETED => 'архив', C::STATUS_ADVERT_NO_RESPONSE => 'нет связи', C::STATUS_ADVERT_RECALL => 'перезвонить'], 'placeholder' => 'Cтатус', 'required' => false]);

        $builder->add('search', 'submit', array('label' => 'Искать'));
    }

    public function getName()
    {
        return 'findAdvertByClient';
    }
}
