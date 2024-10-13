# Account Management System

## Overview
Web application built with Laravel to manage user accounts.

## Tech Stack
- **Backend**: PHP (Laravel)
- **Frontend**: Blade (Laravel's templating engine)
- **Database**: MySQL
- **Containerization**: Docker (using Laradock)
- **Version Control**: Git

## Prerequisites
- PHP 8.3 or higher
- Composer
- Docker and Docker Compose
- MySQL

## Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/AlexandreCK/laravel-introductory-project.git
cd accounts-management-system
```

### 2. Install Laradock
```bash
git clone https://github.com/laradock/laradock.git
cd laradock
```

### 3. Configure Laradock
- Copy the example environment file:
```bash
cp .env.example .env
```
- Adjust configurations in the `.env` file as necessary (database settings, PHP versions, etc.).

### 4. Start Docker Containers
```bash
docker-compose up -d nginx mysql
```

### 5. Enable PHP Extensions
Make sure the following PHP extensions are enabled in your `php.ini` file (usually located at `C:\php-8.3.4\php.ini`):
- `fileinfo`
- `mbstring`
- `pdo`
- `tokenizer`
- `xml`
- `openssl`
- `curl`

To enable an extension, ensure the line is uncommented:
```ini
extension=fileinfo
```

### 6. Restart Docker (if using)
If you’re running the application in Docker, make sure to restart the Docker containers after any changes to the `php.ini`:
```bash
docker-compose restart
```

### 7. Install Composer Dependencies
If you're in the project root directory:
```bash
composer install
```
If there are issues related to missing extensions, run:
```bash
composer update --ignore-platform-reqs
```

### 8. Run Migrations
After installing dependencies, run the migrations to set up the database:
```bash
php artisan migrate
```

### 9. Seed the Database (Optional)
You can also seed the database with initial data:
```bash
php artisan db:seed
```

## Running the Application
Visit `http://localhost` in your browser to access the application.

## Troubleshooting
- If you encounter issues with Composer, ensure all required PHP extensions are enabled.
- Use `php -m` in your command line or Docker container to check installed PHP modules.
- If you face errors regarding missing extensions, check the Docker environment for PHP settings.
