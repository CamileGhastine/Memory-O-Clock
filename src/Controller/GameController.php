<?php

namespace Memory\Controller;

class GameController extends AbstractController
{
    public function index()
    {
        $this->render('home');
    }

    public function play() 
    {
        $this->render('game');
    }
}
