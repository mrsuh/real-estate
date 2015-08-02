<?php namespace Mrsuh\RealEstateBundle\Form\Client;

use Mrsuh\RealEstateBundle\Entity\Advert\AdvertImage;
use Symfony\Component\Form\AbstractType;
use Mrsuh\RealEstateBundle\Entity\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateClientForm extends AbstractType
{
    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name1', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('name2', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('name3', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('phone1', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('phone2', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('phone3', 'text', ['required' => false, 'attr' => ['value' => null]]);

        $builder->add('comment', 'textarea', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('object_type', 'choice', ['choices' => $this->params['object_type']]);

        $builder->add('price_from', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('price_to', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('room_from', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('room_to', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('common_area_from', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('common_area_to', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('live_area_from', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('live_area_to', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('kitchen_area_from', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('kitchen_area_to', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('section_area_from', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('section_area_to', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('floor_from', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('floor_to', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('floors_from', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('floors_to', 'text', ['required' => false, 'attr' => ['value' => null]]);


        $builder->add('birth_day', 'text', ['required' => false, 'attr' => ['value' => null]]);
        $builder->add('status', 'choice', ['choices' => [1 => 'да', 0 => 'нет']]);

        $builder->add('mortgage', 'choice', ['choices' => [1 => 'да', 0 => 'нет']]);
        $builder->add('hot', 'choice', ['choices' => [1 => 'да', 0 => 'нет']]);

        $builder->add('city', 'choice', ['choices' => $this->params['city']]);
        $builder->add('region_city', 'choice', ['choices' => $this->params['region_city']]);

        $builder->add('submit', 'submit', array('label' => 'Создать'));
    }

    public function getName()
    {
        return 'createClient';
    }
}
