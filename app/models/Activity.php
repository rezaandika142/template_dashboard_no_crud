<?php

namespace App\Models;

/**
 * Class Activity
 * Model untuk menangani aktivitas pengguna
 */

class Activity extends Model {
    protected $table = 'activities';

    /**
     * Mendapatkan semua aktivitas
     */
    public function getAllActivities() {
        return [
            [
                'id' => 1,
                'user' => 'Ahmad Rahman',
                'activity' => 'Login ke sistem',
                'timestamp' => '2026-04-23 10:30:00',
                'status' => 'success'
            ],
            [
                'id' => 2,
                'user' => 'Siti Nurhaliza',
                'activity' => 'Update profil',
                'timestamp' => '2026-04-23 09:15:00',
                'status' => 'success'
            ],
            [
                'id' => 3,
                'user' => 'Budi Santoso',
                'activity' => 'Download laporan',
                'timestamp' => '2026-04-22 14:45:00',
                'status' => 'pending'
            ],
            [
                'id' => 4,
                'user' => 'Rina Wijaya',
                'activity' => 'Impor data',
                'timestamp' => '2026-04-22 11:20:00',
                'status' => 'success'
            ],
            [
                'id' => 5,
                'user' => 'Hendra Kusuma',
                'activity' => 'Ubah password',
                'timestamp' => '2026-04-21 16:00:00',
                'status' => 'failed'
            ]
        ];
    }

    /**
     * Mendapatkan aktivitas berdasarkan user
     */
    public function getActivitiesByUser($userId) {
        $activities = $this->getAllActivities();
        return array_slice($activities, 0, 3);
    }

    /**
     * Mencatat aktivitas baru
     */
    public function logActivity($userId, $activity, $status = 'success') {
        // Dalam production, simpan ke database
        return true;
    }

    /**
     * Mendapatkan statistik aktivitas
     */
    public function getActivityStats() {
        $activities = $this->getAllActivities();
        
        return [
            'total' => count($activities),
            'success' => count(array_filter($activities, fn($a) => $a['status'] === 'success')),
            'pending' => count(array_filter($activities, fn($a) => $a['status'] === 'pending')),
            'failed' => count(array_filter($activities, fn($a) => $a['status'] === 'failed'))
        ];
    }
}
