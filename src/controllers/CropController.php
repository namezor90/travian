// src/controllers/CropController.php
<?php
require_once 'src/models/CropModel.php';

class CropController {
    private $cropModel;
    
    public function __construct() {
        $this->cropModel = new CropModel();
    }
    
    public function index() {
        $villages = $this->cropModel->getUserVillages($_SESSION['user_id']);
        include 'src/views/croptool/index.php';
    }
    
    public function calculate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $villageData = $_POST['villages'];
            $results = [];
            
            foreach ($villageData as $village) {
                $result = $this->calculateCropBalance($village);
                $results[] = $result;
            }
            
            echo json_encode($results);
            exit;
        }
    }
    
    private function calculateCropBalance($village) {
        $production = (int)$village['crop_production'];
        $consumption = (int)$village['crop_consumption'];
        $storage = (int)$village['current_crop'];
        $capacity = (int)$village['warehouse_capacity'];
        
        $balance = $production - $consumption;
        
        if ($balance < 0) {
            $hoursUntilStarvation = $storage / abs($balance);
            return [
                'village_name' => $village['name'],
                'status' => 'danger',
                'balance' => $balance,
                'hours_until_starvation' => round($hoursUntilStarvation, 2)
            ];
        } else {
            $hoursUntilFull = ($capacity - $storage) / $balance;
            return [
                'village_name' => $village['name'],
                'status' => 'safe',
                'balance' => $balance,
                'hours_until_full' => round($hoursUntilFull, 2)
            ];
        }
    }
}