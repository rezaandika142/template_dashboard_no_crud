<?php
/**
 * Main Layout
 * Template utama untuk semua halaman
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) . ' - ' : ''; ?><?php echo APP_NAME; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/assets/css/style.css">
    
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --light-bg: #ecf0f1;
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: var(--secondary-color);
            color: white;
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 0 20px;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 20px;
        }

        .sidebar-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar-menu a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .sidebar-menu i {
            margin-right: 15px;
            width: 20px;
        }

        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 20px;
        }

        .topbar {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar-title h1 {
            margin: 0;
            color: var(--secondary-color);
            font-size: 1.8rem;
            font-weight: 700;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            text-align: right;
        }

        .user-info p {
            margin: 0;
            color: var(--secondary-color);
            font-weight: 600;
        }

        .user-info small {
            color: #7f8c8d;
        }

        .logout-btn {
            background-color: var(--danger-color);
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .logout-btn:hover {
            background-color: #c0392b;
            color: white;
        }

        .card-box {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .card-box:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .content-box {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .content-box h2 {
            color: var(--secondary-color);
            margin-bottom: 20px;
            font-weight: 700;
        }

        table {
            width: 100%;
        }

        table thead {
            background-color: var(--light-bg);
        }

        table th {
            padding: 15px;
            color: var(--secondary-color);
            font-weight: 600;
            border: none;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ecf0f1;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }

            .topbar {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .user-menu {
                width: 100%;
                justify-content: space-between;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

            .topbar-title h1 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>

<?php if (isset($user) && $user): ?>
    <!-- Dashboard View -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-chart-line"></i> <?php echo APP_NAME; ?></h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="<?php echo APP_URL; ?>/index.php?controller=dashboard&action=index"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?php echo APP_URL; ?>/index.php?controller=dashboard&action=analytics"><i class="fas fa-chart-bar"></i> Analytics</a></li>
                <li><a href="<?php echo APP_URL; ?>/index.php?controller=dashboard&action=users"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="<?php echo APP_URL; ?>/index.php?controller=dashboard&action=reports"><i class="fas fa-file"></i> Reports</a></li>
                <li><a href="<?php echo APP_URL; ?>/index.php?controller=dashboard&action=settings"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="<?php echo APP_URL; ?>/index.php?controller=auth&action=logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Topbar -->
            <div class="topbar">
                <div class="topbar-title">
                    <h1><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Dashboard'; ?></h1>
                </div>
                <div class="user-menu">
                    <div class="user-info">
                        <p><?php echo htmlspecialchars($user['full_name']); ?></p>
                        <small><?php echo ucfirst($user['role']); ?></small>
                    </div>
                    <a href="<?php echo APP_URL; ?>/index.php?controller=auth&action=logout" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>

            <!-- Content -->
            <?php echo $content; ?>
        </div>
    </div>

<?php else: ?>
    <!-- Non-Dashboard View -->
    <?php echo $content; ?>

<?php endif; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="<?php echo APP_URL; ?>/assets/js/script.js"></script>
</body>
</html>
