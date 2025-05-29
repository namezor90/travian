<?php
class CalculatorController {
    public function index() {
        include 'src/views/calculators/index.php';
    }
    
    public function route() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fromX = (int)$_POST['from_x'];
            $fromY = (int)$_POST['from_y'];
            $toX = (int)$_POST['to_x'];
            $toY = (int)$_POST['to_y'];
            $troopSpeed = (int)$_POST['troop_speed'];
            
            $distance = sqrt(pow($toX - $fromX, 2) + pow($toY - $fromY, 2));
            $travelTime = ($distance * 60) / $troopSpeed; // percben
            
            $result = [
                'distance' => round($distance, 2),
                'travel_time_minutes' => round($travelTime, 2),
                'travel_time_formatted' => $this->formatTime($travelTime)
            ];
            
            echo json_encode($result);
            exit;
        }
    }
    
    private function formatTime($minutes) {
        $hours = floor($minutes / 60);
        $mins = $minutes % 60;
        return sprintf('%d óra %d perc', $hours, $mins);
    }
}
