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

    // proceso de guardar la reservacion
    $('#form-comprobante').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {            
            txt_num_deposito: {
                required: true
            },
            platform: {
                required: true
            },
            subscription: {
                required: true
            },
            gender: 'required',
            agree: 'required'
        },

        messages: {
            txt_num_deposito: {
                required: "Por favor, Digíte numero de comprobante.",                
            },
            password: {
                required: "Please specify a password.",
                minlength: "Please specify a secure password."
            },
            subscription: "Please choose at least one option",
            gender: "Please choose gender",
            agree: "Please accept our policy"
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
            alert('hola mundo')
        }        
    });




});
    