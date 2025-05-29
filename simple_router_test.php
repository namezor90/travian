<?php
// simple_router_test.php - Egyszerű router teszt
session_start();

echo "<h1>🎯 Egyszerű Router Teszt</h1>";

// Csak a szükséges fájlok betöltése
if (file_exists('src/core/Router.php')) {
    require_once 'src/core/Router.php';
    
    $router = new Router();
    
    // Egyszerű route-ok
    $router->get('/', function() {
        echo "<h2>🏠 Főoldal működik!</h2>";
        echo "<p>A router működik és megtalálta a főoldalt.</p>";
        echo "<p>Időpont: " . date('Y-m-d H:i:s') . "</p>";
        echo "<a href='/test'>Teszt oldal</a>";
    });
    
    $router->get('/test', function() {
        echo "<h2>🧪 Teszt oldal működik!</h2>";
        echo "<p>A router működik és megtalálta a teszt oldalt.</p>";
        echo "<a href='/'>Vissza a főoldalra</a>";
    });
    
    // Route dispatch
    $method = $_SERVER['REQUEST_METHOD'];
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    echo "<p><strong>Jelenlegi útvonal:</strong> $method $path</p>";
    
    try {
        $router->dispatch();
    } catch (Exception $e) {
        echo "<p style='color: red;'>Router hiba: " . $e->getMessage() . "</p>";
    }
    
} else {
    echo "<p style='color: red;'>Router.php nem található!</p>";
}
?>