<?php namespace Mrsuh\RealEstateBundle\Form\Advert;

use Mrsuh\RealEstateBundle\C;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Mrsuh\RealEstateBundle\Entity\FileType;
use Mrsuh\RealEstateBundle\Entity\Advert\AdvertImage;

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
        $builder->add('advert_seller_name1', 'text', ['required' => false, 'data' => $this->advert->getSellerName1(), 'attr' =>['placeholder' => 'Фамилия Имя Отчество']]);
        $builder->add('advert_seller_phone1', 'text', ['required' => false, 'data' => $this->advert->getSellerPhone1(), 'attr' =>['placeholder' => '8 999 214 43 42']]);
        $builder->add('advert_seller_name2', 'text', ['required' => false, 'data' => $this->advert->getSellerName2(), 'attr' =>['placeholder' => 'Фамилия Имя Отчество']]);
        $builder->add('advert_seller_phone2', 'text', ['required' => false, 'data' => $this->advert->getSellerPhone2(), 'attr' =>['placeholder' => '8 999 214 43 42']]);
        $builder->add('advert_seller_name3', 'text', ['required' => false, 'data' => $this->advert->getSellerName3(), 'attr' =>['placeholder' => 'Фамилия Имя Отчество']]);
        $builder->add('advert_seller_phone3', 'text', ['required' => false, 'data' => $this->advert->getSellerPhone3(), 'attr' =>['placeholder' => '8 999 214 43 42']]);

        $builder->add('description_description', 'textarea', ['required' => false, 'data' => $this->advert->getDescription()->getDescription(), 'attr' =>['placeholder' => 'Описание']]);
        $builder->add('description_comment', 'textarea', ['required' => false, 'data' => $this->advert->getDescription()->getComment(), 'attr' =>['placeholder' => 'Комментарии']]);

        $builder->add('advert_exclusive', 'choice', ['choices' => [1 => 'да', 0 => 'нет'], 'data' => $this->advert->getExclusive()]);
        $builder->add('advert_type', 'choice', ['choices' =>  $this->params['advert_type'], 'data' => $this->advert->getType()->getId()]);
        $builder->add('advert_category', 'choice', ['choices' =>  $this->params['advert_category'], 'data' => $this->advert->getCategory()->getId()]);
        $builder->add('advert_price', 'text', ['required' => false, 'data' => $this->advert->getPrice(), 'attr' =>['placeholder' => '1200000']]);
        $builder->add('advert_meter_price', 'text', ['required' => false, 'data' => $this->advert->getMeterPrice(), 'attr' =>['placeholder' => '12000']]);
        $builder->add('advert_status', 'choice', ['choices' => [C::STATUS_ADVERT_ACTIVE => 'активно', C::STATUS_ADVERT_NOT_ACTIVE => 'не активно', C::STATUS_ADVERT_DELETED => 'архив', C::STATUS_ADVERT_NO_RESPONSE => 'нет связи', C::STATUS_ADVERT_RECALL => 'перезвонить'], 'data' => $this->advert->getStatus()]);
        $builder->add('advert_change_user', 'choice', ['choices' => $this->params['advert_user'], 'required' => false, 'placeholder' => 'Перенос объявления', 'data' => !is_null($this->advert->getChangeUser()) ? $this->advert->getChangeUser()->getId() : null]);

        $builder->add('object_type', 'choice', ['choices' => $this->params['object_type'], 'data' => $this->advert->getObject()->getType()->getId()]);
        $builder->add('object_state', 'choice', ['choices' => $this->params['object_state'], 'data' => $this->advert->getObject()->getState()->getId()]);
        $builder->add('object_wall', 'choice', ['choices' => $this->params['object_wall'], 'data' => $this->advert->getObject()->getWall()->getId()]);
        $builder->add('object_room_number', 'text', ['required' => false, 'data' => $this->advert->getObject()->getRoomNumber(), 'attr' =>['placeholder' => '4']]);
        $builder->add('object_common_area', 'text', ['required' => false, 'data' => $this->advert->getObject()->getCommonArea(), 'attr' =>['placeholder' => '70']]);
        $builder->add('object_live_area', 'text', ['required' => false, 'data' => $this->advert->getObject()->getLiveArea(), 'attr' =>['placeholder' => '50']]);
        $builder->add('object_kitchen_area', 'text', ['required' => false, 'data' => $this->advert->getObject()->getKitchenArea(), 'attr' =>['placeholder' => '20']]);
        $builder->add('object_section_area', 'text', ['required' => false, 'data' => $this->advert->getObject()->getSectionArea(), 'attr' =>['placeholder' => '300']]);
        $builder->add('object_floor', 'text', ['required' => false, 'data' => $this->advert->getObject()->getFloor(), 'attr' =>['placeholder' => '4']]);
        $builder->add('object_floors', 'text', ['required' => false, 'data' => $this->advert->getObject()->getFloors(), 'attr' =>['placeholder' => '16']]);
        $builder->add('object_build_year', 'text', ['required' => false, 'data' => $this->advert->getObject()->getBuildYear(), 'attr' =>['placeholder' => '2016']]);
        $builder->add('object_water_supply', 'choice', ['choices' => $this->params['object_water_supply'], 'data' => $this->advert->getObject()->getWaterSupply()->getId()]);
        $builder->add('object_heating', 'choice', ['choices' => $this->params['object_heating'], 'data' => $this->advert->getObject()->getHeating()->getId()]);
        $builder->add('object_new_house', 'choice', ['choices' => [1 => 'да', 0 => 'нет'], 'data' => $this->advert->getObject()->getNewHouse()]);
        $builder->add('object_wc', 'choice', ['choices' => $this->params['object_wc'], 'data' => $this->advert->getObject()->getWc()->getId()]);
        $builder->add('object_balcony', 'choice', ['choices' => $this->params['object_balcony'], 'data' => $this->advert->getObject()->getBalcony()->getId()]);
        $builder->add('object_mortgage', 'choice', ['choices' => [1 => 'да', 0 => 'нет'], 'data' => $this->advert->getObject()->getMortgage()]);

        $builder->add('object_region', 'choice', ['choices' => $this->params['object_region'], 'data' => $this->advert->getObject()->getRegion()->getId()]);
        $builder->add('object_city', 'choice', ['choices' => $this->params['object_city'], 'data' => $this->advert->getObject()->getCity()->getId()]);
        $builder->add('object_region_city', 'hidden', ['data' => $this->advert->getObject()->getRegionCity()->getId()]);
        $builder->add('object_street', 'text', ['data' => $this->advert->getObject()->getStreet(), 'required' => false]);
        $builder->add('object_house', 'text', ['required' => false, 'data' => $this->advert->getObject()->getHouse(), 'attr' =>['placeholder' => '43']]);
        $builder->add('object_flat', 'text', ['required' => false, 'data' => $this->advert->getObject()->getFlat(), 'attr' =>['placeholder' => '97']]);
        $builder->add('object_landmark', 'textarea', ['required' => false, 'data' => $this->advert->getObject()->getLandmark(), 'attr' =>['placeholder' => 'Ориентир']]);

        $builder->add('advert_image', 'collection', [
            'type'   =>  new FileType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'data' => [
                new AdvertImage(),
                new AdvertImage(),
                new AdvertImage(),
                new AdvertImage(),
                new AdvertImage(),
                new AdvertImage(),
                new AdvertImage(),
                new AdvertImage(),
                new AdvertImage(),
                new AdvertImage()],
            'required' => false,
        ]);

        $builder->add('advert_image_delete', 'collection', [
            'type'   =>  'checkbox',
            'label' => false,
            'allow_add'    => true,
            'allow_delete' => true,
            'data' => [],
            'required' => false
        ]);

        $builder->add('submit', 'submit', array('label' => 'Сохранить'));
    }

    public function getName()
    {
        return 'editAdvert';
    }
}
