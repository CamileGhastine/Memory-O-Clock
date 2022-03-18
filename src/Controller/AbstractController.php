<?php

namespace Memory\Controller;

abstract class AbstractController
{
    public function render(string $view)
    {
        ob_start();
        require dirname(__DIR__) . '/view/game/' . $view . '.php';
        $content = ob_get_clean();

        require dirname(__DIR__) . '/view/base.php';
    }
}
