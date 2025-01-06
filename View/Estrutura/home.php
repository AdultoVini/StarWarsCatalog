<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" type="text/css" href="./Style/home.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script defer src="./js/jquery.min.js"></script>
    <script defer type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <title>StarWars</title>
</head>
<body>
    <header id="header">
        <a id="link-logo" href="/StarWarsCatalogo">
            <img src="./Style/images/logostarwars.png" id="logo"/>
        </a>
        <div class="container-link">
            <a class="link-menu" href="/StarWarsCatalogo">
                Home
            </a>
        </div>
    </header>
    <section>
        {{content}}
    </section>
</body>
</html>