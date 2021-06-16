<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Proposta;
use PhpParser\Node\Stmt\Catch_;

class UserController extends Controller
{
    private function getEstados()
    {
        $path = public_path() . "/assets/json/estados-cidades.json";
        $json_loc = file_get_contents($path);
        $loc_array = json_decode($json_loc, true);
        return $loc_array;
    }
    public function dashboard()
    {
        if (Auth::user()->user_id === 1) {
            if (Auth::user()->insta == null) {
                return view("complete-influencer");
            } else {
                $allpropostas = json_decode(Proposta::all(), true);
                $mytags = explode("|", Auth::user()->tags);
                $dataNasc = explode("-", Auth::user()->nascimento);
                $dataHoje = explode("-", date("Y-m-d", strtotime("now")));
                $idade = $dataHoje[0] - $dataNasc[0];
                if ($dataHoje[1] < $dataNasc[1]) {
                    $idade--;
                } elseif ($dataHoje[1] == $dataNasc[1]) {
                    if ($dataHoje[2] < $dataNasc[2]) {
                        $idade--;
                    }
                }
                $minhaPropostas = array();
                foreach ($allpropostas as $key => $value) {

                    //filtro de tags
                    $tags = explode("|", $value['tags']);
                    $filtroTags = 0;
                    if ($tags[0] != "all") {
                        foreach ($tags as $i => $valor) {
                            if (in_array($valor, $mytags)) {
                                $filtroTags++;
                                break;
                            }
                        }
                    } else {
                        $filtroTags++;
                    }
                    if ($filtroTags === 0) {
                        continue;
                    }

                    //filtro de seguidores
                    if ($value['num_follows'] > Auth::user()->follows) {
                        continue;
                    }

                    //filtro de estado e cidade
                    $filtroEstado = 0;
                    $filtroCidade = 0;
                    if ($value['estado'] != "all") {
                        if ($value['estado'] == Auth::user()->estado) {
                            $filtroEstado++;
                            if ($value['cidade'] != "all") {
                                if ($value['cidade'] == Auth::user()->cidade) {
                                    $filtroCidade++;
                                }
                            } else {
                                $filtroCidade++;
                            }
                        }
                    } else {
                        $filtroEstado++;
                        if ($value['cidade'] != "all") {
                            if ($value['cidade'] == Auth::user()->cidade) {
                                $filtroCidade++;
                            }
                        } else {
                            $filtroCidade++;
                        }
                    }
                    if ($filtroEstado === 0 || $filtroCidade === 0) {
                        continue;
                    }

                    //filtro sexo
                    $filtroSexo = 0;
                    if ($value['sexo'] != "all") {
                        if ($value['sexo'] ==  Auth::user()->genero) {
                            $filtroSexo++;
                        }
                    } else {
                        $filtroSexo++;
                    }
                    if ($filtroSexo === 0) {
                        continue;
                    }

                    //filtro idade
                    $filtroIdade = 0;
                    if ($value['idade'] == "all") {
                        $filtroIdade++;
                    } elseif ($value['idade'] == "ate18") {
                        if ($idade <= 18) {
                            $filtroIdade++;
                        }
                    } elseif ($value['idade'] == "18e20") {
                        if ($idade >= 18 && $idade <= 20) {
                            $filtroIdade++;
                        }
                    } elseif ($value['idade'] == "20e30") {
                        if ($idade >= 20 && $idade <= 30) {
                            $filtroIdade++;
                        }
                    } elseif ($value['idade'] == "30e60") {
                        if ($idade >= 30 && $idade <= 60) {
                            $filtroIdade++;
                        }
                    } elseif ($value['idade'] == "60mais") {
                        if ($idade >= 60) {
                            $filtroIdade++;
                        }
                    }
                    if ($filtroIdade === 0) {
                        continue;
                    }
                    array_push($minhaPropostas, $allpropostas[$key]);
                }
                return view("dashboard-influ", ['propostas' => $minhaPropostas]);
            }
        } elseif (Auth::user()->user_id === 2) {
            if (Auth::user()->nome_marca == null) {
                return view("complete-empre");
            } else {
                $propostas = Proposta::where([['marca_id', '=', Auth::id()], ['status', '=', 1]])->get();
                $loc_array = $this->getEstados();
                return view("dashboard-empre", ["propostas" => $propostas, "estados" => $loc_array['estados']]);
            }
        } else {
            Auth::logout();
            $msg = "Erro ao fazer login!";
            $classMsg = "alert alert-danger";
            return redirect("/login")->with("msg", $msg)->with("classMsg", $classMsg);
        }
    }
    public function sair()
    {
        Auth::logout();
        $msg = "Desconectado com sucesso!!";
        $classMsg = "alert alert-success";
        return redirect("/login")->with("msg", $msg)->with("classMsg", $classMsg);
    }
    public function select($id)
    {
        if ($id == 1 || $id == 2) {
            session(['reg_id' => $id]);
            return redirect("/register");
        } else {
            return redirect("/cadastro-usuario");
        }
    }
    public function selectUser()
    {
        return view("select-user");
    }
    public function locs()
    {
        $loc_array = $this->getEstados();
        return $loc_array;
    }
    public function buscaInsta($user)
    {
        $json = array(
            'status' => null,
            'seguidores' => null
        );
        try {
            $html = @file_get_contents('https://instagram.com/' . $user . '/');
            preg_match('/_sharedData = ({.*);<\/script>/', $html, $matches);
            $profile_data = json_decode($matches[1])->entry_data->ProfilePage[0]->graphql->user;
            $json['status'] = "ok";
            $json['seguidores'] = $profile_data->edge_followed_by->count;
        } catch (\Throwable $th) {
            $json['status'] = "erro";
        }
        return json_encode($json);
    }
    public function completarInfluencer(Request $request)
    {
        $user = User::find(Auth::id());
        $user->genero = $request->post("genero");
        $user->nascimento = $request->post("nascimento");
        $user->estado = $request->post("estado");
        $user->cidade = $request->post("cidade");
        $user->tags = $request->post("tags");
        $user->insta = $request->post("insta");
        $user->follows = $request->post("follows");
        $user->save();
        return "ok";
    }
    public function completarEmpresario(Request $request)
    {
        $user = User::find(Auth::id());
        $user->nome_marca = $request->post("name_marca");
        $user->telefone_marca = $request->post("telefone_marca");
        if (request()->hasFile("logo_marca") && request()->file("logo_marca")->isValid()) {
            $path = request()->file("logo_marca")->store("/public/assets/img/logos");
            $aux = explode("logos/", $path);
            $path = $aux[1];
        }
        $user->logo_marca = $path;
        $user->save();
        return "ok";
    }
    public function newproposta(Request $request)
    {
        $estados = $this->getEstados();
        $proposta = new Proposta();
        $proposta->titulo = $request->post("titulo");
        $proposta->descricao = $request->post("descricao");
        $proposta->trabalho = $request->post("trabalho");
        $proposta->premiacao = $request->post("premiacao");
        if ($request->has("datatag")) {
            $proposta->tags = $request->post("datatag");
        } else {
            $proposta->tags = "all";
        }
        $proposta->num_follows = $request->post("minfollows");
        $proposta->estado = $estados['estados'][$request->post("estado")]['sigla'];
        $proposta->cidade = $estados['estados'][$request->post("estado")]['cidades'][$request->post("cidade")];
        $proposta->sexo = $request->post("sexo");
        $proposta->idade = $request->post("idade");
        $proposta->status = 1;
        $proposta->marca_id = Auth::id();
        $proposta->save();
        return redirect()->route("dashboard");
    }
    public function editarusuario(Request $request)
    {
        $arrays = [
            0 => 'nome',
            1 => 'genero',
            2 => 'nascimento',
            3 => 'estado',
            4 => 'cidade',
        ];
        $arrays_dados = [
            'nome' => '',
            'genero' => '',
            'nascimento' => '',
            'estado' => '',
            'cidade' => '',
        ];
        //armazenar dados do formulário
        for ($i = 0; $i < count($arrays); $i++) {
            if (array_key_exists($arrays[$i], $arrays_dados)) {
                $arrays_dados[$arrays[$i]] = $request->post($arrays[$i]);
            }
        }
        //verifica com os dados do banco de dados
        $user = User::find(Auth::id());
        for ($i = 0; $i < count($arrays_dados); $i++) {
            $varia = $arrays[$i];
            if ($arrays_dados[$varia] != Auth::user()->$varia) {
                $user->$varia = $request->post($varia);
            }
        }
        if ($request->post('insta') != Auth::user()->insta) {
            $instagram = $this->buscaInsta($request->post('insta'));
            $instagram = json_decode($instagram, true);
            $seguidor = $instagram['seguidores'];
            $user->insta = $request->post("insta");
            $user->follows = $seguidor;
        }
        //verifica as tags
        $tags = $request->post('tags');
        $tags = explode(',', $tags);
        //$tags = str_replace(',', '|', $request->post('tags'));
        $tags_bd = Auth::user()->tags;
        $tags_bd = explode('|', $tags_bd);
        //$tags_bd = str_replace(',', '|', $tags_bd);
        for ($i = 0; $i < count($tags); $i++) {
            $thisTag = $tags[$i];
            for ($j = 0; $j < count($tags_bd); $j++) {
                if ($thisTag == $tags_bd[$j]) {
                    unset($tags[$i]);
                    break;
                }
            }
        }
        if (count($tags) > 0) :
            $user->tags = str_replace(',', '|', $request->post('tags'));
        endif;
        //cidade e estado
        $getEstados = $this->getEstados();
        $estado = $arrays_dados['estado'];
        $cidade = $arrays_dados['cidade'];
        $estado = $getEstados['estados'][$estado];
        $cidade = $estado['cidades'][$cidade];
        $estado = $estado['nome'];
        $user->cidade = $cidade;
        $user->estado = $estado;
        $user->save();
        // if($request->post('insta') == Auth::user()->insta){
        //     $instagram = $this->buscaInsta($request->post('insta'));
        //     $instagram = json_decode($instagram, true);
        //     $seguidor = $instagram['seguidores'];
        // }
        // $estado = $request->post('estado');
        // $cidade = $request->post('cidade');
        // $getEstados = $this->getEstados();
        // $estado = $getEstados['estados'][$estado];
        // $cidade = $estado['cidades'][$cidade];
        // $estado = $estado['nome'];
        // if ($instagram['status'] != 'erro'):
        //     $tags = $request->post('tags');
        //     $tags = str_replace(',', '|', $tags);
        //     $user = User::find(Auth::id());
        //     $user->name = $request->post('Nome');
        //     $user->genero = $request->post("genero");
        //     $user->nascimento = $request->post("data_nasc");
        //     $user->estado = $estado;
        //     $user->cidade = $cidade;
        //     $user->tags = $tags;
        //     $user->insta = $request->post("insta");
        //     $user->follows = $seguidor;
        //     $user->save();
        return redirect()->route('dashboard');
        // endif;
    }
    public function editarempresario(Request $request)
    {
        //campos do formulário
        $arrays = [
            0 => 'name',
            1 => 'email',
            2 => 'nome_marca',
            3 => 'telefone_marca',
        ];
        //onde vai ficar os dados do formulário
        $arrays_dados = [
            'name' => '',
            'email' => '',
            'nome_marca' => '',
            'telefone_marca' => '',
        ];
        //filtro para validação dos campos do formulário
        $array_validacao = [
            'name' => FILTER_SANITIZE_STRING,
            'email' => FILTER_SANITIZE_EMAIL,
            'nome_marca' => FILTER_SANITIZE_STRING,
            'telefone_marca' => FILTER_SANITIZE_NUMBER_INT,
        ];
        //conexão
        $user = User::find(Auth::id());
        //armazenar dados do formulário no array
        for ($i = 0; $i < count($arrays); $i++) {
            if (array_key_exists($arrays[$i], $arrays_dados)) {
                $arrays_dados[$arrays[$i]] = $request->post($arrays[$i]);
            }
        }
        //aplicando o filtro de validação
        for ($j = 0; $j < count($array_validacao); $j++) {
            $arrays_dados[$arrays[$j]] = filter_var($arrays_dados[$arrays[$j]], $array_validacao[$arrays[$j]]);
        }
        //verifica com os dados do banco de dados quais são iguais 
        $user = User::find(Auth::id());
        for ($i = 0; $i < count($arrays_dados); $i++) {
            $varia = $arrays[$i];
            if ($arrays_dados[$varia] != Auth::user()->$varia) {
                $user->$varia = $request->post($varia);
            }
        }
        //salvando a imagem na pasta e no banco de dados
        if (request()->hasFile("logo_marca") && request()->file("logo_marca")->isValid()) {
            $path = request()->file("logo_marca")->store("/public/assets/img/logos");
            $aux = explode("logos/", $path);
            $path = $aux[1];
            $user->logo_marca = $path;
        }
        $user->save();
        return redirect()->route('dashboard');
    }
}
