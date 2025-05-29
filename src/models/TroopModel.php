// src/models/TroopModel.php
<?php
class TroopModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getUserPlans($userId) {
        $stmt = $this->db->prepare("SELECT * FROM troop_plans WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function savePlan($data) {
        $stmt = $this->db->prepare("
            INSERT INTO troop_plans (user_id, name, type, target_x, target_y, troops, launch_time, notes, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        return $stmt->execute([
            $data['user_id'], $data['name'], $data['type'], 
            $data['target_x'], $data['target_y'], $data['troops'], 
            $data['launch_time'], $data['notes']
        ]);
    }
    
    public function getPlan($planId, $userId) {
        $stmt = $this->db->prepare("SELECT * FROM troop_plans WHERE id = ? AND user_id = ?");
        $stmt->execute([$planId, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}