var $j = jQuery.noConflict();
estados = null;
    tags = null;
    datainflu = {
        'genero':'',
        'nascimento':'',
        'estado':'',
        'cidade':'',
        'insta':'',
        'follows':''
    };
    dataempre = {
        'nome_marca':'',
        'telefone_marca':'',
        'logo_marca':''
    };
$j(document).ready(function(){
    $j("#telefone_marca").mask('(00)00000-0000');
    function loadEstados(type){
        if(estados == null){
            $j.ajax({
                url:APP_URL+"/locations",
                type:"get",
                dataType:"json",
                async:false,
                success: function(json){
                    estados = json.estados;
                    if(type == 0){
                        $j("#estado").html('<option value="" disabled selected>Estado</option>');
                        $j.each(json.estados, function(i, item) {
                            $j("#estado").append('<option value="'+i+'">'+item.nome+'</option>');
                        });
                    }
                },
                error: function(){
                    console.log("error no ajax");
                }
    
            });
        }  
    }
    function loadTags(){
        if(tags.length == 0){
            $j(".list-tag").html('<ul class="list-group"><span class="s-tags">Sem tags</span></ul>');
        }else{
            $j.each(tags, function(i, item) {
                if(i==0){
                    $j(".list-tag").html('<ul class="list-group"><li class="list-group-item list-tag-item d-flex justify-content-between align-items-center"><span>'+item+'</span><span class="badge badge-danger delete-tag badge-pill" data-id="'+i+'">X</span></li></ul>');
                }else{
                    $j(".list-tag").append('<ul class="list-group"><li class="list-group-item list-tag-item d-flex justify-content-between align-items-center"><span>'+item+'</span><span class="badge badge-danger delete-tag badge-pill" data-id="'+i+'">X</span></li></ul>');
                }
            });
        }
        
    }
    $j(".questions-influ").on("click",".next", function(){
        let pagina = $j(this).attr("data-pag");
        let nextPage = false;
        if(parseInt(pagina) == 1){
            datainflu.genero = $j("#gender").val();
            nextPage = true;
        }else if(parseInt(pagina) == 2){
            if($j("#nascimento").val().length == 10){
                datainflu.nascimento = $j("#nascimento").val();
                nextPage = true;
            }else{
                nextPage = false;
            } 
        }else if(parseInt(pagina) == 3){
            id_estado = $j("#estado").val();
            id_cidade = $j("#cidade").val();
            if(id_estado == undefined || id_cidade == undefined){
                nextPage = false;
            }else{
                id_estado = $j("#estado").val();
                datainflu.estado = estados[id_estado].sigla;
                datainflu.cidade = estados[id_estado].cidades[id_cidade];
                nextPage = true;
            }
        }else if(parseInt(pagina) == 4){
            if(tags!=null){
                if(tags.length >= 5){
                    nextPage = true;
                }else{
                    $j("#tags").focus();
                }
            }
        }else if(parseInt(pagina) == 5){
            nick = $j("#userinsta").val().trim();
            if(nick.length > 0){
                console.log(nick);
                $j.ajax({
                    url:APP_URL+"/loadinsta/"+nick,
                    type:"get",
                    dataType:"json",
                    async: false,
                    success: function(json){
                        if(json.status == "ok"){
                            datainflu.insta = nick;
                            datainflu.follows = json.seguidores;
                        }else{
                            console.log("nao encontrado");
                        }
                    },
                    error: function(){
                        console.log("error no ajax");
                    }
                });
                if(datainflu.follows != "" && datainflu.insta != ""){
                    let token = $j("#userinsta").attr("data-token");
                    let tags_implode = tags.join("|"); 
                    $j.ajax({
                        url:APP_URL+"/completeInfluencer",
                        type:"post",
                        async: false,
                        data:"_token="+token+"&genero="+datainflu.genero+"&nascimento="+datainflu.nascimento+"&estado="+datainflu.estado+"&cidade="+datainflu.cidade+"&tags="+tags_implode+"&insta="+datainflu.insta+"&follows="+datainflu.follows,
                        success: function(resp){
                            if(resp == "ok"){
                                window.location = APP_URL+"/home";
                            }
                        },
                        error: function(){
                            console.log("error no ajax");
                        }
                    });
                }
            }else{
                $j("#userinsta").focus();
            }
        }
        if(nextPage){
            $j(".question"+pagina).hide();
            $j(".question"+(parseInt(pagina)+1)).slideDown().css("display","flex");
            if((parseInt(pagina)+1)== 3){
                loadEstados(0);
            }
        }
     
    });
    $j(".questions-empre").on("click",".next", function(){
        let pagina = $j(this).attr("data-pag");
        let nextPage = false;
        if(parseInt(pagina) == 1){
            nome_digitado = $j("#name_marca").val().trim();
            if(nome_digitado.length > 1){
                dataempre.nome_marca = nome_digitado;
                nextPage = true;
            }else{
                $j("#name_marca").focus();
            }
        }else if(parseInt(pagina) == 2){
            telefone_emp = $j("#telefone_marca").val();
            if(telefone_emp.length >= 13){
                dataempre.nome_marca = telefone_emp;
                nextPage = true;
            }else{
                $j("#telefone_marca").focus();
            }
        }else if(parseInt(pagina) == 3){
            file_logo = $j("#logo_marca").val();
            if(file_logo != ""){
                dataempre.logo_marca = file_logo;
                var form = new FormData($j("#form_empre")[0]);
                $j.ajax({
                    url:APP_URL+"/completeEmpresario",
                    type:"post",
                    data:form,
                    contentType: false,
                    processData: false,
                    success: function(resp){
                        if(resp == "ok"){
                            window.location = APP_URL+"/home";
                        }
                    },
                    error: function(){
                        console.log("error no ajax");
                    }
                });
            }
            
        }
        if(nextPage){
            $j(".question"+pagina).hide();
            $j(".question"+(parseInt(pagina)+1)).slideDown().css("display","flex");
        }
     
    });
    $j(".questions-influ").on("click",".back", function(){
        let pagina = $j(this).attr("data-pag");
        $j(".question"+pagina).hide();
        $j(".question"+(parseInt(pagina)-1)).slideDown().css("display","flex");
        if((parseInt(pagina)-1)== 3){
            loadEstados(0);
        }
    });
    $j(".questions-empre").on("click",".back", function(){
        let pagina = $j(this).attr("data-pag");
        $j(".question"+pagina).hide();
        $j(".question"+(parseInt(pagina)-1)).slideDown().css("display","flex");
    });
    $j("#estado").on("change", function(){
        selecionado = $j(this).val();
        $j("#cidade").html('<option value="" disabled selected>Cidade</option>');
        $j.each(estados[selecionado].cidades, function(i, item) {
            $j("#cidade").append('<option value="'+i+'">'+item+'</option>');
        });
        
    });
    $j("#form_empre").on("submit", function(e){
        e.preventDefault();
    });
    $j("#add_tag").on("click",function(){
        var tag = $j("#tags").val().trim().toLowerCase();
        if(tag.length > 1){
            if(tags == null){
                tags = [tag];
            }else{
                tags.push(tag);
            }
            loadTags();
            $j("#tags").val("");
        }else{
            $j("#tags").focus();
        }  
    });
   $j(".list-tag").on("click",".delete-tag",function(){
       var id = $j(this).data("id");
        tags.splice(id,1);
        loadTags();
   });
   $j("#menubtn").on("click",function(){
        $j(".menu").animate({
            width: "toggle"
        });
    });
    $j("#form-new-prop").on("submit", function(e){
        
        if(!(tags == null || tags.length == 0)){
            $j("<input />").attr("type", "hidden")
          .attr("name", "datatag")
          .attr("value", tags.join("|"))
          .appendTo("#form-new-prop");
        }
          return true;
    });
    $j("#estadoprop").on("change", function(){
        selecionado = $j(this).val();
        if(selecionado == "all"){
            $j("#cidadeprop").html('<option selected value="all">Qualquer cidade</option>');
        }else{
            loadEstados(1);
            $j("#cidadeprop").html('<option selected value="all">Qualquer cidade</option>');
            $j.each(estados[selecionado].cidades, function(i, item) {
                $j("#cidadeprop").append('<option value="'+i+'">'+item+'</option>');
            });
        }
        
        
    });
    $j(".sem-props-btn").on("click",function(){
        $j(".menu .list-group #list-mypropostas-list").removeClass("active");
        $j(".menu .list-group #list-newpropostas-list").addClass("active");
    });
});