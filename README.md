# Dashboard Template PHP - MVC Architecture

Template dashboard modern dengan fitur login menggunakan arsitektur **MVC (Model-View-Controller)** yang clean dan terstruktur.

## 🎯 Fitur Utama

✅ **Arsitektur MVC** - Struktur yang clean dan maintainable
✅ **Login & Session Management** - Sistem autentikasi dengan session PHP
✅ **Responsive Design** - Sempurna di desktop, tablet, dan mobile
✅ **Bootstrap 5** - Styling modern dan component library
✅ **Font Awesome Icons** - Icon library lengkap
✅ **Dashboard Stats** - Widget statistik dengan data dummy
✅ **Activity Log** - Tabel aktivitas terbaru dengan status badges
✅ **Multi-page Navigation** - Dashboard, Analytics, Users, Reports, Settings
✅ **Routing System** - URL-based controller routing
✅ **Modular Code** - Mudah diperluas dan dikustomisasi

## 📋 Requirements

- PHP 7.4 atau lebih tinggi
- Web Server (Apache, Nginx, dll)
- Browser modern
- Optional: Database (MySQL/PostgreSQL) untuk production

## 🚀 Instalasi

### 1. Copy ke Web Server
```bash
# Untuk XAMPP
cp -r dashboard_template C:\xampp\htdocs\

# Untuk Linux
cp -r dashboard_template /var/www/html/
```

### 2. Akses Dashboard
```
http://localhost/dashboard_template/public/
```

### 3. Login
- **Username:** admin
- **Password:** password

## 📁 Struktur Folder (MVC)

```
dashboard_template/
├── app/                          # Folder utama aplikasi
│   ├── config/                   # Konfigurasi
│   │   ├── config.php           # Setting global aplikasi
│   │   └── Database.php         # Koneksi database (singleton)
│   │
│   ├── controllers/              # Controller (logika aplikasi)
│   │   ├── Controller.php       # Base controller class
│   │   ├── AuthController.php   # Login/Logout
│   │   └── DashboardController.php # Dashboard pages
│   │
│   ├── models/                   # Model (logika bisnis & data)
│   │   ├── Model.php            # Base model class
│   │   ├── User.php             # Model untuk user
│   │   └── Activity.php         # Model untuk aktivitas
│   │
│   └── views/                    # View (tampilan UI)
│       ├── layouts/
│       │   └── main.php         # Layout utama
│       ├── login.php            # Halaman login
│       ├── dashboard.php        # Dashboard utama
│       ├── analytics.php        # Halaman analytics
│       ├── users.php            # Halaman users
│       ├── reports.php          # Halaman reports
│       └── settings.php         # Halaman settings
│
├── public/                       # Folder publik (web root)
│   ├── index.php                # Entry point aplikasi
│   ├── .htaccess                # URL rewriting (optional)
│   └── assets/
│       ├── css/
│       │   └── style.css        # Custom CSS
│       └── js/
│           └── script.js        # Custom JavaScript
│
└── README.md                     # Dokumentasi
```

## 🏗️ Penjelasan Arsitektur MVC

### **Model** (`app/models/`)
Menangani logika bisnis dan akses data:
- `Model.php` - Base class dengan method CRUD
- `User.php` - Handle user authentication & data
- `Activity.php` - Handle activity logging

```php
// Contoh penggunaan model
$userModel = new User();
$user = $userModel->authenticate('admin', 'password');
```

### **Controller** (`app/controllers/`)
Menangani logika aplikasi dan request:
- `Controller.php` - Base class dengan method render, redirect, dll
- `AuthController.php` - Login/Logout logic
- `DashboardController.php` - Dashboard pages logic

```php
// Contoh controller
class DashboardController extends Controller {
    public function index() {
        $user = $this->getUser();
        $this->set('user', $user);
        $this->render('dashboard');
    }
}
```

### **View** (`app/views/`)
Menampilkan UI kepada user:
- `layouts/main.php` - Template wrapper untuk semua halaman
- `login.php` - Form login
- `dashboard.php` - Dashboard utama
- Halaman lainnya sesuai kebutuhan

```php
<!-- Contoh view -->
<div class="card-value"><?php echo $stats['total_users']; ?></div>
```

### **Entry Point** (`public/index.php`)
Router utama yang mengarahkan request ke controller yang sesuai:

```
URL: http://localhost/dashboard_template/public/?controller=dashboard&action=index
Router akan memanggil: DashboardController::index()
```

## 🔐 Kredensial Demo

```
Username: admin
Password: password

Username: user
Password: password

Username: manager
Password: password
```

> ⚠️ **PENTING:** Untuk production:
> - Ubah kredensial default
> - Implementasikan database authentication
> - Gunakan password hashing dengan `password_hash()`
> - Tambahkan CSRF protection
> - Implement permission/role system

## 📝 Cara Menggunakan

### 1. **Menambah Controller Baru**

```php
// app/controllers/ProductController.php
<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Product.php';

class ProductController extends Controller {
    private $productModel;

    public function __construct() {
        parent::__construct();
        $this->productModel = new Product();
        $this->requireLogin();
    }

    public function index() {
        $products = $this->productModel->getAllProducts();
        $this->set('products', $products);
        $this->render('product/index');
    }
}
```

### 2. **Menambah Model Baru**

```php
// app/models/Product.php
<?php

require_once __DIR__ . '/Model.php';

class Product extends Model {
    protected $table = 'products';

    public function getAllProducts() {
        // Query ke database atau return dummy data
        return [];
    }
}
```

### 3. **Menambah View Baru**

```php
// app/views/product/index.php
<?php foreach ($products as $product): ?>
    <div class="card-box">
        <h3><?php echo $product['name']; ?></h3>
        <p><?php echo $product['description']; ?></p>
    </div>
<?php endforeach; ?>
```

### 4. **Update Router di public/index.php**

```php
case 'product':
    $productController = new ProductController();
    if ($action === 'index') {
        $productController->index();
    } elseif ($action === 'show') {
        $productController->show($_GET['id'] ?? null);
    }
    break;
```

## 🎨 Kustomisasi

### Mengubah Warna
Edit CSS variables di `app/views/layouts/main.php`:

```css
:root {
    --primary-color: #3498db;
    --secondary-color: #2c3e50;
    --success-color: #27ae60;
    --warning-color: #f39c12;
    --danger-color: #e74c3c;
}
```

### Mengubah Data Dummy
Edit method di models:

```php
// app/models/Activity.php
public function getAllActivities() {
    return [
        // Tambahkan data sesuai kebutuhan
    ];
}
```

## 🗄️ Integrasi Database

### Contoh dengan MySQLi

```php
// app/config/Database.php
class Database {
    public function connect() {
        $this->connection = new mysqli(
            DB_HOST,
            DB_USER,
            DB_PASS,
            DB_NAME
        );

        if ($this->connection->connect_error) {
            die('Connection failed: ' . $this->connection->connect_error);
        }

        return $this->connection;
    }
}
```

### Model dengan Database Query

```php
// app/models/User.php
public function authenticate($username, $password) {
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $this->db->prepare($query);
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
```

## 📱 Responsive Breakpoints

- **Desktop (1200px+):** Full sidebar 250px
- **Tablet (768px-1199px):** Sidebar 200px
- **Mobile (<768px):** Stack layout, sidebar hidden

## 🌐 Browser Compatibility

✅ Chrome/Edge 90+
✅ Firefox 88+
✅ Safari 14+
✅ Mobile browsers (iOS Safari, Chrome Mobile)

## 🔍 Best Practices

1. **MVC Separation** - Pisahkan concerns antara Model, View, Controller
2. **DRY (Don't Repeat Yourself)** - Gunakan base classes untuk reusable code
3. **Validation** - Validasi input di controller dan model
4. **Error Handling** - Implement proper error handling
5. **Security** - Sanitasi input, prevent SQL injection, XSS, CSRF
6. **Performance** - Cache data, optimize queries
7. **Testing** - Tulis unit tests untuk critical functions

## 📚 Referensi

- [PHP Best Practices](https://www.phptherightway.com/)
- [Bootstrap Documentation](https://getbootstrap.com/docs/)
- [Font Awesome Icons](https://fontawesome.com/docs)
- [MVC Pattern](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)

## 📄 License

Free to use and modify for commercial and personal projects.

## 💬 Support

Untuk pertanyaan atau customisasi lebih lanjut, hubungi developer atau konsultasikan dokumentasi di atas.
