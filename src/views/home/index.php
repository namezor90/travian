<?php
// src/views/home/index.php
include __DIR__ . '/../layout/header.php';
?>

<div class="container mt-4">
    <div class="jumbotron bg-primary text-white rounded p-5 mb-4">
        <h1 class="display-4"><i class="fas fa-shield-alt"></i> Travian Tools</h1>
        <p class="lead">A legkomplexebb eszköztár Travian játékosoknak</p>
        <hr class="my-4">
        <p>Professional eszközök támadáshoz, védekezéshez, gabonakezeléshez és statisztikai elemzéshez.</p>
        
        <?php if (!isset($_SESSION['user_id'])): ?>
        <a class="btn btn-warning btn-lg" href="/register" role="button">
            <i class="fas fa-rocket"></i> Kezdj el most!
        </a>
        <a class="btn btn-outline-light btn-lg ms-2" href="/login" role="button">
            <i class="fas fa-sign-in-alt"></i> Bejelentkezés
        </a>
        <?php else: ?>
        <a class="btn btn-warning btn-lg" href="/dashboard" role="button">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <?php endif; ?>
    </div>
    
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-sword fa-3x text-danger mb-3"></i>
                    <h5>Troop Tool</h5>
                    <p class="small">Támadási és védekezési tervek készítése precíz időzítéssel</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-wheat fa-3x text-success mb-3"></i>
                    <h5>Crop Tool</h5>
                    <p class="small">Gabona egyenleg kezelés és éhezés előrejelzés</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-calculator fa-3x text-info mb-3"></i>
                    <h5>Kalkulátorok</h5>
                    <p class="small">Útvonal, kultúrpont, NPC és elfogás számítások</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-chart-bar fa-3x text-warning mb-3"></i>
                    <h5>Statisztikák</h5>
                    <p class="small">Játékos és szövetség elemzések</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>