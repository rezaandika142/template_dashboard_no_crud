# 📋 Project Structure Overview

Dokumentasi lengkap struktur file dan folder Dashboard Template MVC.

## 📂 Complete Folder Structure

```
dashboard_template/
│
├── 📄 README.md                    ← Main documentation
├── 📄 QUICK_START.md              ← Quick start guide
├── 📄 ARCHITECTURE.md             ← MVC architecture detail
├── 📄 INSTALLATION_GUIDE.md       ← Installation instructions
├── 📄 PROJECT_STRUCTURE.md        ← This file
├── 📄 .gitignore                  ← Git ignore rules
├── 📄 index.php                   ← Redirect to public folder
├── 📄 logout.php                  ← Old logout (deprecated)
│
├── 📁 app/                        ← Application core
│   ├── 📁 config/                 ← Configuration files
│   │   ├── config.php            ← Global config
│   │   └── Database.php          ← Database singleton
│   │
│   ├── 📁 controllers/           ← Business logic handlers
│   │   ├── Controller.php        ← Base controller class
│   │   ├── AuthController.php    ← Authentication logic
│   │   └── DashboardController.php ← Dashboard pages logic
│   │
│   ├── 📁 models/               ← Data layer
│   │   ├── Model.php            ← Base model class
│   │   ├── User.php             ← User model (auth, data)
│   │   └── Activity.php         ← Activity model
│   │
│   └── 📁 views/                ← Presentation layer
│       ├── 📁 layouts/
│       │   └── main.php         ← Main layout wrapper
│       ├── login.php            ← Login page
│       ├── dashboard.php        ← Dashboard page
│       ├── analytics.php        ← Analytics page
│       ├── users.php            ← Users page
│       ├── reports.php          ← Reports page
│       └── settings.php         ← Settings page
│
└── 📁 public/                    ← Web root (public access)
    ├── index.php                ← Application entry point
    ├── .htaccess                ← Apache URL rewriting
    └── 📁 assets/              ← Static files
        ├── 📁 css/
        │   └── style.css       ← Custom styles
        └── 📁 js/
            └── script.js       ← Custom JavaScript
```

## 📄 File Descriptions

### Root Level Files

| File | Purpose |
|------|---------|
| `README.md` | Main documentation & features |
| `QUICK_START.md` | Quick start guide for developers |
| `ARCHITECTURE.md` | Detailed MVC architecture |
| `INSTALLATION_GUIDE.md` | Setup & deployment guide |
| `PROJECT_STRUCTURE.md` | This file - structure documentation |
| `.gitignore` | Git ignore patterns |
| `index.php` | Redirect to public folder |
| `logout.php` | Deprecated (for reference) |

### app/config/ - Configuration

```php
config.php
├── Database credentials
├── App name & URL
├── Session timeout
├── Error display settings
└── Timezone

Database.php
├── MySQLi connection handler
├── Connection pooling (singleton)
└── Error handling
```

### app/controllers/ - Request Handlers

```php
Controller.php (Base Class)
├── render($view, $data)      - Render view with data
├── redirect($url)            - Redirect to URL
├── set($key, $value)         - Set view data
├── isLoggedIn()              - Check session
├── getUser()                 - Get session user
├── requireLogin()            - Enforce login
└── requireLogout()           - Enforce logout

AuthController
├── login()                   - Handle login page & form
└── logout()                  - Handle logout

DashboardController
├── index()                   - Main dashboard
├── analytics()               - Analytics page
├── users()                   - Users list page
├── reports()                 - Reports page
└── settings()                - Settings page
```

### app/models/ - Data Layer

```php
Model.php (Base Class)
├── getAll()                  - Get all records
├── getById($id)              - Get by ID
├── save($data)               - Create new
├── update($id, $data)        - Update record
├── delete($id)               - Delete record
├── getAttribute()            - Get property
└── setAttribute()            - Set property

User.php
├── authenticate($user, $pass)  - Verify login
├── getUserById($id)            - Get user by ID
└── getAllUsers()               - List all users

Activity.php
├── getAllActivities()        - Get all activities
├── getActivitiesByUser($id)  - Get user activities
├── logActivity()             - Log new activity
└── getActivityStats()        - Get activity stats
```

### app/views/ - Presentation Layer

```
layouts/
└── main.php              - Master template
                           - Sidebar & navigation
                           - Topbar & user menu
                           - CSS/JS includes
                           - View wrapper

login.php                - Login form page
                          - Username/password input
                          - Error messages
                          - Demo credentials info

dashboard.php            - Main dashboard
                          - Stats cards (4 widgets)
                          - Activity table
                          - Recent data display

analytics.php            - Analytics placeholder
                          - Ready for charts

users.php                - User listing
                          - User data table
                          - Role badges

reports.php              - Reports placeholder
                          - Ready for data export

settings.php             - Settings page
                          - Profile settings form
                          - Security settings
                          - App settings
```

### public/assets/ - Static Files

```
css/
└── style.css            - Custom styles
                          - Variables & animations
                          - Utility classes
                          - Print styles

js/
└── script.js            - Custom JavaScript
                          - Utility functions
                          - Event listeners
                          - Bootstrap tooltips

index.php               - Entry point
                        - URL routing
                        - Controller loading
                        - Error handling

.htaccess               - Apache config
                        - URL rewriting
                        - RewriteEngine rules
```

## 🔄 Data Flow Through Files

### User Login Flow

```
1. public/index.php
   ↓ Parse URL: controller=auth&action=login
   ↓
2. app/controllers/AuthController.php
   ↓ Instantiate & call login()
   ↓
3. POST request received
   ↓
4. app/models/User.php
   ↓ authenticate($username, $password)
   ↓
5. Check credentials (dummy or database)
   ↓
6. If valid:
   ├→ Set $_SESSION['user_id']
   ├→ Set $_SESSION['user']
   ├→ redirect() to dashboard
   │
   └→ If invalid:
      ├→ Set $error message
      └→ render('login')
   
7. app/views/login.php
   ↓ Display form with error (if any)
   ↓
8. app/views/layouts/main.php
   ↓ Wrap with HTML structure
   ↓
9. Browser displays login page
```

### Dashboard Page Load Flow

```
1. public/index.php
   ↓ Parse: controller=dashboard&action=index
   ↓
2. app/controllers/DashboardController.php
   ↓ __construct() → requireLogin() check
   ↓
3. Session exists? Continue : Redirect to login
   ↓
4. Call dashboard models
   ├→ app/models/Activity.php → getAllActivities()
   └→ app/models/User.php → getCurrentUser()
   
5. $controller->set('activities', $activities)
   ↓
6. $controller->render('dashboard')
   ↓
7. app/views/dashboard.php
   ├→ Display stats cards
   ├→ Display activity table
   └→ Use $activities data
   
8. Rendered content stored in $content
   ↓
9. app/views/layouts/main.php
   ├→ Display sidebar
   ├→ Display topbar
   ├→ Echo $content
   └→ Include CSS/JS
   
10. Complete HTML sent to browser
```

## 🔧 How Files Work Together

### Controller & Model Relationship

```
DashboardController.php
│
├─→ __construct()
│   └─→ $this->activityModel = new Activity()
│
└─→ index()
    ├─→ $activities = $this->activityModel->getAllActivities()
    │
    ├─→ $this->set('activities', $activities)
    │
    └─→ $this->render('dashboard')
        └─→ app/views/dashboard.php gets $activities
```

### Model & Database Relationship

```
app/models/Activity.php
│
└─→ getAllActivities()
    ├─→ Query database
    │   SELECT * FROM activities
    │
    ├─→ Fetch all rows
    │
    └─→ Return array of activities
        │
        └─→ Controller uses this data
```

### View & Layout Relationship

```
app/views/layouts/main.php (MASTER)
│
├─→ HTML Head & Body
├─→ Sidebar Navigation
├─→ Topbar
├─→ Echo $content ← HERE (view rendered content)
├─→ Footer
└─→ CSS/JS

INSERTED FROM: app/views/dashboard.php
│
├─→ Stats cards
├─→ Activity table
└─→ Uses $activities data
```

## 📊 Typical File Modifications

### Adding New Feature (e.g., Products)

1. **Create Model:** `app/models/Product.php`
   - Define database table & methods
   - Handle data queries

2. **Create Controller:** `app/controllers/ProductController.php`
   - Handle requests
   - Call model methods
   - Set view data

3. **Create Views:**
   - `app/views/product/index.php` - List
   - `app/views/product/show.php` - Detail
   - `app/views/product/create.php` - Create form
   - `app/views/product/edit.php` - Edit form

4. **Update Router:** `public/index.php`
   - Add case for 'product' controller
   - Include ProductController

5. **Update Layout:** `app/views/layouts/main.php`
   - Add menu item for Products

## 🔐 Security Considerations by File

| File | Security Aspects |
|------|------------------|
| `config.php` | Keep sensitive data safe, use .env |
| `Database.php` | Prepared statements to prevent SQL injection |
| `AuthController.php` | Validate credentials, hash passwords |
| `Controller.php` | Session validation, access control |
| `User.php` | Password verification, secure queries |
| `login.php` | Escape output, CSRF protection ready |
| `*.php` (views) | Always use `htmlspecialchars()` |

## 📦 Dependencies

### Framework
- **Bootstrap 5** - CSS framework (CDN)
- **Font Awesome 6.4** - Icon library (CDN)

### PHP Built-in
- `mysqli` - Database (optional)
- `sessions` - Session management

### No external PHP dependencies needed!
All code uses native PHP functions.

## 🎯 File Editing Checklist

When modifying files, check these:

- [ ] **Controllers** - Call correct models, validate input
- [ ] **Models** - Use prepared statements, return consistent data
- [ ] **Views** - Escape all output with `htmlspecialchars()`
- [ ] **Layouts** - Don't break structure, maintain consistency
- [ ] **Config** - Update for new settings
- [ ] **Routes** - Add new controller/action pairs to router

## 📈 Scalability - When to Refactor

| When | Action |
|------|--------|
| Too many models | Create `models/entities/` subdirectory |
| Complex controllers | Create `services/` layer for business logic |
| Duplicate code | Extract to `helpers/` utility functions |
| Many routes | Use advanced routing library |
| Large views | Split into partials/components |
| Multiple environments | Use environment-based configs |

## 🚀 Performance Tips

- Cache database queries in models
- Minimize CSS/JS in assets
- Use CDN for libraries
- Implement pagination for large tables
- Add database indexes on frequently queried columns
- Minify and compress assets

---

**Happy Coding! 🎉**
