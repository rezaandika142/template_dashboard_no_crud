<?php
/**
 * Entry Point Aplikasi Dashboard
 * File ini menangani routing ke controller yang sesuai
 */

// Start session
session_start();

// Load konfigurasi
require_once __DIR__ . '/../app/config/config.php';

// Load autoloader untuk namespace
require_once __DIR__ . '/../app/autoloader.php';

// Import controllers
use App\Controllers\AuthController;
use App\Controllers\DashboardController;

// Get controller and action dari URL
$controller = isset($_GET['controller']) ? strtolower($_GET['controller']) : 'auth';
$action = isset($_GET['action']) ? strtolower($_GET['action']) : 'login';

// Routing
try {
    switch ($controller) {
        case 'auth':
            $authController = new AuthController();
            if ($action === 'login') {
                $authController->login();
            } elseif ($action === 'logout') {
                $authController->logout();
            } else {
                throw new Exception('Action tidak ditemukan');
            }
            break;

        case 'dashboard':
            $dashboardController = new DashboardController();
            
            if ($action === 'index') {
                $dashboardController->index();
            } elseif ($action === 'analytics') {
                $dashboardController->analytics();
            } elseif ($action === 'users') {
                $dashboardController->users();
            } elseif ($action === 'reports') {
                $dashboardController->reports();
            } elseif ($action === 'settings') {
                $dashboardController->settings();
            } else {
                throw new Exception('Action tidak ditemukan');
            }
            break;

        default:
            // Default ke auth login
            $authController = new AuthController();
            $authController->login();
            break;
    }
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
