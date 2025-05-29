<?php include 'src/views/layout/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2><i class="fas fa-wheat"></i> Crop Tool - Gabonakezelő Eszköz</h2>
            
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5><i class="fas fa-plus"></i> Falu Adatok Hozzáadása</h5>
                        </div>
                        <div class="card-body">
                            <form id="villageForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Falu neve</label>
                                            <input type="text" class="form-control" name="village_name" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label">X koordináta</label>
                                                <input type="number" class="form-control" name="x" required>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Y koordináta</label>
                                                <input type="number" class="form-control" name="y" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Gabona termelés/óra</label>
                                            <input type="number" class="form-control" name="crop_production" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Gabona fogyasztás/óra</label>
                                            <input type="number" class="form-control" name="crop_consumption" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jelenlegi gabona</label>
                                            <input type="number" class="form-control" name="current_crop" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Raktár kapacitás</label>
                                            <input type="number" class="form-control" name="warehouse_capacity" value="800" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Falu hozzáadása
                                </button>
                                <button type="button" class="btn btn-primary" onclick="calculateAll()">
                                    <i class="fas fa-calculator"></i> Összes számítása
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Eredmények táblázat -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5><i class="fas fa-chart-line"></i> Gabona Egyenleg Eredmények</h5>
                        </div>
                        <div class="card-body">
                            <div id="cropResults" class="table-responsive">
                                <!-- Ajax eredmények ide kerülnek -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5><i class="fas fa-info-circle"></i> Crop Tool Használata</h5>
                        </div>
                        <div class="card-body">
                            <h6>Automatikus adatfeldolgozás:</h6>
                            <p class="small">Másold be a piacról vagy az áttekintésből az adatokat, és az eszköz automatikusan feldolgozza őket.</p>
                            
                            <h6>Funkciók:</h6>
                            <ul class="small">
                                <li>Éhezés idő számítása</li>
                                <li>Raktár megteltének időpontja</li>
                                <li>Gabona egyenleg vizualizáció</li>
                                <li>Szállítási javaslatok</li>
                            </ul>
                            
                            <div class="alert alert-warning">
                                <strong>Figyelem:</strong> Piros háttér = éhezés veszélye!
                            </div>
                        </div>
                    </div>
                    
                    <!-- Gyors gabona kalkulátor -->
                    <div class="card mt-3">
                        <div class="card-header bg-warning">
                            <h6><i class="fas fa-bolt"></i> Gyors Kalkulátor</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label class="form-label small">Termelés/óra:</label>
                                <input type="number" class="form-control form-control-sm" id="quickProd">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small">Fogyasztás/óra:</label>
                                <input type="number" class="form-control form-control-sm" id="quickCons">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small">Jelenlegi gabona:</label>
                                <input type="number" class="form-control form-control-sm" id="quickCurrent">
                            </div>
                            <button class="btn btn-warning btn-sm" onclick="quickCalculate()">
                                <i class="fas fa-zap"></i> Gyors számítás
                            </button>
                            <div id="quickResult" class="mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let villages = [];

document.getElementById('villageForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const village = {
        name: formData.get('village_name'),
        x: formData.get('x'),
        y: formData.get('y'),
        crop_production: parseInt(formData.get('crop_production')),
        crop_consumption: parseInt(formData.get('crop_consumption')),
        current_crop: parseInt(formData.get('current_crop')),
        warehouse_capacity: parseInt(formData.get('warehouse_capacity'))
    };
    
    villages.push(village);
    e.target.reset();
    displayVillages();
});

function calculateAll() {
    if (villages.length === 0) {
        alert('Először adj hozzá legalább egy falut!');
        return;
    }
    
    const results = villages.map(village => {
        const balance = village.crop_production - village.crop_consumption;
        
        if (balance < 0) {
            const hoursUntilStarvation = village.current_crop / Math.abs(balance);
            return {
                village_name: village.name,
                status: 'danger',
                balance: balance,
                hours_until_starvation: hoursUntilStarvation.toFixed(2),
                coordinates: `(${village.x}, ${village.y})`
            };
        } else {
            const hoursUntilFull = (village.warehouse_capacity - village.current_crop) / balance;
            return {
                village_name: village.name,
                status: 'safe',
                balance: balance,
                hours_until_full: hoursUntilFull.toFixed(2),
                coordinates: `(${village.x}, ${village.y})`
            };
        }
    });
    
    displayResults(results);
}

function displayResults(results) {
    let html = `
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Falu</th>
                    <th>Koordináták</th>
                    <th>Egyenleg/óra</th>
                    <th>Státusz</th>
                    <th>Idő</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
    `;
    
    results.forEach((result, index) => {
        const rowClass = result.status === 'danger' ? 'table-danger' : 'table-success';
        const statusText = result.status === 'danger' ? 'Éhezés veszélye' : 'Biztonságos';
        const timeText = result.status === 'danger' 
            ? `${result.hours_until_starvation} óra múlva éhezés`
            : `${result.hours_until_full} óra múlva megtelt`;
        
        html += `
            <tr class="${rowClass}">
                <td><strong>${result.village_name}</strong></td>
                <td>${result.coordinates}</td>
                <td><span class="badge ${result.balance >= 0 ? 'bg-success' : 'bg-danger'}">${result.balance}</span></td>
                <td>${statusText}</td>
                <td>${timeText}</td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick="sendCrop(${index})">
                        <i class="fas fa-paper-plane"></i> Gabona küldés
                    </button>
                </td>
            </tr>
        `;
    });
    
    html += '</tbody></table>';
    document.getElementById('cropResults').innerHTML = html;
}

function displayVillages() {
    // Egyszerű lista megjelenítése a hozzáadott falvakról
    console.log('Falvak:', villages);
}

function sendCrop(villageIndex) {
    const village = villages[villageIndex];
    const travianUrl = `https://ts1.travian.hu/build.php?id=17&t=5&target=${village.x},${village.y}`;
    window.open(travianUrl, '_blank');
}

function quickCalculate() {
    const prod = parseInt(document.getElementById('quickProd').value) || 0;
    const cons = parseInt(document.getElementById('quickCons').value) || 0;
    const current = parseInt(document.getElementById('quickCurrent').value) || 0;
    
    const balance = prod - cons;
    let resultHtml = `<div class="small">Egyenleg: <strong>${balance}</strong>/óra<br>`;
    
    if (balance < 0) {
        const hours = current / Math.abs(balance);
        resultHtml += `<span class="text-danger">Éhezés: ${hours.toFixed(2)} óra múlva</span>`;
    } else {
        resultHtml += `<span class="text-success">Pozitív egyenleg!</span>`;
    }
    
    resultHtml += '</div>';
    document.getElementById('quickResult').innerHTML = resultHtml;
}
</script>

</body>
</html>