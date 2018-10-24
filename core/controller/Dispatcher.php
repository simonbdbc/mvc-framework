<?php
namespace Core\Controller;
use Core\Controller\View as View;
// use Core\Model\Model as Model;


class Dispatcher
{
    private $viewDirectory = "view/";

    public function displayPage($sModule, $sRouteModule = '')
    {
        $view = new View();
        $aData = [];
        
        if ($sModule != 'home') {

            $sRouteModule = $GLOBALS['conf']->module_directory.$sModule;

            $sModel = ucfirst($sModule).'Model';
            $sRouteModel = $sRouteModule.'/model/'.ucfirst($sModule).'Model.php';
            $sUseModel = 'Modules\\'.$sModule.'\\model\\'.$sModel;
            include_once($sRouteModel);
            $model = new $sUseModel();
    
            $aData = json_decode($model->getAll());
            // var_dump($aData);die;
        }

        $view->renderView($sModule,[
            "{{TITLE}}" => ucfirst($GLOBALS['conf']->app_modules[$sModule])
        ], $aData);
    }

    public function code404()
    {
        echo '<h2>Cette page est introuvable...</h2>';
    }
}
