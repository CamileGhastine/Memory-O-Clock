<?php

namespace Memory;

use Memory\Controller\GameController;
use Exception;

class Router
{
    public function run()
    {
        try {
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';

            if ($page === 'home') {
                $controller = new GameController();
                $controller->index();
            } elseif ($page === 'game') {
                $controller = new GameController();
                $controller->play();
            } else {
                throw new Exception('Erreur 404 : page non trouvée !!!');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
