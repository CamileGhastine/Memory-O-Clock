<?php

namespace Memory\Controller;

use Memory\Model\Entity\Game;
use Memory\Model\GameRepository;

/**
 * Class GameController
 * @package Memory\Controller
 */
class GameController extends AbstractController
{
    /**
     * @var GameRepository
     */
    private $GameRepository;

    /**
     * GameController constructor
     */
    public function __construct()
    {
        $this->GameRepository = new GameRepository;
    }

    /**
     * homepage
     * @return void
     */
    public function index(): void
    {
        $games = $this->GameRepository->findTopTen();

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

        $this->GameRepository->add($game);

        $result = [
            'timer' => $game->getResult(),
            'ranking' => $this->ranked($game->getResult())
        ];

        require dirname(__DIR__) . '/view/game/ajax/result.php';
    }

    /**
     * @param float $result
     * @return int|string
     */
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
