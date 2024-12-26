<?php 
    require_once "./Core/Core.php";
    require_once "./Controller/HomeController.php";
    require_once "./Controller/ErroController.php";

    $home = file_get_contents("./View/home.php");
    
    // A função ob_start e ob_end_clean capturam todo o conteudo que é retornado entre elas
    ob_start();

    $core = new Core;
    $core->start($_GET);

    $retornoController = ob_get_contents();

    ob_end_clean();

    echo $home;
