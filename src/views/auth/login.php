<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés - Travian Tools</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h3><i class="fas fa-shield-alt"></i> Travian Tools</h3>
                        <p class="mb-0">Bejelentkezés</p>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i> <?= $error ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (isset($success)): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check"></i> <?= $success ?>
                        </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="/login">
                            <div class="mb-3">
                                <label for="username" class="form-label">
                                    <i class="fas fa-user"></i> Felhasználónév
                                </label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Jelszó
                                </label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt"></i> Bejelentkezés
                                </button>
                            </div>
                        </form>
                        
                        <div class="text-center mt-3">
                            <p>Még nincs fiókod? <a href="/register">Regisztrálj itt!</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-3">
                    <div class="card-body">
                        <h6><i class="fas fa-info-circle"></i> Főbb funkciók:</h6>
                        <ul class="small">
                            <li><strong>Troop Tool:</strong> Támadási és védekezési tervek készítése</li>
                            <li><strong>Crop Tool:</strong> Gabona egyenleg számítások és éhezés előrejelzés</li>
                            <li><strong>Kalkulátorok:</strong> Útvonal, kultúrpont, NPC és elfogás kalkulátorok</li>
                            <li><strong>Statisztikák:</strong> Játékos és szövetségi elemzések</li>
                            <li><strong>Térkép:</strong> Interaktív térkép eszközök</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>