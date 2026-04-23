<?php
/**
 * Konfigurasi Aplikasi Dashboard
 * File ini berisi setting global aplikasi
 */

namespace App\Config;

// Database Configuration
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'dashboard_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_PORT', 3306);

// Application Configuration
define('APP_NAME', 'Dashboard Template');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/dashboard_template');

// Session Configuration
define('SESSION_TIMEOUT', 3600); // 1 hour

// Display errors (set to false in production)
define('DISPLAY_ERRORS', true);
ini_set('display_errors', DISPLAY_ERRORS);
error_reporting(E_ALL);

// Set timezone
date_default_timezone_set('Asia/Jakarta');
