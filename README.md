<p align="center"><a href="#" target="_blank"><img src="#" width="400"></a></p>

## About This Project

This is project is the Courier Management System. Built with `Laravel` & various packages included.

## Setup

- First of all we have to `clone` the project at our local machine using below command
 ```
git clone https://github.com/spysabbir/laravel-courier-project-one.git
``` 
- Now change the command line present working directory (pwd) by
 ```
cd laravel-courier-project-one
``` 
- Now with help of `composer` download all required packages those need to run this laravel project
 ```
composer install
``` 
- Now, we need to copy the .env.example file as .env file for our laravel project. Use below command to copy the file
 ```
cp .env.example .env
``` 
- Currently our project do not have any key, we have generate it using
 ```
php artisan key:generate
``` 
- Basic setup is done at this point, now we have work on `.env`. Below changes should be done at .env file

Variable Name | Description
--- | ---
APP_DEBUG | `true` will show the errors, `false` will hide errors by showing common exception page
DB_* | database settings to connect the database with this project
MAIL_* | database settings to send email via SMTP

- Now migrate the database using
 ```
php artisan migrate
``` 

- Seed the database using
 ```
php artisan db:seed
``` 

- At last, we can now run the project using
 ```
php artisan serve
``` 

- Demo login credentials 
 ```
For Super Admin:- 
Email: superadmin@email.com
For Admin:- 
Email: admin@email.com
For Manager:- 
Email: manager1@email.com
Email: manager2@email.com
For Staff:- 
Email: staff1@email.com
Email: staff2@email.com
Password: 12345678
``` 

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the  [Laravel documentation](https://laravel.com/docs/contributions) .

## License

The Laravel framework is open-sourced software licensed under the  [MIT license](https://opensource.org/licenses/MIT) .
