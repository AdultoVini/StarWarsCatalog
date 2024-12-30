<?php 
    namespace App\Controller;
    use App\Model\LogRequest;
    use Twig\Loader\FilesystemLoader;
    use Twig\Environment;
    use Exception;
    
    class HomeController{

        public function index(){
            
            try {
                // $Logs["Logs"] = LogRequest::GetAllLogs();
                
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

        public function carregarCatalogos(){
            try {
                header('Content-Type: text/html');
                
                $movies = ["movies" => $this->GetMoviesApi()];

                if($movies == false){

                    throw new Exception("Falha ao tentar listar filmes!");
                }

                $loader = new \Twig\Loader\FilesystemLoader("./View");
                $twig = new \Twig\Environment($loader);

                $view = $twig->load("lista_filmes.php");
                
                $view = $view->render($movies);

                echo $view;

            } catch (Exception $e) {

                http_response_code($e->getCode()); 

                echo json_encode([
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                ]);

                exit; 
            }
        }

        public function GetMoviesApi(){

            try {

                $urlGet = "https://www.swapi.tech/api/films";

                $c = curl_init();

                curl_setopt($c, CURLOPT_URL, $urlGet);           
                curl_setopt($c, CURLOPT_RETURNTRANSFER, true); 
                curl_setopt($c, CURLOPT_FOLLOWLOCATION, true); 

                
                $response = curl_exec($c);
                $data = json_decode($response);
                $response = $data->result;

                if(curl_errno($c)) {
                    
                    throw new Exception(curl_error($c));
                }

                curl_close($c);

                return $response;

            } catch (Exception $e) {

                echo $e->getMessage();

                return false;

                exit; 
            }
        }
    }