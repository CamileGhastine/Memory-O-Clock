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
}
