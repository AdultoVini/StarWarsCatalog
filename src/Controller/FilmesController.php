<?php 
    namespace App\Controller;
    use Exception;
    use DateTime;
    use GuzzleHttp\Client;
    use GuzzleHttp\Promise;
    use Stichoza\GoogleTranslate\GoogleTranslate;

    class FilmesController{

        public function index($url){

            try {
                $movie = [];

                $id = $url['id'];

                //Pego os dados gerais do filme
                $dados = $this->GetMoviesApi($id);
                //Pego todos os personagens do filme
                $characters = $this->CharactersFormat($dados->properties->characters);

                //Calculo a idade do filme
                $dataAtual = new DateTime();
                $lancFilme = new DateTime($dados->properties->release_date);
                $idade = $lancFilme->diff($dataAtual);

                //traduz texto
                $tr = new GoogleTranslate();

                $tr->setSource('en'); 
                $tr->setTarget('pt-br'); 

                $movie = [
                    'nome' => $dados->properties->title,
                    'episodio' => $dados->properties->episode_id,
                    'diretor' => $dados->properties->director,
                    'produtores' => $dados->properties->producer,
                    'sinopse' => $tr->translate($dados->properties->opening_crawl),
                    'personagens' => $characters,
                    'idade' => ['anos' => $idade->y, 'meses' => $idade->m, 'dias' => $idade->d]
                    
                ];
                print_r($movie);
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

        public function GetMoviesApi($id = null){

            try {

                $urlGet = "https://www.swapi.tech/api/films";

                if($id != null){
                    $urlGet .= "/" .$id;
                }
                
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

        public function CharactersFormat($urls){
            $client = new Client();

            $promises = [];
            $results = []; 

            foreach ($urls as $index => $url) {
                $promises[] = $client->getAsync($url)
                    ->then(
                        function ($response) use ($index, &$results) {
                            $data = json_decode($response->getBody()->getContents());
                  
                            $results[$index] = $data->result->properties->name;
                        },
                        function ($exception) use ($index, &$results) {
                            $results[$index] = "Erro ao obter dados do personagem {$index}: " . $exception->getMessage();
                        }
                    );
            }
        
            Promise\all($promises)->wait();

            $nomes = implode(", ", $results);

            return $nomes;
        }
    }