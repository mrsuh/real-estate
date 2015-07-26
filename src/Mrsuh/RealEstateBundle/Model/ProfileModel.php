<?php namespace Mrsuh\RealEstateBundle\Model;

use Mrsuh\RealEstateBundle\C;

class ProfileModel
{
    private $userRepo;

    public function __construct($em)
    {
       $this->userRepo = $em->getRepository(C::REPO_USER);
    }

    public function update($user, $params)
    {
        $this->userRepo->update($user, $params);
    }

    private function shapeArray()
    {
        $typeObject = [
            C::TYPE_OBJECT_HOUSE => 'Дом(Коттедж)',
            C::TYPE_OBJECT_PARCEL => 'Земельный участок',
            C::TYPE_OBJECT_FLAT => 'Квартира',
            C::TYPE_OBJECT_COMMERCE => 'Коммерческая',
            C::TYPE_OBJECT_ROOM => 'Комната'
        ];

        $stateObject = [
           C::STATE_OBJECT_DESIGN_REPAIR => 'Дизайнерский ремонт',
            C::STATE_OBJECT_EUROSTANDARD => 'Евростандарт',
            C::STATE_OBJECT_COSMETIC_REPAIR => 'Косметическй ремонт',
            C::STATE_OBJECT_NOT_REQUIRE_REPAIR => 'Не трубует ремонта',
            C::STATE_OBJECT_AFTER_REPAIR => 'После кап. ремонта',
            C::STATE_OBJECT_UNDER_REPAIR => 'Стройвариант',
            C::STATE_OBJECT_REQUIRE_REPAIR => 'Требует ремонта',
            C::STATE_OBJECT_FINE_FINISHING => 'Чистовая отделка'
        ];

        $wall = [
            C::MATERIAL_WALL_OBJECT_MONOLITHIC => 'Монолитный',
            C::MATERIAL_WALL_OBJECT_OLD_FUND => 'Старый фонд',
            C::MATERIAL_WALL_OBJECT_PANEL => 'Панельный',
            C::MATERIAL_WALL_OBJECT_BRICK => 'Кирпичный',
            C::MATERIAL_WALL_OBJECT_OTHER => 'Иное',
            C::MATERIAL_WALL_OBJECT_BRICK_MONOLITHIC => 'Кирпично-монолитный',
            C::MATERIAL_WALL_OBJECT_KHRUSCHEV => 'Хрущевский',
            C::MATERIAL_WALL_OBJECT_STALIN => 'Сталинский'
        ];

        $waterSupply = [
            C::TYPE_WATER_SUPPLY_OBJECT_WEll => 'Скважина на участке',
            C::TYPE_WATER_SUPPLY_OBJECT_WATER_HEATER => 'Водонагреватель',
            C::TYPE_WATER_SUPPLY_OBJECT_GAS_BOILER => 'Газовый котел',
            C::TYPE_WATER_SUPPLY_OBJECT_CONNECTIVITY => 'Есть возможность подключения',
            C::TYPE_WATER_SUPPLY_OBJECT_COLUMN => 'Колонка',
            C::TYPE_WATER_SUPPLY_OBJECT_SUMMER_WATER => 'Летний водопровод',
            C::TYPE_WATER_SUPPLY_OBJECT_HAVE_NOT => 'Центральное водоснабжение',
            C::TYPE_WATER_SUPPLY_OBJECT_CENTRAL_WATER_SUPPLY => 'Центральное водоснабжение'
        ];

        $heating = [
            C::TYPE_HEATING_OBJECT_AOGV => 'АОГВ',
            C::TYPE_HEATING_OBJECT_HAVE_NOT => 'Без отопления',
            C::TYPE_HEATING_OBJECT_WATER => 'Водяное',
            C::TYPE_HEATING_OBJECT_AIR => 'Воздушное',
            C::TYPE_HEATING_OBJECT_GAS_BOILER => 'Газовый котел',
            C::TYPE_HEATING_OBJECT_CONNECTIVITY => 'Есть возможность подключения',
            C::TYPE_HEATING_OBJECT_STEAM => 'Паровое',
            C::TYPE_HEATING_OBJECT_OVEN => 'Печное',
            C::TYPE_HEATING_OBJECT_WARM_FLOOR => 'Теплые полы',
            C::TYPE_HEATING_OBJECT_CENTRAL => 'Центральное',
            C::TYPE_HEATING_OBJECT_ELECTRIC => 'Электропитание',
        ];
    }
}