![Laravel](https://laravel.com/assets/img/components/logo-laravel.svg)

<h2 align="center">Aplikasi Arsip Takah Digital</h2>

## Tentang
Aplikasi ini dibuat untuk arsip takah kepegawaian menjadi berkas digital.

## Manfaat
1. Mudah Mencari File Berkas

### Input Ke Sistem
1. Membuat Folder
2. Memasukan file dalam folder tersebut

## Cara Install

### Kebutuhan Server

Aplikasi ini dapat dipasang pada server lokal dan onlne dengan spesifikasi berikut:

1. PHP > 7.2.5 (dan mengikuti [server requirements Laravel 7.x](https://laravel.com/docs/7.x/installation#server-requirements) lainnya),
2. Database MySQL atau MariaDB.

### Langkah Instalasi

1. Clone Repo, pada terminal : `git clone https://github.com/kukuh21/takahkepegawaian.git`
2. `cd takahkepegawaian`
3. `composer install`
4. `cp .env.example .env`
5. `php artisan key:generate`
6. Buat **database pada mysql** untuk aplikasi ini
7. **Setting database** pada file `.env`
8. `php artisan migrate`
9. `php artisan db:seed`
10. `php artisan serve`


## License
