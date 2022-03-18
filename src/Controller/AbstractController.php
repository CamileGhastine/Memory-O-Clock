<?php

namespace Memory\Controller;

abstract class AbstractController
{
    protected function render(string $view, array $datas = null): void
    {
        if ($datas) extract($datas);

        ob_start();
        require dirname(__DIR__) . '/view/game/' . $view . '.php';
        $content = ob_get_clean();

        require dirname(__DIR__) . '/view/base.php';
    }
}
