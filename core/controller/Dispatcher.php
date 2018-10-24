<?php
namespace Core\Controller;
use Core\Controller\View as View;
use Core\Model\Model as Model;


class Dispatcher
{
    private $viewDirectory = "view/";

    public function displayPage($sModule, $sAction = '')
    {
        $view = new View();

        $view->renderView($sModule,[
            "{{TITLE}}" => ucfirst($GLOBALS['conf']->app_modules[$sModule])
        ], false);
    }

    public function code404()
    {
        echo '<h2>Cette page est introuvable...</h2>';
    }
}
