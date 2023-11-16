<p align="center"><a href="https://courier.spysabbir.com/" target="_blank"><img src="https://courier.spysabbir.com/uploads/default_photo/default_logo_photo.png"></a></p>

## About This Project

This is project is the Courier Management System. Built with `Laravel` & various packages included.

## Setup

- First of all we have to `clone` the project at our local machine using below command
 ```
git clone https://github.com/spysabbir/laravel-courier-application.git
``` 
- Now change the command line present working directory (pwd) by
 ```
cd laravel-courier-application
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
*DB | database settings for connect the database with this project
*MAIL | mail settings for send email via smtp server
*SMS | sms settings for send sms via bulksmsbd api

- Now migrate and seed the database using
 ```
php artisan migrate --seed
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

All account password as same
Password: 12345678
``` 
