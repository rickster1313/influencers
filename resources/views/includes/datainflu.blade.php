@php
$tagBD = Auth::user()->tags;
$tagBD = explode('|', $tagBD);
$cidade_bd = Auth::user()->cidade;
$estado_bd = Auth::user()->estado;
@endphp
<script type="text/javascript">
  var tags_bd = {!! json_encode($tagBD) !!};
  var estado_bd = {!! json_encode($estado_bd) !!}
  var cidade_bd ={!! json_encode($cidade_bd) !!}
</script>
<div class="card">
  <div class="card-header">
    Meu perfil
  </div>
  <div class="card-body">
    <form method="POST" action="{{ url('/') }}/altUser">
      <div class="form-row">
        @csrf
        <div class="form-group col-sm-6">
          <label for="Nome" class="col-form-label">Nome</label>
          <input type="text" id="nome" disabled name="name" value="{{Auth::user()->name}}" class="form-control"/>
        </div>
        <div class="form-group col-sm-6">
          <label for="email" class="col-form-label">Email</label>
          <input id="email" type="text" disabled name="email" value="{{Auth::user()->email}}" class="form-control">
        </div>
        <div class="form-group col-sm-3">
          <label for="genero" class="col-form-label">genero</label>
          <select name="genero" class='form-control' disabled>
            <option value="{{Auth::user()->genero}}"  selected>{{Auth::user()->genero}}</option>
            <option value="masculino">Masculino</option>
            <option value="feminino">Feminino</option>
            <option value="outro">Outro</option>
          </select>
        </div>
        <div class="form-group col-sm-3">
          <label for="nascimento" class="col-form-label">Data de nascimento</label>
          <input type="date" value="{{Auth::user()->nascimento}}" disabled name="nascimento" class="form-control">
        </div>
        <div class="form-group col-sm-3">
          <label for="estado" class="col-form-label">Estado</label>
          <select class="custom-select form-control" name="estado" id="estado" disabled required>
            <!-- <option value="{{Auth::user()->estado}}"  selected='selected'>{{Auth::user()->estado}}</option> -->
          </select>
          <!-- <input type="text" value="{{Auth::user()->estado}}" disabled name="estado"  class="form-control"> -->
        </div>
        <div class="form-group col-sm-3">
          <label for="cidade" class="col-form-label">Cidade</label>
          <select class="custom-select form-control" name="cidade" id="cidade" disabled required>
            <!-- <option value="{{Auth::user()->cidade}}" selected='selected'>{{Auth::user()->cidade}}</option> -->
          </select>
          <!-- <input type="text" value="{{Auth::user()->estado}}" disabled name="cidade"  class="form-control"> -->
        </div>

        <div class="form-group col-sm-6" id='tag'>
          <label for="tags" class="col-form-label">Tags</label>
          <input type="text" value="{{Auth::user()->tags}}" disabled name="tags" class="form-control">
        </div>
        <div class="form-group col-sm-3">
          <label for="insta" class="col-form-label">Instagram</label>
          <input type="text" value="{{Auth::user()->insta}}" disabled name="insta" class="form-control">
        </div>
        <div class="form-group col-sm-3">
          <label for="follows" class="col-form-label">Seguidores</label>
          <div class="form-control">
            {{Auth::user()->follows}}
          </div>
        </div>
        <button id="alterar-bank" type="button" class="btn btn-warning">Alterar</button>
        <button value="{{ csrf_token() }}" id="btn-confirm" type="submit" name='confirma' class="btn btn-success d-none">Confirmar</button>
      </div>
    </form>
  </div>
</div>
<script src="{{ asset('assets/js/script2.js')}}" type="text/javascript"></script>