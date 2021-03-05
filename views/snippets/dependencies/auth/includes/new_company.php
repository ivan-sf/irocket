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
    header("location:" . URL);
}
 ?>
<div class="notificacion1">
     <div class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-success myadmin-alert-top alerttop" style="display: block;"> 
    <i class="ti-comment"></i>
        Bienvenido, <b>iRocket</b> es un sistema contable y de control empresarial multiplataforma, cuyo objetivo es ser su mejor aliado. Recuerde que puede visitar 
        <a target="_blank" href="<?php echo URL_SITIO; ?>"><b>nuestro sitio web</b></a> para obtener mas informacion.<br>
        <a href="#" class="closed"><b>x</b></a> 
 </div>
 </div>

 <div class="notificacion2">
    <div id="alertbottomright" class="myadmin-alert myadmin-alert-img alert-info myadmin-alert-bottom-right" style="display: block;"> 
        <img src="views/plugins/images/users/8.jpg" class="img" alt="img">
        <a href="#" class="closed2">×</a>
            <b>Primer paso !</b> Completa el formulario <br> con los datos de tu empresa.
    </div>
 </div>

<script>
    $(".closed").click(function () {
       $(".notificacion1").toggleClass('hiddenDIV');
    });

    $(".closed2").click(function () {
       $(".notificacion2").toggleClass('hiddenDIV');
    });
</script>

 <section id="wrapper" class="company-register">
    <div class="login-deposit">



        <div class="white-box">

            <center><img src="views/plugins/images/logo-2.png" width="140"></center>

    <form class="form-horizontal form-material" method="POST" id="formulario" enctype="multipart/form-data"  onsubmit="return checkSubmit();">

        <center><h1 class="box-title m-b-20">Registrar empresa en el sistema <br><small><p>Los campos con * son obligatorios</p></small></h1>
        </center>


        <div class="form-group m-form__group row">
            <div class="col-lg-6">
                 <label for="name_company"><b>Nombre empresa *</b></label>
                 <input class="form-control" autofocus=""  type="text" placeholder="Empresa *" name="name_company" id="name_company">
             </div>
             <div class="col-lg-6">
                <label for="companyNit"><b>NIT</b></label>
                <input class="form-control"   type="text" placeholder="Nit empresa" name="companyNit" id="companyNit">
             </div>
        </div>
        <div class="form-group m-form__group row">
            <div class="col-lg-6">
                <label for="direction"><b>Direccion</b></label>
                <input class="form-control"   type="text" placeholder="Direccion" name="direction" id="direction">
             </div>
             <div class="col-lg-6">
                <label for="city"><b>Ciudad</b></label>
                <input class="form-control"   type="text" placeholder="Ciudad" name="city" id="city">
             </div>
        </div>

        <div class="form-group m-form__group row">
            <div class="col-lg-6">
                  <label for="tel"><b>Telefono / Celular</b></label>
                 <input class="form-control"   type="tel" placeholder="Telefono" name="tel" id="tel">
             </div>
             <div class="col-lg-6">
                <label for="mail"><b>Email</b></label>
                <input class="form-control"   type="email" placeholder="Email" name="mail" id="mail">
             </div>
        </div>

        <div class="form-group m-form__group row">
            <div class="col-lg-12">
                <label for="companyLogo"><b>Logo</b></label>
                <input class="form-control"   type="file" placeholder="Logotipo" name="companyLogo" id="companyLogo">
             </div>
        </div>

        <div class="form-group m-form__group row">
            <div class="col-lg-12">
            <center>
                <button type="button" class="btn m-btn--square  btn-success" id="boton">Registrar</button>
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
        var tel = $('#tel').val();
        var company = $('#name_company').val();
        var answer = $('#answerJS');
        var respuesta = $('#respuesta');
        if(isNaN($('#tel').val())){
            respuesta.removeClass('hiddenDIV');
            answer.html("recuerda que en el campo telefono solo puedes ingresar numeros (0-9).")
            return false;
        }
        if (company == '') {
            respuesta.removeClass('hiddenDIV');
            answer.html("al parecer aun no has ingresado el nombre de la empresa.")
            return false;
        } 
        else{
            $("#formulario").submit();
        }
        }
    });

    $("#boton").click(function () {
        var tel = $('#tel').val();
        var company = $('#name_company').val();
        var answer = $('#answerJS');
        var respuesta = $('#respuesta');
        if(isNaN($('#tel').val())){
            respuesta.removeClass('hiddenDIV');
            answer.html("recuerda que en el campo telefono solo puedes ingresar numeros (0-9).")
            return false;
        }
        if (company == '') {
            respuesta.removeClass('hiddenDIV');
            answer.html("al parecer aun no has ingresado el nombre de la empresa.")
            return false;
        } 
        else{
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