<?php namespace Mrsuh\RealEstateBundle\Form\Advert;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateAdvertForm extends AbstractType
{
    private $advert;

    public function __construct($advert)
    {
        $this->advert = $advert;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('seller_name', 'text');
        $builder->add('seller_phone', 'text');
        $builder->add('description', 'textarea');
        $builder->add('comment', 'textarea');
        $builder->add('expire_time', 'text');
        $builder->add('exclusive', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);

        $builder->add('object_type', 'choice', ['choices' => $this->advert['type']]);
        $builder->add('object_state', 'choice', ['choices' => $this->advert['state']]);
        $builder->add('object_wall', 'choice', ['choices' => $this->advert['wall']]);
        $builder->add('object_room_number', 'text');
        $builder->add('object_common_area', 'text');
        $builder->add('object_live_area', 'text');
        $builder->add('object_kitchen_area', 'text');
        $builder->add('object_section_area', 'text');
        $builder->add('object_floor', 'text');
        $builder->add('object_floors', 'text');
        $builder->add('object_build_year', 'text');
        $builder->add('object_watter_supply', 'choice', ['choices' => $this->advert['water_supply']]);
        $builder->add('object_heating', 'choice', ['choices' => $this->advert['heating']]);
        $builder->add('object_new_house', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);
        $builder->add('object_wc', 'choice', ['choices' => $this->advert['wc']]);
        $builder->add('object_balcony', 'choice', ['choices' => $this->advert['balcony']]);
        $builder->add('object_mortgage', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);

        $builder->add('object_region', 'choice', ['choices' => $this->advert['region']]);
        $builder->add('object_city', 'choice', ['choices' => $this->advert['city']]);
        $builder->add('object_city_region', 'choice', ['choices' => $this->advert['region_city']]);
        $builder->add('object_street', 'choice', ['choices' => $this->advert['street']]);
        $builder->add('object_house', 'text');
        $builder->add('object_flat', 'text');
        $builder->add('object_landmark', 'textarea');

        $builder->add('submit', 'submit', array('label' => 'Создать',));
    }

    public function getName()
    {
        return 'editProfile';
    }
}
