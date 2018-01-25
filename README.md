# eStarter. The beginning of your beautiful, custom ecommerce on Laravel.
## What's new?
- Upgrade to Laravel 5.5 & latest version of [BackPack](https://backpackforlaravel.com/)
- Clients Management (including addresses and companies)
- Specific Prices for products
- Cart Rules
- Orders
- Notification Templates
- Users Management
- Roles & Permissions

## All Features
- Create and organize categories & subcategoires
- Create attributes and group them in sets of attributes
- Create currencies
- Create carriers
- Create taxes and use them on products
- Create order statuses
- Create products and upload product multiple images at once, using dropzone
- Ability to create product groups
- Ability to clone a product
- Add Clients
- See orders & change order statuses that will notify users via e-mail
- Add / Edit Notification templates
- Create users with different roles & permissions
- Create cart rules
- Create Specific prices

## Installation
- Clone repository
```
$ git clone https://github.com/updivision/estarter-ecommerce-for-laravel.git
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

## Do not forget to add in your env file following lines:
```
ADMIN_ROLE_NAME=administrator
CLIENT_ROLE_NAME=client
```

- Migrate tables and seed with demo data
```
$ php artisan migrate --seed
```

- Access it on
```
http://localhost/estarter-ecommerce-for-laravel/admin/login
```

## Setup
In order to use the shop and be able to add products, you must have a minimum configuration:
- Create at least one category;
- Create at least one attribute for at least one of these types: text, textarea, date, dropdown, multiple select, media;
- Create at least one attribute set;
- Create a tax (eg. VAT).

After creating these, you’re ready to add your first product.

## Known Issues
- Product image uploader - still - not fully responsive


## EER Diagram
![alt_text](https://i.imgur.com/NzZM6RN.png "eStarter EER Diagram")

## Screenshots (update soon)
![alt text](http://i.imgur.com/i3rp9Jk.png "List categories")
![alt text](http://i.imgur.com/CCCgGvl.png "Edit category")
![alt text](http://i.imgur.com/92WE6wd.png "Edit product")
![alt text](http://i.imgur.com/ZZF70eo.png "Edit attribute")
![alt text](http://i.imgur.com/xmb0u7o.png "Edit attribute set")
![alt text](http://i.imgur.com/OVbI44p.png "Edit currency")
![alt text](http://i.imgur.com/86mx9U2.png "Edit tax")

## Contributors
 - [Paul Duca](https://github.com/pduca)
 - [Diana Marusic](https://github.com/mdiannna)
 - [Andrei Barta](https://github.com/abarta)
 
## License
eStarter is based on Backpack which is free for non-commercial use and $49/project for commercial use. Please see [License File](LICENSE.md) and [backpackforlaravel.com](https://backpackforlaravel.com/#pricing) for more information.

[ico-version]: https://img.shields.io/packagist/v/backpack/base.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/backpack/base.svg?style=flat-square
