<?php 
    namespace App\Controller;
    use App\Model\LogRequest;
    use Twig\Loader\FilesystemLoader;
    use Twig\Environment;
    use Exception;
    
    class HomeController{

        public function index(){
            
            try {
                //Aqui eu uso a biblioteca Twig para poder carregar as views com os dados.
                $loader = new \Twig\Loader\FilesystemLoader("./View");
                $twig = new \Twig\Environment($loader);

                $view = $twig->load("catalogo.php");
                $view = $view->render();

                echo $view;
            } catch (Exception $e) {
                
                echo $e->getMessage();
            }

        }
    }