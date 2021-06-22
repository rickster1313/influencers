var $j = jQuery.noConflict();
$j(document).ready(function() {
    //variáveis
    var quant_carrega = 8;
    var larguraPag = $j(window).width();
    if (larguraPag > 1100) {
        quant_carrega = 20;
    } else if (larguraPag > 657 && larguraPag < 944) {
        quant_carrega = 8;
    } else if (larguraPag > 336 && larguraPag < 597) {
        quant_carrega = 4;
    }
    var final = false;
    var inicio = 0;

    //paginação
    const local = $j('.body-postagem');
    for (let i = 0; i < quant_carrega; i++) {
        can = allpropostas[inicio]['candidatos'] || allpropostas[inicio]['candidatos'].length;
        local.append(`<div class="quadro-proposta">  <p class="titulo-proposta">${allpropostas[i]['titulo']}</p><div class="baixo-propostas"><p>Candidatos: ${can}</p><button class="btn btn-success" id="list-newpropostas-list" data-toggle="list" role="tab" aria-controls="newpropostas" href='#view-propostas'>Ver proposta</button></div></div>`)
        inicio++
    }
    $j(window).scroll(function() {
        larguraPag = $j(window).width();
        alturaPag = $j(window).height();
        var distanciaTop = $j('body').offset().top;
        var posicaoScroll = $j(window).scrollTop();
        var altura_elemento = $j('body').height();
        var diferenca = alturaPag - altura_elemento;
        if (posicaoScroll == (distanciaTop - diferenca)) {
            if (larguraPag > 1100) {
                quant_carrega = 20;
            } else if (larguraPag > 657 && larguraPag < 944) {
                quant_carrega = 8;
            } else if (larguraPag > 336 && larguraPag < 597) {
                quant_carrega = 4;
            }
            var cont = 0;
            const valores = {
                'null': 0,
                'valor': ''
            };
            var can = '';
            for (let i = 0; i < quant_carrega; i++) {
                can = allpropostas[inicio]['candidatos'] || allpropostas[inicio]['candidatos'].length;
                local.append(`<div class="quadro-proposta">  <p class="titulo-proposta">${allpropostas[inicio]['titulo']}</p> <div class="baixo-propostas"><p>Candidatos: ${can}</p><button class="btn btn-success" id="list-newpropostas-list" data-toggle="list" role="tab" aria-controls="newpropostas" href='#view-propostas'>Ver proposta</button></div></div>`)
                cont++
                inicio++
            }
            inicio = inicio + 1;
        }
    });
    // $j('#filtro').click(function() {

    // });
});