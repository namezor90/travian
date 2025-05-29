<?php
class DashboardController {
    public function index() {
        // Dashboard adatok lekérése
        $data = [
            'recent_activities' => $this->getRecentActivities(),
            'quick_stats' => $this->getQuickStats()
        ];
        
        include 'src/views/dashboard/index.php';
    }
    
    private function getRecentActivities() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT action, created_at 
            FROM activity_logs 
            WHERE user_id = ? 
            ORDER BY created_at DESC 
            LIMIT 10
        ");
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    private function getQuickStats() {
        $db = Database::getInstance()->getConnection();
        
        // Támadási tervek száma
        $stmt = $db->prepare("SELECT COUNT(*) as count FROM troop_plans WHERE user_id = ? AND type = 'attack'");
        $stmt->execute([$_SESSION['user_id']]);
        $attackPlans = $stmt->fetch()['count'];
        
        // Védekezési tervek száma
        $stmt = $db->prepare("SELECT COUNT(*) as count FROM troop_plans WHERE user_id = ? AND type = 'defense'");
        $stmt->execute([$_SESSION['user_id']]);
        $defensePlans = $stmt->fetch()['count'];
        
        // Falvak száma
        $stmt = $db->prepare("SELECT COUNT(*) as count FROM villages WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $villages = $stmt->fetch()['count'];
        
        return [
            'attack_plans' => $attackPlans,
            'defense_plans' => $defensePlans,
            'villages' => $villages
        ];
    }
}