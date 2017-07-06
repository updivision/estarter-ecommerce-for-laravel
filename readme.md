## Setup
- Clone repository
```
$ git clone git@bitbucket.org:updivision/laravel-ecommerce.git
```
- Run in your terminal
```
$ composer install
$ php artisan key:generate
```
- Setup database connection in .env file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

- Migrate tables with demo data
```
$ php artisan migrate --seed
```

- Access it on
```
http://localhost/laravel-ecommerce/admin/login
```