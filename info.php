
<?php
// info.php - Egyszerű teszt fájl
echo "<h1>PHP működik!</h1>";
echo "<p>Ha ezt látod, a webszerver rendben van.</p>";
echo "<p>PHP verzió: " . phpversion() . "</p>";
echo "<p>Aktuális könyvtár: " . __DIR__ . "</p>";

// Fájlok listázása
echo "<h3>Fájlok a könyvtárban:</h3>";
$files = scandir('.');
foreach($files as $file) {
    if($file != '.' && $file != '..') {
        echo "- " . $file . "<br>";
    }
}
?>

<?php 
// test_db.php - Javított adatbázis teszt
echo "<h1>Adatbázis kapcsolat teszt</h1>";

// Ellenőrizzük hogy létezik-e a .env fájl
if (!file_exists('.env')) {
    echo "<div style='color: red;'>";
    echo "<h3>❌ Hiba: .env fájl nem található!</h3>";
    echo "<p>Hozd létre a .env fájlt a következő tartalommal:</p>";
    echo "<pre>";
    echo "DB_HOST=127.0.0.1\n";
    echo "DB_NAME=travian_tools\n";
    echo "DB_USER=root\n";
    echo "DB_PASS=\n";
    echo "</pre>";
    echo "</div>";
    exit;
}

// .env betöltése
echo "<p>✅ .env fájl megtalálva</p>";
$lines = file('.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos($line, '=') !== false && substr($line, 0, 1) !== '#') {
        list($key, $value) = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

echo "<p>✅ .env fájl betöltve</p>";
echo "<p>DB_HOST: " . ($_ENV['DB_HOST'] ?? 'nincs beállítva') . "</p>";
echo "<p>DB_NAME: " . ($_ENV['DB_NAME'] ?? 'nincs beállítva') . "</p>";
echo "<p>DB_USER: " . ($_ENV['DB_USER'] ?? 'nincs beállítva') . "</p>";

// Adatbázis fájl ellenőrzése
if (!file_exists('config/database.php')) {
    echo "<div style='color: red;'>";
    echo "<h3>❌ Hiba: config/database.php nem található!</h3>";
    echo "</div>";
    exit;
}

echo "<p>✅ Database.php fájl megtalálva</p>";

// Próbáljuk betölteni
try {
    require_once 'config/database.php';
    echo "<p>✅ Database osztály betöltve</p>";
    
    // Kapcsolat tesztelése
    $db = Database::getInstance();
    echo "<p>✅ Database instance létrehozva</p>";
    
    echo $db->testConnection();
    
} catch(Exception $e) {
    echo "<div style='color: red;'>";
    echo "<h3>❌ Adatbázis hiba:</h3>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "</div>";
    
    // MySQL szolgáltatás ellenőrzése
    echo "<h3>🔧 Ellenőrizendő dolgok:</h3>";
    echo "<ul>";
    echo "<li>XAMPP/WAMP MySQL szolgáltatás fut-e?</li>";
    echo "<li>phpMyAdmin elérhető-e: <a href='http://localhost/phpmyadmin' target='_blank'>http://localhost/phpmyadmin</a></li>";
    echo "<li>travian_tools adatbázis létezik-e?</li>";
    echo "<li>Felhasználónév/jelszó helyes-e?</li>";
    echo "</ul>";
}
?>

<?php
// simple_test.php - Még egyszerűbb teszt
?>
<!DOCTYPE html>
<html>
<head>
    <title>Egyszerű Teszt</title>
</head>
<body>
    <h1>Webszerver Teszt</h1>
    <p>Ha ezt az oldalt látod, a webszerver működik!</p>
    <p>Időpont: <?= date('Y-m-d H:i:s') ?></p>
    
    <h2>Fájl ellenőrzések:</h2>
    <ul>
        <li>.env fájl: <?= file_exists('.env') ? '✅ Létezik' : '❌ Hiányzik' ?></li>
        <li>config/database.php: <?= file_exists('config/database.php') ? '✅ Létezik' : '❌ Hiányzik' ?></li>
        <li>index.php: <?= file_exists('index.php') ? '✅ Létezik' : '❌ Hiányzik' ?></li>
    </ul>
    
    <h2>Tesztelendő linkek:</h2>
    <ul>
        <li><a href="info.php">info.php teszt</a></li>
        <li><a href="test_db.php">Adatbázis teszt</a></li>
        <li><a href="index.php">Főoldal (index.php)</a></li>
        <li><a href="/">Router teszt</a></li>
    </ul>
</body>
</html>