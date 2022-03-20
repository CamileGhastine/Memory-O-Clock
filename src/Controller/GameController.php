<?php

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
        $this->gameRepository = new GameRepository;
        $this->resultBinder = new ResultBinder;
    }

    /**
     * homepage
     * @return void
     */
    public function index(): void
    {
        $games = $this->gameRepository->findTopTen();

        $this->render('home', compact('games'));
    }

    /**
     * Game page
     * @return void
     */
    public function play(): void
    {
        $this->render('game');
    }

    /**
     * Call by AJAX request
     * @return void
     */
    public function addResult(): void
    {
        $game = new Game();
        $game->setResult($_POST['result']);

        $this->gameRepository->add($game);

        $result = [
            'timer' => $game->getResult(),
            'ranking' => $this->resultBinder->findRank($game->getResult(), $this->gameRepository)
        ];

        require dirname(__DIR__) . '/view/game/ajax/result.php';
    }
}
