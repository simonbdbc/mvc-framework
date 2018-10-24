<?php
namespace Core\Controller;
use Core\Controller\Dispatcher as Dispatcher;

class Router
{
    private $moduleDirectory = "modules/";
    
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
        // var_dump($aURI);

        $sModule = (count($aURI) > 0) ? $aURI[0] : '';
        $sAction = (count($aURI) > 1) ? $aURI[1] : '';
        
        if ($sModule == '') {
            $sModule = 'home';
            $sClass = $sModule.'Page';
        } else {
            // var_dump($uri);
            $sClass = $sModule.'Page';
        }

        if ($sModule != 'home' && count(scandir($this->moduleDirectory)) > 0 ) {

            $sController = ucfirst($sModule).'Controller';
            $sRouteModule = $this->moduleDirectory.$sModule.'/controller/'.ucfirst($sModule).'Controller.php';
            $sUseController = 'Modules\\'.$sModule.'\\Controller\\' . $sController;
            include_once($sRouteModule);
            $dispatcher = new $sUseController();
            
            // var_dump($dispatcher);
            
        } else {
          
            $dispatcher = new Dispatcher();
        }


        // var_dump($sModule, $sAction);
        if(method_exists($dispatcher,$sClass))
        {

            $dispatcher->$sClass($sModule, $sAction = '');
        } else {
            $dispatcher->code404();
        }       
    
    }
}
