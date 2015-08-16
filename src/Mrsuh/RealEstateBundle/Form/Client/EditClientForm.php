<?php namespace Mrsuh\RealEstateBundle\Form\Client;

use Mrsuh\RealEstateBundle\C;
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
        $builder->add('name1', 'text', ['required' => true, 'data' => $this->client->getName1(), 'attr' => ['placeholder' => 'Фамилия Имя Отчество']]);
        $builder->add('name2', 'text', ['required' => false, 'data' => $this->client->getName2(), 'attr' => ['placeholder' => 'Фамилия Имя Отчество']]);
        $builder->add('name3', 'text', ['required' => false, 'data' => $this->client->getName3(), 'attr' => ['placeholder' => 'Фамилия Имя Отчество']]);
        $builder->add('phone1', 'text', ['required' => true, 'data' => $this->client->getPhone1(), 'attr' => ['placeholder' => '8 999 214 43 42']]);
        $builder->add('phone2', 'text', ['required' => false, 'data' => $this->client->getPhone2(), 'attr' => ['placeholder' => '8 999 214 43 42']]);
        $builder->add('phone3', 'text', ['required' => false, 'data' => $this->client->getPhone3(), 'attr' => ['placeholder' => '8 999 214 43 42']]);

        $builder->add('comment', 'textarea', ['required' => false, 'data' => $this->client->getComment(), 'attr' => ['placeholder' => 'Комментарий']]);
        $builder->add('object_type', 'choice', ['choices' => $this->params['object_type'], 'data' => $this->client->getObjectType()->getId()]);

        $builder->add('price_from', 'text', ['required' => false, 'data' => $this->client->getPriceFrom(), 'attr' => ['placeholder' => 'от']]);
        $builder->add('price_to', 'text', ['required' => false, 'data' => $this->client->getPriceTo(), 'attr' => ['placeholder' => 'до']]);
        $builder->add('room_from', 'text', ['required' => false, 'data' => $this->client->getRoomFrom(), 'attr' => ['placeholder' => 'от']]);
        $builder->add('room_to', 'text', ['required' => false, 'data' => $this->client->getRoomTo(), 'attr' => ['placeholder' => 'до']]);
        $builder->add('common_area_from', 'text', ['required' => false, 'data' => $this->client->getCommonAreaFrom(), 'attr' => ['placeholder' => 'от']]);
        $builder->add('common_area_to', 'text', ['required' => false, 'data' => $this->client->getCommonAreaTo(), 'attr' => ['placeholder' => 'до']]);
        $builder->add('live_area_from', 'text', ['required' => false, 'data' => $this->client->getLiveAreaFrom(), 'attr' => ['placeholder' => 'от']]);
        $builder->add('live_area_to', 'text', ['required' => false, 'data' => $this->client->getLiveAreaTo(), 'attr' => ['placeholder' => 'до']]);
        $builder->add('kitchen_area_from', 'text', ['required' => false, 'data' => $this->client->getKitchenAreaFrom(), 'attr' => ['placeholder' => 'от']]);
        $builder->add('kitchen_area_to', 'text', ['required' => false, 'data' => $this->client->getKitchenAreaTo(), 'attr' => ['placeholder' => 'до']]);
        $builder->add('section_area_from', 'text', ['required' => false, 'data' => $this->client->getSectionAreaFrom(), 'attr' => ['placeholder' => 'от']]);
        $builder->add('section_area_to', 'text', ['required' => false, 'data' => $this->client->getSectionAreaTo(), 'attr' => ['placeholder' => 'до']]);
        $builder->add('floor_from', 'text', ['required' => false, 'data' => $this->client->getFloorFrom(), 'attr' => ['placeholder' => 'от']]);
        $builder->add('floor_to', 'text', ['required' => false, 'data' => $this->client->getFloorTo(), 'attr' => ['placeholder' => 'до']]);
        $builder->add('floors_from', 'text', ['required' => false, 'data' => $this->client->getFloorsFrom(), 'attr' => ['placeholder' => 'от']]);
        $builder->add('floors_to', 'text', ['required' => false, 'data' => $this->client->getFloorsTo(), 'attr' => ['placeholder' => 'до']]);

        $builder->add('reviewed_adverts', 'text', ['required' => false, 'attr' => ['placeholder' => 'Введите номер объявления через запятую']]);

        $date = null;
        if(!is_null($this->client->getBirthDay())) {
            $date = $this->client->getBirthDay()->format('d.m.Y');
        }
        $builder->add('birth_day', 'text', ['required' => false, 'data' => $date, 'attr' => ['placeholder' => '10.04.1991']]);
        $builder->add('status', 'choice', ['choices' => [
            C::STATUS_CLIENT_IN_WORK => 'В работе',
            C::STATUS_CLIENT_TEMPORARY_SUSPENDED => 'Временно приостановил поиск',
            C::STATUS_CLIENT_BOUGHT_WITH_US => 'Купил в нашем агенстве',
            C::STATUS_CLIENT_BOUGHT_HIMSELF => 'Купил самостоятельно',
            C::STATUS_CLIENT_BLACK_LIST => 'Черный список'
        ], 'data' => $this->client->getStatus()]);

        $builder->add('mortgage', 'choice', ['choices' => [1 => 'да', 0 => 'нет'], 'data' => $this->client->getMortgage()]);
        $builder->add('hot', 'choice', ['choices' => [1 => 'да', 0 => 'нет'], 'data' => $this->client->getHot()]);

        $builder->add('city', 'choice', ['choices' => $this->params['city'], 'data' => $this->client->getCity()->getId()]);

        $builder->add('region_city', 'collection', [
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
        return 'editClient';
    }
}
