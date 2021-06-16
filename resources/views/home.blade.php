@extends('layouts.app')
@section('content')
@php
    $btnLogin = true;
    $btnMenu = false;
@endphp
@include('includes.header')
<section class="container apresentacao">
    <div class="row">


        <div class="col-sm apresentacao-left">
            <h3>GANHE COM SUAS REDES SOCIAIS!</h3>
            <div class="container-img-left"> 
                <img class="img-fluid" src="{{ asset('assets/images/img300.jpg') }}" alt="">
            </div>
        </div>

        <div class="col-sm apresentacao-right">
            <h3>São d ezenas de empresas buscando pessoas como você!</h3>
            <div class="container-img-right">
                <img class="img-fluid" src="{{ asset('assets/images/img200.jpg') }}" alt="">
                <img class="img-fluid" src="{{ asset('assets/images/img200.jpg') }}" alt="">
                <img class="img-fluid" src="{{ asset('assets/images/img200.jpg') }}" alt="">
            </div>
            

        </div>
    </div>
</section>
<section class="container ciclo">
    <h1>O influencers conecta influenciadores a negócios de todos os tipos!</h1>
    <div class="graph">
        <div class="coluna"> 
            <div class="linha" id="id11"><i class="icofont-reply"></i></div>
            <div class="linha" id="id12"><span class="name-cicle" id="nm-empre">Empresa</span><i class="icofont-building-alt"></i></div>
            <div class="linha" id="id13"><i class="icofont-reply"></i></div>
        </div>
        <div class="coluna"> 
            <div class="linha" id="id21"><div><i class="icofont-gift"></i><i class="icofont-money"></i></div> <span class="name-cicle-min">Produtos/dinheiro</span></div>
            <div class="linha" id="id22">&nbsp;</div>
            <div class="linha" id="id23"><div><i class="icofont-users-social"></i><i class="icofont-chart-growth"></i></div> <span class="name-cicle-min">Alcance do público</span></div>
        </div>
        <div class="coluna"> 
            <div class="linha" id="id31"><i class="icofont-reply"></i></div>
            <div class="linha" id="id32"><span class="name-cicle" id="nm-influ">Influenciador</span><div><i class="icofont-boy"></i><i class="icofont-girl"></i></div></div>
            <div class="linha" id="id33"><i class="icofont-reply"></i></div>
        </div>
        
    </div>
</section>
<section class="container funciona">
<h2>Como funciona o influencers?</h2>
    <div class="row">
        <div class="col-sm-6">
        <h3>Para influenciadores</h3>
        <div class="box-funciona">
            <div class="icon-influenciadores"><i class="icofont-boy"></i><i class="icofont-girl"></i></div>
            <h5>Encontre empresas que <br>querem divulgação!</h5>
            <a href="{{url('/cadastro-usuario')}}"><button class="btn btn-danger">Quero entrar!</button></a>
        </div>

        
        <p>Tenha acesso a milhares de oportunidades para divulgar produtos, serviços ou lugares em suas redes sociais e ainda seja encontrado por empresas  que buscam alguém como você!</p>
        <h5>O que eu ganho com isso?</h5>
        <p>Dependendo da proposta, você ganhará produtos, descontos, dinheiro e muito mais!</p>
        </div>
        <div class="col-sm-6">
        <h3>Para negócios</h3>
        <div class="box-funciona">
            <i class="icofont-building-alt"></i>
            <h5>Encontre influenciadores <br> para divulgar seu negócio!</h5>
            <a href="{{url('/cadastro-usuario')}}"><button class="btn btn-danger">Quero entrar!</button></a>
        </div>
        
        
        <p>Com vários filtros de busca, você encontra a pessoas perfeita para divulgar seu produto ou pode criar sua proposta e esperar que os influenciadores se candidatem!</p>
        <h5>Quanto custa essa divulgação?</h5>
        <p>Você que define! Pode ser em troca de produtos, dinheiro, descontos e mais!</p>
        </div>
    </div>
    
</section>
<footer>
    <div class="container">
        <div class="row">
        <div class="col-md-4">
            <h4>Influencers@name</h4> 
        </div>
        <div class="col-md-3">
            <h4>Redes sociais</h4>
            <div class="list">
                <span><i class="icofont-facebook"></i> facebook-influencers</span><br>
                <span><i class="icofont-instagram"></i> instagram_influencers</span> 
            </div>
        </div>
        <div class="col-md-3">
            <h4>Contato</h4> 
            <div class="list">
                <span><i class="icofont-email"></i> emailinfluencers@gmail.com</span><br>
                <span><i class="icofont-brand-whatsapp"></i> +551191234-5678</span> 
            </div>
        </div>
        <div class="col-md-2">
                
        </div>
        </div>
    </div>
</footer>
@endsection