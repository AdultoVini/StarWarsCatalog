<?php 
    //No autoload está configurado para carregar todas as pastas mais importantes, deixando o código mais limpo
    require_once './vendor/autoload.php';
    use App\Core\Core;

    // Ativar a exibição de erros no PHP
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    

    $home = file_get_contents("./View/Estrutura/home.php");

    switch($_GET["api"] ?? "false"){
        case "true":

            $core = new Core;
            $core->start($_GET);

            break;
        default:
        
            // A função ob_start e ob_end_clean capturam todo o conteudo que é retornado entre elas
            ob_start();

            $core = new Core;
            $core->start($_GET);

            $retornoController = ob_get_contents();

            ob_end_clean();

            $home = str_replace("{{content}}", $retornoController, $home);
            echo $home;

            break;
    }
   
