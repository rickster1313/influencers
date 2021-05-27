<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Proposta;

class UserController extends Controller
{
    private function getEstados(){
        $path = public_path()."\assets\json\\estados-cidades.json";
        $json_loc = file_get_contents($path);
        $loc_array = json_decode($json_loc, true);
        return $loc_array;
    }
    public function dashboard(){
        if(Auth::user()->user_id === 1){
            if(Auth::user()->insta == null){
                return view("complete-influencer");
            }else{
                $allpropostas = json_decode(Proposta::all(),true);
                $mytags = explode("|", Auth::user()->tags);
                $dataNasc = explode("-", Auth::user()->nascimento);
                $dataHoje = explode("-",date("Y-m-d", strtotime("now")));
                $idade = $dataHoje[0] - $dataNasc[0];
                if($dataHoje[1] < $dataNasc[1]){
                    $idade--;
                }elseif ($dataHoje[1] == $dataNasc[1]) {
                    if ($dataHoje[2] < $dataNasc[2]) {
                        $idade--;
                    }
                }
                $minhaPropostas = array();
                foreach ($allpropostas as $key => $value) {

                    //filtro de tags
                    $tags = explode("|", $value['tags']);
                    $filtroTags = 0;
                    if($tags[0] != "all"){
                        foreach ($tags as $i => $valor) {
                            if(in_array($valor, $mytags)){
                                $filtroTags++;
                                break;
                            }
                        }
                    }else{
                        $filtroTags++;
                    }
                    if ($filtroTags === 0) {
                        continue;
                    }

                    //filtro de seguidores
                    if($value['num_follows'] > Auth::user()->follows){
                        continue;
                    }

                    //filtro de estado e cidade
                    $filtroEstado = 0;
                    $filtroCidade = 0;
                    if($value['estado'] != "all"){
                        if($value['estado'] == Auth::user()->estado){
                            $filtroEstado++;
                            if ($value['cidade'] != "all") {
                                if($value['cidade'] == Auth::user()->cidade){
                                    $filtroCidade++;
                                }
                            }else{
                                $filtroCidade++;
                            }
                        }
                    }else{
                        $filtroEstado++;
                        if ($value['cidade'] != "all") {
                            if($value['cidade'] == Auth::user()->cidade){
                                $filtroCidade++;
                            }
                        }else{
                            $filtroCidade++;
                        }
                    }
                    if($filtroEstado === 0 || $filtroCidade === 0){
                        continue;
                    }

                    //filtro sexo
                    $filtroSexo = 0;
                    if($value['sexo'] != "all"){
                        if($value['sexo'] ==  Auth::user()->genero){
                            $filtroSexo++;
                        }
                    }else{
                        $filtroSexo++;
                    }
                    if ($filtroSexo === 0) {
                        continue;
                    }

                    //filtro idade
                    $filtroIdade = 0;
                    if($value['idade'] == "all"){
                        $filtroIdade++;
                    }elseif ($value['idade'] == "ate18") {
                        if($idade <= 18){
                            $filtroIdade++;
                        }
                    }elseif ($value['idade'] == "18e20") {
                        if($idade>=18 && $idade <= 20){
                            $filtroIdade++;
                        }
                    }elseif ($value['idade'] == "20e30") {
                        if($idade >= 20 && $idade <=30){
                            $filtroIdade++;
                        }
                    }elseif ($value['idade'] == "30e60") {
                        if($idade>=30 && $idade<=60){
                            $filtroIdade++;
                        }
                    }elseif ($value['idade'] == "60mais") {
                        if($idade>=60){
                            $filtroIdade++;
                        }
                    }
                    if ($filtroIdade === 0) {
                        continue;
                    }
                    array_push($minhaPropostas, $allpropostas[$key]);
                }
                return view("dashboard-influ",['propostas'=>$minhaPropostas]);
            }
            
        }elseif(Auth::user()->user_id === 2){
            if(Auth::user()->nome_marca == null){
                return view("complete-empre");
            }else{
                $propostas = Proposta::where([['marca_id', '=', Auth::id()], ['status', '=', 1]])->get();
                $loc_array = $this->getEstados();
                return view("dashboard-empre",["propostas"=>$propostas,"estados"=>$loc_array['estados']]);
            }
            
        }else{
            Auth::logout();
            $msg = "Erro ao fazer login!";
            $classMsg = "alert alert-danger";
            return redirect("/login")->with("msg",$msg)->with("classMsg",$classMsg);
        }
        
    }
    public function sair(){
        Auth::logout();
        $msg = "Desconectado com sucesso!!";
        $classMsg = "alert alert-success";
        return redirect("/login")->with("msg",$msg)->with("classMsg",$classMsg);
    } 
    public function select($id){
        if($id == 1 || $id == 2){
            session(['reg_id'=> $id]);
            return redirect("/register");
        }else{
            return redirect("/cadastro-usuario");
        }
        
    }
    public function selectUser(){
        return view("select-user");
    }
    public function locs(){
        $loc_array = $this->getEstados();
        return $loc_array;
    }
    public function buscaInsta($user){
        $json = array(
            'status'=>null,
            'seguidores'=>null
        );
        try {
            $html = file_get_contents('https://instagram.com/'.$user.'/');
            preg_match('/_sharedData = ({.*);<\/script>/', $html, $matches);
            $profile_data = json_decode($matches[1])->entry_data->ProfilePage[0]->graphql->user;
            $json['status'] = "ok";
            $json['seguidores'] = $profile_data->edge_followed_by->count;
        } catch (\Throwable $th) {
            $json['status'] = "erro";
        }
        return json_encode($json);
    }
    public function completarInfluencer(Request $request){
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
    public function completarEmpresario(Request $request){
        $user = User::find(Auth::id());
        $user->nome_marca = $request->post("name_marca");
        $user->telefone_marca = $request->post("telefone_marca");
        if(request()->hasFile("logo_marca") && request()->file("logo_marca")->isValid()){
            $path = request()->file("logo_marca")->store("/public/assets/img/logos");
            $aux = explode("logos/",$path);
            $path = $aux[1];
        }
        $user->logo_marca = $path;
        $user->save();
        return "ok";
    }
    public function newproposta(Request $request){
        $estados = $this->getEstados();
        $proposta = new Proposta();
        $proposta->titulo = $request->post("titulo");
        $proposta->descricao = $request->post("descricao");
        $proposta->trabalho = $request->post("trabalho");
        $proposta->premiacao = $request->post("premiacao");
        if($request->has("datatag")){
            $proposta->tags = $request->post("datatag");
        }else{
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
}
