<div class="card">
    <div class="card-header">
      Propostas para mim
    </div>
    <div class="card-body card-mypropostas">
        @if ($propostas != "[]")
            @foreach ($propostas as $item)  
                <div class="quadro-proposta">
                    <p class="titulo-proposta">{{$item["titulo"]}}</p>
                    <div class="baixo-propostas">
                        <p class="">Candidatos: {{($item['candidatos'] == null? 0:count($item['candidatos']))}}</p>
                        <button class="btn btn-success">Ver proposta</button>
                    </div>
                </div>
            @endforeach
        @else
            <div>
                <p>Comece criando uma proposta e atraia os melhores Influencers para seu projeto!</p>
                <button class="btn btn-primary sem-props-btn" id="list-newpropostas-list" data-toggle="list" href="#list-newpropostas" role="tab" aria-controls="newpropostas">Criar proposta</button>
            </div>
        @endif
        
    </div>
</div>