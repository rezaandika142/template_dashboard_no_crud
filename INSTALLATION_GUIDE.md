# 📦 Installation & Setup Guide

Panduan lengkap untuk instalasi dan setup Dashboard Template MVC.

## 🖥️ System Requirements

- **PHP:** 7.4 atau lebih tinggi
- **Web Server:** Apache (dengan mod_rewrite), Nginx, atau IIS
- **Database:** MySQL 5.7+ (optional, untuk production)
- **Browser:** Modern browser (Chrome, Firefox, Safari, Edge)

## 💻 Installation

### Option 1: XAMPP (Windows)

#### Step 1: Extract Files
```bash
# Extract dashboard_template ke:
C:\xampp\htdocs\dashboard_template\
```

#### Step 2: Start XAMPP
- Buka XAMPP Control Panel
- Click "Start" untuk Apache

#### Step 3: Access Dashboard
```
http://localhost/dashboard_template/public/
```

---

### Option 2: Linux / Ubuntu / Debian

#### Step 1: Install Apache & PHP
```bash
sudo apt-get update
sudo apt-get install apache2 php libapache2-mod-php
```

#### Step 2: Extract Files
```bash
cd /var/www/html
sudo git clone <repo_url> dashboard_template
# Atau
sudo cp -r dashboard_template /var/www/html/
```

#### Step 3: Set Permissions
```bash
sudo chown -R www-data:www-data /var/www/html/dashboard_template
sudo chmod -R 755 /var/www/html/dashboard_template
```

#### Step 4: Enable mod_rewrite
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

#### Step 5: Access Dashboard
```
http://your-server-ip/dashboard_template/public/
```

---

### Option 3: Docker

#### Dockerfile
```dockerfile
FROM php:7.4-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Copy project
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
```

#### Build & Run
```bash
docker build -t dashboard-mvc .
docker run -p 80:80 dashboard-mvc
```

---

## ⚙️ Configuration

### 1. Database Setup (Optional)

#### Create Database
```sql
CREATE DATABASE dashboard_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE dashboard_db;

-- Users Table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user', 'manager') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Activities Table
CREATE TABLE activities (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    activity VARCHAR(255) NOT NULL,
    status ENUM('success', 'pending', 'failed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert Demo Users
INSERT INTO users (username, password, email, full_name, role) VALUES 
('admin', '$2y$10$...', 'admin@dashboard.local', 'Administrator', 'admin'),
('user', '$2y$10$...', 'user@dashboard.local', 'Regular User', 'user');
```

#### Generate Password Hash
```php
<?php
$password = 'password';
$hashed = password_hash($password, PASSWORD_DEFAULT);
echo $hashed;
?>
```

### 2. Update Config File

**File:** `app/config/config.php`

```php
// Database Configuration
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'dashboard_db');
define('DB_USER', 'root');
define('DB_PASS', 'password');
define('DB_PORT', 3306);

// Application Configuration
define('APP_URL', 'http://localhost/dashboard_template');

// Display errors (set false di production)
define('DISPLAY_ERRORS', false);
```

---

## 🔐 Security Setup

### 1. Environment Variables (Production)

Create `.env` file:
```
DB_HOST=localhost
DB_NAME=dashboard_db
DB_USER=db_user
DB_PASS=secure_password
APP_ENV=production
```

Load di config:
```php
$env = parse_ini_file(__DIR__ . '/../../.env');
define('DB_HOST', $env['DB_HOST']);
```

### 2. Change Default Credentials

**File:** `app/models/User.php`

Ubah dummy users atau implementasikan database authentication.

### 3. HTTPS Configuration

```apache
# .htaccess atau vhost config
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### 4. Database Password Hashing

**File:** `app/models/User.php`

```php
public function authenticate($username, $password) {
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password with hash
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }

    return null;
}
```

---

## 🗄️ Database Integration

### Update Model untuk Database

**File:** `app/models/User.php`

```php
<?php
require_once __DIR__ . '/Model.php';

class User extends Model {
    protected $table = 'users';
    private $db;

    public function __construct() {
        parent::__construct();
        $this->db = Database::getInstance()->getConnection();
    }

    public function authenticate($username, $password) {
        $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        
        if (!$stmt) {
            return null;
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return null;
    }

    public function getAllUsers() {
        $query = "SELECT id, username, email, full_name, role, created_at FROM users";
        $result = $this->db->query($query);
        
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        
        return $users;
    }
}
```

### Update Database Class

**File:** `app/config/Database.php`

```php
<?php

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
            self::$instance->connect();
        }
        return self::$instance;
    }

    private function connect() {
        $this->connection = new mysqli(
            DB_HOST,
            DB_USER,
            DB_PASS,
            DB_NAME,
            DB_PORT
        );

        if ($this->connection->connect_error) {
            die('Database Connection Failed: ' . $this->connection->connect_error);
        }

        $this->connection->set_charset("utf8mb4");
    }

    public function getConnection() {
        return $this->connection;
    }

    public function close() {
        $this->connection->close();
    }
}
```

---

## 📝 File Permissions

### Linux/Mac

```bash
# Folder permissions
chmod 755 app/
chmod 755 public/
chmod 755 public/assets/

# File permissions
chmod 644 app/config/config.php
chmod 644 public/.htaccess

# Writable folder (untuk upload, cache, logs)
chmod 777 var/
chmod 777 var/uploads/
chmod 777 var/cache/
chmod 777 var/logs/
```

---

## 🧪 Testing Installation

### 1. Verify PHP Version
```bash
php -v
# Output: PHP 7.4.0 atau lebih tinggi
```

### 2. Check Extensions
```bash
php -m | grep -E 'mysqli|pdo'
```

### 3. Test Database Connection
```php
<?php
$conn = new mysqli("localhost", "root", "password", "dashboard_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
?>
```

### 4. Access Dashboard
```
Browser: http://localhost/dashboard_template/public/
Login: admin / password
```

---

## 🐛 Troubleshooting

### Problem: "404 Not Found"

**Solution:**
1. Check folder structure di htdocs
2. Verify Apache menggunakan correct DocumentRoot
3. Check .htaccess file permission
4. Enable mod_rewrite: `a2enmod rewrite`

### Problem: "Headers already sent"

**Solution:**
- Remove BOM dari PHP files
- No space/newline sebelum `<?php`
- No output sebelum `header()` or `session_start()`

### Problem: "Database connection failed"

**Solution:**
1. Check MySQL running
2. Verify credentials di config.php
3. Check database exists
4. Verify user permissions

### Problem: "Session not saving"

**Solution:**
1. Check `session_start()` di public/index.php
2. Verify session.save_path writable
3. Check php.ini session settings
4. Verify browser cookie enabled

### Problem: "Files can't be uploaded"

**Solution:**
```bash
# Create upload folder
mkdir -p var/uploads

# Set permissions
chmod 777 var/uploads
```

---

## 🚀 Production Deployment

### Checklist

- [ ] Change default credentials
- [ ] Set `DISPLAY_ERRORS = false`
- [ ] Use environment variables untuk sensitive data
- [ ] Enable HTTPS/SSL
- [ ] Backup database regularly
- [ ] Setup logs rotation
- [ ] Enable caching
- [ ] Minimize CSS/JS
- [ ] Use CDN untuk static files
- [ ] Setup monitoring & alerting

### Recommended Server Setup

```
Ubuntu 20.04 LTS
├── Nginx (reverse proxy)
├── Apache (PHP handler)
├── MySQL 8.0
├── Redis (caching)
├── Let's Encrypt SSL
├── Supervisor (process manager)
└── ELK Stack (logging)
```

### Deploy Using Git

```bash
cd /var/www/html
git clone <repo_url> dashboard_template
cd dashboard_template

# Install dependencies (jika ada)
composer install

# Setup permissions
chmod 755 app/ public/

# Setup database
mysql -u root -p < database/setup.sql

# Restart services
sudo systemctl restart apache2
sudo systemctl restart mysql
```

---

## 📚 Next Steps

1. **Read QUICK_START.md** - Learn basic usage
2. **Read ARCHITECTURE.md** - Understand MVC structure
3. **Read README.md** - Full documentation
4. **Explore Examples** - Check app/ folder
5. **Build Features** - Start coding!

---

**Happy Development! 🎉**
