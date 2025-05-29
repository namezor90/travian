<?php
// .env betöltése
if (file_exists('.env')) {
    $lines = file('.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && substr($line, 0, 1) !== '#') {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

require_once 'config/database.php';

try {
    $db = Database::getInstance();
    echo $db->testConnection();
} catch(Exception $e) {
    echo "Hiba: " . $e->getMessage();
}
?>