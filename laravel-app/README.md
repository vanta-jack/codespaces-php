# Laravel 8 Application - Restaurant Demo

A Laravel 8 application with built-in authentication and a responsive restaurant-themed interface.

## Quick Start

### Prerequisites
- MariaDB running (`sudo service mariadb start`)
- Dependencies installed (`composer install`)

### Start the Application

```bash
# Navigate to the Laravel app directory
cd /workspaces/codespaces-php/laravel-app

# Start the development server on port 8001
php artisan serve --port=8001
```

The app will be available at:
- **Codespaces**: `https://[CODESPACE_NAME]-8001.preview.app.github.dev`
- **Local**: `http://localhost:8001`

### Stop the Application

```bash
# Kill the Laravel server gracefully (Ctrl+C in terminal)
# Or kill it by PID/port:
pkill -f "php artisan serve"

# Or kill by port:
lsof -i :8001 -sTCP:LISTEN -t | xargs kill -9
```

### Reset the Application

#### Clear Caches Only
```bash
php artisan cache:clear
php artisan config:cache
```

#### Full Reset (keep database)
```bash
php artisan cache:clear
php artisan config:cache
php artisan view:clear
php artisan route:cache
```

#### Complete Reset (including database)
```bash
# Clear all caches and views
php artisan cache:clear
php artisan config:cache
php artisan view:clear
php artisan route:cache

# Reset the database
php artisan migrate:refresh --seed

# Restart the server
pkill -f "php artisan serve"
sleep 1
php artisan serve --port=8001
```

#### Create a Test User
```bash
php artisan tinker
>>> \App\Models\User::create(['name'=>'Test User','email'=>'test@domain.com','password'=>bcrypt('test123')])
```

## Configuration

### URL Configuration
The app automatically detects whether it's running in:
- **Codespaces**: Uses the Codespaces domain (e.g., `https://codespace-name-8001.preview.app.github.dev`)
- **Local Development**: Uses `http://localhost:8001`

This is configured in:
- `.env` - `APP_URL` environment variable
- `config/app.php` - Dynamic URL detection logic
- `config/sanctum.php` - Authentication domain whitelist
- `app/Http/Middleware/TrustProxies.php` - Proxy trust settings

### Database
- Host: `127.0.0.1`
- Port: `3306`
- Database: `login_db`
- User: `webuser`
- Password: `password`

## Troubleshooting

### Port 8001 Already in Use
```bash
# Kill the process using port 8001
lsof -i :8001 -sTCP:LISTEN -t | xargs kill -9

# Then start the server again
php artisan serve --port=8001
```

### Login Redirects to localhost
This has been fixed with automatic URL detection. If you still experience this:
1. Clear all caches: `php artisan cache:clear && php artisan config:cache`
2. Restart the server: `pkill -f "php artisan serve"` then `php artisan serve --port=8001`

### Database Connection Issues
Ensure MariaDB is running:
```bash
sudo service mariadb start

# Verify connection
mysql -u webuser -ppassword -h127.0.0.1 login_db
```

## Available Routes

After starting the server:
- `/` - Home page (redirects to `/home` if authenticated)
- `/home` - Dashboard (authenticated users only)
- `/login` - Login page
- `/register` - Registration page

## Laravel Documentation

For more information about Laravel, visit the [official documentation](https://laravel.com/docs).
