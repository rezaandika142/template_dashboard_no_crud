<?php

namespace App\Controllers;

use App\Models\User;

/**
 * Class AuthController
 * Controller untuk menangani authentikasi (login/logout)
 */

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
    }

    /**
     * Menampilkan halaman login
     */
    public function login() {
        $this->requireLogout(); // Jangan tampilkan jika sudah login

        $error = '';

        // Process login form
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            // Validasi input
            if (empty($username) || empty($password)) {
                $error = 'Username dan password harus diisi';
            } else {
                // Authenticate user
                $user = $this->userModel->authenticate($username, $password);

                if ($user) {
                    // Set session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['user'] = $user;
                    $_SESSION['login_time'] = time();

                    // Redirect ke dashboard (relative URL)
                    $this->redirect('?controller=dashboard&action=index');
                } else {
                    $error = 'Username atau password salah';
                }
            }
        }

        // Set data untuk view
        $this->set('error', $error);
        $this->render('login');
    }

    /**
     * Logout user
     */
    public function logout() {
        // Destroy session
        session_destroy();

        // Redirect ke login (relative URL)
        $this->redirect('?controller=auth&action=login');
    }
}
