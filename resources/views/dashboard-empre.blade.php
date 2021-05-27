@extends('layouts.app')
@section('content')
@php
    $btnLogin = false;
    $btnMenu = true;
@endphp
@include('includes.header')
<div class="pagina">
    <div class="menu">
      <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action text-nowrap" id="list-newpropostas-list" data-toggle="list" href="#list-newpropostas" role="tab" aria-controls="newpropostas">Criar propostas</a>
        <a class="list-group-item list-group-item-action text-nowrap active" id="list-mypropostas-list" data-toggle="list" href="#list-mypropostas" role="tab" aria-controls="mypropostas">Minhas propostas</a>
        <a class="list-group-item list-group-item-action text-nowrap" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Meu perfil</a>
        <a class="list-group-item list-group-item-action text-nowrap" id="list-sobre-list" data-toggle="list" href="#list-sobre" role="tab" aria-controls="sobre">Sobre</a>
        <a class="list-group-item list-group-item-action text-nowrap" id="list-termos-list" data-toggle="list" href="#list-termos" role="tab" aria-controls="termos">Termos de uso</a>
        <a class="list-group-item list-group-item-action text-nowrap" id="list-politica-list" data-toggle="list" href="#list-politica" role="tab" aria-controls="politica">Políticas de dados</a>
        <a class="list-group-item list-group-item-action text-nowrap"  href="{{ url('/logout') }}" role="tab" aria-controls="termos">Sair</a>
      </div>
    </div>
    <div class="conteudo">
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show" id="list-newpropostas" role="tabpanel" aria-labelledby="list-newpropostas-list">
          @include('includes.newproposta')
        </div>
        <div class="tab-pane fade show active" id="list-mypropostas" role="tabpanel" aria-labelledby="list-mypropostas-list">
          @include('includes.mypropostas')
        </div>
        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
          @include('includes.dataempre')
        </div>
        <div class="tab-pane fade" id="list-sobre" role="tabpanel" aria-labelledby="list-sobre-list">
            Sobre
        </div>
        <div class="tab-pane fade" id="list-termos" role="tabpanel" aria-labelledby="list-termos-list">
            Termos de uso
        </div>
        <div class="tab-pane fade" id="list-politica" role="tabpanel" aria-labelledby="list-politica-list">
            Politicas de dados
        </div>
      </div>
    </div>
  </div>
@endsection