# BankPro_AdmiralDigital
Simple banking system

- User authentication
- Display bank account information
- Deposit money into the account
- Transfer money to another bank account


## Project Features and Files

1. Authentication: login, logout and register
   (On registration, new bank account will be created)
   
2. Repository Pattern Implementation: find on app/Repositories directory.

3. Business Login Layer: find on app/Services directory.

4. Logging to database

## Technologies 
* Laravel
* MySql
* Vue.Js, vuex, vue-router
* Tailwindcss


## Steps to run the project
- After cloning, run "composer install" command
- run "npm i && npm run dev" in vue folder
- run "php artisan migrate" to create database tables (migration file "create_articles_table" added by me)
- run "php artisan serve"
