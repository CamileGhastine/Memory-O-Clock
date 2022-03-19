<?php

namespace Memory\Controller;

use Memory\Model\Entity\Game;
use Memory\Model\GameRepository;

class GameController extends AbstractController
{
    private $GameRepository;

    public function __construct()
    {
        $this->GameRepository = new GameRepository;
    }

    public function index()
    {
        $games = $this->GameRepository->findTopTen();

        $this->render('home', compact('games'));
    }

    public function play()
    {
        $this->render('game');
    }

    public function addResult()
    {
        $game =new Game();
        $game->setResult($_POST['result']);

        $this->GameRepository->add($game) ;

        $result = [
            'timer' => $game->getResult(),
            'ranking' => $this->isTopTen($game->getResult())
        ];

        require dirname(__DIR__) . '/view/game/result.php';
    }

    private function isTopTen(float $result)
    {
        $game = $this->GameRepository->findTenth()[0];

        return $result <= $game->getResult();
    }
}
