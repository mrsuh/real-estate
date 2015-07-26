<?php namespace Mrsuh\RealEstateBundle\Form\Advert;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateAdvertForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('seller_name', 'text');
        $builder->add('seller_phone', 'text');
        $builder->add('description', 'text');
        $builder->add('comment', 'text');
        $builder->add('expire_time', 'text');
        $builder->add('exclusive', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);

        $builder->add('object_type', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);
        $builder->add('object_state', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);
        $builder->add('object_wall', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);
        $builder->add('object_room_number', 'text');
        $builder->add('object_common_area', 'text');
        $builder->add('object_live_area', 'text');
        $builder->add('object_kitchen_area', 'text');
        $builder->add('object_section_area', 'text');
        $builder->add('object_floor', 'text');
        $builder->add('object_floors', 'text');
        $builder->add('object_build_year', 'text');
        $builder->add('object_watter_supply', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);
        $builder->add('object_heating', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);
        $builder->add('object_new_house', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);
        $builder->add('object_wc', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);

        $builder->add('object_region', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);
        $builder->add('object_city', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);
        $builder->add('object_city_region', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);
        $builder->add('object_street', 'choice', ['choices' => ['true' => 'true', 'false' => 'false']]);
        $builder->add('object_house', 'text');
        $builder->add('object_flat', 'text');
        $builder->add('object_landmark', 'text');

        $builder->add('submit', 'submit', array('label' => 'Создать',));
    }

    public function getName()
    {
        return 'editProfile';
    }
}
