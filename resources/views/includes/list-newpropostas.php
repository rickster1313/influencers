<?php
foreach ($allpropostas as $item) { ?>
    <div class="quadro-proposta">
        <p class="titulo-proposta"><?=$item["titulo"]?></p>
        <div class="baixo-propostas">
            <p class="">Candidatos: <?php ($item['candidatos'] == null? 0:count($item['candidatos']))?></p>
            <button class="btn btn-success" id="list-newpropostas-list" data-toggle="list" role="tab" aria-controls="newpropostas" href='#view-propostas'>Ver proposta</button>
        </div>
    </div>
<?php
}
