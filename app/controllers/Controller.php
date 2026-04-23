<?php

namespace App\Controllers;

/**
 * Class Controller
 * Base class untuk semua controller
 * Menyediakan method-method umum untuk render view, redirect, dll
 */

class Controller {
    protected $data = [];

    /**
     * Constructor
     */
    public function __construct() {
        // Initialize data array
        $this->data = [];
    }

    /**
     * Render view
     */
    protected function render($view, $data = []) {
        $this->data = array_merge($this->data, $data);
        
        // Ekstrak data agar bisa diakses langsung di view
        extract($this->data);
        
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        
        if (!file_exists($viewPath)) {
            die("View tidak ditemukan: " . $view);
        }
        
        ob_start();
        require $viewPath;
        $content = ob_get_clean();
        
        // Include layout
        $layoutPath = __DIR__ . '/../views/layouts/main.php';
        require $layoutPath;
    }

    /**
     * Render layout dengan content
     */
    protected function renderLayout($content) {
        extract($this->data);
        include __DIR__ . '/../views/layouts/main.php';
    }

    /**
     * Redirect ke URL
     */
    protected function redirect($url) {
        header('Location: ' . $url);
        exit;
    }

    /**
     * Set data yang akan dikirim ke view
     */
    protected function set($key, $value = null) {
        if (is_array($key)) {
            $this->data = array_merge($this->data, $key);
        } else {
            $this->data[$key] = $value;
        }
    }

    /**
     * Get data
     */
    protected function get($key) {
        return $this->data[$key] ?? null;
    }

    /**
     * Check if user is logged in
     */
    protected function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    /**
     * Get current logged in user
     */
    protected function getUser() {
        return $_SESSION['user'] ?? null;
    }

    /**
     * Require login
     */
    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            $this->redirect('?controller=auth&action=login');
        }
    }

    /**
     * Require logout (untuk login page)
     */
    protected function requireLogout() {
        if ($this->isLoggedIn()) {
            $this->redirect('?controller=dashboard&action=index');
        }
    }
}
