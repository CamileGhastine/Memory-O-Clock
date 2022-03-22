<?php
/* Le contrôleur gère la logique du code. C'est lui qui dicte les actions à réaliser.
Il va demander les données au modèle.
Puis il va traiter, vérifier et transformer ces données et les injecter dans la vue.
La vue sera renvoyée au client.
Elle sera interprétée par son navigateur (html, css, js) et affichée sur son écran*/

namespace Memory\Controller;

use Memory\Model\Entity\Game;
use Memory\Model\GameRepository;
use Memory\Service\ResultBinder;

/**
 * Class GameController
 * @package Memory\Controller
 */
class GameController extends AbstractController
{
    /**
     * @var GameRepository
     */
    private $gameRepository;

    /**
     * @var ResultBinder
     */
    private $resultBinder;

    /**
     * GameController constructor
     */
    public function __construct()
    {
        $this->gameRepository = new GameRepository();
        $this->resultBinder = new ResultBinder();
    }

    /**
     * homepage
     * @return mixed
     */
    public function home(): mixed
    {
        /* Le contrôleur récupère les données auprès du modèle. */
        $games = $this->gameRepository->findTopTen();

        /* Les données sont renvoyées à la vue. */
        return $this->render('home', compact('games'));
    }

    /**
     * Game page
     * @return mixed
     */
    public function play(): mixed
    {
        return $this->render('game');
    }

    /**
     * Call by AJAX request
     * @return mixed
     */
    public function addResult(): mixed
    {
        $game = new Game();
        $game->setResult($_POST['result']);

        $this->gameRepository->add($game);

        $result = [
            'timer' => $game->getResult(),
            'ranking' => $this->resultBinder->findRank($game->getResult(), $this->gameRepository)
        ];

        return $this->renderAjax('result', compact('result'));
    }
}
