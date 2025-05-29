<?php
// index.php - JAVÍTOTT verzió alkönyvtárhoz
?>
<?php
// index.php - Alkönyvtár verzió debug-gal
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session indítása
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

// Debug mód ellenőrzése
$debug = isset($_GET['debug']);
if ($debug) {
    echo "<!-- DEBUG MODE ON -->\n";
    echo "<!-- REQUEST_URI: " . ($_SERVER['REQUEST_URI'] ?? 'nincs') . " -->\n";
    echo "<!-- SCRIPT_NAME: " . ($_SERVER['SCRIPT_NAME'] ?? 'nincs') . " -->\n";
}

// Szükséges fájlok betöltése
$requiredFiles = [
    'config/database.php',
    'src/core/Router.php',
    'src/core/Auth.php'
];

foreach ($requiredFiles as $file) {
    if (!file_exists($file)) {
        die("<h1>Hiba: $file nem található!</h1><p><a href='debug_subdir.php'>Debug oldal</a></p>");
    }
    require_once $file;
    if ($debug) echo "<!-- $file betöltve -->\n";
}

// Statikus fájlok kiszolgálása
if (preg_match('/\.(?:css|js|png|jpg|gif|ico)$/', $_SERVER["REQUEST_URI"])) {
    return false;
}

try {
    $router = new Router();
    $auth = new Auth();
    
    // Útvonalak regisztrálása
    $router->get('/', 'HomeController@index');
    $router->get('/login', 'AuthController@loginForm');
    $router->post('/login', 'AuthController@login');
    $router->get('/register', 'AuthController@registerForm');
    $router->post('/register', 'AuthController@register');
    $router->get('/logout', 'AuthController@logout');

    // Védett útvonalak
    $router->get('/dashboard', 'DashboardController@index', true);
    $router->get('/trooptool', 'TroopController@index', true);
    $router->post('/trooptool/save', 'TroopController@save', true);
    $router->get('/croptool', 'CropController@index', true);
    $router->post('/croptool/calculate', 'CropController@calculate', true);
    $router->get('/stats', 'StatsController@index', true);
    $router->get('/calculators', 'CalculatorController@index', true);
    $router->get('/map', 'MapController@index', true);
    $router->get('/admin', 'AdminController@index', true, 'admin');
    
    if ($debug) echo "<!-- Router konfigurálva -->\n";
    
    // Router dispatch
    $router->dispatch();
    
} catch (Exception $e) {
    echo "<h1>Alkalmazás hiba</h1>";
    echo "<p>Hiba: " . $e->getMessage() . "</p>";
    if ($debug) {
        echo "<pre>";
        echo $e->getTraceAsString();
        echo "</pre>";
    }
    echo "<p><a href='debug_subdir.php'>Debug oldal</a></p>";
}
?>