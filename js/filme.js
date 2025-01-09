$(document).ready(function() {
    carregarDetalhes();

});

function carregarDetalhes(){

    
    var load = Toastify({
        text: "<div class='d-flex align-items-center'><div class='spinner-border mr-10px' role='status'><span class='visually-hidden'></span></div> Carregando Detalhes</div>",
        escapeMarkup: false,
        duration: -1,
        style: {
          background: "#ffd077",
        }
      }).showToast();

    var queryString = window.location.search;
    
    var urlParams = new URLSearchParams(queryString);
    var id = urlParams.get('id')
    
    $.ajax({
        url: '/StarWarsCatalogo/api/filmes/CarregarDetalhesFilme',
        type: 'GET',
        method: 'GET',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (response) {
            load.hideToast();

            $("#personagens").html(response.personagens);
            $("#planetas").html(response.planetas);
            $("#veiculos").html(response.veiculos);
            $("#starships").html(response.starships);

            Toastify({
                text: "<i class='fa fa-check'></i> Detalhes Carregados com sucesso!",
                className: "info",
                escapeMarkup: false,
                style: {
                  background: "#64a85a",
                }
              }).showToast();
        },
        error: function (err) {
            load.hideToast();
            console.error('Erro na requisição:', err);
        }
    })
}