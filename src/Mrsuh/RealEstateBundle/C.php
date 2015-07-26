<?php

namespace Mrsuh\RealEstateBundle;


class C
{

    const REPO_ROLE = 'MrsuhRealEstateBundle:Role';
    const REPO_USER = 'MrsuhRealEstateBundle:User';
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

    const TYPE_OBJECT_HOUSE = 1;
    const TYPE_OBJECT_PARCEL = 2;
    const TYPE_OBJECT_FLAT = 3;
    const TYPE_OBJECT_ROOM = 4;
    const TYPE_OBJECT_COMMERCE = 5;

    const STATE_OBJECT_DESIGN_REPAIR = 1;
    const STATE_OBJECT_EUROSTANDARD = 2;
    const STATE_OBJECT_COSMETIC_REPAIR = 3;
    const STATE_OBJECT_NOT_REQUIRE_REPAIR = 4;
    const STATE_OBJECT_AFTER_REPAIR = 5;
    const STATE_OBJECT_UNDER_REPAIR = 6;
    const STATE_OBJECT_REQUIRE_REPAIR = 7;
    const STATE_OBJECT_FINE_FINISHING = 8;

    const MATERIAL_WALL_OBJECT_MONOLITHIC = 1;
    const MATERIAL_WALL_OLD_FUND = 2;
    const MATERIAL_WALL_PANEL = 3;
    const MATERIAL_WALL_BRICK = 4;
    const MATERIAL_WALL_OTHER= 5;
    const MATERIAL_WALL_KHRUSCHEV = 6;
    const MATERIAL_WALL_STALIN = 7;

    const TYPE_WATER_SUPPLY_OBJECT_WEll = 1;
    const TYPE_WATER_SUPPLY_WATER_HEATER = 2;
    const TYPE_WATER_SUPPLY_GAS_BOILER = 3;
    const TYPE_WATER_SUPPLY_CONNECTIVITY = 4;
    const TYPE_WATER_SUPPLY_COLUMN = 5;
    const TYPE_WATER_SUPPLY_SUMMER_WATER = 6;
    const TYPE_WATER_SUPPLY_CENTRAL_WATER_SUPPLY = 7;
    const TYPE_WATER_SUPPLY_HAVE_NOT = 8;


    const TYPE_HEATING_OBJECT_AOGV = 1;
    const TYPE_HEATING_OBJECT_HAVE_NOT = 2;
    const TYPE_HEATING_OBJECT_WATER = 3;
    const TYPE_HEATING_OBJECT_AIR = 4;
    const TYPE_HEATING_OBJECT_GAS_BOILER = 5;
    const TYPE_HEATING_OBJECT_CONNECTIVITY = 6;
    const TYPE_HEATING_OBJECT_STEAM = 7;
    const TYPE_HEATING_OBJECT_OVEN = 8;
    const TYPE_HEATING_OBJECT_WARM_FLOOR = 9;
    const TYPE_HEATING_OBJECT_CENTRAL = 10;
    const TYPE_HEATING_OBJECT_ELECTRIC = 11;

    const TYPE_WC_OBJECT_COMBINED = 1;
    const TYPE_WC_OBJECT_SEPARATE = 2;
    const TYPE_WC_OBJECT_ON_STREET = 3;

    const TYPE_BALCONY_OBJECT_WITH_GLASS = 1;
    const TYPE_BALCONY_OBJECT_WITHOUT_GLASS = 2;

}