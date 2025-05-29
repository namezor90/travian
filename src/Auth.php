// src/core/Auth.php
<?php
class Auth {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? AND active = 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            // Login log
            $this->logActivity($user['id'], 'login');
            return true;
        }
        return false;
    }
    
    public function register($username, $email, $password, $serverName = '') {
        if ($this->userExists($username, $email)) {
            return false;
        }
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, server_name, created_at) VALUES (?, ?, ?, ?, NOW())");
        return $stmt->execute([$username, $email, $hashedPassword, $serverName]);
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    
    public function hasRole($role) {
        return isset($_SESSION['role']) && $_SESSION['role'] === $role;
    }
    
    public function logout() {
        if (isset($_SESSION['user_id'])) {
            $this->logActivity($_SESSION['user_id'], 'logout');
        }
        session_destroy();
    }
    
    private function userExists($username, $email) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        return $stmt->rowCount() > 0;
    }
    
    private function logActivity($userId, $action) {
        $stmt = $this->db->prepare("INSERT INTO activity_logs (user_id, action, ip_address, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$userId, $action, $_SERVER['REMOTE_ADDR']]);
    }
}