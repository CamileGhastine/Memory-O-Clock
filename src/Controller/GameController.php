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
        $game = new Game();
        $game->setResult($_POST['result']);

        $this->GameRepository->add($game);

        $result = [
            'timer' => $game->getResult(),
            'ranking' => $this->ranked($game->getResult())
        ];

        require dirname(__DIR__) . '/view/game/ajax/result.php';
    }

    private function ranked(float $result)
    {
        $games = $this->GameRepository->findAll();
        
        foreach ($games as $index => $game) {
            if ($game->getResult() >= $result) {
                return $index;
            }
        }
    }
}
