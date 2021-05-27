<div class="card">
    <div class="card-header">
      Meu perfil
    </div>
    <div class="card-body">
      <form method="POST" action="{{ url('/') }}/">
        <div class="form-row">
          @csrf
            <div class="form-group col-sm-6">
                <label for="Nome" class="col-form-label">Nome</label>
                <input type="text" id="nome" disabled name="Nome" value="{{Auth::user()->name}}" class="form-control">
            </div>
            <div class="form-group col-sm-6">
                <label for="Nome" class="col-form-label">Email</label>
                <input type="text" disabled name="email" value="{{Auth::user()->email}}" class="form-control">
            </div>
           <div class="form-group col-sm-3">
            <label for="genero" class="col-form-label">genero</label>
            <input type="text" value="{{Auth::user()->genero}}" disabled name="genero" class="form-control">
          </div>
          <div class="form-group col-sm-3">
            <label for="nascimento" class="col-form-label">Data de nascimento</label>
            <input type="text" value="{{Auth::user()->nascimento}}" disabled name="data_nasc"  class="form-control">
          </div>
          <div class="form-group col-sm-3">
            <label for="estado" class="col-form-label">Estado</label>
            <input type="text" value="{{Auth::user()->estado}}" disabled name="estado"  class="form-control">
          </div>
          <div class="form-group col-sm-3">
            <label for="cidade" class="col-form-label">Cidade</label>
            <input type="text" value="{{Auth::user()->estado}}" disabled name="cidade"  class="form-control">
          </div>
          <div class="form-group col-sm-6">
            <label for="tags" class="col-form-label">Tags</label>
            <input type="text" value="{{Auth::user()->tags}}" disabled name="tags"  class="form-control">
          </div>
          <div class="form-group col-sm-3">
            <label for="insta" class="col-form-label">Instagram</label>
            <input type="text" value="{{Auth::user()->insta}}" disabled name="insta"  class="form-control">
          </div>
          <div class="form-group col-sm-3">
            <label for="follows" class="col-form-label">Seguidores</label>
            <input type="text" value="{{Auth::user()->follows}}" disabled name="follows"  class="form-control">
          </div>

          
          <button id="alterar-bank" type="button" class="btn btn-warning">Alterar</button>
          <button id="btn-confirm" type="submit" class="btn btn-success d-none">Confirmar</button>
        </div>
    </form>
    </div>
</div>