// README.md
# Travian Tools - Komplex Játék Segédeszköz

## Leírás
Teljes körű PHP-alapú webalkalmazás Travian játékosok számára, amely tartalmaz minden szükséges eszközt a hatékony játékhoz.

## Főbb Funkciók

### 🗡️ Troop Tool
- **Támadási tervek**: Részletes támadási stratégiák készítése koordinátákkal és időzítéssel
- **Védekezési tervek**: Védekezési taktikák kidolgozása és csapatelosztás
- **Személyes tervek**: Egyéni játékos tervek mentése és kezelése

### 🌾 Crop Tool
- **Automatikus adatfeldolgozás**: Piaci adatok alapján gabona számítások
- **Éhezés előrejelzés**: Pontos időszámítás az éhezés elkerülésére
- **Grafikus áttekintés**: Vizuális megjelenítés a gabona egyenlegről
- **Szállítási javaslatok**: Optimális gabona elosztási stratégiák

### 🧮 Kalkulátorok
- **Útvonal kalkulátor**: Távolság és utazási idő számítás
- **Kultúrpont kalkulátor**: Új falu alapítási költségek
- **NPC kalkulátor**: Erőforrás átváltási arányok
- **Elfogás kalkulátor**: Ellenséges csapatok elfogásának számítása

### 📊 Statisztikák
- **Játékos statisztikák**: Részletes teljesítmény elemzések
- **Szövetségi áttekintés**: Alliance ranglisták és összehasonlítások
- **Top listák**: Legjobb játékosok és szövetségek

### 🗺️ Térkép Eszközök
- **Interaktív térkép**: Dinamikus térkép böngészés
- **Inaktív kereső**: Potenciális célpontok azonosítása

## Technikai Specifikáció

### Backend
- **PHP 7.4+** - Modern PHP fejlesztés
- **MySQL/MariaDB** - Relációs adatbázis
- **PDO** - Biztonságos adatbázis kezelés
- **Session Management** - Biztonságos felhasználói munkamenetek
- **MVC Architecture** - Tiszta kód struktúra

### Frontend
- **Bootstrap 5** - Responsive design framework
- **Font Awesome 6** - Ikonok és grafikai elemek
- **Vanilla JavaScript** - Kliens oldali interaktivitás
- **Chart.js** - Adatvizualizáció

### Biztonság
- **Password Hashing** - Bcrypt titkosítás
- **SQL Injection Protection** - Prepared statements
- **XSS Protection** - Input sanitization
- **CSRF Protection** - Token alapú védelem

## Telepítés

### 1. Rendszerkövetelmények
```bash
- PHP 7.4 vagy újabb
- MySQL 5.7 vagy MariaDB 10.2+
- Apache/Nginx webszerver
- mod_rewrite engedélyezve
```

### 2. Adatbázis létrehozása
```bash
mysql -u root -p < database/schema.sql
```

### 3. Konfigurációs fájl
```bash
cp .env.example .env
# Szerkeszd a .env fájlt az adatbázis adataiddal
```

### 4. Webszerver konfiguráció
Apache .htaccess:
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

## Használat

### Regisztráció és Bejelentkezés
1. Látogass el a `/register` oldalra
2. Töltsd ki a regisztrációs űrlapot
3. Jelentkezz be a `/login` oldalon

### Troop Tool Használata
1. Válaszd a támadási vagy védekezési tervet
2. Add meg a koordinátákat és csapat adatokat
3. Állítsd be az időzítést
4. Mentsd el a tervet

### Crop Tool Használata
1. Add hozzá a falvaid adatait
2. Írd be a termelési és fogyasztási értékeket
3. Kattints a "Számítás" gombra
4. Ellenőrizd az eredményeket

### Kalkulátorok Használata
1. Válaszd ki a megfelelő kalkulátort
2. Töltsd ki a szükséges mezőket
3. Kattints a "Számítás" gombra
4. Mentsd az eredményeket

## API Dokumentáció

### Authentikáció Endpointok
```php
POST /login - Bejelentkezés
POST /register - Regisztráció  
GET /logout - Kijelentkezés
```

### Troop Tool API
```php
GET /trooptool - Tervek listázása
POST /trooptool/save - Új terv mentése
DELETE /trooptool/delete/{id} - Terv törlése
```

### Crop Tool API
```php
POST /croptool/calculate - Gabona számítás
GET /croptool/villages - Falvak listázása
```

## Adatbázis Séma

### Főbb Táblák
- `users` - Felhasználói adatok
- `troop_plans` - Támadási/védekezési tervek
- `villages` - Falu adatok
- `player_stats` - Játékos statisztikák
- `alliances` - Szövetség adatok
- `activity_logs` - Aktivitási naplók

## Fejlesztési Roadmap

### v1.1 Tervezett Funkciók
- [ ] **Telegram Bot integráció** - Értesítések küldése
- [ ] **Export funkciók** - Excel/CSV export
- [ ] **Fejlett térképek** - Leaflet.js integráció
- [ ] **Multi-server támogatás** - Több szerver kezelése
- [ ] **API kulcsok** - Külső alkalmazások számára

### v1.2 Hosszú Távú Tervek
- [ ] **Mobile App** - React Native alkalmazás
- [ ] **Real-time frissítések** - WebSocket támogatás
- [ ] **AI elemzések** - Gépi tanulás alapú javaslatok
- [ ] **Klán management** - Szövetség kezelő eszközök

## Hozzájárulás

### Fejlesztési Környezet
```bash
git clone https://github.com/your-repo/travian-tools.git
cd travian-tools
composer install  # ha használnánk Composer-t
```

### Kód Stílus
- PSR-4 autoloading
- PSR-12 kód formázás
- Dokumentált függvények
- Egységtesztek

### Pull Request Folyamat
1. Fork-old a repository-t
2. Hozz létre új branch-et (`git checkout -b feature/new-feature`)
3. Commit-old a változásokat (`git commit -am 'Add new feature'`)
4. Push-old a branch-et (`git push origin feature/new-feature`)
5. Hozz létre Pull Request-et

## Licenc

MIT License - Részletek a LICENSE fájlban.

## Támogatás

### Dokumentáció
- [Wiki](https://github.com/your-repo/travian-tools/wiki)
- [FAQ](https://github.com/your-repo/travian-tools/wiki/FAQ)

### Közösség
- [Discord szerver](https://discord.gg/travian-tools)
- [Forum](https://forum.travian-tools.com)

### Bug Jelentések
Issues section a GitHub-on vagy email: support@travian-tools.com

## Köszönetnyilvánítás

- **Travian Games** - Az eredeti játék fejlesztőinek
- **Bootstrap Team** - UI framework
- **Font Awesome** - Ikonok
- **Chart.js** - Adatvizualizáció

---

## Változások Jegyzéke

### v1.0.0 (2025-05-29)
- ✅ Teljes Troop Tool implementáció
- ✅ Komplex Crop Tool gabona kezelés
- ✅ 4 fajta kalkulátor
- ✅ Statisztikai rendszer
- ✅ Felhasználói hitelesítés
- ✅ Responsive web design
- ✅ Adatbázis struktúra
- ✅ Admin panel alapok

### Következő Kiadások
- 🔄 v1.1 - Fejlett térképek és exportálás
- 🔄 v1.2 - Mobile alkalmazás és API bővítés

---

**Travian Tools** - A legkomplexebb eszköztár Travian játékosoknak! 🗡️🛡️
