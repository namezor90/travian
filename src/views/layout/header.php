<?php
// src/views/layout/header.php - JAVÍTOTT verzió alkönyvtárhoz
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Travian Tools' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="/travian/public/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/travian/">
                <i class="fas fa-shield-alt"></i> Travian Tools
            </a>
            
            <?php if (isset($_SESSION['user_id'])): ?>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/travian/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a class="nav-link" href="/travian/trooptool"><i class="fas fa-sword"></i> Troop Tool</a>
                <a class="nav-link" href="/travian/croptool"><i class="fas fa-wheat"></i> Crop Tool</a>
                <a class="nav-link" href="/travian/stats"><i class="fas fa-chart-bar"></i> Statisztikák</a>
                <a class="nav-link" href="/travian/calculators"><i class="fas fa-calculator"></i> Kalkulátorok</a>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i> <?= $_SESSION['username'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li><a class="dropdown-item" href="/travian/admin"><i class="fas fa-cog"></i> Admin</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="/travian/logout"><i class="fas fa-sign-out-alt"></i> Kijelentkezés</a></li>
                    </ul>
                </div>
            </div>
            <?php else: ?>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/travian/login">Bejelentkezés</a>
                <a class="nav-link" href="/travian/register">Regisztráció</a>
            </div>
            <?php endif; ?>
        </div>
    </nav>