<?php
class dashboardController {

    public function index() {
        $title = 'Domovská stránka'; // Titulek stránky
        $script = '/assets/js/home.js'; // Specifický JS soubor

        // Generování obsahu
        ob_start();
        ?>
        <h2>Vítejte!</h2>
        <p>Toto je domovská stránka.</p>
        <p>Máte <strong>3 nové zprávy</strong>.</p>
        <?php
        $content = ob_get_clean();

        // Zahrnutí layoutu
        require 'app/layout.php';
    }
}
?>