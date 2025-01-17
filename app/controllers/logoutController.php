<?php
class logoutController {
    public function index() {
        // Inicializace modelu autentizace
        $auth = new Auth();

        // Odhlášení uživatele
        $auth->logout();

        // Přesměrování na přihlašovací stránku
        header('Location: /login');
        exit();
    }
}
?>