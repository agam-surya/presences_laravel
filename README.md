<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## WEB

## Fitur

1. Autentikasi User

- Login Dan Logout User

2. Dashboard menu
- jumlah user 
- jumlah jabatan 
- jumlah staff sesuai jabatan(contoh = dosen : 10, pegawai: 2)
- tabel Rekomendasi staff / karyawan paling rajin absen menggunakan metode SAW

3. Manajemen posisi/jabatan 

- CRUD(melihat,menambah,mengubah dan menghapus) data jabatan

4. manajemen staff sesuai jabatan

- CRUD(melihat,menambah,mengubah dan menghapus) data staff sesuai jabatan

5. manajemen waktu absensi

- CRUD(melihat,menambah,mengubah dan menghapus) data waktu absen

6. manajemen hari libur

- CRUD(melihat,menambah,mengubah dan menghapus) data hari libur


7. laporan kehadiran 

- list absensi
- cetak list absensi format pdf

8. data izin user

- melihat data izin semua user
- terima atau tolak data izin
- download file izin yang telah dikirim

9. Lokasi Absen

- melihat lokasi absen

## Demo Web

| URL      | https://goabsensi-beta-2.000webhostapp.com/ |
| -------- | ------------------------------------------- |
| email    | admin@gmail.com                             |
| password | password                                    |

## Instalasi WEB & REST API

### Spesifikasi

- PHP ^7.4
- Laravel ^8
- PHP Composer
- Database MySQL atau MariaDB
- web hosting 000webhost

### Cara Install

1. Clone atau download source code
   - Pada terminal, clone repo `git clone https://github.com/agam-surya/presences_laravel.git`
   - Jika tidak menggunakan Git, silakan **Download Zip** 
2. buka folder yang telah di extract `cd presences_laravel`
3. jalankan perintah`composer install`
4. jalankan perintah `cp .env.example .env`
   - Jika tidak menggunakan Git, bisa rename file `.env.example` menjadi `.env`
5. Pada terminal `php artisan key:generate`
6. Buat **database pada mysql** untuk aplikasi ini dengan nama `goabsensi`
7. **Setting database** pada file `.env`
8. jalankan perintah `php artisan migrate:fresh --seed`
9.  jalankan perintah `php artisan serve`
10. Selesai

### Login Admin

```
Username: admin@gmail.com
Password: password
```

## Api Akses Dan Dokumentasi

Dokumentasi Api Bisa Diakses Di : https://documenter.getpostman.com/view/23565435/2s8YzXvfNJ
