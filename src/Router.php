<?php

namespace Memory;

use Memory\Controller\GameController;
use Exception;

/**
 * Class Router
 * @package Memory
 */
class Router
{
    /**
     * Route the request
     * @return void
     */
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
            } elseif ($page === 'add') {
                $controller = new GameController();
                $controller->addResult();
            } else {
                throw new Exception('Erreur 404 : page non trouvée !!!');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
