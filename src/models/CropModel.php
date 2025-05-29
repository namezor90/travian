<?php
class CropModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getUserVillages($userId) {
        $stmt = $this->db->prepare("SELECT * FROM villages WHERE user_id = ? ORDER BY name");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function saveVillage($data) {
        $stmt = $this->db->prepare("
            INSERT INTO villages (user_id, name, x, y, crop_production, crop_consumption, current_crop, warehouse_capacity) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
            crop_production = VALUES(crop_production),
            crop_consumption = VALUES(crop_consumption),
            current_crop = VALUES(current_crop),
            warehouse_capacity = VALUES(warehouse_capacity)
        ");
        return $stmt->execute([
            $data['user_id'], $data['name'], $data['x'], $data['y'],
            $data['crop_production'], $data['crop_consumption'], 
            $data['current_crop'], $data['warehouse_capacity']
        ]);
    }
}