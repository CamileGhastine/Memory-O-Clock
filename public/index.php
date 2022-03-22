<?php
/* Le client envoie une requête au serveur qui est réceptionnée par le fichier index.php.
C’est le point d'entrée dans l'application.
C’est ici que le routeur va être instancié et appelé.*/

use Memory\Router;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$router = new Router();
$router->run();
