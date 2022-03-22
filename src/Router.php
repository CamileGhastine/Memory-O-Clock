<?php
/* Notre application est architecturée avec le modèle MVC (modèle, vue, contrôleur).
Le routeur va analyser l’url de la requête client.
En fonction de celle-ci, il va appeler la méthode du contrôleur appropriée. */

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
        $uri = $this->getUri();

        try {
            if ($uri === '/') {
                $controller = new GameController();
                $controller->home();
            } elseif ($uri === '/game') {
                $controller = new GameController();
                $controller->play();
            } elseif ($uri === '/game/add') {
                $controller = new GameController();
                $controller->addResult();
            } else {
                throw new Exception('Erreur 404 : page non trouvée !!!<br> Retournez à <a href="/">l\'accueil</a>');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * get the uri of the request
     * @return void
     */
    private function getUri()
    {
        $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
        $uri = rtrim($uri, '/');

        return $uri ? $uri : '/';
    }
}
