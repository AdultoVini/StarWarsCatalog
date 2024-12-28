<?php 
    namespace App\Core;

    class Core{

        public function start($url){
            
            //Aqui eu verifico se a pagina está vazia, caso esteja redireciono para a home.
            if(isset($url['pagina'])){

                $controller = "App\\Controller\\" . ucfirst($url['pagina'])."Controller";

                //Aqui verifico se existe a solicitação de algum metodo em especifico
                $metodo = empty($url['metodo']) ? "index" : $url['metodo'];

            }else{

                $controller = "App\\Controller\\HomeController";
                $metodo = "index";
            }
            
            if(!class_exists($controller)){
                $controller = "App\\Controller\\ErroController";
                $metodo = "index";
            }
            
            call_user_func_array(array(new $controller, $metodo), array());
        }
    }