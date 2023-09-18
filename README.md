
# USJ PUB

  

## Prerequisites

 1. PHP version 8.0 or higher [Download](https://www.php.net/downloads.php)
2.  Composer package manager [Download](https://getcomposer.org/download/)

## Setup Environment
1. Clone the repository
```shell
git clone https://github.com/adithyakalhan15/teamworks.git
git checkout newBackend
```

2. Setup Laravel
```
composer install
```
3. Duplicate and rename the .env.test to to .env file. 
4.  Migrate the database.
```
php artisan migrate
``` 
5. Start test server on http://127.0.0.1:8000
```
php artisan serve
```
<hr>

>Note: All design files are in resources/views/ folder and CSS and JS are in public/res/