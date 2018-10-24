<?php
namespace Modules\Salarie\Controller;
use Core\Controller\Dispatcher as Dispatcher;
use Core\Controller\View as View;

class SalarieController extends Dispatcher
{

    public function add($sModule, $sAction = '')
    { 
        var_dump('ici');
        $view = new View();

        $view->renderView('',[
            "{{TITLE}}" => ucfirst($sModule)
        ], false);
    }

    public function edit($sModule, $sAction = '')
    {
        
    }

    public function update($sModule, $sAction = '')
    {
        
    }
}