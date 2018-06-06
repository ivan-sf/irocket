 <div class="alertnotificacion1">
     <div class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-danger myadmin-alert-top alerttop" style="display: block;"> 
    <i class=" ti-comment"></i>
        <b>Lo sentimos !</b> la contraseña ingresada es incorrecta si el problema persiste puede contactar al soporte por medio de 
        <a target="_blank" href="<?php echo URL_SITIO; ?>"><b>nuestro sitio web.</b></a>

    </div>
 </div>


<script>
    $("#boton").click(function () {

        var answer = $('#answerJS');
        var respuesta = $('#respuesta');
        var alertJS = $('#alertJS');



        var datos = $("#formulario").serialize();
        $.ajax({
            type: "POST",
            url: "controllers/ajax/ajax_validationLogin.php",
            data: datos,
            success:function (data) {
                if (data == 'Hi') {
                    $("#formulario").submit();
                    
                }else{
                    respuesta.removeClass('hiddenDIV');
                    answer.html(data);
                }
            }
        });         
    })
</script>