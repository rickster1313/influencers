<div class="card">
  <div class="card-header">
    Meu perfil
  </div>
  <div class="card-body">
    <form method="POST" action="{{ url('/') }}/altEmp" enctype="multipart/form-data">
      <div class="form-row">
        @csrf
        <div class="form-group col-sm-6">
          <label for="Nome" class="col-form-label">Nome</label>
          <input type="text" id="nome" disabled name="name" value="{{Auth::user()->name}}" class="form-control">
        </div>
        <div class="form-group col-sm-6">
          <label for="Nome" class="col-form-label">Email</label>
          <input type="text" disabled name="email" value="{{Auth::user()->email}}" class="form-control">
        </div>

        <div class="form-group col-sm-4">
          <label for="nome-marca" class="col-form-label">Nome da marca</label>
          <input type="text" value="{{Auth::user()->nome_marca}}" disabled name="nome_marca" class="form-control">
        </div>
        <div class="form-group col-sm-4">
          <label for="telefone" class="col-form-label">Telefone</label>
          <input type="tel" value="{{Auth::user()->telefone_marca}}" disabled name="telefone_marca" class="form-control">
        </div>
        <div class="form-group col-sm-4" id="imagem">
          <label for="logo" class="col-form-label">Logo</label><br>
          <img class="img-fluid logo-marca-min" src="{{asset('storage/assets/img/logos/'.Auth::user()->logo_marca)}}" alt="imagem logo">
        </div>
        <button id="alterar-bank" type="button" class="btn btn-warning">Alterar</button>
        <button id="btn-confirm" type="submit" class="btn btn-success d-none">Confirmar</button>
      </div>
    </form>
  </div>
</div>
<script src="{{asset('assets/js/script3.js') }} "></script>