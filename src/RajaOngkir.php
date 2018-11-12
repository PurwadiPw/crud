<?php

namespace Pw\RajaOngkir;

use Pw\RajaOngkir\Contracts\RajaOngkirFactory;
use Pw\RajaOngkir\Helpers\RESTClient;

/**
 * RajaOngkir Endpoints
 *
 * @auZthor Purwadi <purwadie97@gmail.com>
 */

class RajaOngkir implements RajaOngkirFactory
{

    private static $api_key;
    private static $account_type;

    public function __construct($api_key, $account_type)
    {
        self::$api_key = $api_key;
        self::$account_type = $account_type;
    }

    /**
     * Fungsi untuk mendapatkan data propinsi di Indonesia
     * @param integer $province_id ID propinsi, jika NULL tampilkan semua propinsi
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    public static function province($province_id = null)
    {
        $params = (is_null($province_id)) ? array() : array('id' => $province_id);
        $rest_client = new RESTClient(self::$api_key, 'province', self::$account_type);
        return $rest_client->get($params);
    }

    /**
     * Fungsi untuk mendapatkan data kota di Indonesia
     * @param integer $province_id ID propinsi
     * @param integer $city_id ID kota, jika ID propinsi dan kota NULL maka tampilkan semua kota
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    public static function city($province_id = null, $city_id = null)
    {
        $params = (is_null($province_id)) ? array() : array('province' => $province_id);
        if (!is_null($city_id)) {
            $params['id'] = $city_id;
        }
        $rest_client = new RESTClient(self::$api_key, 'city', self::$account_type);
        return $rest_client->get($params);
    }

    /**
     * Fungsi untuk mendapatkan data kecamatan di Indonesia
     * @param integer $city_id ID kota, WAJIB DIISI.
     * @param integer @subdistrict_id ID kecamatan, jika ID kecamatan NULL maka tampilkan semua kecamatan di kota tersebut
     * @return string Response dari cURL berupa string JSON balasan dari RajaOngkir
     */
    public static function subdistrict($city_id = null, $subdistrict_id = null)
    {
        $params = array('city' => $city_id);
        if (!is_null($subdistrict_id)) {
            $params['id'] = $subdistrict_id;
        }
        $rest_client = new RESTClient(self::$api_key, 'subdistrict', self::$account_type);
        return $rest_client->get($params);
    }

    /**
     * Fungsi untuk mendapatkan data ongkos kirim
     * @param integer $origin ID kota asal
     * @param string $originType tipe kota asal 'city' atau 'subdistrict'
     * @param integer $destination ID kota tujuan
     * @param string $destinationType tipe kota tujuan 'city' atau 'subdistrict'
     * @param integer $weight Berat kiriman dalam gram
     * @param string $courier Kode kurir
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    public static function cost($origin, $originType, $destination, $destinationType, $weight, $courier)
    {
        $params = array(
            'origin' => $origin,
            'originType' => $originType,
            'destination' => $destination,
            'destinationType' => $destinationType,
            'weight' => $weight,
            'courier' => $courier,
        );
        $rest_client = new RESTClient(self::$api_key, 'cost', self::$account_type);
        return $rest_client->post($params);
    }

    /**
     * Fungsi untuk mendapatkan daftar/nama kota yang mendukung pengiriman Internasional
     *
     * @param integer $province_id ID propinsi
     * @param integer $city_id ID kota, jika ID propinsi dan ID kota NULL maka tampilkan semua kota
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    public static function internationalOrigin($province_id = null, $city_id = null)
    {
        $params = (is_null($province_id)) ? array() : array('province' => $province_id);
        if (!is_null($city_id)) {
            $params['id'] = $city_id;
        }
        $rest_client = new RESTClient(self::$api_key, 'internationalOrigin', self::$account_type);
        return $rest_client->get($params);
    }

    /**
     * Fungsi untuk mendapatkan daftar/nama negara tujuan pengiriman internasional
     *
     * @param integer ID negara, jika kosong maka akan menampilkan semua negara
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    public static function internationalDestination($country_id = null)
    {
        $params = (is_null($country_id)) ? array() : array('id' => $country_id);
        $rest_client = new RESTClient(self::$api_key, 'internationalDestination', self::$account_type);
        return $rest_client->get($params);
    }

    /**
     * Fungsi untuk mendapatkan ongkir internasional (EMS)
     *
     * @param integer ID kota asal
     * @param ineteger ID negara tujuan
     * @param integer Berat kiriman dalam gram
     * @param string Kode kurir
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    public static function internationalCost($origin, $destination, $weight, $courier)
    {
        $params = array(
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        );
        $rest_client = new RESTClient(self::$api_key, 'internationalCost', self::$account_type);
        return $rest_client->post($params);
    }

    /**
     * Fungsi untuk mendapatkan nilai kurs rupiah terhadap USD
     *
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    public static function currency()
    {
        $rest_client = new RESTClient(self::$api_key, 'currency', self::$account_type);
        return $rest_client->get(array());
    }

    /**
     * Fungsi untuk melacak paket/nomor resi
     *
     * @param string Nomor resi
     * @param string Kode kurir
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    public static function waybill($waybill_number, $courier)
    {
        $params = array(
            'waybill' => $waybill_number,
            'courier' => $courier,
        );
        $rest_client = new RESTClient(self::$api_key, 'waybill', self::$account_type);
        return $rest_client->post($params);
    }

}
