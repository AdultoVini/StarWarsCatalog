<?php 
    namespace App\Controller;
    use App\Model\LogRequest;
    use Twig\Loader\FilesystemLoader;
    use Twig\Environment;
    use Exception;
    
    class HomeController{

        public function index(){
            
            try {
                $Logs["Logs"] = LogRequest::GetAllLogs();
                
                $loader = new \Twig\Loader\FilesystemLoader("./View");
                $twig = new \Twig\Environment($loader);

                $view = $twig->load("catalogo.php");

                $conteudo = $view->render($Logs);

                echo $conteudo;
            } catch (Exception $e) {
                
                echo $e->getMessage();
            }

        }
    }