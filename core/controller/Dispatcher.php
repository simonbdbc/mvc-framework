<?php
namespace Core\Controller;
use Core\Controller\View as View;
use Core\Model\Model as Model;


class Dispatcher
{
    private $viewDirectory = "view/";

    public function homePage($sModule, $sAction = '')
    {
        $view = new View();

        $view->renderView('',[
            "{{TITLE}}" => ucfirst($sModule)
        ], false);
    }

    public function editView($uri)
    {
        
    }

    public function updateView($uri)
    {
        
    }

    public function code404()
    {
        echo '<h2>Cette page est introuvable...</h2>';
    }
}
