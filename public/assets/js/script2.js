var id_estado = ''
var id_cidade = ''
var $j = jQuery.noConflict();
$j(document).ready(function () {

    /**
     * CLICK DO EDITAR
     */
    $j('#alterar-bank').click(function () {

        $j(this).removeAttr('class');
        $j(this).attr('class', 'btn btn-warning d-none');
        $j('#btn-confirm').attr('class', 'btn btn-success');
        var tags = [];
        $j('.form-control').removeAttr('disabled');
        $j('#tag').empty();
        $j('#tag').append('<label for="tags" class="col-form-label">Tags</label><div class="mini-form"><div class="input-group group-tags mb-3"><input id="tags" type="text" class="form-control" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" placeholder="adicionar tag" aria-label="Recipients username" aria-describedby="button-addon2"><div class="input-group-append"><button class="btn btn-outline-secondary" type="button" id="add_tag">+</button></div></div><div class="list-tag"></div> </div>');
        $j('.list-tag').empty();
        for (var i = 0; i < tags_bd.length; i++) {
            tags.push(tags_bd[i]);
        }
        $j.each(tags, function (i, item) {
            if (i == 0) {
                $j(".list-tag").html('<ul class="list-group"><li class="list-group-item list-tag-item d-flex justify-content-between align-items-center"><span>' + item + '</span><span class="badge badge-danger delete-tag badge-pill" data-id="' + i + '">X</span></li></ul>');
            } else {
                $j(".list-tag").append('<ul class="list-group"><li class="list-group-item list-tag-item d-flex justify-content-between align-items-center"><span>' + item + '</span><span class="badge badge-danger delete-tag badge-pill" data-id="' + i + '">X</span></li></ul>');
            }
        });
        /**
         * PREENCHER SELECT
         */
        var estados = '';
         $j.ajax({
            url:APP_URL+"/locations",
            type:"get",
            dataType:"json",
            async:false,
            success: function(json){
                estados = json.estados;
            },
            error: function(){
                console.log("error no ajax");
            }

        });
        var myestado = '';
        var mycidade='';
        for (let i = 0; i < estados.length; i++) {
            if((estados[i].nome == estado_bd)){
                myestado = estados[i];
                for (let j = 0; j < myestado.length; j++) {
                   if(myestado.cidades[j] == cidade_bd){
                        mycidade = myestado.cidades[j];
                        $j('#cidade').empty();
                        $j('#cidade').append(`<option value='${j}'> ${mycidade}</option>`);
                        break;
                   }
                }
                 $j('#estado').empty();
                 $j('#estado').append(`<option value='${i}'> ${myestado.nome} </option>`)
                 break;
            }
        }
        
        $j.each(estados, function (i, item) {
            $j("#estado").append('<option value="' + i + '">' + item.nome + '</option>');
        });
        /**
         * TAGS
         */
        function loadTags() {
            if (tags.length == 0) {
                $j(".list-tag").html('<ul class="list-group"><span class="s-tags">Sem tags</span></ul>');
            } else {
                $j.each(tags, function (i, item) {
                    if (i == 0) {
                        $j(".list-tag").html('<ul class="list-group"><li class="list-group-item list-tag-item d-flex justify-content-between align-items-center"><span>' + item + '</span><span class="badge badge-danger delete-tag badge-pill" data-id="' + i + '">X</span></li></ul>');
                    } else {
                        $j(".list-tag").append('<ul class="list-group"><li class="list-group-item list-tag-item d-flex justify-content-between align-items-center"><span>' + item + '</span><span class="badge badge-danger delete-tag badge-pill" data-id="' + i + '">X</span></li></ul>');
                    }
                });
            }
        }

        $j("#add_tag").on("click", function () {
            var tag = $j("#tags").val().trim().toLowerCase();
            if (tag.length > 1) {
                // if(tags == null){
                //     tags = [tag];
                // }else{
                tags.push(tag);
                //}
                loadTags();
                $j("#tags").val("");
            } else {
                $j("#tags").focus();
            }
        });
        $j(".list-tag").on("click", ".delete-tag", function () {
            id = $j(this).data("id");
            tags.splice(id, 1);
            loadTags();
        });
        $j('#btn-confirm').click(function () {
            id_cidade = $j('#cidade').val();
            id_estado = $j("#estado").val();
            $j('#estado').attr('value', estados[id_estado].sigla);
            $j('#cidade').attr('value', estados[id_estado].cidades[id_cidade]);
            $j('form').append(`<input type="hidden" name="tags" value='${tags}'/>`);
        });
        $j("#estado").click(function () {
            id_estado = $j("#estado").val();
            $j("#cidade").html('<option value="" disabled selected>Cidade</option>');
            $j.each(estados[id_estado].cidades, function (i, item) {
                $j("#cidade").append('<option value="' + i + '">' + item + '</option>');
            });
        });
    });
});
