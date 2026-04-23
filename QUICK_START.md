# 🚀 Quick Start Guide - Dashboard MVC

Panduan cepat untuk memulai menggunakan Dashboard Template dengan arsitektur MVC.

## 📍 Akses Dashboard

```
http://localhost/dashboard_template/public/
```

## 🔑 Kredensial Login

```
Username: admin
Password: password
```

Atau coba user lain:
- `user` / `password`
- `manager` / `password`

## 📂 Struktur Folder (Penjelasan Singkat)

```
app/
├── config/          → Konfigurasi aplikasi
├── controllers/     → Logika request handling
├── models/          → Logika bisnis & data
└── views/           → Template HTML

public/
├── index.php        → Entry point aplikasi
└── assets/          → CSS, JS, images
```

## 🔄 Alur Kerja MVC

```
REQUEST
   ↓
public/index.php (ROUTER)
   ↓
app/controllers/XXXController.php (CONTROLLER)
   ↓
app/models/XXX.php (MODEL - ambil data)
   ↓
app/views/xxx.php (VIEW - tampilkan)
   ↓
app/views/layouts/main.php (LAYOUT WRAPPER)
   ↓
RESPONSE (HTML ke browser)
```

## 📝 Contoh: Membuat Fitur Baru

### 1. Buat Model Baru
**File:** `app/models/Product.php`

```php
<?php
require_once __DIR__ . '/Model.php';

class Product extends Model {
    protected $table = 'products';

    public function getAllProducts() {
        return [
            ['id' => 1, 'name' => 'Product 1', 'price' => 100000],
            ['id' => 2, 'name' => 'Product 2', 'price' => 200000],
        ];
    }
}
```

### 2. Buat Controller Baru
**File:** `app/controllers/ProductController.php`

```php
<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Product.php';

class ProductController extends Controller {
    private $productModel;

    public function __construct() {
        parent::__construct();
        $this->productModel = new Product();
        $this->requireLogin(); // Protect page
    }

    public function index() {
        $products = $this->productModel->getAllProducts();
        
        $this->set([
            'page_title' => 'Products',
            'products' => $products
        ]);
        
        $this->render('product/index');
    }
}
```

### 3. Buat View Baru
**File:** `app/views/product/index.php`

```php
<?php
/**
 * View: Product List
 */
?>

<div class="content-box">
    <h2>Product List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td>Rp. <?php echo number_format($product['price']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
```

### 4. Update Router
**File:** `public/index.php`

Tambahkan di sectionSwitch:

```php
case 'product':
    $productController = new ProductController();
    if ($action === 'index') {
        $productController->index();
    }
    break;
```

### 5. Akses Fitur Baru
```
http://localhost/dashboard_template/public/?controller=product&action=index
```

## 🎨 Menggunakan Layout & View

### Di Controller:

```php
public function dashboard() {
    // Set data untuk view
    $this->set('page_title', 'Dashboard');
    $this->set('stats', $data);
    
    // Render view (akan otomatis wrap dengan layout)
    $this->render('dashboard');
}
```

### Di View:

```php
<!-- app/views/dashboard.php -->
<div class="content-box">
    <h1><?php echo $page_title; ?></h1>
    <p>Stats: <?php echo $stats['total']; ?></p>
</div>
```

Layout akan otomatis render view dengan sidebar, navbar, etc.

## 🔐 Session & Authentication

### Check if User Logged In:

```php
// Di Controller
if (!$this->isLoggedIn()) {
    $this->redirect(APP_URL . '/public/?controller=auth&action=login');
}

// Atau langsung
$this->requireLogin(); // Auto redirect if not logged in
```

### Get Current User:

```php
$user = $this->getUser();
echo $user['username'];  // admin
echo $user['role'];      // admin
```

## 🌐 URLs & Routing

### Format URL:
```
http://localhost/dashboard_template/public/?controller=XXX&action=YYY
```

### Contoh URLs:
```
Dashboard Home:
?controller=dashboard&action=index

Analytics:
?controller=dashboard&action=analytics

Users:
?controller=dashboard&action=users

Login:
?controller=auth&action=login

Logout:
?controller=auth&action=logout
```

## 💾 Integrasi Database

### Setup Database (config.php):

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'dashboard_db');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### Model dengan Query:

```php
public function authenticate($username, $password) {
    $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
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

## 📚 Helper Methods di Controller

```php
// Render view
$this->render('dashboard', ['key' => 'value']);

// Redirect
$this->redirect(APP_URL . '/public/');

// Set data untuk view
$this->set('var_name', $value);

// Check login
$this->isLoggedIn();

// Get user
$this->getUser();

// Require login (auto redirect if not)
$this->requireLogin();

// Require logout (auto redirect if logged in)
$this->requireLogout();
```

## 🎯 Best Practices

1. **Keep Controllers Lean** - Business logic di Model
2. **Validate Input** - Sanitize dan validate di Controller/Model
3. **Use Prepared Statements** - Prevent SQL Injection
4. **Password Hashing** - Gunakan `password_hash()` dan `password_verify()`
5. **Error Handling** - Implement proper try-catch blocks
6. **Comments** - Document your code
7. **DRY Principle** - Don't Repeat Yourself

## 🚨 Common Issues

### 1. "Page not found" / "View tidak ditemukan"
```
✅ Pastikan file view ada di app/views/
✅ Pastikan nama controller dan action benar
```

### 2. "Headers already sent"
```
✅ Jangan ada output sebelum redirect()
✅ Check BOM di file PHP
```

### 3. Session tidak tersimpan
```
✅ Pastikan session_start() dipanggil di public/index.php
✅ Check browser cookie settings
```

## 📞 Need Help?

1. Baca README.md untuk dokumentasi lengkap
2. Check app/controllers/DashboardController.php untuk contoh
3. Review app/models/ untuk struktur model
4. Check app/views/ untuk contoh view

---

**Happy Coding! 🎉**
