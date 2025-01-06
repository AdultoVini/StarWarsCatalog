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
                //Aqui eu uso a biblioteca Twig para poder carregar as views com os dados.
                $loader = new \Twig\Loader\FilesystemLoader("./View");
                $twig = new \Twig\Environment($loader);

                $movie = [];

                $id = $url['id'];

                //Pego os dados gerais do filme
                $dados = $this->GetMoviesApi($id);

                //Calculo a idade do filme e formato as mesmas
                $idadeFilme = $this->CalcularIdade($dados->properties->release_date);

                //traduz texto
                $tr = new GoogleTranslate();

                $tr->setSource('en'); 
                $tr->setTarget('pt-br'); 

                $movie = [
                    'uid' => $id,
                    'nome' => $dados->properties->title,
                    'episodio' => $dados->properties->episode_id,
                    'diretor' => $dados->properties->director,
                    'produtores' => $dados->properties->producer,
                    'sinopse' => $tr->translate($dados->properties->opening_crawl),
                    'idade' => $idadeFilme
                    
                ];
               
                $view = $twig->load("filme_detalhes.php");
                $view = $view->render($movie);

                echo $view;
                // print_r($movie);
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

        public function DetailsSwapiFormat($urls){
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

        public function CalcularIdade($ano){

            $dataAtual = new DateTime();
            $lancFilme = new DateTime($ano);
            $idade = $lancFilme->diff($dataAtual);

            $anos = $idade->y == 1 ? $idade->y . " Ano" : $idade->y . " Anos";
            $meses = $idade->m == 1 ? $idade->m . " Mês" : $idade->m . " Meses";
            $dias = $idade->d == 1 ? $idade->d . " Dia" : $idade->d . " Dias";

            return $idadeFinal = $anos . ", " . $meses . " e " . $dias;
        }
        
        public function CarregarDetalhesFilme(){
            $id = $_POST['id'];

            $dados = $this->GetMoviesApi($id);

            //Pego todos os personagens, planetas, veiculos e naves do filme
            $characters = $this->DetailsSwapiFormat($dados->properties->characters);
            $planetas = $this->DetailsSwapiFormat($dados->properties->planets);
            $veiculos = $this->DetailsSwapiFormat($dados->properties->vehicles);
            $starships = $this->DetailsSwapiFormat($dados->properties->starships);

            $detalhes = [
                'personagens' => $characters,
                'planetas' => $planetas,
                'veiculos' => $veiculos,
                'starships' => $starships,
            ];

            echo json_encode($detalhes);
        }
    }