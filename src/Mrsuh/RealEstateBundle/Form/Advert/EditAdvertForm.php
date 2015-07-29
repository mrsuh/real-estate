<?php namespace Mrsuh\RealEstateBundle\Form\Advert;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EditAdvertForm extends AbstractType
{

    private $advert;
    private $params;

    public function __construct($params, $advert)
    {
        $this->params = $params;
        $this->advert = $advert;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('seller_name', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('seller_phone', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('description_description', 'textarea', ['required' => false, 'attr' =>['value' => $this->advert->getDescription()->getDescription()]]);
        $builder->add('description_comment', 'textarea', ['required' => false, 'attr' =>['value' => $this->advert->getDescription()->getComment()]]);
        $builder->add('advert_expire_time', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('advert_exclusive', 'choice', ['choices' => ['true' => 'да', 'false' => 'нет']]);

        $builder->add('object_type', 'choice', ['choices' => $this->params['type'], 'attr' => ['value' => $this->advert->getObject()->getType()->getId()]]);
        $builder->add('object_state', 'choice', ['choices' => $this->params['state'], 'attr' => ['value' => $this->advert->getObject()->getState()->getId()]]);
        $builder->add('object_wall', 'choice', ['choices' => $this->params['wall'], 'attr' => ['value' => $this->advert->getObject()->getWall()->getId()]]);
        $builder->add('object_room_number', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_common_area', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_live_area', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_kitchen_area', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_section_area', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_floor', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_floors', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_build_year', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_water_supply', 'choice', ['choices' => $this->params['water_supply'], 'attr' => ['value' => $this->advert->getObject()->getWaterSupply()->getId()]]);
        $builder->add('object_heating', 'choice', ['choices' => $this->params['heating'], 'attr' => ['value' => $this->advert->getObject()->getHeating()->getId()]]);
        $builder->add('object_new_house', 'choice', ['choices' => ['true' => 'да', 'false' => 'нет']]);
        $builder->add('object_wc', 'choice', ['choices' => $this->params['wc'], 'attr' => ['value' => $this->advert->getObject()->getWc()->getId()]]);
        $builder->add('object_balcony', 'choice', ['choices' => $this->params['balcony'], 'attr' => ['value' => $this->advert->getObject()->getBalcony()->getId()]]);
        $builder->add('object_mortgage', 'choice', ['choices' => ['true' => 'да', 'false' => 'нет']]);

        $builder->add('object_region', 'choice', ['choices' => $this->params['region'], 'attr' => ['value' => $this->advert->getObject()->getRegion()->getId()]]);
        $builder->add('object_city', 'choice', ['choices' => $this->params['city'], 'attr' => ['value' => $this->advert->getObject()->getCity()->getId()]]);
        $builder->add('object_region_city', 'choice', ['choices' => $this->params['region_city'], 'attr' => ['value' => $this->advert->getObject()->getRegionCity()->getId()]]);
        $builder->add('object_street', 'choice', ['choices' => $this->params['street'], 'attr' => ['value' => $this->advert->getObject()->getStreet()->getId()]]);
        $builder->add('object_house', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_flat', 'text', ['required' => false, 'attr' =>['value' => null]]);
        $builder->add('object_landmark', 'textarea', ['required' => false, 'attr' =>['value' => null]]);

        $builder->add('submit', 'submit', array('label' => 'Сохранить'));
    }

    public function getName()
    {
        return 'editAdvert';
    }
}
