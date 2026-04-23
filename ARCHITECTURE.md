# 🏗️ Arsitektur MVC Dashboard

Dokumentasi detail tentang arsitektur Model-View-Controller yang digunakan dalam template dashboard ini.

## 📊 Diagram Alur Aplikasi

```
┌─────────────────────────────────────────────────────────────┐
│                    USER BROWSER                              │
│              http://localhost/public/                        │
│         ?controller=dashboard&action=index                   │
└────────────────────────┬────────────────────────────────────┘
                         │
                         ↓
┌─────────────────────────────────────────────────────────────┐
│            public/index.php (ROUTER)                         │
│  ├─ Load config                                              │
│  ├─ Load all controllers                                     │
│  ├─ Parse URL (controller, action)                           │
│  └─ Call appropriate controller action                       │
└────────────────────────┬────────────────────────────────────┘
                         │
                         ↓
┌─────────────────────────────────────────────────────────────┐
│     app/controllers/DashboardController.php                  │
│  ├─ Validate session                                         │
│  ├─ Call model methods to get data                           │
│  ├─ Set data for view                                        │
│  └─ Call render() to show view                               │
└────────────────────────┬────────────────────────────────────┘
                         │
        ┌────────────────┴────────────────┐
        ↓                                 ↓
┌───────────────────────┐      ┌──────────────────────┐
│  app/models/          │      │ app/views/           │
│  ├─ Activity.php      │      │ ├─ dashboard.php     │
│  ├─ User.php          │      │ ├─ analytics.php     │
│  └─ Product.php       │      │ ├─ layouts/main.php  │
│                       │      │ └─ (others)          │
│ Ambil data dari DB    │      │ Tampilkan HTML       │
│ atau file             │      │ Gunakan data dari    │
│                       │      │ Controller           │
└───────────────────────┘      └──────────────────────┘
        │                                 │
        └────────────────┬────────────────┘
                         │
                         ↓
┌─────────────────────────────────────────────────────────────┐
│       HTML Rendered dengan Data                              │
│  (Bootstrap CSS + JavaScript Framework)                      │
└─────────────────────────────────────────────────────────────┘
                         │
                         ↓
┌─────────────────────────────────────────────────────────────┐
│              DISPLAY DI BROWSER                              │
└─────────────────────────────────────────────────────────────┘
```

## 🔧 Komponen Utama

### 1. **Router (public/index.php)**

**Tanggung Jawab:**
- Parse URL request dari user
- Load controller yang sesuai
- Call action method
- Handle error jika controller/action tidak ada

**Contoh:**
```
URL: ?controller=dashboard&action=index
↓
Instantiate: new DashboardController()
↓
Call: $controller->index()
```

**Kode:**
```php
$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

switch ($controller) {
    case 'dashboard':
        $dashboardController = new DashboardController();
        if ($action === 'index') {
            $dashboardController->index();
        }
        break;
}
```

---

### 2. **Controller (app/controllers/)**

**Tanggung Jawab:**
- Menerima request dari user
- Validasi input & session
- Call model untuk ambil data
- Set data untuk view
- Render view atau redirect

**Struktur:**
```php
class DashboardController extends Controller {
    // 1. Construct - Setup dependencies
    public function __construct() {
        parent::__construct();
        $this->activityModel = new Activity();
        $this->requireLogin(); // Protect
    }

    // 2. Action - Handle request
    public function index() {
        // 3. Get data dari model
        $activities = $this->activityModel->getAllActivities();

        // 4. Set data untuk view
        $this->set('activities', $activities);

        // 5. Render view
        $this->render('dashboard');
    }
}
```

**Base Controller Methods:**
```php
// Render view dengan data
$this->render('viewname', ['key' => 'value']);

// Set data untuk view
$this->set('variable', $value);

// Get data
$value = $this->get('variable');

// Redirect ke URL lain
$this->redirect('/path/');

// Check login
if (!$this->isLoggedIn()) { ... }

// Get user dari session
$user = $this->getUser();

// Auto-redirect ke login jika belum login
$this->requireLogin();

// Auto-redirect ke dashboard jika sudah login
$this->requireLogout();
```

---

### 3. **Model (app/models/)**

**Tanggung Jawab:**
- Definisikan struktur data
- Query database atau ambil dari file/API
- Business logic (validasi, calculation)
- Return data terstruktur ke controller

**Struktur:**
```php
class User extends Model {
    protected $table = 'users';

    // Ambil data dari database
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

    // Get single record
    public function getUserById($id) {
        // SQL query
    }

    // Get all records
    public function getAllUsers() {
        // SQL query
    }

    // Insert new record
    public function save($data) {
        // INSERT query
    }

    // Update record
    public function update($id, $data) {
        // UPDATE query
    }

    // Delete record
    public function delete($id) {
        // DELETE query
    }
}
```

**Base Model Methods:**
```php
$this->save($data);              // INSERT
$this->getById($id);             // SELECT WHERE id
$this->getAll();                 // SELECT *
$this->update($id, $data);       // UPDATE
$this->delete($id);              // DELETE
$this->getAttribute($key);       // Get property
$this->setAttribute($key, $value); // Set property
```

---

### 4. **View (app/views/)**

**Tanggung Jawab:**
- Terima data dari controller
- Render HTML dengan data
- Template untuk UI

**Struktur:**
```php
<!-- app/views/dashboard.php -->
<?php
/**
 * View: Dashboard
 * Data yang diterima dari controller:
 * - $page_title
 * - $user
 * - $stats
 * - $activities
 */
?>

<div class="content-box">
    <h1><?php echo $page_title; ?></h1>
    
    <table>
        <?php foreach ($activities as $activity): ?>
            <tr>
                <td><?php echo htmlspecialchars($activity['user']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
```

**Best Practices:**
- Gunakan `htmlspecialchars()` untuk escape HTML
- Gunakan `isset()` untuk check variable
- Keep logic minimal (gunakan ternary operator)
- Pisahkan HTML kompleks ke component partial

---

### 5. **Layout (app/views/layouts/main.php)**

**Tanggung Jawab:**
- Wrapper template untuk semua halaman
- Shared header, sidebar, footer
- Include CSS/JS global

**Struktur:**
```php
<!DOCTYPE html>
<html>
<head>
    <!-- Global CSS -->
    <link rel="stylesheet" href="...">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Navigation -->
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">...</div>

        <!-- View Content -->
        <?php echo $content; ?>
    </div>

    <!-- Global JS -->
    <script src="..."></script>
</body>
</html>
```

---

## 🔄 Data Flow Detail

### Contoh: User Login

```
1. USER BROWSER
   ↓
   Ketik URL: ?controller=auth&action=login
   
2. ROUTER (public/index.php)
   ↓
   Parse: controller=auth, action=login
   Instantiate: new AuthController()
   Call: $auth->login()
   
3. CONTROLLER (AuthController)
   ↓
   Check if POST request
   Get username & password dari $_POST
   
4. MODEL (User)
   ↓
   Query database atau check dummy data
   Return user object atau null
   
5. CONTROLLER
   ↓
   If user found:
   - Set session['user_id']
   - Set session['user']
   - Redirect ke dashboard
   
   If not found:
   - Set error message
   - Render login view
   
6. VIEW (login.php)
   ↓
   If error, tampilkan pesan error
   Show login form
   
7. LAYOUT (main.php)
   ↓
   Wrap view dengan HTML structure
   Include CSS/JS
   
8. HTML RESPONSE
   ↓
   Send ke browser
   Browser render HTML
   
9. USER BROWSER
   ↓
   Display login page atau redirect ke dashboard
```

---

## 📁 File Organization Best Practices

```
controllers/
├── Controller.php          # Base class
├── AuthController.php      # Auth related
├── DashboardController.php # Dashboard pages
├── ProductController.php   # Product management
└── UserController.php      # User management

models/
├── Model.php              # Base class
├── User.php               # User model
├── Product.php            # Product model
├── Activity.php           # Activity model
└── Permission.php         # Permission model

views/
├── layouts/
│   └── main.php           # Main layout wrapper
├── product/
│   ├── index.php          # Product list
│   ├── show.php           # Product detail
│   ├── create.php         # Create form
│   └── edit.php           # Edit form
├── user/
│   └── profile.php        # User profile
├── auth/
│   ├── login.php          # Login page
│   └── register.php       # Register page
└── dashboard.php          # Dashboard page
```

---

## 🔐 Security Considerations

### 1. **Input Validation**
```php
// Di Controller
$username = trim($_POST['username'] ?? '');
if (empty($username) || strlen($username) < 3) {
    $error = 'Username invalid';
}
```

### 2. **SQL Injection Prevention**
```php
// Di Model - WRONG
$query = "SELECT * FROM users WHERE username = '$username'";

// CORRECT - Gunakan prepared statements
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $this->db->prepare($query);
$stmt->bind_param("s", $username);
```

### 3. **XSS Prevention**
```php
// Di View - WRONG
<h1><?php echo $user_input; ?></h1>

// CORRECT - Escape HTML
<h1><?php echo htmlspecialchars($user_input); ?></h1>
```

### 4. **Password Security**
```php
// Hash password saat create
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Verify saat login
if (password_verify($password, $user['password'])) {
    // Login success
}
```

### 5. **Session Security**
```php
// Check session sebelum akses dashboard
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
```

---

## 🧪 Testing Architecture

### Unit Test Model
```php
// tests/UserModelTest.php
public function testAuthenticate() {
    $userModel = new User();
    $user = $userModel->authenticate('admin', 'password');
    $this->assertNotNull($user);
    $this->assertEquals('admin', $user['username']);
}
```

### Controller Test
```php
// tests/AuthControllerTest.php
public function testLoginWithValidCredentials() {
    $_POST['username'] = 'admin';
    $_POST['password'] = 'password';
    $_POST['login'] = 1;
    
    $controller = new AuthController();
    $controller->login();
    
    $this->assertTrue(isset($_SESSION['user_id']));
}
```

---

## 🚀 Scaling Tips

### 1. **Multiple Models per Feature**
```
controllers/
└── ProductController.php

models/
├── Product.php
├── ProductCategory.php
├── ProductImage.php
└── ProductReview.php
```

### 2. **Middleware Pattern**
```php
class AuthMiddleware {
    public static function check() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
            exit;
        }
    }
}

// Di controller
public function __construct() {
    AuthMiddleware::check();
}
```

### 3. **Service Layer**
```php
class UserService {
    private $userModel;
    
    public function login($username, $password) {
        $user = $this->userModel->authenticate($username, $password);
        if ($user) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }
}
```

### 4. **Dependency Injection**
```php
class ProductController extends Controller {
    public function __construct(Product $product, Category $category) {
        $this->product = $product;
        $this->category = $category;
    }
}
```

---

## 📚 References

- [MVC Pattern - Wikipedia](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)
- [PHP Best Practices](https://www.phptherightway.com/)
- [OWASP Security](https://owasp.org/)

---

**Architecture by MVC Pattern 🏗️**
