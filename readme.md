<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

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

Create a database name it to: ovoda_db

Set up database table with demo datas
```
php artisan migrate:fresh --seed
```

(Optional) Create a virtualhost to this project.

###Advanced debug with Telescope

<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1539108489/telescope-logo.svg"></p>

This project comes with a super simple but powerful debug plugin

Visit: YourVirtulHostName/telescope/

More info: https://github.com/laravel/telescope