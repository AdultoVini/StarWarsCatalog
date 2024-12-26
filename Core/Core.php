<?php 
    class Core{

        public function start($url){
            
            //Aqui eu verifico se a pagina está vazia, caso esteja redireciono para a home.
            $controller = empty($url['pagina']) ? "HomeController" : ucfirst($url['pagina'])."Controller";

            $metodo = "index";
            
            if(!class_exists($controller)){
                $controller = "ErroController";
            }

            call_user_func_array(array(new $controller, $metodo), array());
        }
    }