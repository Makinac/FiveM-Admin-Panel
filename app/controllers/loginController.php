<?php

class CreatorController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        } else {
            if (file_exists('app/config/config.json')) {
                header("Location: /dashboard");
                exit();
            }

            require 'app/views/creator.php';
        }
    }
}
?>