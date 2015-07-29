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
        $builder->add('seller_name', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('seller_phone', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('description_description', 'textarea', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('description_comment', 'textarea', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('advert_expire_time', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('advert_exclusive', 'choice', ['choices' => ['true' => 'да', 'false' => 'нет']]);

        $builder->add('object_type', 'choice', ['choices' => $this->advert['type']]);
        $builder->add('object_state', 'choice', ['choices' => $this->advert['state']]);
        $builder->add('object_wall', 'choice', ['choices' => $this->advert['wall']]);
        $builder->add('object_room_number', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_common_area', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_live_area', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_kitchen_area', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_section_area', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_floor', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_floors', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_build_year', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_water_supply', 'choice', ['choices' => $this->advert['water_supply']]);
        $builder->add('object_heating', 'choice', ['choices' => $this->advert['heating']]);
        $builder->add('object_new_house', 'choice', ['choices' => ['true' => 'да', 'false' => 'нет']]);
        $builder->add('object_wc', 'choice', ['choices' => $this->advert['wc']]);
        $builder->add('object_balcony', 'choice', ['choices' => $this->advert['balcony']]);
        $builder->add('object_mortgage', 'choice', ['choices' => ['true' => 'да', 'false' => 'нет']]);

        $builder->add('object_region', 'choice', ['choices' => $this->advert['region']]);
        $builder->add('object_city', 'choice', ['choices' => $this->advert['city']]);
        $builder->add('object_region_city', 'choice', ['choices' => $this->advert['region_city']]);
        $builder->add('object_street', 'choice', ['choices' => $this->advert['street']]);
        $builder->add('object_house', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_flat', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_landmark', 'textarea', ['required' => false, 'attr' =>['value' => null]]);

        $builder->add('submit', 'submit', array('label' => 'Создать'));
    }

    public function getName()
    {
        return 'createAdvert';
    }
}
