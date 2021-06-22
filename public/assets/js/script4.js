var $j = jQuery.noConflict();
$j(document).ready(function() {
    //variáveis


    var final = false;
    var quant_carrega = 8;
    var inicio = 0;

    //paginação
    const local = $j('.body-postagem');
    for (let i = inicio; i < quant_carrega; i++) {
        local.append(`<div class="quadro-proposta">  <p class="titulo-proposta">${allpropostas[i]['titulo']}</p>${i}</div>`)
    }
    $j(window).scroll(function() {
        var alturaPag = $j(window).height();
        var distanciaTop = $j('body').offset().top;
        var posicaoScroll = $j(window).scrollTop();
        var altura_elemento = $j('body').height();
        var diferenca = alturaPag - altura_elemento;
        if (posicaoScroll == (distanciaTop - diferenca)) {


            //console.log(inicio);
            var cont = 0;
            //console.log(allpropostas.length / quant_carrega)

            for (let i = 0; i < 8; i++) {
                if (allpropostas.length < inicio) {
                    break;
                }
                local.append(`<div class="quadro-proposta">  <p class="titulo-proposta">${allpropostas[inicio]['titulo']}</p> ${inicio}</div>`)
                cont++
                inicio++
            }

            inicio = inicio + 1;
        }

        //console.log(inicio)

        //console.log(posicaoScroll)
    });
    // $j('#filtro').click(function() {

    // });
});