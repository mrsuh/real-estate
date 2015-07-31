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

    const REPO_ADVERT = 'MrsuhRealEstateBundle:Advert\Advert';
    const REPO_ADVERT_CATEGORY = 'MrsuhRealEstateBundle:Advert\AdvertCategory';
    const REPO_ADVERT_TYPE = 'MrsuhRealEstateBundle:Advert\AdvertType';
    const REPO_ADVERT_DESCRIPTION = 'MrsuhRealEstateBundle:Advert\AdvertDescription';

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
    const STATUS_ADVERT_REQUEST_DELETE = 2;
    const STATUS_ADVERT_DELETED = 3;
    const STATUS_ADVERT_AGENT = 4;

}