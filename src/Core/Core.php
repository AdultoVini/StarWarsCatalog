<?php 
    namespace App\Core;

    class Core {

        public function start($url){

            $pagina = isset($url['pagina']) ? $url['pagina'] : 'home';
            
            $controller = "App\\Controller\\" . ucfirst($pagina) . "Controller";
            $metodo = "index"; 
            
            if (!class_exists($controller)) {

                $controller = "App\\Controller\\ErroController";
            }

            if(isset($url['metodo']) && method_exists($controller, $url['metodo'])){

                $metodo = $url['metodo'];
            }else{

                $metodo = "index"; 
            }
            
            call_user_func_array(array(new $controller, $metodo), array());
    
        }
    }