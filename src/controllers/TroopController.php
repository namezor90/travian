// src/controllers/TroopController.php
<?php
require_once 'src/models/TroopModel.php';

class TroopController {
    private $troopModel;
    
    public function __construct() {
        $this->troopModel = new TroopModel();
    }
    
    public function index() {
        $plans = $this->troopModel->getUserPlans($_SESSION['user_id']);
        $data = ['plans' => $plans];
        include 'src/views/trooptool/index.php';
    }
    
    public function save() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $planData = [
                'user_id' => $_SESSION['user_id'],
                'name' => $_POST['plan_name'],
                'type' => $_POST['plan_type'], // attack/defense
                'target_x' => $_POST['target_x'] ?? null,
                'target_y' => $_POST['target_y'] ?? null,
                'troops' => json_encode($_POST['troops']),
                'launch_time' => $_POST['launch_time'],
                'notes' => $_POST['notes'] ?? ''
            ];
            
            if ($this->troopModel->savePlan($planData)) {
                header('Location: /trooptool?success=1');
            } else {
                header('Location: /trooptool?error=1');
            }
            exit;
        }
    }
}