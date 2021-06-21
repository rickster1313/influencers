<div class="card">
    <div class="card-header">
        Nova proposta
    </div>
    <div class="card-body">
        <form id="form-new-prop" method="POST" action="{{ url('/') }}/novaproposta">
            <div class="form-row">
                @csrf
                <div class="form-group col-sm-8 offset-sm-2">
                    <label for="titulo" class="col-form-label">Título da proposta</label>
                    <input type="text" required id="titulo" name="titulo" placeholder="Defina um título para sua proposta" class="form-control" />
                </div>
                <div class="form-group col-sm-8 offset-sm-2">
                    <label for="descricao" class="col-form-label">Descrição da proposta</label>
                    <textarea name="descricao" required id="descricao" cols="30" rows="5" placeholder="Fale para o Influencer informações sobre essa proposta que você está criando..." class="form-control"></textarea>
                </div>
                <div class="form-group col-sm-8 offset-sm-2">
                    <label for="trabalho" class="col-form-label">O que você espera do Influencer?*</label>
                    <textarea name="trabalho" required id="trabalho" cols="30" rows="5" placeholder="O que você espera que o Influencer faça? Tipo e número de posts, stories, videos..." class="form-control"></textarea>
                </div>
                <div class="form-group col-sm-8 offset-sm-2">
                    <label for="premiacao" class="col-form-label">Qual será o prêmio para o Influencer?*</label>
                    <textarea name="premiacao" required id="premiacao" cols="30" rows="4" placeholder="O que o Influencer ganhará nessa proposta? Desconto, produto, dinheiro..." class="form-control"></textarea>
                </div>
                <div class="form-group col-sm-8 offset-sm-2">
                    <hr>
                    <p class="p-requisitos"><span class="tit-requisitos">Requisitos do Influencer: </span> Defina quais os requisitos necessários para o Influencer se candidatar a sua proposta!</p>
                </div>
                <div class="form-group col-sm-3 offset-sm-2">
                    <label for="tags" class="col-form-label">Tags</label>
                    <div class="input-group">
                        <input id="tags" name="tags" type="text" class="form-control" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" placeholder="adicionar tag" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="add_tag">+</button>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-3">
                    <div class="list-tag list-tag-prop">
                        <ul class="list-group"><span class="s-tags">Sem tags</span></ul>
                    </div>
                </div>
                <div class="form-group col-sm-2">
                    <label for="min-follows" class="col-form-label">Mínimo de seguidores*</label>
                    <input type="number" min="0" id="minfollows" name="minfollows" value="0" class="form-control">
                </div>
                <div class="form-group col-sm-2 offset-sm-2">
                    <label for="estado" class="col-form-label">Estado</label>
                    <select name="estado" id="estadoprop" class="form-control">
                        <option selected value="all">Qualquer estado</option>
                        @foreach ($estados as $i => $item)
                        <option value="{{$i}}">{{$item['nome']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label for="cidade" class="col-form-label">Cidade</label>
                    <select name="cidade" id="cidadeprop" class="form-control">
                        <option selected value="all">Qualquer cidade</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label for="sexo" class="col-form-label">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option selected value="all">Indiferente</option>
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label for="idade" class="col-form-label">Idade</label>
                    <select name="idade" id="idade" class="form-control">
                        <option selected value="all">Indiferente</option>
                        <option value="ate18">Até 18 anos</option>
                        <option value="18e20">Entre 18 e 20 anos</option>
                        <option value="20e30">Entre 20 e 30 anos</option>
                        <option value="30e60">Entre 30 e 60 anos</option>
                        <option value="60mais">Acima de 60 anos</option>
                    </select>
                </div>
                <div class="form-group col-sm-3 offset-sm-2">
                    <button class="btn btn-primary">+ Criar proposta!</button>
                </div>
                <span class="form-group col-sm-2 offset-sm-3 obrigatorio">*Campos obrigatórios</span>
            </div>
        </form>
    </div>
</div>