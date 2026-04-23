<?php
echo "Server OK - PHP Running";
echo "<br>";
echo "Current dir: " . __DIR__;
echo "<br>";
echo "App dir exists: " . (file_exists(__DIR__ . '/../app') ? 'YES' : 'NO');
echo "<br>";
echo "Config file exists: " . (file_exists(__DIR__ . '/../app/config/config.php') ? 'YES' : 'NO');
echo "<br>";
echo "Autoloader file exists: " . (file_exists(__DIR__ . '/../app/autoloader.php') ? 'YES' : 'NO');
