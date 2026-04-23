<?php

namespace App\Models;

/**
 * Class User
 * Model untuk menangani data user
 */

class User extends Model {
    protected $table = 'users';

    /**
     * Authenticate user dengan username dan password
     */
    public function authenticate($username, $password) {
        // Dummy users untuk demo (dalam production gunakan database)
        $users = [
            [
                'id' => 1,
                'username' => 'admin',
                'password' => 'password', // Dalam production, gunakan password_hash()
                'email' => 'admin@dashboard.local',
                'full_name' => 'Administrator',
                'role' => 'admin'
            ],
            [
                'id' => 2,
                'username' => 'user',
                'password' => 'password',
                'email' => 'user@dashboard.local',
                'full_name' => 'Regular User',
                'role' => 'user'
            ]
        ];

        foreach ($users as $user) {
            if ($user['username'] === $username && $user['password'] === $password) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Mendapatkan user berdasarkan ID
     */
    public function getUserById($id) {
        $users = [
            1 => [
                'id' => 1,
                'username' => 'admin',
                'email' => 'admin@dashboard.local',
                'full_name' => 'Administrator',
                'role' => 'admin'
            ]
        ];

        return $users[$id] ?? null;
    }

    /**
     * Mendapatkan semua users
     */
    public function getAllUsers() {
        return [
            [
                'id' => 1,
                'username' => 'admin',
                'email' => 'admin@dashboard.local',
                'full_name' => 'Administrator',
                'role' => 'admin',
                'created_at' => '2024-01-01'
            ],
            [
                'id' => 2,
                'username' => 'user',
                'email' => 'user@dashboard.local',
                'full_name' => 'Regular User',
                'role' => 'user',
                'created_at' => '2024-01-05'
            ],
            [
                'id' => 3,
                'username' => 'manager',
                'email' => 'manager@dashboard.local',
                'full_name' => 'Manager User',
                'role' => 'manager',
                'created_at' => '2024-01-10'
            ]
        ];
    }
}
