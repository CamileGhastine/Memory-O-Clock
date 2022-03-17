<?php

namespace Memory\Controller;

class GameController
{
    public function index()
    {
        require dirname(__DIR__) . '/view/home.php';
    }

    public function play() 
    {
        require dirname(__DIR__) . '/view/game.php';
    }
}
