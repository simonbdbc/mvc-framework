<?php
    namespace Core\Controller;
    use Model\Model as Model;

    class View
    {
        private $viewDirectory = "core/view/";
        private $moduleDirectory = "modules/";

        public function renderView($viewHtml, Array $values = [])
        {
            // charge le main.html du core
            $sHtml = $this->loadTemplate('main');
            // inclusion du menu dans le main.html            
            $sHtml = str_replace("{{MENU}}", $this->loadMenu(), $sHtml);
        
            foreach ($values as $key => $value) {
                $sHtml = str_replace($key, $value, $sHtml);
            }
            
            echo $sHtml;
        }

        public function loadMenu()
        {
            // recupere les noms des modules dans un tableau pour remplir le menu
            $aMenu = '';
            $aMenu = array_slice(scandir($this->moduleDirectory), 2);
            // var_dump($aMenu);
            if($aMenu != '' && $aMenu != null) {
                $menuHtml = '<ul style="display: flex;justify-content: space-around;">';
                $menuHtml .= '<li><a href="home">Home</a></li>';
                foreach ($aMenu as $key => $value) {
                    $menuHtml .= '<li><a href="'.$value.'">'.ucfirst($value).'</a></li>';
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

        public function loadSection()
        {
            // $section = new Section();
            // $aSection = json_decode($section->getAll());
            // // var_dump($aSection);
            // if($aSection != '' && $aSection != null) {
            //     $sectionHtml = '<a href="/edit">Edition</a>';
            //     $sectionHtml .= '<div style="">';
            //     foreach ($aSection as $key => $value) {
            //         $sectionHtml .= '<section><h2>'.$value->title.'</h2><p>'.$value->content.'</p></section>';
            //     }
            //     $sectionHtml .= '</div>';
            // } else {
            //     $sectionHtml = '';
            // }
            // return $sectionHtml;
        }

        public function editSection()
        {
            // $section = new Section();
            // $aSection = json_decode($section->getAll());
            // // var_dump($aSection);
            // if($aSection != '' && $aSection != null) {
            //     $editSectionHtml = '<a href="/">Retour</a>';
            //     $editSectionHtml .= '<h2>Edition des sections</h2>';
            //     $editSectionHtml .= '<form action="/update" method="post">';
            //     $editSectionHtml .= '<input type="submit" value="Update">';
            //     foreach ($aSection as $key => $value) {
            //         $editSectionHtml .= '<div style="display: flex;flex-direction: column;justify-content: center;">';
            //         $editSectionHtml .= '<label style="margin: 10px" for="title">Titre de la section</label>';
            //         $editSectionHtml .= '<input type="text" name="'.$value->id.'[]" id="title" value="'.$value->title.'">';
            //         $editSectionHtml .= '<label for="content">Contenu de la section</label>';
            //         $editSectionHtml .= '<textarea rows="10" cols="100" type="text" name="'.$value->id.'[]" id="content" value="'.$value->content.'">'.$value->content.'</textarea>';
            //         $editSectionHtml .= '<label for="ordre">Ordre de la section</label>';
            //         $editSectionHtml .= '<input type="text" name="'.$value->id.'[]" id="ordre" value="'.$value->n_order.'">';
            //         $editSectionHtml .= '<input type="hidden" name="'.$value->id.'[]" value="'.$value->id.'"><hr></div>';
            //     }
            //     $editSectionHtml .= '</form>';
            // } else {
            //     $editSectionHtml = '';
            // }
            // return $editSectionHtml;
        }

        
    }