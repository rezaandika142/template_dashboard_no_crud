<?php
/**
 * Redirect ke public/index.php
 * File ini hanya untuk memudahkan akses tanpa harus ke /public folder
 */

// Redirect ke public folder
header('Location: ' . str_replace(basename(__FILE__), '', $_SERVER['PHP_SELF']) . 'public/');
exit;
