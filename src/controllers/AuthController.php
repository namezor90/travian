// src/controllers/AuthController.php
<?php
class AuthController {
    private $auth;
    
    public function __construct() {
        $this->auth = new Auth();
    }
    
    public function loginForm() {
        include 'src/views/auth/login.php';
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if ($this->auth->login($username, $password)) {
                header('Location: /dashboard');
                exit;
            } else {
                $error = "Hibás felhasználónév vagy jelszó!";
                include 'src/views/auth/login.php';
            }
        }
    }
    
    public function registerForm() {
        include 'src/views/auth/register.php';
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $serverName = $_POST['server_name'] ?? '';
            
            if ($this->auth->register($username, $email, $password, $serverName)) {
                $success = "Sikeres regisztráció! Most bejelentkezhetsz.";
                include 'src/views/auth/login.php';
            } else {
                $error = "Regisztráció sikertelen! A felhasználónév vagy email már létezik.";
                include 'src/views/auth/register.php';
            }
        }
    }
    
    public function logout() {
        $this->auth->logout();
        header('Location: /');
        exit;
    }
}