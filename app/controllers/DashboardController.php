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
        $user = $this->getUser();
        
        // Get analytics data
        $analyticsData = [
            'page_views' => 45231,
            'engagement' => 3214,
            'conversion_rate' => 3.24,
            'revenue' => 45320
        ];
        
        $this->set([
            'page_title' => 'Analytics',
            'user' => $user,
            'analytics' => $analyticsData
        ]);
        
        $this->render('analytics');
    }

    /**
     * Menampilkan halaman users
     */
    public function users() {
        $user = $this->getUser();
        $users = $this->userModel->getAllUsers();
        
        $this->set([
            'page_title' => 'Users',
            'user' => $user,
            'users' => $users
        ]);

        $this->render('users');
    }

    /**
     * Menampilkan halaman reports
     */
    public function reports() {
        $user = $this->getUser();
        
        $this->set([
            'page_title' => 'Reports',
            'user' => $user
        ]);
        
        $this->render('reports');
    }

    /**
     * Menampilkan halaman settings
     */
    public function settings() {
        $user = $this->getUser();
        
        $this->set([
            'page_title' => 'Settings',
            'user' => $user
        ]);
        
        $this->render('settings');
    }
}
