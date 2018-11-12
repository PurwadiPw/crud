<?php
namespace Pw\RajaOngkir\Contracts;

interface RajaOngkirFactory {
    public static function province($province_id = null);
    public static function city($province_id = null, $city_id = null);
    public static function subdistrict($city_id = null, $subdistrict_id = null);
    public static function cost($origin, $originType, $destination, $destinationType, $weight, $courier);
    public static function internationalOrigin($province_id = null, $city_id = null);
    public static function internationalDestination($country_id = null);
    public static function internationalCost($origin, $destination, $weight, $courier);
    public static function currency();
    public static function waybill($waybill_number, $courier);
}