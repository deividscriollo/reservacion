$(function(){

        var inp = $('#txt_valor_pagar').get(0);
        if(inp.hasAttribute('disabled')) {
            inp.setAttribute('readonly' , 'true');
            inp.removeAttribute('disabled');
            inp.value="This text field is readonly!";
        }
        else {
            inp.setAttribute('disabled' , 'disabled');
            inp.removeAttribute('readonly');
        }


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

    // proceso de guardar la reservacion
    $('#form-comprobante').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            txt_num_deposito: {required: true,number: true},
            txt_val_deposito: {required: true,number: true,equalTo: "#txt_valor_pagar"},
            sel_banco: {required: true},
            sel_cuenta: {required: true},
            boucher: {required: true},
            sel_baucher: {required: true}
        },

        messages: {
            txt_num_deposito:{
                required:"Digite numero de comprobante.",
                number:'Por favor, Digite solo numeros'
            },
            txt_val_deposito:{required:'Por favor, Digite el valor de su deposito',equalTo:'Su monto debe ser igual'},
            sel_banco:"Por favor, Seleccione Banco.",
            sel_cuenta: "Por favor, seleccione numero cuenta",
            boucher: "Por favor, Seleccione Imagen",
            sel_baucher:"Por favor, Seleccione una opción"
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
            var formObj = new FormData(form);
            $.ajax({
                url:'reserva_banco.php',
                type:'POST',
                mimeType:"multipart/form-data",
                contentType: false,
                cache: false,
                processData:false,
                data:formObj,
                success:function(data){
                    // console.log(data);
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
                        $('#form-comprobante').each (function(){
                            this.reset();
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

                }
            });
        }
    });
});