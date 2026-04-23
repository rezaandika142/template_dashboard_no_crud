<?php

namespace App\Models;

/**
 * Class Model
 * Base class untuk semua model
 * Menyediakan method-method umum untuk CRUD operations
 */

class Model {
    protected $db;
    protected $table;
    protected $attributes = [];

    public function __construct() {
        // Inisialisasi database jika perlu
        // $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Mendapatkan semua data dari tabel
     */
    public function getAll() {
        // Implementasi query ke database
        return [];
    }

    /**
     * Mendapatkan data berdasarkan ID
     */
    public function getById($id) {
        // Implementasi query ke database
        return [];
    }

    /**
     * Menyimpan data baru
     */
    public function save($data) {
        $this->attributes = $data;
        // Implementasi insert ke database
        return true;
    }

    /**
     * Update data
     */
    public function update($id, $data) {
        // Implementasi update ke database
        return true;
    }

    /**
     * Menghapus data
     */
    public function delete($id) {
        // Implementasi delete dari database
        return true;
    }

    /**
     * Mendapatkan attribute
     */
    public function getAttribute($key) {
        return $this->attributes[$key] ?? null;
    }

    /**
     * Set attribute
     */
    public function setAttribute($key, $value) {
        $this->attributes[$key] = $value;
        return $this;
    }
}
