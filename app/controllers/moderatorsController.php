<?php
class moderatorsController {

    public function index() {
        $title = 'Manage Moderators'; 
        $script = '/assets/js/moderators.js';
        $auth = new Auth();

        // Generování obsahu
        ob_start();
        $users = $auth->getAllUsers();
        require 'app/views/layouts/moderators.php';
        $content = ob_get_clean();

        // Zahrnutí layoutu
        require 'app/layout.php';
    }
}
?>