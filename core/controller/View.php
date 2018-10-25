<?php
    namespace Core\Controller;
    use Model\Model as Model;

    class View
    {
        private $viewDirectory = "core/view/";
        private $moduleDirectory = "modules/";

        public function renderView($sModule, Array $values = [], $aData = [])
        {
            // charge le main.html du core
            $sHtml = $this->loadTemplate('main');
            // inclusion du menu dans le main.html            
            $sHtml = str_replace("{{MENU}}", $this->loadMenu(), $sHtml);

            $sHtml = str_replace("{{MODULE-LAYOUT}}", $this->loadModule($sModule, $aData), $sHtml);
            
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
                $menuHtml = '<ul class="flex justify-around items-center my-4 list-reset">';
                // $menuHtml .= '<li><a href="home">Home</a></li>';
                foreach ($aMenu as $key => $value) {
                    $menuHtml .= '<li class="shadow-md px-8 py-2"><a href="'.$key.'">'.ucfirst($value).'</a></li>';
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

        public function loadModule($sModule, $aData)
        {
            $viewPath = $this->moduleDirectory.$sModule.'/view/layout/'.$sModule.'.html';              
         
            // var_dump(file_get_contents($viewPath));die;
            if (file_exists($viewPath)) {
                $sContentHtml = file_get_contents($viewPath);

                // var_dump($aData);

                if($aData != '' && $aData != null) {
                    // $sContentHtml .= '<a href="/">Retour</a>';
                    $sContentHtml .= '<div class="flex justify-center items-center my-8"><h2>'.ucfirst($GLOBALS['conf']->app_modules[$sModule]).'</h2></div>';

                    $sContentHtml .='<div class="px-2"><div class="flex -mx-2"><div class="w-1/3">';
                    $sContentHtml .='<div class="h-12 flex justify-center items-center mt-4">Nom :</div>';
                    $sContentHtml .='</div><div class="w-1/3">';
                    $sContentHtml .='<div class="h-12 flex justify-center items-center mt-4">Prénom :</div>';
                    $sContentHtml .='</div><div class="w-1/3">';
                    $sContentHtml .='<div class="h-12 flex justify-center items-center mt-4">Salaire :</div>';
                    $sContentHtml .='</div></div></div>';
                    
                    foreach ($aData as $key => $value) {
                        
                        $sContentHtml .='<div class="px-2">';
                        $sContentHtml .='<div class="flex -mx-2">';
                        $sContentHtml .='<div class="w-1/3">';
                        $sContentHtml .='<div class="bg-grey-light h-12 text-left flex items-center pl-8 mt-4">'.ucfirst($value->name).'</div>';
                        $sContentHtml .='</div>';
                        $sContentHtml .='<div class="w-1/3">';
                        $sContentHtml .='<div class="bg-grey h-12 text-left flex items-center pl-8 mt-4">'.ucfirst($value->firstname).'</div>';
                        $sContentHtml .='</div>';
                        $sContentHtml .='<div class="w-1/3">';
                        $sContentHtml .='<div class="bg-grey-light h-12 text-left flex items-center pl-8 mt-4">'.$value->salary.'</div>';
                        $sContentHtml .='</div>';
                        $sContentHtml .='</div>';
                        $sContentHtml .='</div>';
                    }
                }
                return $sContentHtml;
            } else {
                $sDefaultContentHtml = '';
                $sDefaultContentHtml .= '<div class="flex justify-center items-center my-8"><h2>Accueil</h2></div>';
                $sDefaultContentHtml .= '<div class="flex justify-center items-center my-8"><p>Hello world !</p></div>';

                return $sDefaultContentHtml;
            }
        }

    }