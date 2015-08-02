<?php namespace Mrsuh\RealEstateBundle\Form\Client;

use Mrsuh\RealEstateBundle\Entity\Advert\AdvertImage;
use Symfony\Component\Form\AbstractType;
use Mrsuh\RealEstateBundle\Entity\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class EditClientForm extends AbstractType
{
    private $params;
    private $client;

    public function __construct($client ,$params)
    {
        $this->params = $params;
        $this->client = $client;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name1', 'text', ['required' => false, 'data' => $this->client->getName1()]);
        $builder->add('name2', 'text', ['required' => false, 'data' => $this->client->getName2()]);
        $builder->add('name3', 'text', ['required' => false, 'data' => $this->client->getName3()]);
        $builder->add('phone1', 'text', ['required' => false, 'data' => $this->client->getPhone1()]);
        $builder->add('phone2', 'text', ['required' => false, 'data' => $this->client->getPhone2()]);
        $builder->add('phone3', 'text', ['required' => false, 'data' => $this->client->getPhone3()]);

        $builder->add('comment', 'textarea', ['required' => false, 'data' => $this->client->getComment()]);
        $builder->add('object_type', 'choice', ['choices' => $this->params['object_type'], 'data' => $this->client->getObjectType()->getId()]);

        $builder->add('price_from', 'text', ['required' => false, 'data' => $this->client->getPriceFrom()]);
        $builder->add('price_to', 'text', ['required' => false, 'data' => $this->client->getPriceTo()]);
        $builder->add('room_from', 'text', ['required' => false, 'data' => $this->client->getRoomFrom()]);
        $builder->add('room_to', 'text', ['required' => false, 'data' => $this->client->getRoomTo()]);
        $builder->add('common_area_from', 'text', ['required' => false, 'data' => $this->client->getCommonAreaFrom()]);
        $builder->add('common_area_to', 'text', ['required' => false, 'data' => $this->client->getCommonAreaTo()]);
        $builder->add('live_area_from', 'text', ['required' => false, 'data' => $this->client->getLiveAreaFrom()]);
        $builder->add('live_area_to', 'text', ['required' => false, 'data' => $this->client->getLiveAreaTo()]);
        $builder->add('kitchen_area_from', 'text', ['required' => false, 'data' => $this->client->getKitchenAreaFrom()]);
        $builder->add('kitchen_area_to', 'text', ['required' => false, 'data' => $this->client->getKitchenAreaTo()]);
        $builder->add('section_area_from', 'text', ['required' => false, 'data' => $this->client->getSectionAreaFrom()]);
        $builder->add('section_area_to', 'text', ['required' => false, 'data' => $this->client->getSectionAreaTo()]);
        $builder->add('floor_from', 'text', ['required' => false, 'data' => $this->client->getFloorFrom()]);
        $builder->add('floor_to', 'text', ['required' => false, 'data' => $this->client->getFloorTo()]);
        $builder->add('floors_from', 'text', ['required' => false, 'data' => $this->client->getFloorsFrom()]);
        $builder->add('floors_to', 'text', ['required' => false, 'data' => $this->client->getFloorsTo()]);


        $builder->add('birth_day', 'text', ['required' => false, 'data' => $this->client->getBirthDay()->format('d.m.Y')]);
        $builder->add('status', 'choice', ['choices' => [1 => 'да', 0 => 'нет'], 'data' => $this->client->getStatus()]);

        $builder->add('mortgage', 'choice', ['choices' => [1 => 'да', 0 => 'нет'], 'data' => $this->client->getMortgage()]);
        $builder->add('hot', 'choice', ['choices' => [1 => 'да', 0 => 'нет'], 'data' => $this->client->getHot()]);

        $builder->add('city', 'choice', ['choices' => $this->params['city'], 'data' => $this->client->getCity()->getId()]);
        $builder->add('region_city', 'choice', ['choices' => $this->params['region_city'], 'data' => $this->client->getRegionCity()->getId()]);

        $builder->add('submit', 'submit', array('label' => 'Создать'));
    }

    public function getName()
    {
        return 'createClient';
    }
}
