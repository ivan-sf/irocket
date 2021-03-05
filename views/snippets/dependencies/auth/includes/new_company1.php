<?php
$modelCompany = new models\Company();
$modelUser = new models\User();
$modelDepositAccount = new models\DepositAccount();
$modelCash = new models\Cash();

$dataCompany = $modelCompany->list();
$dataUser = $modelUser->list();
$dataAccount = $modelDepositAccount->list();
$dataCash = $modelCash->list();
if ($dataCompany >= 1) {
    //header("location:" . URL);
}
?>
<div class="notificacion1">
    <div class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-success myadmin-alert-top alerttop" style="display: block;">
        <i class="ti-comment"></i>
        Bienvenido, <b>Titan Comercial</b> es un sistema contable y de control empresarial multiplataforma, cuyo objetivo es ser su mejor aliado. Recuerde que puede visitar
        <a target="_blank" href="<?php echo URL_SITIO; ?>"><b>nuestro sitio web</b></a> para obtener mas informacion.<br>

        <a href="#" class="closed"><b>x</b></a>
    </div>
</div>



<script>
    $(".closed").click(function() {
        $(".notificacion1").toggleClass('hiddenDIV');
    });

    $(".closed2").click(function() {
        $(".notificacion2").toggleClass('hiddenDIV');
    });
</script>

<section id="wrapper" class="company-register">
    <div class="login-deposit">



        <div class="white-box">

            <center><img src="views/plugins/images/logo-2.png" width="140"></center>

            <form class="form-horizontal form-material" method="POST" id="formulario" enctype="multipart/form-data" onsubmit="return checkSubmit();">

                <br>
                <center><small>
                        <p>Los campos con * son obligatorios</p>
                    </small></h1>
                </center>


                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <input class="form-control" autofocus="" type="text" placeholder="Empresa *" name="name_company" id="name_company">
                    </div>
                </div>
                

                <div class="form-group m-form__group row">
                    <select class="form-control custom-select"  name="regimen">
                        <option value="2">RESPONSABLE DE IVA(COMUN)</option>
                        <option value="1">NO RESPONSABLE DE IVA (SIMPLIFICADO)</option>
                    </select>
                </div>


                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <input class="form-control m-input" autofocus="" type="text" placeholder="Nombres *" name="nameUser" id="nameUser">
                    </div>
                    <div class="col-lg-6">
                        <input class="form-control m-input" type="text" placeholder="Primer apellido *" name="lastnameUser" id="lastnameUser">
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <input class="form-control m-input" type="tel" placeholder="Documento *" name="documentUser" id="documentUser">
                    </div>
                    <div class="col-lg-6">
                        <input class="form-control m-input" type="password" placeholder="Clave *" name="claveUser" id="claveUser">
                    </div>
                </div>

                <input type="hidden" autofocus="" class="form-control form-control-sm m-input" placeholder="Nombre cuenta" name="numberInput[]" id="numberInput" value="Principal">
                <input type="hidden" class="form-control form-control-sm m-input" placeholder="Fondos cuenta" name="currentInput[]" id="currentInput" value="0">




                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <center>
                            <button type="button" class="btn btn-success" id="boton">
                            <i class="fa fa-check"></i> REGISTRAR
                            </button>
                        </center>
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
        if (e.keyCode == 13) {
            var tel = $('#tel').val();
            var company = $('#name_company').val();
            var answer = $('#answerJS');
            var respuesta = $('#respuesta');

            if (company == '') {
                respuesta.removeClass('hiddenDIV');
                answer.html("al parecer aun no has ingresado el nombre de la empresa.")
                return false;
            }
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

            } else if (lastnameUser == '') {
                respuesta.removeClass('hiddenDIV');
                alertJS.addClass('fade show');
                answer.html("al parecer aun no has ingresado el <b>apellido</b> recuerda que los campos con (*) son obligatorios.");
            } else if (documentUser == '') {
                respuesta.removeClass('hiddenDIV');
                alertJS.addClass('fade show');
                answer.html("al parecer aun no has ingresado el <b>documento</b> recuerda que los campos con (*) son obligatorios.");
            } else if (claveUser == '') {
                respuesta.removeClass('hiddenDIV');
                alertJS.addClass('fade show');
                answer.html("al parecer aun no has ingresado la<b> clave de usuario </b> recuerda que los campos con (*) son obligatorios.");
            } else if (isNaN(documentUser)) {
                respuesta.removeClass('hiddenDIV');
                alertJS.addClass('fade show');
                answer.html("en el campo <b>documento</b> solo puedes ingresar numeros (0-9)");
            } else {
                $("#formulario").submit();

            }



        }
    });

    $("#boton").click(function() {
        var company = $('#name_company').val();
        var answer = $('#answerJS');
        var respuesta = $('#respuesta');

        if (company == '') {
            respuesta.removeClass('hiddenDIV');
            answer.html("al parecer aun no has ingresado el nombre de la empresa.")
            return false;
        }
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

        } else if (lastnameUser == '') {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("al parecer aun no has ingresado el <b>apellido</b> recuerda que los campos con (*) son obligatorios.");
        } else if (documentUser == '') {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("al parecer aun no has ingresado el <b>documento</b> recuerda que los campos con (*) son obligatorios.");
        } else if (claveUser == '') {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("al parecer aun no has ingresado la<b> clave de usuario </b> recuerda que los campos con (*) son obligatorios.");
        } else if (isNaN(documentUser)) {
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("en el campo <b>documento</b> solo puedes ingresar numeros (0-9)");
        } else {
            $("#formulario").submit();
        }


    })
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