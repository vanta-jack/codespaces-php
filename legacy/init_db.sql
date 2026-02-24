-- init_db.sql
-- schema for the login_demo application

CREATE DATABASE IF NOT EXISTS login_db;
USE login_db;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- application user; change password in db_connect.php if modified
CREATE USER IF NOT EXISTS 'webuser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON login_db.* TO 'webuser'@'localhost';
FLUSH PRIVILEGES;
