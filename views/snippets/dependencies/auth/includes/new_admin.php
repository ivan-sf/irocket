<?php 
$modelCompany = new models\Company();
$modelUser = new models\User();
$modelDepositAccount = new models\DepositAccount();
$modelCash = new models\Cash();

$dataCompany = $modelCompany->list();
$dataUser = $modelUser->list();
$dataAccount = $modelDepositAccount->list();
$dataCash = $modelCash->list();
if ($dataUser >= 1) {
    header("location:" . URL);
}
 ?>

<div class="alert2">
    <div id="alertbottomright" class="myadmin-alert myadmin-alert-img alert-info myadmin-alert-bottom-right" style="display: block;"> 
        <img src="views/plugins/images/users/8.jpg" class="img" alt="img">
        <a href="#" class="closed2">×</a>
        <b>Segundo paso !</b> Completa el formulario <br> con los datos del administrador(a).
    </div>
</div>

<script>

    $(".closed2").click(function () {
     $(".alert2").toggleClass('hiddenDIV');
 });
</script>

<section id="wrapper" class="company-register">
    <div class="login-company">



        <div class="white-box">

            <center><img src="views/plugins/images/logo-2.png" width="140"></center>

            <form class="form-horizontal form-material" method="POST" id="formulario" enctype="multipart/form-data" onsubmit="return checkSubmit();">

                <center><h1 class="box-title m-b-20">Registrar administrador(a) en el sistema <small><p>Los campos con * son obligatorios</p></small></h1></center>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                       <label for="nameUser"><b>Nombres *</b></label>
                       <input class="form-control m-input"  autofocus="" type="text" placeholder="Nombres *" name="nameUser" id="nameUser">
                   </div>
                   <div class="col-lg-6">
                    <label for="lastnameUser"><b>Primer Apellido *</b></label>
                    <input class="form-control m-input"   type="text" placeholder="Primer apellido" name="lastnameUser" id="lastnameUser">
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label for="documentUser"><b>Documento *</b></label>
                    <input class="form-control m-input"   type="tel" placeholder="Documento" name="documentUser" id="documentUser">
                </div>
                <div class="col-lg-6">
                    <label for="claveUser"><b>Clave *</b></label><br>
                    <input class="form-control m-input"   type="password" placeholder="Clave" name="claveUser" id="claveUser">
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label for="emailUser"><b>Email</b></label><br>
                    <input class="form-control m-input"   type="text" placeholder="E-mail" name="emailUser" id="emailUser">
                </div>
                <div class="col-lg-6">
                    <label for="phoneUser"><b>Telefono</b></label><br>
                    <input class="form-control m-input"   type="tel" placeholder="Telefono" name="phoneUser" id="phoneUser">
                </div>
            </div>

            <div class="form-group m-form__group row">

                <div class="col-lg-12">
                    <label for="ageUser"><b>Edad</b></label>
                    <input class="form-control m-input"   type="date" placeholder="Edad" name="ageUser" id="ageUser">
                    <br></div> 

                    <div class="col-lg-12">

                        <label for="exampleSelect1">
                            <b>Genero</b>
                        </label><center>
                            <select class="form-control" id="exampleSelect1" name="genereUser">
                                <option value="femenino">
                                    Femenino
                                </option>
                                <option value="masculino">
                                    Masculino
                                </option>
                                <option value="otro">
                                    Otro
                                </option>
                            </select>
                        </center>
                    </div>


                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-12">

                        <label for="photoUser"><b>Foto de perfil</b></label>
                        <input class="form-control m-input"   type="file" placeholder="Logotipo" name="photoUser" id="photoUser">

                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <center>
                            <button type="button" class="btn m-btn--square  btn-success" id="botonAdmin"> Registrar</button>
                        </center><br>
                    </div>
                </div>




                <div id="respuesta" class="hiddenDIV">
                    <div class="m-alert m-alert--icon m-alert--air alert alert-warning alert-dismissible fade show" role="alert" id="alertJS">
                        <div class="m-alert__icon">
                            <i class="la la-warning"></i>
                        </div>
                        <div class="m-alert__text">
                            <strong>
                                Lo sentimos,
                            </strong>
                            <span id="answerJS"></span>
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </section>




<script>
    $('#formulario').keyup(function(e) {
    if(e.keyCode == 13) {
        var nameUser = $('#nameUser').val();
        var lastnameUser = $('#lastnameUser').val();
        var documentUser = $('#documentUser').val();
        var phoneUser = $('#phoneUser').val();
        var emailUser = $('#emailUser');
        var claveUser = $('#claveUser').val();
        var genereUser = $('#genereUser').val();
        var ageUser = $('#ageUser').val();
        var photoUser = $('#photoUser');
        var answer = $('#answerJS');
        var respuesta = $('#respuesta');
        var alertJS = $('#alertJS');

        //alert("Hola isma");
        if (nameUser == '') {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("al parecer aun no has ingresado el <b>nombre</b> recuerda que los campos con (*) son obligatorios.");

        }else if (lastnameUser == '') {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("al parecer aun no has ingresado el <b>apellido</b> recuerda que los campos con (*) son obligatorios.");
        }else if (documentUser == '') {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("al parecer aun no has ingresado el <b>documento</b> recuerda que los campos con (*) son obligatorios.");
        }else if (claveUser == '') {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("al parecer aun no has ingresado la<b> clave de usuario </b> recuerda que los campos con (*) son obligatorios.");
        }else if (isNaN(phoneUser)) {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("en el campo <b>tefelono</b> solo puedes ingresar numeros (0-9)");
        }else if (isNaN(documentUser)) {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("en el campo <b>documento</b> solo puedes ingresar numeros (0-9)");
        }else{
            $("#formulario").submit();
        }
        }
    });

 
    $("#botonAdmin").click(function () {
        var nameUser = $('#nameUser').val();
        var lastnameUser = $('#lastnameUser').val();
        var documentUser = $('#documentUser').val();
        var phoneUser = $('#phoneUser').val();
        var emailUser = $('#emailUser');
        var claveUser = $('#claveUser').val();
        var genereUser = $('#genereUser').val();
        var ageUser = $('#ageUser').val();
        var photoUser = $('#photoUser');
        var answer = $('#answerJS');
        var respuesta = $('#respuesta');
        var alertJS = $('#alertJS');

        //alert("Hola isma");
        if (nameUser == '') {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("al parecer aun no has ingresado el <b>nombre</b> recuerda que los campos con (*) son obligatorios.");

        }else if (lastnameUser == '') {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("al parecer aun no has ingresado el <b>apellido</b> recuerda que los campos con (*) son obligatorios.");
        }else if (documentUser == '') {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("al parecer aun no has ingresado el <b>documento</b> recuerda que los campos con (*) son obligatorios.");
        }else if (claveUser == '') {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("al parecer aun no has ingresado la<b> clave de usuario </b> recuerda que los campos con (*) son obligatorios.");
        }else if (isNaN(phoneUser)) {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("en el campo <b>tefelono</b> solo puedes ingresar numeros (0-9)");
        }else if (isNaN(documentUser)) {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("en el campo <b>documento</b> solo puedes ingresar numeros (0-9)");
        }else{
            $("#formulario").submit();
        }
    });
</script>
<script>
    var statSend = false;
function checkSubmit() {
    if (!statSend) {
        statSend = true;
        return true;
    } else {
        return false;
    }
}
</script>