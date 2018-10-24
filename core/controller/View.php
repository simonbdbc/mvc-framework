<?php
    namespace Core\Controller;
    use Model\Model as Model;

    class View
    {
        private $viewDirectory = "core/view/";
        private $moduleDirectory = "modules/";

        public function renderView($sModule, Array $values = [])
        {
            // charge le main.html du core
            $sHtml = $this->loadTemplate('main');
            // inclusion du menu dans le main.html            
            $sHtml = str_replace("{{MENU}}", $this->loadMenu(), $sHtml);

            $sHtml = str_replace("{{MODULE-LAYOUT}}", $this->loadModule($sModule), $sHtml);
            
            foreach ($values as $key => $value) {
                $sHtml = str_replace($key, $value, $sHtml);
            }
            
            echo $sHtml;
        }

        public function loadMenu()
        {
            // recupere les noms des modules dans un tableau pour remplir le menu
            $aMenu = '';
            $aMenu = $GLOBALS['conf']->app_modules;
            // $aMenu = array_slice(scandir($this->moduleDirectory), 2);
            // var_dump($aMenu);
            if($aMenu != '' && $aMenu != null) {
                $menuHtml = '<ul style="display: flex;justify-content: space-around;">';
                // $menuHtml .= '<li><a href="home">Home</a></li>';
                foreach ($aMenu as $key => $value) {
                    $menuHtml .= '<li><a href="'.$key.'">'.ucfirst($value).'</a></li>';
                }
                $menuHtml .= '</ul>';
            } else {
                $menuHtml = '';
            }
            return $menuHtml;
        }
    
        
        private function loadTemplate($viewName)
        {
            $viewPath = $this->viewDirectory ."template/".$viewName.".html";                
         
            if (file_exists($viewPath)) {
                return file_get_contents($viewPath);
            }
        }

        public function loadModule($sModule)
        {
            $viewPath = $this->moduleDirectory.$sModule.'/view/layout/'.$sModule.'.html';              
         
            // var_dump(file_get_contents($viewPath));die;
            if (file_exists($viewPath)) {
                return file_get_contents($viewPath);
            } else {
                return '';
            }
        }
        
    }