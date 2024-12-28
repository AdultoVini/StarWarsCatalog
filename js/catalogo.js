$(document).ready(function() {
    carregarCatalogos();
});

function carregarCatalogos(){
    
    $.ajax({
        url: '/StarWarsCatalogo/?pagina=home&metodo=carregarCatalogos&api=true',
        type: 'GET',
        method: 'GET',
        dataType: 'html',
        cache: false,
        success: function (response) {

            $("#lista-filmes").html(response);
        },
        error: function (err) {
            console.error('Erro na requisição:', err);
        }
    })
}