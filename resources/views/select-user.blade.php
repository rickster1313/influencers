@extends('layouts.app')

@section('content')
@php
    $btnLogin = false;
    $btnMenu = false;
@endphp
@include('includes.header')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 register-select">
            <h4>Cadastre-se no INFLUNCERS!</h4>
            <div class="row">
                <div class="col slc-reg-esq">
                    <div class="influ-slc"><i class="icofont-boy"></i><i class="icofont-girl"></i></div>
                    <a href="{{url('/select/1')}}"><button>SOU INFLUENCIADOR!</button></a>
                </div>
                <div class="col slc-reg-dir">
                    <div class="empre-slc"><i class="icofont-building-alt"></i></div>
                    <a href="{{url('/select/2')}}"><button>SOU MARCA OU NEGÓCIO!</button></a>
                </div>
            </div>
        </div>
    
    </div>
</div>
@endsection
