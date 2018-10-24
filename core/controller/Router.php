<?php
namespace Core\Controller;
use Core\Controller\Dispatcher as Dispatcher;

class Router
{
    // private $moduleDirectory = "modules/";
    
    private function trimUri($uri)
    {
        $uri = substr($uri, 1);
        // var_dump($uri);
        $aURI = [];
        if($uri != ''){
            $aURI = explode('/', $uri);
        }
        // var_dump($aURI);

        return $aURI;

    }

    public function route()
    {
        
        $aURI = $this->trimUri($_SERVER['REQUEST_URI']);

        $sModule = (count($aURI) > 0) ? $aURI[0] : '';
        $sAction = (count($aURI) > 1) ? $aURI[1] : '';

        if ($sModule == '') {
            if (count(scandir($GLOBALS['conf']->module_directory)) > 2 && count($GLOBALS['conf']->app_modules) > 0) {
                $sModule = $GLOBALS['conf']->app_modules;
                $sModule = array_keys($sModule);
                $sModule = $sModule[0];
                // var_dump($sModule);
            } else {
                echo "Aucun module n'a été trouvé...";die;
            }
        }
        
        if ($sAction == '') {
            $sAction = 'displayPage';
        }
        
        if ($sModule != 'home' && count(scandir($GLOBALS['conf']->module_directory)) > 0 ) {

            $sRouteModule = $GLOBALS['conf']->module_directory.$sModule;
            
            $sController = ucfirst($sModule).'Controller';
            $sRouteController = $sRouteModule.'/controller/'.ucfirst($sModule).'Controller.php';
            $sUseController = 'Modules\\'.$sModule.'\\Controller\\' . $sController;
            include_once($sRouteController);
            $dispatcher = new $sUseController();
        } else {
            $dispatcher = new Dispatcher();
        }


        // var_dump($sModule, $sAction);
        if(method_exists($dispatcher,$sAction)) {
            $dispatcher->$sAction($sModule);
        } else {
            $dispatcher->code404();
        }       
    
    }
}
