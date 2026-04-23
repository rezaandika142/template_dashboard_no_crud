<?php

namespace App\Config;

/**
 * Class Database
 * Menangani koneksi ke database
 */

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        // Constructor private untuk singleton pattern
    }

    /**
     * Mendapatkan singleton instance
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
            self::$instance->connect();
        }
        return self::$instance;
    }

    /**
     * Koneksi ke database (bisa menggunakan mysqli atau PDO)
     * Untuk sekarang menggunakan dummy data (tidak perlu DB)
     */
    private function connect() {
        // Untuk demo ini kita tidak menggunakan database nyata
        // Bisa diganti dengan mysqli atau PDO sesuai kebutuhan
    }

    /**
     * Mendapatkan koneksi
     */
    public function getConnection() {
        return $this->connection;
    }
}
