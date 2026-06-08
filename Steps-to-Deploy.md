# Steps to Deploy EduTenant ERP

## Prerequisites

* PHP 8.2 or above
* Composer
* Node.js and npm
* MySQL
* Git

## Clone Repository

```bash
git clone https://github.com/PraveenAmujuri/campus-erp-system.git
cd campus-erp-system
```

## Install Dependencies

```bash
composer install
npm install
```

## Configure Environment

Copy the environment file:

```bash
cp .env.example .env
```

Update the database configuration in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=campus_erp
DB_USERNAME=root
DB_PASSWORD=
```

## Generate Application Key

```bash
php artisan key:generate
```

## Run Database Migrations

```bash
php artisan migrate
```

## Build Frontend Assets

```bash
npm run build
```

For development:

```bash
npm run dev
```

## Start the Application

```bash
php artisan serve
```

Application URL:

```text
http://127.0.0.1:8000
```

## Features

* Authentication & RBAC
* Student Management
* Student Attendance Management
* Notification Management
* Fee Management
* Payroll Management
* Multi-Tenant ERP System
