<?php include 'src/views/layout/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2><i class="fas fa-chart-bar"></i> Statisztikák</h2>
        </div>
    </div>
    
    <div class="row mt-4">
        <!-- Saját statisztikák -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5><i class="fas fa-user"></i> Saját Statisztikák</h5>
                </div>
                <div class="card-body">
                    <?php if ($data['player_stats']): ?>
                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-primary"><?= number_format($data['player_stats']['population']) ?></h4>
                            <p class="small">Összlakosság</p>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success"><?= $data['player_stats']['villages'] ?></h4>
                            <p class="small">Falvak száma</p>
                        </div>
                        <div class="col-6">
                            <h4 class="text-warning">#<?= $data['player_stats']['rank_position'] ?></h4>
                            <p class="small">Helyezés</p>
                        </div>
                        <div class="col-6">
                            <h4 class="text-info"><?= $data['player_stats']['alliance_name'] ?></h4>
                            <p class="small">Szövetség</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-6">
                            <h5 class="text-danger"><?= number_format($data['player_stats']['attack_points']) ?></h5>
                            <p class="small">Támadási pontok</p>
                        </div>
                        <div class="col-6">
                            <h5 class="text-primary"><?= number_format($data['player_stats']['defense_points']) ?></h5>
                            <p class="small">Védekezési pontok</p>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Még nincsenek statisztikai adatok. 
                        <a href="#" class="btn btn-sm btn-primary">Adatok frissítése</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Top játékosok -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning">
                    <h5><i class="fas fa-crown"></i> Top Játékosok</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Játékos</th>
                                    <th>Lakosság</th>
                                    <th>Falvak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_slice($data['top_players'], 0, 10) as $index => $player): ?>
                                <tr>
                                    <td><span class="badge bg-secondary"><?= $index + 1 ?></span></td>
                                    <td><?= htmlspecialchars($player['player_name']) ?></td>
                                    <td><?= number_format($player['population']) ?></td>
                                    <td><?= $player['villages'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <!-- Top szövetségek -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5><i class="fas fa-users"></i> Top Szövetségek</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Helyezés</th>
                                    <th>Szövetség</th>
                                    <th>Tag</th>
                                    <th>Tagok száma</th>
                                    <th>Összlakosság</th>
                                    <th>Átlag lakosság/tag</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['top_alliances'] as $index => $alliance): ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-<?= $index < 3 ? 'warning' : 'secondary' ?>">
                                            #<?= $index + 1 ?>
                                        </span>
                                    </td>
                                    <td><strong><?= htmlspecialchars($alliance['name']) ?></strong></td>
                                    <td><span class="badge bg-primary"><?= htmlspecialchars($alliance['tag']) ?></span></td>
                                    <td><?= $alliance['member_count'] ?></td>
                                    <td><?= number_format($alliance['total_population']) ?></td>
                                    <td><?= $alliance['member_count'] > 0 ? number_format($alliance['total_population'] / $alliance['member_count']) : 0 ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>