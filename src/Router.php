<?php
class Router {
    private $routes = [];
    
    public function get($path, $handler, $protected = false, $role = null) {
        $this->routes['GET'][$path] = ['handler' => $handler, 'protected' => $protected, 'role' => $role];
    }
    
    public function post($path, $handler, $protected = false, $role = null) {
        $this->routes['POST'][$path] = ['handler' => $handler, 'protected' => $protected, 'role' => $role];
    }
    
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if (!isset($this->routes[$method][$path])) {
            http_response_code(404);
            include 'src/views/404.php';
            return;
        }
        
        $route = $this->routes[$method][$path];
        
        // Hitelesítés ellenőrzése
        if ($route['protected']) {
            $auth = new Auth();
            if (!$auth->isLoggedIn()) {
                header('Location: /login');
                exit;
            }
            
            if ($route['role'] && !$auth->hasRole($route['role'])) {
                http_response_code(403);
                include 'src/views/403.php';
                return;
            }
        }
        
        // Controller meghívása
        $this->callController($route['handler']);
    }
    
    private function callController($handler) {
        list($controller, $method) = explode('@', $handler);
        $controllerFile = "src/controllers/{$controller}.php";
        
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerInstance = new $controller();
            $controllerInstance->$method();
        }
    }
}
