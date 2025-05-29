<?php
// debug_subdir.php - Alkönyvtár debug teszt
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Alkönyvtár Debug Teszt</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .success { color: green; background: #e7f5e7; padding: 10px; }
        .error { color: red; background: #ffeee7; padding: 10px; }
        .info { color: blue; background: #e7f0ff; padding: 10px; }
        pre { background: #f0f0f0; padding: 10px; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>🔍 Alkönyvtár Debug Teszt</h1>
    
    <?php
    echo "<div class='info'>";
    echo "<h3>📊 URL információk:</h3>";
    echo "<p><strong>HTTP_HOST:</strong> " . ($_SERVER['HTTP_HOST'] ?? 'nincs') . "</p>";
    echo "<p><strong>REQUEST_URI:</strong> " . ($_SERVER['REQUEST_URI'] ?? 'nincs') . "</p>";
    echo "<p><strong>SCRIPT_NAME:</strong> " . ($_SERVER['SCRIPT_NAME'] ?? 'nincs') . "</p>";
    echo "<p><strong>PHP_SELF:</strong> " . ($_SERVER['PHP_SELF'] ?? 'nincs') . "</p>";
    echo "<p><strong>DOCUMENT_ROOT:</strong> " . ($_SERVER['DOCUMENT_ROOT'] ?? 'nincs') . "</p>";
    echo "<p><strong>Aktuális könyvtár:</strong> " . __DIR__ . "</p>";
    echo "</div>";
    
    // Path parsing teszt
    echo "<div class='info'>";
    echo "<h3>🧭 Path parsing teszt:</h3>";
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $path = parse_url($uri, PHP_URL_PATH);
    
    echo "<p><strong>Eredeti URI:</strong> $uri</p>";
    echo "<p><strong>Parsed path:</strong> $path</p>";
    
    // Alkönyvtár eltávolítása
    $basePath = '/travian';
    if (strpos($path, $basePath) === 0) {
        $cleanPath = substr($path, strlen($basePath));
        if (empty($cleanPath) || $cleanPath[0] !== '/') {
            $cleanPath = '/' . $cleanPath;
        }
        echo "<p><strong>Tisztított path:</strong> $cleanPath</p>";
    }
    echo "</div>";
    
    // Router teszt
    echo "<div class='info'>";
    echo "<h3>🚦 Router fájl teszt:</h3>";
    if (file_exists('src/core/Router.php')) {
        echo "<p>✅ Router.php megtalálva</p>";
        
        try {
            require_once 'src/core/Router.php';
            $router = new Router();
            echo "<p>✅ Router instance létrehozva</p>";
            
            // Teszt route
            $router->get('/', function() {
                echo "Teszt route működik!";
            });
            
            echo "<p>✅ Teszt route hozzáadva</p>";
            
        } catch (Exception $e) {
            echo "<p style='color: red;'>❌ Router hiba: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Router.php nem található!</p>";
    }
    echo "</div>";
    
    // Tesztelendő linkek
    echo "<div class='info'>";
    echo "<h3>🔗 Tesztelendő linkek:</h3>";
    echo "<ul>";
    echo "<li><a href='/travian/'>Főoldal (/travian/)</a></li>";
    echo "<li><a href='/travian/index.php'>index.php direkt</a></li>";
    echo "<li><a href='/travian/?debug=1'>Router debug mód</a></li>";
    echo "<li><a href='/travian/login'>Login oldal</a></li>";
    echo "<li><a href='simple_test.php'>Egyszerű teszt</a></li>";
    echo "</ul>";
    echo "</div>";
    ?>
</body>
</html>