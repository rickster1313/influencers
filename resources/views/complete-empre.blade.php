@extends('layouts.app')

@section('content')
@php
    $btnLogin = false;
    $btnMenu = false;
@endphp
@include('includes.header')

<div class="container data-inicial-empre">
    <form action="" id="form_empre" enctype="multipart/form-data">
    <div class="welcome-empre">
        <h2>Bem-vindo ao influencers!</h2>
        <p>Vamos começar com algumas perguntas para definir melhor sua marca!</p>
    </div>
    <div class="questions-empre">
        <div class="question1 pergunta">
            <span for="">Pergunta 1 de 3</span>
            <div class="mini-form">
                <label for="">Qual é o nome da sua marca?</label>
                <input class="form-control" type="text" name="name_marca" id="name_marca">
            </div>
            <button data-pag="1" class="next btn btn-outline-secondary">Próximo</button>
        </div>
        <div class="question2 pergunta">
            <span for="">Pergunta 2 de 3</span>
            <div class="mini-form">
                <label for="">Qual o telefone para contato?</label>
                <input class="form-control" type="text" name="telefone_marca" id="telefone_marca"> 
            </div>
            <div class="acoes">
                <button data-pag="2" class="back btn btn-outline-secondary">Voltar</button>
                <button data-pag="2" class="next btn btn-outline-secondary">Próximo</button>
            </div>
            
        </div>
        <div class="question3 pergunta">
            
                @csrf
                <span for="">Pergunta 3 de 3</span>
                <div class="mini-form">
                    <label for="">Selecione uma foto/logo de sua marca!</label>
                    <input class="form-control" type="file" name="logo_marca" id="logo_marca">
                </div>
                <div class="acoes">
                    <button data-pag="3" class="back btn btn-outline-secondary">Voltar</button>
                    <button data-pag="3" class="next btn btn-outline-secondary">Próximo</button>
                </div>
            </form>
        </div>
    </div>
    
</div>
@endsection