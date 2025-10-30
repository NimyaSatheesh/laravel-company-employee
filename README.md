<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Laravel Companies & Employees — CRUD App

A small Laravel application demonstrating: authentication, database migrations & seeders, CRUD for Companies & Employees, file storage for logos, request validation, pagination, DataTables (server-side using Yajra), resource controllers, Blade components/slots, and an API documented via Postman.

Requirements

PHP 8.1+ (match your Laravel version)

Composer

Node.js & npm (for frontend assets)

MySQL / Postgres / SQLite

Git
Quick Start
# clone repo
git clone https://github.com/<your-user>/<repo>.git
cd <repo>

# install PHP dependencies
composer install

# copy env and set DB credentials
cp .env.example .env
# edit .env -> set DB_DATABASE, DB_USERNAME, DB_PASSWORD, APP_URL

php artisan key:generate

# install frontend dependencies
npm install
npm run build    # or npm run dev for local dev

# run migrations + seeders (this will create admin user & demo data)
php artisan migrate --seed

# create storage symlink so logos are accessible
php artisan storage:link

# start server
php artisan serve

Open http://127.0.0.1:8000 and log in with seeded admin:

Email: admin@admin.com

Password: password