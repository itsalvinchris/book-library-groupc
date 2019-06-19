# Book Library

Book Library is a Final Project COMP7084 - Multimedia Systems LB08 Class in Bina Nusantara University.

The Objective is we want to improve manual system to manage lending and borrowing books especially in University and we provide a system that can search the book online with feature like pre-booking the book.

[library.christopheralvin.xyz](http://library.christopheralvin.xyz)

## Teams
Group C
* Aaron Christian Hansel - 2101628820
* Christopher Alvin - 2101626683
* Hendy - 2101632225
* Ignatius Ryan Yonata - 2101639925
* Jonathan Sebastian - 2101626626

## System Requirements

* PHP >= 7.1.3
* BCMath PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension


## Installation

Use the package manager [composer](https://getcomposer.org/download/) to install Book Library.

```bash
composer install
```
Edit .env file and change application from production to local
```bash
APP_ENV=local
```

You might want to look at .env to configure the database
Example
```bash
DB_DATABASE=xxx
DB_USERNAME=xxx
DB_PASSWORD=xxx
```

Migrate the database and seed the data
```bash
php artisan migrate:fresh --seed
```
You might want to look at DatabaseSeeder.php to edit seed data

Don't forget to link storage/app folder to public folder wit
```bash
php artisan storage:link
```

## Technologies
Project is created with:
* Laravel PHP Framework: 5.8.19
* Bootstrap: 4.31
* jQuery: 3.31
* DataTables : 1.10.18
* Laratables


## Images and Videos

Images and Videos that used in this app taken and edited from [Freepik](https://freepik.com), [Youtube](https://youtube.com), and other sources

## License
This project is licensed under the terms of the MIT license. [MIT](https://choosealicense.com/licenses/mit/)

___
> Source Code and this Github maintained by Christopher Alvin
>   ·  Github: [@itsalvinchris](https://github.com/itsalvinchris)
>   ·  Email: [alvzz99@gmail.com](mailto:alvzz99@gmail.com) and [christopher.alvin001@binus.ac.id](mailto:christopher.alvin001@binus.ac.id)  