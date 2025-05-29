<?php
// src/core/Router.php - JAVÍTOTT verzió alkönyvtárhoz
?>
<?php
class Router {
    private $routes = [];
    private $basePath = '/travian'; // Alkönyvtár megadása
    
    public function get($path, $handler, $protected = false, $role = null) {
        $this->routes['GET'][$path] = ['handler' => $handler, 'protected' => $protected, 'role' => $role];
    }
    
    public function post($path, $handler, $protected = false, $role = null) {
        $this->routes['POST'][$path] = ['handler' => $handler, 'protected' => $protected, 'role' => $role];
    }
    
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        
        // Alkönyvtár eltávolítása az URI-ból
        $path = $this->getPathFromUri($uri);
        
        // Debug információ (fejlesztési célokra)
        if (isset($_GET['debug'])) {
            echo "<pre>";
            echo "REQUEST_URI: $uri\n";
            echo "Cleaned Path: $path\n";
            echo "Method: $method\n";
            echo "Available routes:\n";
            print_r(array_keys($this->routes[$method] ?? []));
            echo "</pre>";
        }
        
        if (!isset($this->routes[$method][$path])) {
            http_response_code(404);
            $this->show404($path);
            return;
        }
        
        $route = $this->routes[$method][$path];
        
        // Hitelesítés ellenőrzése
        if ($route['protected']) {
            $auth = new Auth();
            if (!$auth->isLoggedIn()) {
                header('Location: ' . $this->basePath . '/login');
                exit;
            }
            
            if ($route['role'] && !$auth->hasRole($route['role'])) {
                http_response_code(403);
                $this->show403();
                return;
            }
        }
        
        // Controller meghívása
        $this->callController($route['handler']);
    }
    
    private function getPathFromUri($uri) {
        // Query string eltávolítása
        $path = parse_url($uri, PHP_URL_PATH);
        
        // Alkönyvtár eltávolítása
        if (strpos($path, $this->basePath) === 0) {
            $path = substr($path, strlen($this->basePath));
        }
        
        // Kezdő slash biztosítása
        if (empty($path) || $path[0] !== '/') {
            $path = '/' . $path;
        }
        
        // Végső slash eltávolítása (kivéve a gyökér)
        if ($path !== '/' && substr($path, -1) === '/') {
            $path = substr($path, 0, -1);
        }
        
        return $path;
    }
    
    private function callController($handler) {
        list($controller, $method) = explode('@', $handler);
        $controllerFile = "src/controllers/{$controller}.php";
        
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerInstance = new $controller();
            $controllerInstance->$method();
        } else {
            echo "<h1>Controller hiba</h1>";
            echo "<p>A $controllerFile fájl nem található!</p>";
            echo "<p><a href='{$this->basePath}/debug_router.php'>Debug oldal</a></p>";
        }
    }
    
    private function show404($path) {
        echo "<h1>404 - Oldal nem található</h1>";
        echo "<p>A keresett oldal (<code>$path</code>) nem létezik.</p>";
        echo "<p><a href='{$this->basePath}/'>Vissza a főoldalra</a></p>";
        echo "<p><a href='{$this->basePath}/debug_router.php'>Debug információk</a></p>";
        
        if (file_exists('src/views/404.php')) {
            include 'src/views/404.php';
        }
    }
    
    private function show403() {
        echo "<h1>403 - Hozzáférés megtagadva</h1>";
        echo "<p>Nincs jogosultságod az oldal megtekintéséhez.</p>";
        echo "<p><a href='{$this->basePath}/'>Vissza a főoldalra</a></p>";
        
        if (file_exists('src/views/403.php')) {
            include 'src/views/403.php';
        }
    }
}
