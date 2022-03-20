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
        $this->gameRepository = new GameRepository();
        $this->resultBinder = new ResultBinder();
    }

    /**
     * homepage
     * @return mixed
     */
    public function home(): mixed
    {
        $games = $this->gameRepository->findTopTen();

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
