<?php
// src/controllers/AdminController.php
class AdminController {
    public function index() {
        // Admin jogosultság ellenőrzése már a Router-ben megtörtént
        include 'src/views/admin/index.php';
    }
}