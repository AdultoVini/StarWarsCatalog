$(document).ready(function() {
    carregarCatalogos();
});

function carregarCatalogos(){

    $.ajax({
        url: '/StarWarsCatalogo/api/home/carregarCatalogos',
        type: 'GET',
        method: 'GET',
        dataType: 'html',
        success: function (response) {
            
            $("#lista-filmes").html(response);
        },
        error: function (err) {
            console.error('Erro na requisição:', err);
        }
    })
}