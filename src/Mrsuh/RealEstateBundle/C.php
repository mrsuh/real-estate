<?php

namespace Mrsuh\RealEstateBundle;


class C
{
    const REPO_OBJECT = 'MrsuhRealEstateBundle:Object\Object';
    const REPO_OBJECT_TYPE = 'MrsuhRealEstateBundle:Object\ObjectType';
    const REPO_OBJECT_BALCONY = 'MrsuhRealEstateBundle:Object\ObjectBalcony';
    const REPO_OBJECT_HEATING = 'MrsuhRealEstateBundle:Object\ObjectHeating';
    const REPO_OBJECT_STATE = 'MrsuhRealEstateBundle:Object\ObjectState';
    const REPO_OBJECT_WALL = 'MrsuhRealEstateBundle:Object\ObjectWall';
    const REPO_OBJECT_WATER_SUPPLY = 'MrsuhRealEstateBundle:Object\ObjectWaterSupply';
    const REPO_OBJECT_WC = 'MrsuhRealEstateBundle:Object\ObjectWc';

    const REPO_ADDRESS_CITY = 'MrsuhRealEstateBundle:Address\AddressCity';
    const REPO_ADDRESS_REGION = 'MrsuhRealEstateBundle:Address\AddressRegion';
    const REPO_ADDRESS_REGION_CITY = 'MrsuhRealEstateBundle:Address\AddressRegionCity';
    const REPO_ADDRESS_STREET = 'MrsuhRealEstateBundle:Address\AddressStreet';

    const REPO_ROLE = 'MrsuhRealEstateBundle:Role';
    const REPO_USER = 'MrsuhRealEstateBundle:User';

    const REPO_CLIENT = 'MrsuhRealEstateBundle:Client';

    const REPO_ADVERT = 'MrsuhRealEstateBundle:Advert\Advert';
    const REPO_ADVERT_CATEGORY = 'MrsuhRealEstateBundle:Advert\AdvertCategory';
    const REPO_ADVERT_TYPE = 'MrsuhRealEstateBundle:Advert\AdvertType';
    const REPO_ADVERT_DESCRIPTION = 'MrsuhRealEstateBundle:Advert\AdvertDescription';
    const REPO_ADVERT_IMAGE = 'MrsuhRealEstateBundle:Advert\AdvertImage';

    //roles
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';
    const ROLE_SYSTEM = 'ROLE_SYSTEM';

    //object status
    const STATUS_OBJECT_ACTIVE = 1;
    const STATUS_OBJECT_ARCHIVE = 2;
    const STATUS_OBJECT_RECALL = 3;
    const STATUS_OBJECT_NOT_RESPONSE = 4;

    //advert status
    const STATUS_ADVERT_ACTIVE = 1;
    const STATUS_ADVERT_NOT_ACTIVE = 2;
    const STATUS_ADVERT_DELETED = 3;
    const STATUS_ADVERT_NO_RESPONSE = 4;
    const STATUS_ADVERT_RECALL = 5;

    const STATUS_CLIENT_IN_WORK = 1;
    const STATUS_CLIENT_TEMPORARY_SUSPENDED = 2;
    const STATUS_CLIENT_BOUGHT_WITH_US = 3;
    const STATUS_CLIENT_BOUGHT_HIMSELF = 4;
    const STATUS_CLIENT_BLACK_LIST = 5;


    const OBJECT_TYPE_HOUSE = 'Дом(коттедж)';
    const OBJECT_TYPE_EARTH_AREA = 'Земельный участок';
    const OBJECT_TYPE_FLAT = 'Квартира';
    const OBJECT_TYPE_COMMERCE = 'Коммерческая';
    const OBJECT_TYPE_ROOM = 'Комната';


    const OBJECT_NUMBER = 1;
    const PHONE_NUMBER = 2;
    const STREET_NAME= 3;
    const LANDMARK = 4;
    const DESCRIPTION = 5;

    const SEARCH_STRING = 'search_string';
    const SEARCH_EXTENSION= 'search_extension';


    const ORDER_TYPE_ASC = 'ASC';
    const ORDER_TYPE_DESC = 'DESC';

    const PASSWORD_LENGTH = 6;

    const USER_STATUS_ACTIVE = 1;
    const USER_STATUS_DELETED = 2;

    const SYSTEM_USER = 'root';

}