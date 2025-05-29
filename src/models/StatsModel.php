<?php
class StatsModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getPlayerStats($userId) {
        $stmt = $this->db->prepare("SELECT * FROM player_stats WHERE user_id = ? ORDER BY updated_at DESC LIMIT 1");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getAllianceStats() {
        $stmt = $this->db->query("SELECT * FROM alliances ORDER BY total_population DESC LIMIT 20");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTopPlayers() {
        $stmt = $this->db->query("SELECT * FROM player_stats ORDER BY population DESC LIMIT 20");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTopAlliances() {
        $stmt = $this->db->query("SELECT * FROM alliances ORDER BY total_population DESC LIMIT 10");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}