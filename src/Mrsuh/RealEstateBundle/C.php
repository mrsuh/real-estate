<?php

namespace Mrsuh\RealEstateBundle;


class C
{
    const REPO_OBJECT = 'MrsuhRealEstateBundle:Object\Object';
    const REPO_OBJECT_TYPE = 'MrsuhRealEstateBundle:Object\Type';
    const REPO_OBJECT_BALCONY = 'MrsuhRealEstateBundle:Object\Balcony';
    const REPO_OBJECT_HEATING = 'MrsuhRealEstateBundle:Object\Heating';
    const REPO_OBJECT_STATE = 'MrsuhRealEstateBundle:Object\State';
    const REPO_OBJECT_WALL = 'MrsuhRealEstateBundle:Object\Wall';
    const REPO_OBJECT_WATER_SUPPLY = 'MrsuhRealEstateBundle:Object\WaterSupply';
    const REPO_OBJECT_WC = 'MrsuhRealEstateBundle:Object\Wc';

    const REPO_ADDRESS_CITY = 'MrsuhRealEstateBundle:Address\City';
    const REPO_ADDRESS_REGION = 'MrsuhRealEstateBundle:Address\Region';
    const REPO_ADDRESS_REGION_CITY = 'MrsuhRealEstateBundle:Address\RegionCity';
    const REPO_ADDRESS_STREET = 'MrsuhRealEstateBundle:Address\Street';
    const REPO_ADVERT_DESCRIPTION = 'MrsuhRealEstateBundle:AdvertDescription';

    const REPO_ROLE = 'MrsuhRealEstateBundle:Role';
    const REPO_USER = 'MrsuhRealEstateBundle:User';
    const REPO_ADVERT = 'MrsuhRealEstateBundle:Advert';

    //roles
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';
    const ROLE_SYSTEM = 'ROLE_SYSTEM';

    //name for check_login
    const WSSE_NAME = 'wsse_username';
    const WSSE_PASS = 'wsse_password';

    //object status
    const STATUS_OBJECT_ACTIVE = 1;
    const STATUS_OBJECT_ARCHIVE = 2;
    const STATUS_OBJECT_RECALL = 3;
    const STATUS_OBJECT_NOT_RESPONSE = 4;


    //advert type
    const TYPE_ADVERT_RENT = 1;
    const TYPE_ADVERT_SALE = 2;

    //advert status
    const STATUS_ADVERT_ACTIVE = 1;
    const STATUS_ADVERT_REQUEST_DELETE = 2;
    const STATUS_ADVERT_DELETED = 3;
    const STATUS_ADVERT_AGENT = 4;

}