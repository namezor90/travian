<?php
// debug_router.php - Router hibakeresés
echo "<h1>🔍 Router Debug Teszt</h1>";

// 1. Alapvető fájl ellenőrzések
echo "<h2>📁 Fájl ellenőrzések:</h2>";
$requiredFiles = [
    'index.php' => file_exists('index.php'),
    '.htaccess' => file_exists('.htaccess'),
    'src/core/Router.php' => file_exists('src/core/Router.php'),
    'src/core/Auth.php' => file_exists('src/core/Auth.php'),
    'src/controllers/HomeController.php' => file_exists('src/controllers/HomeController.php'),
    'src/views/home/index.php' => file_exists('src/views/home/index.php'),
    'config/database.php' => file_exists('config/database.php')
];

foreach ($requiredFiles as $file => $exists) {
    echo "<p>" . ($exists ? "✅" : "❌") . " $file</p>";
}

// 2. URL információk
echo "<h2>🌐 URL információk:</h2>";
echo "<p><strong>REQUEST_URI:</strong> " . ($_SERVER['REQUEST_URI'] ?? 'nincs beállítva') . "</p>";
echo "<p><strong>HTTP_HOST:</strong> " . ($_SERVER['HTTP_HOST'] ?? 'nincs beállítva') . "</p>";
echo "<p><strong>SCRIPT_NAME:</strong> " . ($_SERVER['SCRIPT_NAME'] ?? 'nincs beállítva') . "</p>";
echo "<p><strong>REQUEST_METHOD:</strong> " . ($_SERVER['REQUEST_METHOD'] ?? 'nincs beállítva') . "</p>";

// 3. .htaccess tartalom ellenőrzése
echo "<h2>⚙️ .htaccess ellenőrzése:</h2>";
if (file_exists('.htaccess')) {
    echo "<pre style='background: #f0f0f0; padding: 10px;'>";
    echo htmlspecialchars(file_get_contents('.htaccess'));
    echo "</pre>";
} else {
    echo "<p style='color: red;'>❌ .htaccess fájl hiányzik!</p>";
}

// 4. Egyszerű router teszt
echo "<h2>🚦 Router teszt:</h2>";
try {
    if (file_exists('src/core/Router.php')) {
        require_once 'src/core/Router.php';
        echo "<p>✅ Router.php betöltve</p>";
        
        $router = new Router();
        echo "<p>✅ Router instance létrehozva</p>";
        
        // Teszt route hozzáadása
        $router->get('/test', 'TestController@test');
        echo "<p>✅ Teszt route hozzáadva</p>";
        
    } else {
        echo "<p style='color: red;'>❌ Router.php nem található!</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Router hiba: " . $e->getMessage() . "</p>";
}

// 5. Session teszt
echo "<h2>🔐 Session teszt:</h2>";
if (session_status() === PHP_SESSION_ACTIVE) {
    echo "<p>✅ Session aktív</p>";
} else {
    echo "<p>⚠️ Session nincs elindítva</p>";
    session_start();
    echo "<p>✅ Session elindítva</p>";
}

// 6. Tesztelendő linkek
echo "<h2>🔗 Tesztelendő linkek:</h2>";
echo "<ul>";
echo "<li><a href='index.php'>index.php direkt</a></li>";
echo "<li><a href='/'>Gyökér URL (/)</a></li>";
echo "<li><a href='simple_test.php'>Simple Test</a></li>";
echo "<li><a href='info.php'>Info Test</a></li>";
echo "</ul>";

?>