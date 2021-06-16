var $j = jQuery.noConflict();
$j(document).ready(function () {
    
    /**
     * CLICK DO EDITAR
     */
     $j('#alterar-bank').click(function () {
        $j(this).removeAttr('class');
        $j(this).attr('class', 'btn btn-warning d-none');
        $j('#btn-confirm').attr('class', 'btn btn-success');
        $j('.form-control').removeAttr('disabled');
        $j('#imagem').append(`<input type='file' name='logo_marca'/>`);
    });
});