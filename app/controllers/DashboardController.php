<?php

namespace App\Controllers;

use App\Models\Activity;
use App\Models\User;

/**
 * Class DashboardController
 * Controller untuk menangani dashboard
 */

class DashboardController extends Controller {
    private $activityModel;
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->activityModel = new Activity();
        $this->userModel = new User();
        
        // Login check sudah dilakukan di router (public/index.php)
        // Jadi tidak perlu call requireLogin() di sini
    }

    /**
     * Menampilkan dashboard utama
     */
    public function index() {
        // Get current user
        $user = $this->getUser();

        // Get data untuk dashboard
        $stats = [
            'total_users' => 1234,
            'revenue' => 45320,
            'orders' => 892,
            'growth' => 24
        ];

        $activities = $this->activityModel->getAllActivities();

        // Set data untuk view
        $this->set([
            'page_title' => 'Dashboard',
            'user' => $user,
            'stats' => $stats,
            'activities' => $activities
        ]);

        $this->render('dashboard');
    }

    /**
     * Menampilkan halaman analytics
     */
    public function analytics() {
        $this->set('page_title', 'Analytics');
        $this->render('analytics');
    }

    /**
     * Menampilkan halaman users
     */
    public function users() {
        $users = $this->userModel->getAllUsers();
        
        $this->set([
            'page_title' => 'Users',
            'users' => $users
        ]);

        $this->render('users');
    }

    /**
     * Menampilkan halaman reports
     */
    public function reports() {
        $this->set('page_title', 'Reports');
        $this->render('reports');
    }

    /**
     * Menampilkan halaman settings
     */
    public function settings() {
        $this->set('page_title', 'Settings');
        $this->render('settings');
    }
}
