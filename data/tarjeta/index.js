$(function(){

    function buscando(registro){
        var result = "" ;
        $.ajax({
                url:'../../utilidades/tarjeta_credito.php',
                async :  false ,
                type:  'post',
                dataType:'json',
                data: {validar_targeta:'ok',tarjeta:registro},
                success : function ( data )  {
                    //$("#icon_b_usuario").addClass("icon-user");
                     result = data['valid'];
                }
            });
        return result ;
    }
    jQuery.validator.addMethod("validacion_tarjeta", function (value, element) {
            var a=value;
            var reg=$('#txt_num_deposito').val();
                return buscando(reg,0);

    }, "Por favor, Revise el numero la TARJETA DE CRÉDITO NO ES VALIDA.");
    // proceso de guardar la reservacion
    $('#form-comprobante').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            txt_num_deposito: {
                required: true,
                number: true,
                validacion_tarjeta:true
            },
            sel_tarjeta:{
                required: true
            }
            // txt_val_deposito: {required: true,number: true,equalTo: "#txt_valor_pagar"},
        },

        messages: {
            txt_num_deposito:{
                required:"Digíte numero de comprobante.",
                number:'Por favor, Digite solo números'
            },
            sel_tarjeta:{
                required: 'Selección requerida '
            }
            // txt_val_deposito:{required:'Por favor, Digíte el valor de su deposito',equalTo:'Su monto debe ser igual'},
        },

        invalidHandler: function (event, validator) { //display error alert on form submit
            $('.alert-error', $('.login-form')).show();
        },

        highlight: function (e) {
            $(e).closest('.control-group').removeClass('info').addClass('error');
        },

        success: function (e) {
            $(e).closest('.control-group').removeClass('error').addClass('info');
            $(e).remove();
        },

        errorPlacement: function (error, element) {
            if(element.is(':checkbox') || element.is(':radio')) {
                var controls = element.closest('.controls');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chzn-select')) {
                error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
            }
            else error.insertAfter(element);
        },

        submitHandler: function (form) {
            $.ajax({
                url:'reserva_banco.php',
                type:'POST',
                data:{guardar:'ok',num_deposito:$('#txt_num_deposito').val(),id:$('#txt_id_reservacion').val(),t:$('#sel_tarjeta').val()},
                success:function(data){
                    if (data==0) {
                        $.gritter.add({
                            title: '..Mensaje..!',
                            text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos se almacenaron con exito. por favor espere un periodo de 24 horas para la confirmación de su reservación <br><i class="icon-spinner icon-spin green bigger-230"></i>',                      
                            //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',
                            sticky: false,
                            time: 2000,
                            after_close: function(){
                                location.href="";
                            }
                        });
                    };
                     if(data!=0&&data!=1){
                         $.gritter.add({
                            title: '..Mensaje..!',
                            text: 'Lo sentimos: <br><i class=" icon-cogs red bigger-230"></i>   Intente mas Tarde . <br><i class="icon-spinner icon-spin red bigger-230"></i>',                       
                            //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',
                            sticky: false,
                            time: ''
                        });
                     };
                     $('#form-comprobante').each (function(){
                            this.reset();
                        });
                }
            });
        }
    });
});
