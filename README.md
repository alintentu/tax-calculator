# UK Income Tax Calculator

This project is a simple UK income tax calculator built using the Laravel framework. It allows users to input their gross annual salary and calculates the tax based on predefined tax bands. The application displays the gross monthly and annual salary, net salary, and tax paid.

## Features

- Calculates UK income tax based on three tax bands.
- Displays gross salary, net salary, and tax paid (both annually and monthly).
- Simple user interface for salary input.
- Unit and feature tests for core functionality.

## Requirements

- PHP >= 8.0
- Composer
- MySQL or another relational database
- Laravel >= 9.x

## Installation

### Step 1: Clone the repository

```bash
git clone https://github.com/alintentu/tax-calculator.git
cd tax-calculator

composer install

cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tax_calculator_db
DB_USERNAME=your_username
DB_PASSWORD=your_password

php artisan migrate
php artisan db:seed --class=TaxBandsSeeder

php artisan serve

php artisan test

php artisan cache:clear

