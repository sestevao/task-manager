# Task Manager

A modern task management application built with Laravel, designed to help users organize and track their tasks efficiently.

## Features

- ✨ Create, read, update, and delete tasks
- 📋 Task status management
- 🔐 User authentication and authorization
- 💾 Database persistence
- 🎨 Clean and intuitive user interface

## Prerequisites

- PHP >= 8.0
- Composer
- MySQL/PostgreSQL
- Node.js & NPM

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/task-manager.git
cd task-manager
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Create environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run database migrations and seeders:
```bash
php artisan migrate --seed
```

## Running the Application

1. Start the Laravel development server:
```bash
php artisan serve
```

2. Compile assets:
```bash
npm run dev
```

The application will be available at `http://localhost:8000`

## Application Structure

```
task-manager/
├── app/
│   ├── Http/Controllers/    # Application controllers
│   └── Models/             # Eloquent models
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
├── resources/
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files
│   └── views/             # Blade templates
└── routes/
    └── web.php            # Web routes
```

## Screenshot

![Task Manager Screenshot](github/app%20screen.png)

## Technologies Used

- [Laravel](https://laravel.com) - PHP web framework
- [MySQL](https://www.mysql.com) - Database
- [Blade](https://laravel.com/docs/blade) - Template engine
- [Laravel Mix](https://laravel-mix.com) - Asset compilation

## Testing

Run the test suite:
```bash
php artisan test
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).