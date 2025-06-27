## HEPARS (Higher Education Program Application Recommendation System)

This is a web application designed to assist applicants wishing to pursue undergraduate programs provided by universities in Tanzania.

## Requirements
This system can be hosted on an environment with:

  * APACHE Server: `v2.4 or above`
  * MySQL Server: `v8.2 or above`
  * PHP: `v8.2 or above`

## Installation
Clone this repo into your file system and run the following commands:

  * `composer install`
  * `php artisan key:generate --ansi`
  * `php artisan migrate`
  * `php artisan db:seed`
  * `php artisan serve`
  
## Acknowledgements
 - [Laravel Framework](https://laravel.com/)
 - [AdminLTE Theme](https://adminlte.io/)
