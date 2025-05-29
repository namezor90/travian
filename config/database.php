<?php
class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        $config = [
            'host' => $_ENV['DB_HOST'] ?? 'localhost',
            'dbname' => $_ENV['DB_NAME'] ?? 'travian_tools',
            'username' => $_ENV['DB_USER'] ?? 'root',
            'password' => $_ENV['DB_PASS'] ?? ''
        ];
        
        try {
            $this->connection = new PDO(
                "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8",
                $config['username'],
                $config['password'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch(PDOException $e) {
            die("Adatbázis kapcsolat hiba: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
}