<?php include 'src/views/layout/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2><i class="fas fa-calculator"></i> Kalkulátorok</h2>
            
            <div class="row mt-4">
                <!-- Útvonal kalkulátor -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5><i class="fas fa-route"></i> Útvonal Kalkulátor</h5>
                        </div>
                        <div class="card-body">
                            <form id="routeForm">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Kiindulási pont:</h6>
                                        <div class="mb-2">
                                            <input type="number" class="form-control" name="from_x" placeholder="X koordináta" required>
                                        </div>
                                        <div class="mb-2">
                                            <input type="number" class="form-control" name="from_y" placeholder="Y koordináta" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h6>Célpont:</h6>
                                        <div class="mb-2">
                                            <input type="number" class="form-control" name="to_x" placeholder="X koordináta" required>
                                        </div>
                                        <div class="mb-2">
                                            <input type="number" class="form-control" name="to_y" placeholder="Y koordináta" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Csapat sebesség (mező/perc):</label>
                                    <select class="form-control" name="troop_speed" required>
                                        <option value="6">Phalanx (6)</option>
                                        <option value="7">Swordsman (7)</option>
                                        <option value="17">Pathfinder (17)</option>
                                        <option value="19">Theutates Thunder (19)</option>
                                        <option value="16">Druidrider (16)</option>
                                        <option value="13">Haeduan (13)</option>
                                    </select>
                                </div>
                                
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-calculator"></i> Számítás
                                </button>
                            </form>
                            
                            <div id="routeResult" class="mt-3"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Kultúrpont kalkulátor -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h5><i class="fas fa-crown"></i> Kultúrpont Kalkulátor</h5>
                        </div>
                        <div class="card-body">
                            <form id="cultureForm">
                                <div class="mb-3">
                                    <label class="form-label">Jelenlegi kultúrpontok:</label>
                                    <input type="number" class="form-control" name="current_culture" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Falvak száma:</label>
                                    <input type="number" class="form-control" name="village_count" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Kultúrpont termelés/nap:</label>
                                    <input type="number" class="form-control" name="culture_production" required>
                                </div>
                                
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-calculator"></i> Számítás
                                </button>
                            </form>
                            
                            <div id="cultureResult" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <!-- NPC kalkulátor -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5><i class="fas fa-exchange-alt"></i> NPC Kalkulátor</h5>
                        </div>
                        <div class="card-body">
                            <form id="npcForm">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Eladni:</h6>
                                        <div class="mb-2">
                                            <label class="small">Fa:</label>
                                            <input type="number" class="form-control form-control-sm" name="sell_wood" value="0">
                                        </div>
                                        <div class="mb-2">
                                            <label class="small">Agyag:</label>
                                            <input type="number" class="form-control form-control-sm" name="sell_clay" value="0">
                                        </div>
                                        <div class="mb-2">
                                            <label class="small">Vas:</label>
                                            <input type="number" class="form-control form-control-sm" name="sell_iron" value="0">
                                        </div>
                                        <div class="mb-2">
                                            <label class="small">Gabona:</label>
                                            <input type="number" class="form-control form-control-sm" name="sell_crop" value="0">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h6>Venni:</h6>
                                        <div class="mb-2">
                                            <label class="small">Fa:</label>
                                            <input type="number" class="form-control form-control-sm" name="buy_wood" value="0">
                                        </div>
                                        <div class="mb-2">
                                            <label class="small">Agyag:</label>
                                            <input type="number" class="form-control form-control-sm" name="buy_clay" value="0">
                                        </div>
                                        <div class="mb-2">
                                            <label class="small">Vas:</label>
                                            <input type="number" class="form-control form-control-sm" name="buy_iron" value="0">
                                        </div>
                                        <div class="mb-2">
                                            <label class="small">Gabona:</label>
                                            <input type="number" class="form-control form-control-sm" name="buy_crop" value="0">
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-calculator"></i> NPC Árfolyam Számítás
                                </button>
                            </form>
                            
                            <div id="npcResult" class="mt-3"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Elfogás kalkulátor -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            <h5><i class="fas fa-crosshairs"></i> Elfogás Kalkulátor</h5>
                        </div>
                        <div class="card-body">
                            <form id="interceptionForm">
                                <div class="mb-3">
                                    <label class="form-label">Ellenséges csapat koordináták:</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="number" class="form-control" name="enemy_x" placeholder="X" required>
                                        </div>
                                        <div class="col-6">
                                            <input type="number" class="form-control" name="enemy_y" placeholder="Y" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Ellenséges csapat célja:</label>
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
                                    <label class="form-label">Ellenséges csapat sebessége:</label>
                                    <select class="form-control" name="enemy_speed" required>
                                        <option value="6">Lassú (6)</option>
                                        <option value="7">Közepes (7)</option>
                                        <option value="17">Gyors (17)</option>
                                        <option value="19">Nagyon gyors (19)</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Saját csapat koordináták:</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="number" class="form-control" name="my_x" placeholder="X" required>
                                        </div>
                                        <div class="col-6">
                                            <input type="number" class="form-control" name="my_y" placeholder="Y" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-calculator"></i> Elfogás Számítás
                                </button>
                            </form>
                            
                            <div id="interceptionResult" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Útvonal kalkulátor
document.getElementById('routeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const fromX = parseInt(formData.get('from_x'));
    const fromY = parseInt(formData.get('from_y'));
    const toX = parseInt(formData.get('to_x'));
    const toY = parseInt(formData.get('to_y'));
    const speed = parseInt(formData.get('troop_speed'));
    
    const distance = Math.sqrt(Math.pow(toX - fromX, 2) + Math.pow(toY - fromY, 2));
    const travelTime = (distance * 60) / speed; // percben
    
    const hours = Math.floor(travelTime / 60);
    const minutes = Math.round(travelTime % 60);
    
    document.getElementById('routeResult').innerHTML = `
        <div class="alert alert-info">
            <h6><i class="fas fa-info-circle"></i> Eredmény:</h6>
            <p><strong>Távolság:</strong> ${distance.toFixed(2)} mező</p>
            <p><strong>Utazási idő:</strong> ${hours} óra ${minutes} perc</p>
        </div>
    `;
});

// Kultúrpont kalkulátor
document.getElementById('cultureForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const current = parseInt(formData.get('current_culture'));
    const villages = parseInt(formData.get('village_count'));
    const production = parseInt(formData.get('culture_production'));
    
    // Következő falu költsége (egyszerűsített számítás)
    const nextVillageCost = 500 + (villages * 750);
    const needed = nextVillageCost - current;
    const daysNeeded = needed > 0 ? Math.ceil(needed / production) : 0;
    
    document.getElementById('cultureResult').innerHTML = `
        <div class="alert alert-success">
            <h6><i class="fas fa-info-circle"></i> Kultúrpont Eredmény:</h6>
            <p><strong>Következő falu költsége:</strong> ${nextVillageCost} CP</p>
            <p><strong>Szükséges CP:</strong> ${needed > 0 ? needed : 0}</p>
            <p><strong>Idő új faluig:</strong> ${daysNeeded} nap</p>
        </div>
    `;
});

// NPC kalkulátor
document.getElementById('npcForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    
    // NPC árfolyamok (egyszerűsített)
    const rates = { wood: 1, clay: 1, iron: 1, crop: 1 };
    
    const sellTotal = 
        parseInt(formData.get('sell_wood')) * rates.wood +
        parseInt(formData.get('sell_clay')) * rates.clay +
        parseInt(formData.get('sell_iron')) * rates.iron +
        parseInt(formData.get('sell_crop')) * rates.crop;
    
    const buyTotal = 
        parseInt(formData.get('buy_wood')) * rates.wood +
        parseInt(formData.get('buy_clay')) * rates.clay +
        parseInt(formData.get('buy_iron')) * rates.iron +
        parseInt(formData.get('buy_crop')) * rates.crop;
    
    const ratio = sellTotal / buyTotal;
    const isValid = ratio >= 1.0;
    
    document.getElementById('npcResult').innerHTML = `
        <div class="alert ${isValid ? 'alert-success' : 'alert-danger'}">
            <h6><i class="fas fa-exchange-alt"></i> NPC Eredmény:</h6>
            <p><strong>Eladás értéke:</strong> ${sellTotal}</p>
            <p><strong>Vétel értéke:</strong> ${buyTotal}</p>
            <p><strong>Arány:</strong> ${ratio.toFixed(2)}</p>
            <p><strong>Státusz:</strong> ${isValid ? 'Érvényes csere' : 'Érvénytelen - többet akarsz venni!'}</p>
        </div>
    `;
});

// Elfogás kalkulátor
document.getElementById('interceptionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const enemyX = parseInt(formData.get('enemy_x'));
    const enemyY = parseInt(formData.get('enemy_y'));
    const targetX = parseInt(formData.get('target_x'));
    const targetY = parseInt(formData.get('target_y'));
    const enemySpeed = parseInt(formData.get('enemy_speed'));
    const myX = parseInt(formData.get('my_x'));
    const myY = parseInt(formData.get('my_y'));
    
    // Ellenséges csapat útja
    const enemyDistance = Math.sqrt(Math.pow(targetX - enemyX, 2) + Math.pow(targetY - enemyY, 2));
    const enemyTravelTime = (enemyDistance * 60) / enemySpeed;
    
    // Saját csapat útja az elfogási ponthoz (célponthoz)
    const myDistance = Math.sqrt(Math.pow(targetX - myX, 2) + Math.pow(targetY - myY, 2));
    
    // Szükséges sebesség az elfogáshoz
    const requiredSpeed = (myDistance * 60) / enemyTravelTime;
    
    const canIntercept = requiredSpeed <= 19; // Max sebesség Traviánban
    
    document.getElementById('interceptionResult').innerHTML = `
        <div class="alert ${canIntercept ? 'alert-success' : 'alert-danger'}">
            <h6><i class="fas fa-crosshairs"></i> Elfogás Eredmény:</h6>
            <p><strong>Ellenség útja:</strong> ${enemyDistance.toFixed(2)} mező</p>
            <p><strong>Ellenség ideje:</strong> ${(enemyTravelTime / 60).toFixed(2)} óra</p>
            <p><strong>Saját távolság:</strong> ${myDistance.toFixed(2)} mező</p>
            <p><strong>Szükséges sebesség:</strong> ${requiredSpeed.toFixed(2)}</p>
            <p><strong>Elfogás lehetséges:</strong> ${canIntercept ? 'IGEN' : 'NEM'}</p>
            ${canIntercept ? '<p class="text-success">Használj gyors csapatokat!</p>' : '<p class="text-danger">Túl lassú lennél az elfogáshoz.</p>'}
        </div>
    `;
});
</script>

</body>
</html>