
<script type="text/javascript">
var allpropostas = <?=json_encode($allpropostas)?>
</script>

<div class="filtros">
    <button id="filtro">Filtrar</button>
    <select name="titulo" id="">
        <option value="0" disabled selected>Titulo</option>
        <option value="1">Ordem alfabetica(A-Z)</option>
        <option value="2">Ordem alfabetica(Z-A)</option>
        <option value="3">Recomendado</option>
    </select>
    <select name="candidatos" id="">
        <option value="3" disabled selected>Seguidores</option>
        <option value="0">Maior quantidade</option>
        <option value="1">Menor quantidade</option>
        <option value="2">Recomendado</option>
    </select>
    <select name="postagem" id="">
        <option value="6" disabled selected>Tempo da postagem</option>
        <option value="0">hoje</option>
        <option value="1">ontem</option>
        <option value="2">Essa semana</option>
        <option value="3">Semana passada</option>
        <option value="4">Este mês</option>
        <option value="5">Este ano</option>
    </select>
    <!--
    TITULO
    CANDIDATOS
    ORDEM DE POSTAGEM
    -->
</div>
<div class="body-postagem">
</div>
    <?php
    return;
    foreach ($allpropostas as $item) { ?>
        <div class="quadro-proposta">
            <p class="titulo-proposta"><?= $item["titulo"] ?></p>
            <div class="baixo-propostas">
                <p class="">Candidatos: <?= $item['candidatos'] == null ? 0 : count($item['candidatos']) ?></p>
                <button class="btn btn-success" id="list-newpropostas-list" data-toggle="list" role="tab" aria-controls="newpropostas" href='#view-propostas'>Ver proposta</button>
            </div>
        </div>
    <?php
    }
    ?>
</div>
