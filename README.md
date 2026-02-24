# PHP and SQL database sandbox

A sandbox hosted in Codespaces. This project was made for my Software Design class.

- Mobile-first and web responsive design

MARIADB CONSOLE PASSWORD: password
MARIADB DB CREDENTIALS: admin@cftgmbh.com password

## TO-DO
- [x] A simple login page
  - [x] Basic email and password (MariaDB)
  - [ ] Liquid Glass setup
  - [ ] OAuth Implementation
  - [ ] Sample Database for Blades in the Dark
  - [ ] Material 3 Style
  - [ ] Palantir/Crowdstrike aesthetic
  - [ ] Pill Navbar

### Database setup

1. Start MariaDB if it's not running. The service in the container sometimes stops after
   a restart; use:

   ```bash
   sudo service mariadb start
   ```

2. If you haven't already run the schema script, import it now:

   ```bash
   sudo mysql -u root < init_db.sql
   ```

   The script creates `login_db`, the `users` table, and a dedicated application
   account (`webuser`/`password`). The PHP code connects using this account, not
   root.

3. You can inspect the database manually with:

   ```bash
   sudo mysql -u root -e "SHOW DATABASES;"
   ```

   or connect as the app user using TCP:
   `mysql -u webuser -ppassword -h127.0.0.1 login_db`.

### Using the Laravel application

A Laravel 8 project now lives in `laravel-app` and replaces the procedural
PHP scripts. It provides built-in authentication, routing, and a blade-based
view system.

To get started:

1. Start MariaDB (`sudo service mariadb start`).
2. Change into the Laravel directory:
   ```bash
   cd laravel-app
   ```
3. Install dependencies (if you haven't already):
   ```bash
   composer install
   ```
4. Ensure the `.env` file is configured to use the `login_db` database with
   the `webuser` account (this is already set up for you).
5. Run migrations to create the users table:
   ```bash
   php artisan migrate:fresh --force
   ```
6. (Optional) seed a test user:
   ```bash
   php artisan tinker --execute="\App\Models\User::create(['name'=>'Test','email'=>'test@domain.com','password'=>bcrypt('test123')]);"
   ```
7. Start the development server:
   ```bash
   php artisan serve --port=8001
   ```
   Visit `http://localhost:8001` to see the site. Use `/login` or `/register`
   to access the authentication UI.

The `home` view has been customised with the restaurant content from the
original `index.php`. Logged-in users can access `/home`; unauthenticated
visitors are redirected to the login page. You can safely delete or ignore the
old `login.php`, `register.php`, `index.php`, etc. – they are legacy and no
longer required.

### Credentials

- **Laravel DB user**: `webuser` / `password` (configured in `laravel-app/.env`)
- **MariaDB root**: no password in dev container (use `sudo` to access).

### PHP extensions

The container now includes both `mysqli` and `pdo_mysql` so Laravel can connect
to MariaDB. The `.devcontainer/Dockerfile` has been updated accordingly. If you
rebuild the container, those drivers will be available automatically.

### Legacy notes

The earlier PHP/HTML files remain at the repository root purely for reference.
All future development should occur inside the Laravel project. They are deletable