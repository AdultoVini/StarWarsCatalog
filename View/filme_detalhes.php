<div id="background-detalhe" class="container d-flex align-items-center flex-column mt-3">
    <div class="mb-5">
        <h2 style="font-family: 'Star Wars', sans-serif ">Star Wars {{nome}}</h2>
    </div>

    <div class="row col-md-12">
    
        <div class="d-flex col-md-12">

            <div class="mr-10px">
                <img src="./Style/images/{{uid}}.jpg" class="cartaz" style="width: 210px"/>
            </div>
            
            <div class="line-18px">
                <p><b>Direção:</b> {{diretor}}</p>

                <p><b>Produtor(es):</b> {{produtores}}</p>

                <p><b>Episódio:</b> {{episodio}}</p>

                <p><b>Idade:</b> {{idade}}</p>
                
                <p class="text-justify"><b>Personagens:</b> <span id="personagens">Carregando...</span></p>

                <p class="text-justify"><b>Planetas:</b> <span id="planetas">Carregando...</span></p>

                <p class="text-justify"><b>Veículos:</b> <span id="veiculos">Carregando...</span></p>

                <p class="text-justify"><b>Starships:</b> <span id="starships">Carregando...</span></p>
                
            </div>
        </div>
     
        <div class="mt-2">
            <h3>Sinopse</h3>
            <p class="text-justify">{{sinopse}}</p>
        </div>
    </div>
    
</div>
<script defer src="./js/filme.js"></script>