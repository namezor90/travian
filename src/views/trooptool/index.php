<?php include 'src/views/layout/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2><i class="fas fa-sword"></i> Troop Tool - Támadás és Védekezés Tervezője</h2>
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            <h5><i class="fas fa-fire"></i> Új Támadási Terv</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/trooptool/save">
                                <input type="hidden" name="plan_type" value="attack">
                                
                                <div class="mb-3">
                                    <label class="form-label">Terv neve</label>
                                    <input type="text" class="form-control" name="plan_name" required>
                                </div>
                                
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label">Cél X koordináta</label>
                                        <input type="number" class="form-control" name="target_x" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Cél Y koordináta</label>
                                        <input type="number" class="form-control" name="target_y" required>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <h6>Csapatok:</h6>
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Phalanx</label>
                                            <input type="number" class="form-control" name="troops[phalanx]" value="0">
                                        </div>
                                        <div class="col-4">
                                            <label>Swordsman</label>
                                            <input type="number" class="form-control" name="troops[swordsman]" value="0">
                                        </div>
                                        <div class="col-4">
                                            <label>Pathfinder</label>
                                            <input type="number" class="form-control" name="troops[pathfinder]" value="0">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-4">
                                            <label>Theutates Thunder</label>
                                            <input type="number" class="form-control" name="troops[tt]" value="0">
                                        </div>
                                        <div class="col-4">
                                            <label>Druidrider</label>
                                            <input type="number" class="form-control" name="troops[druid]" value="0">
                                        </div>
                                        <div class="col-4">
                                            <label>Haeduan</label>
                                            <input type="number" class="form-control" name="troops[haeduan]" value="0">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3 mt-3">
                                    <label class="form-label">Indítási idő</label>
                                    <input type="datetime-local" class="form-control" name="launch_time" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Megjegyzések</label>
                                    <textarea class="form-control" name="notes" rows="3"></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-save"></i> Támadási terv mentése
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5><i class="fas fa-shield"></i> Védekezési Tervek</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/trooptool/save">
                                <input type="hidden" name="plan_type" value="defense">
                                
                                <div class="mb-3">
                                    <label class="form-label">Védekezési terv neve</label>
                                    <input type="text" class="form-control" name="plan_name" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Védendő falu koordinátái</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="number" class="form-control" name="target_x" placeholder="X" required>
                                        </div>
                                        <div class="col-6">
                                            <input type="number" class="form-control" name="target_y" placeholder="Y" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <h6>Védekezési csapatok:</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Phalanx</label>
                                            <input type="number" class="form-control" name="troops[phalanx]" value="0">
                                        </div>
                                        <div class="col-6">
                                            <label>Druidrider</label>
                                            <input type="number" class="form-control" name="troops[druid]" value="0">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Érkezési idő</label>
                                    <input type="datetime-local" class="form-control" name="launch_time" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-shield"></i> Védekezési terv mentése
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mentett tervek -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-list"></i> Mentett Tervek</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Név</th>
                                            <th>Típus</th>
                                            <th>Cél</th>
                                            <th>Időzítés</th>
                                            <th>Létrehozva</th>
                                            <th>Műveletek</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['plans'] as $plan): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($plan['name']) ?></td>
                                            <td>
                                                <span class="badge <?= $plan['type'] === 'attack' ? 'bg-danger' : 'bg-primary' ?>">
                                                    <?= $plan['type'] === 'attack' ? 'Támadás' : 'Védekezés' ?>
                                                </span>
                                            </td>
                                            <td>(<?= $plan['target_x'] ?>, <?= $plan['target_y'] ?>)</td>
                                            <td><?= date('Y-m-d H:i', strtotime($plan['launch_time'])) ?></td>
                                            <td><?= date('Y-m-d', strtotime($plan['created_at'])) ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-info" onclick="viewPlan(<?= $plan['id'] ?>)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="deletePlan(<?= $plan['id'] ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
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
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function viewPlan(planId) {
    // Plan részleteinek megjelenítése modal-ban
    alert('Plan részletek megjelenítése: ' + planId);
}

function deletePlan(planId) {
    if (confirm('Biztosan törölni szeretnéd ezt a tervet?')) {
        // Ajax törlés
        fetch(`/trooptool/delete/${planId}`, { method: 'DELETE' })
            .then(() => location.reload());
    }
}
</script>

</body>
</html>