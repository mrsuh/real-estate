<?php namespace Mrsuh\RealEstateBundle\Form\Advert;

use Mrsuh\RealEstateBundle\Entity\Advert\AdvertImage;
use Symfony\Component\Form\AbstractType;
use Mrsuh\RealEstateBundle\Entity\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateAdvertForm extends AbstractType
{
    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('advert_seller_name1', 'text', ['required' => false, 'attr' =>['value' => null, 'placeholder' => 'Фамилия Имя Отчество']]);
        $builder->add('advert_seller_phone1', 'text', ['required' => false, 'attr' =>['value' => null, 'placeholder' => '8 999 214 43 42']]);
        $builder->add('advert_seller_name2', 'text', ['required' => false, 'attr' =>['value' => null, 'placeholder' => 'Фамилия Имя Отчество']]);
        $builder->add('advert_seller_phone2', 'text', ['required' => false, 'attr' =>['value' => null, 'placeholder' => '8 999 214 43 42']]);
        $builder->add('advert_seller_name3', 'text', ['required' => false, 'attr' =>['value' => null, 'placeholder' => 'Фамилия Имя Отчество']]);
        $builder->add('advert_seller_phone3', 'text', ['required' => false, 'attr' =>['value' => null, 'placeholder' => '8 999 214 43 42']]);

        $builder->add('description_description', 'textarea', ['required' => false, 'attr' =>['value' => null, 'placeholder' => 'Описание']]);
        $builder->add('description_comment', 'textarea', ['required' => false, 'attr' =>['value' => null, 'placeholder' => 'Комментарии']]);

        $builder->add('advert_exclusive', 'choice', ['choices' => [1 => 'да', 0 => 'нет']]);
        $builder->add('advert_type', 'choice', ['choices' =>  $this->params['advert_type']]);
        $builder->add('advert_category', 'choice', ['choices' =>  $this->params['advert_category']]);
        $builder->add('advert_price', 'text', ['required' => false, 'attr' => ['placeholder' => '1200000']]);
        $builder->add('advert_meter_price', 'text', ['required' => false, 'attr' =>['value' => null, 'placeholder' => '12000']]);

        $builder->add('object_type', 'choice', ['choices' => $this->params['object_type']]);
        $builder->add('object_state', 'choice', ['choices' => $this->params['object_state']]);
        $builder->add('object_wall', 'choice', ['choices' => $this->params['object_wall']]);
        $builder->add('object_room_number', 'text', ['required' => false, 'attr' =>['value' => null, 'placeholder' => '4']]);
        $builder->add('object_common_area', 'text', ['required' => true, 'attr' =>['value' => null, 'placeholder' => '70']]);
        $builder->add('object_live_area', 'text', ['required' => true, 'attr' =>['value' => null, 'placeholder' => '50']]);
        $builder->add('object_kitchen_area', 'text', ['required' => true, 'attr' =>['value' => null, 'placeholder' => '20']]);
        $builder->add('object_section_area', 'text', ['required' => false, 'attr' =>['value' => null, 'placeholder' => '300']]);
        $builder->add('object_floor', 'text', ['required' => true, 'attr' =>['value' => null, 'placeholder' => '4']]);
        $builder->add('object_floors', 'text', ['required' => true, 'attr' =>['value' => null, 'placeholder' => '16']]);
        $builder->add('object_build_year', 'text', ['required' => false, 'attr' =>['value' => null, 'placeholder' => '2016']]);
        $builder->add('object_water_supply', 'choice', ['choices' => $this->params['object_water_supply']]);
        $builder->add('object_heating', 'choice', ['choices' => $this->params['object_heating']]);
        $builder->add('object_new_house', 'choice', ['choices' => [1 => 'да', 0 => 'нет']]);
        $builder->add('object_wc', 'choice', ['choices' => $this->params['object_wc']]);
        $builder->add('object_balcony', 'choice', ['choices' => $this->params['object_balcony']]);
        $builder->add('object_mortgage', 'choice', ['choices' => [1 => 'да', 0 => 'нет']]);

        $builder->add('object_region', 'choice', ['choices' => $this->params['object_region']]);
        $builder->add('object_city', 'choice', ['choices' => $this->params['object_city']]);
        $builder->add('object_region_city', 'hidden');
        $builder->add('object_street', 'choice', ['choices' => $this->params['object_street']]);
        $builder->add('object_house', 'text', ['required' => false, 'attr' =>['value' => null, 'placeholder' => '43']]);
        $builder->add('object_flat', 'text', ['required' => false, 'attr' =>['value' => null, 'placeholder' => '97']]);
        $builder->add('object_landmark', 'textarea', ['required' => false, 'attr' =>['value' => null, 'placeholder' => 'Ориентир']]);

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

        $builder->add('submit', 'submit', array('label' => 'Создать'));
    }

    public function getName()
    {
        return 'createAdvert';
    }
}
