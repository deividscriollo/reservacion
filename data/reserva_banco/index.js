$(function(){   
    //proceso de accion cselect bancos
    $('#sel_banco').change(function(){
        var valor_select=$('#sel_banco').val();
        $.ajax({
            url:'reserva_banco.php',
            type:'POST',
            data:{select_banco_cuenta:'ok', id:valor_select},
            success:function(data){
                $('#sel_cuenta').html(data)
            }

        });
    });

});
    