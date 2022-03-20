<?php

namespace Memory\Controller;

/**
 * Class AbstractController
 * @package Memory\Controller
 */
abstract class AbstractController
{
    /**
     * @param string $view
     * @param array|null $datas
     * @return void
     */
    protected function render(string $view, array $datas = null): void
    {
        if ($datas) extract($datas);

        ob_start();
        require dirname(__DIR__) . '/view/game/' . $view . '.php';
        $content = ob_get_clean();

        require dirname(__DIR__) . '/view/base.php';
    }

        /**
     * @param string $view
     * @param array|null $datas
     * @return void
     */
    protected function renderAjax(string $view, array $datas = null): void
    {
        if ($datas) extract($datas);

        require dirname(__DIR__) . '/view/game/ajax/' . $view . '.php';
    }
 
}
