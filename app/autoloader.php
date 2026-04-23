<?php

/**
 * PSR-4 Autoloader untuk Dashboard Template
 * Menghandle loading class secara otomatis berdasarkan namespace
 */

spl_autoload_register(function ($class) {
    // Prefix namespace
    $prefix = 'App\\';
    
    // Check jika class menggunakan prefix
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Ambil relative class name
    $relative_class = substr($class, $len);

    // Replace namespace separator dengan directory separator
    $file = __DIR__ . '/' . str_replace('\\', '/', $relative_class) . '.php';

    // Include file jika ada
    if (file_exists($file)) {
        require $file;
    }
});
