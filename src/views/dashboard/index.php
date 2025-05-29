<?php include 'src/views/layout/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
            <p class="text-muted">Üdvözöllek, <strong><?= $_SESSION['username'] ?></strong>!</p>
        </div>
    </div>
    
    <div class="row mt-4">
        <!-- Gyors hozzáférés kártyák -->
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body text-center">
                    <i class="fas fa-sword fa-3x mb-3"></i>
                    <h5>Troop Tool</h5>
                    <p>Támadási és védekezési tervek</p>
                    <a href="/trooptool" class="btn btn-outline-light">
                        <i class="fas fa-arrow-right"></i> Megnyitás
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <i class="fas fa-wheat fa-3x mb-3"></i>
                    <h5>Crop Tool</h5>
                    <p>Gabona egyenleg kezelő</p>
                    <a href="/croptool" class="btn btn-outline-light">
                        <i class="fas fa-arrow-right"></i> Megnyitás
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <i class="fas fa-calculator fa-3x mb-3"></i>
                    <h5>Kalkulátorok</h5>
                    <p>Különböző számítások</p>
                    <a href="/calculators" class="btn btn-outline-light">
                        <i class="fas fa-arrow-right"></i> Megnyitás
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body text-center">
                    <i class="fas fa-chart-bar fa-3x mb-3"></i>
                    <h5>Statisztikák</h5>
                    <p>Játékos és szövetség adatok</p>
                    <a href="/stats" class="btn btn-outline-light">
                        <i class="fas fa-arrow-right"></i> Megnyitás
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <!-- Legújabb aktivitások -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-clock"></i> Legutóbbi Aktivitások</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6>Új támadási terv mentve</h6>
                                <p class="text-muted small">2 órája</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <h6>Crop Tool használat</h6>
                                <p class="text-muted small">5 órája</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6>Útvonal kalkuláció</h6>
                                <p class="text-muted small">1 napja</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Gyors statisztikák -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-chart-pie"></i> Gyors Áttekintés</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h3 class="text-danger">12</h3>
                            <p class="small">Támadási terv</p>
                        </div>
                        <div class="col-6">
                            <h3 class="text-primary">8</h3>
                            <p class="small">Védekezési terv</p>
                        </div>
                        <div class="col-6">
                            <h3 class="text-success">5</h3>
                            <p class="small">Falvak kezelve</p>
                        </div>
                        <div class="col-6">
                            <h3 class="text-warning">23</h3>
                            <p class="small">Kalkuláció</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Hasznos linkek -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6><i class="fas fa-external-link-alt"></i> Hasznos Linkek</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="https://travian.hu" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-globe"></i> Travian.hu
                        </a>
                        <a href="https://kiraly.cc" target="_blank" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-chart-line"></i> Kiraly.cc statisztikák
                        </a>
                        <a href="/map" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-map"></i> Interaktív térkép
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    top: 5px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: -30px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>