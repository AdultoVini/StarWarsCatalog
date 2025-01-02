<?php 
    //No autoload está configurado para carregar todas as pastas mais importantes, deixando o código mais limpo
    require_once './vendor/autoload.php';
    use App\Core\Core;

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    // Obter a URI e remover base path
    $requestUri = trim($_SERVER['REQUEST_URI'], '/');
    $basePath = 'StarWarsCatalogo';
    $requestUri = str_replace($basePath, '', $requestUri);
    $requestUri = trim($requestUri, '/');

    // Dividi a URI em partes
    $urlParts = explode('/', $requestUri);
    
    // Defini valores padrão para a página inicial
    if (empty($urlParts[0])) {
        $urlParts[0] = 'home'; 
    }
    
    //Aqui caso seja Api não carrega a pagina inicial
    if ($urlParts[0] === 'api') {
        $core = new Core();
        $core->start([
            'pagina' => $urlParts[1] ?? 'home',
            'metodo' => $urlParts[2] ?? 'index',
            'api' => 'true',
        ]);
    } else {
        
        $urlParts[0] = explode('?', $urlParts[0])[0];
        
        ob_start();
        
        $core = new Core();
        $core->start([
            'pagina' => $urlParts[0] ?? 'home',
            'metodo' => $urlParts[1] ?? 'index',
            'id' => $_GET['id'] ?? null
        ]);
    
        $retornoController = ob_get_contents();
        ob_end_clean();
    
        $home = file_get_contents("./View/Estrutura/home.php");
        $home = str_replace("{{content}}", $retornoController, $home);
        echo $home;
    }
   
