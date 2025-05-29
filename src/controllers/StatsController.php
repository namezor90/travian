<?php
require_once 'src/models/StatsModel.php';

class StatsController {
    private $statsModel;
    
    public function __construct() {
        $this->statsModel = new StatsModel();
    }
    
    public function index() {
        $data = [
            'player_stats' => $this->statsModel->getPlayerStats($_SESSION['user_id']),
            'alliance_stats' => $this->statsModel->getAllianceStats(),
            'top_players' => $this->statsModel->getTopPlayers(),
            'top_alliances' => $this->statsModel->getTopAlliances()
        ];
        
        include 'src/views/stats/index.php';
    }
}
