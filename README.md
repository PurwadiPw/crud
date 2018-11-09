# LaraOngkir
Raja Ongkir API Wrapper for Laravel 5

## Installation

### Composer

	composer require rifkyekayama/rajaongkir-laravel

Untuk melakukan konfigurasi Api Key dan Jenis Akun, ketikan pada Terminal perintah sebagai berikut.

	php artisan vendor:publish

Perintah ini akan men-generate file `rajaongkir.php` pada `config/rajaongkir.php`.

Tambahkan setting pada `.env`

	RAJAONGKIR_ACCOUNT_TYPE=starter|basic|pro
	RAJAONGKIR_APIKEY=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

