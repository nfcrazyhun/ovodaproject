<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

This app made in with the following versions:

- Laravel 5.8
- PHP 7.3.9
- MySQL 8.0.17

##Quick start guide

Clone this repository

```
https://github.com/nfcrazyhun/ovodaproject.git
```

Install dependencies
```
composer u -o
```

Rename '.env.example' file to '.env' in the project root folder.

Generate Application Key
```
php artisan key:generate
```

Change your database credentials

Create a database name it to: ovoda_db ; Collation: utf8mb4_unicode_ci

Set up database table with demo datas
```
php artisan migrate:fresh --seed
```

(Optional) Create a virtualhost to this project.

To generate dummy data, open tinner first:
```
php artisan tinker
```
To generate 4 student, insert:
```
factory(App\Student::class, 4)->create();
```

Or generate 3 students with addresses, insert:
```
factory(App\Student::class, 3)->create()->each(
    function($item) {
        factory(App\Address::class)->create(['student_id' => $item->id]);
    }
);
```


###Advanced debug with Telescope

<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1539108489/telescope-logo.svg"></p>

This project comes with a super simple but powerful debug plugin

Visit: YourVirtulHostName/telescope/

More info: https://github.com/laravel/telescope