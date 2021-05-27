@extends('layouts.app')

@section('content')
@php
    $btnLogin = false;
    $btnMenu = false;
@endphp
@include('includes.header')

<div class="container data-inicial-influ">
    <div class="welcome-influ">
        <h2>Bem-vindo ao Influencers!</h2>
        <p>Vamos começar com algumas perguntas para filtrar as melhores propostas para você!</p>
    </div>
    <div class="questions-influ">
        <div class="question1 pergunta">
            <span for="">Pergunta 1 de 4</span>
            <div class="mini-form">
                <label for="">Qual é seu gênero?</label>
                <select class="custom-select" name="genero" id="gender">
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select> 
            </div>
            <button data-pag="1" class="next btn btn-outline-secondary">Próximo</button>
        </div>
        <div class="question2 pergunta">
            <span for="">Pergunta 2 de 4</span>
            <div class="mini-form">
                <label for="">Qual sua data de nascimento?</label>
                <input class="form-control" type="date" name="data_nasc" id="nascimento"> 
            </div>
            <div class="acoes">
                <button data-pag="2" class="back btn btn-outline-secondary">Voltar</button>
                <button data-pag="2" class="next btn btn-outline-secondary">Próximo</button>
            </div>
            
        </div>
        <div class="question3 pergunta">
            <span for="">Pergunta 3 de 4</span>
            <div class="mini-form">
                <label for="">Onde você mora?</label>
                <select class="custom-select" name="estado" id="estado">
                    <option value="" disabled selected>Estado</option>
                </select> 
                <select class="custom-select"  name="cidade" id="cidade">
                    <option value="" disabled selected>Cidade</option>
                </select>
            </div>
            <div class="acoes">
                <button data-pag="3" class="back btn btn-outline-secondary">Voltar</button>
                <button data-pag="3" class="next btn btn-outline-secondary">Próximo</button>
            </div>
        </div>
        <div class="question4 pergunta">
            <span for="">Pergunta 4 de 4</span>
            <div class="mini-form">
                <label for="">Quais tags melhor definem você e suas redes sociais? Escolha no mínimo 5 tags!</label>
                <div class="input-group group-tags mb-3">
                    <input id="tags" name="tags" type="text" class="form-control" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" placeholder="adicionar tag" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button" id="add_tag">+</button>
                    </div>
                  </div> 
            </div>
            <div class="acoes">
                <button data-pag="4" class="back btn btn-outline-secondary">Voltar</button>
                <button data-pag="4" class="next btn btn-outline-secondary">Próximo</button>
            </div>
            <div class="list-tag">
                <ul class="list-group"><span class="s-tags">Sem tags</span></ul>
            </div>
            
        </div>
        
        <div class="question5 pergunta">
            <span for="">Pronto!</span>
            <div class="mini-form">
                <label for="">Agora precisamos que você coloque o seu Intagram para ter as estatísticas de seu perfil! Ex.:@nomeinstagram</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span id="arroba" class="input-group-text">@</span>
                    </div>
                    <input type="text" data-token="{{ csrf_token() }}" id="userinsta" class="form-control">
                  </div>
            </div>
            <div class="acoes">
                <button data-pag="5" class="back btn btn-outline-secondary">Voltar</button>
                <button data-pag="5" class="next btn btn-outline-secondary">Próximo</button>
            </div>
        </div>
    </div>
</div>
@endsection