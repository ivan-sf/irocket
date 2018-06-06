<?php 

$modelCompany = new models\Company();
$modelUser = new models\User();
$modelDepositAccount = new models\DepositAccount();
$modelCash = new models\Cash();

$dataCompany = $modelCompany->list();
$dataUser = $modelUser->list();
$dataAccount = $modelDepositAccount->list();
$dataCash = $modelCash->list();
if ($dataAccount >= 1) {
    header("location:" . URL);
}

$model = new models\Providers();
$con = new models\Conexion();
$sql = "SELECT * FROM users ORDER BY idusers desc";
$query = $con->returnConsulta($sql);
$datos1 = mysqli_fetch_array($query);

 ?>




            <form class="form-horizontal form-material" method="POST" id="formulario">

                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <input type="hidden" autofocus="" class="form-control form-control-sm m-input" placeholder="Nombre cuenta" name="numberInput[]" id="numberInput" value="Principal">
                   </div>
                   <div class="col-lg-12">
                        <div class="m-input-icon" id="nameAccount">
        
                        </div>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-12">
                    <input type="hidden" class="form-control form-control-sm m-input" placeholder="Fondos cuenta" name="currentInput[]" id="currentInput" value="0">
                <br>
                </div>
                <div class="col-lg-12">
                    <input type="hidden" class="form-control form-control-sm m-input" placeholder="Banco cuenta" name="bankInput[]" id="bankInput">
                </div>
            </div>

          



               
            </form>








<script>
    var answer = $('#answerJS');
        var respuesta = $('#respuesta');
        var alertJS = $('#alertJS');

        var datos = $("#formulario").serialize();
        $.ajax({
            type: "POST",
            url: "controllers/ajax/ajax_validationAccountDeposits.php",
            data: datos,
            success:function (data) {
                if(data.indexOf('1') != -1){
                    respuesta.removeClass('hiddenDIV1');
                    alertJS.addClass('fade show');
                    answer.html('no puede agregar una cuenta sin nombre o sin fondos.');
                }else{
                    $("#formulario").submit();
                }
                
            }
        });  
    $('#formulario').keyup(function(e) {
    if(e.keyCode == 13) {
        var answer = $('#answerJS');
        var respuesta = $('#respuesta');
        var alertJS = $('#alertJS');

        var datos = $("#formulario").serialize();
        $.ajax({
            type: "POST",
            url: "controllers/ajax/ajax_validationAccountDeposits.php",
            data: datos,
            success:function (data) {
                if(data.indexOf('1') != -1){
                    respuesta.removeClass('hiddenDIV1');
                    alertJS.addClass('fade show');
                    answer.html('no puede agregar una cuenta sin nombre o sin fondos.');
                }else{
                    $("#formulario").submit();
                }
                
            }
        });         
    }
    });

 
            $("#botonDeposit").click(function () {

                var answer = $('#answerJS');
                var respuesta = $('#respuesta');
                var alertJS = $('#alertJS');

                var datos = $("#formulario").serialize();
                $.ajax({
                    type: "POST",
                    url: "controllers/ajax/ajax_validationAccountDeposits.php",
                    data: datos,
                    success:function (data) {
                        if(data.indexOf('1') != -1){
                            respuesta.removeClass('hiddenDIV1');
                            alertJS.addClass('fade show');
                            answer.html('no puede agregar una cuenta sin nombre o sin fondos.');
                        }else{
                            $("#formulario").submit();
                        }
                        
                    }
                });         
            })
        </script>

        <script>
            var i = 1;
        //$("#nameInput").prop("disabled", true);
        //$("#nameInput").val("ISL101010" + i);
        var input = document.createElement("input");
        input.setAttribute("class",'form-control form-control-sm m-input');
        input.setAttribute("id",'nameInput');
        input.setAttribute("value","ISL101010" + i);
        input.setAttribute("type",'hidden');
        input.setAttribute("readonly",'');
        input.setAttribute("name",'nameInput[]');
        insert = $("#nameAccount").append(input);       


        $("#botonPlus").click(function() {
            if (i >= 0) {
                i = i+1;
            //alert(i);
        }else{
            alert('no')
        }
        
        $("#botonDelete").removeClass('hiddenDIV');
        var input = document.createElement("input");
        var input2 = document.createElement("input");
        var input3 = document.createElement("input");
        var input4 = document.createElement("input");

        input.setAttribute("class",'form-control form-control-sm m-input');
        input2.setAttribute("class",'form-control form-control-sm m-input');
        input3.setAttribute("class",'form-control form-control-sm m-input');
        input4.setAttribute("class",'form-control form-control-sm m-input');

        input.setAttribute("name",'nameInput[]');
        input2.setAttribute("name",'numberInput[]');
        input3.setAttribute("name",'currentInput[]');
        input4.setAttribute("name",'bankInput[]');

        input.setAttribute("id",'nameInput');
        input2.setAttribute("id",'numberInput');
        input3.setAttribute("id",'currentInput');
        input4.setAttribute("id",'bankInput');

        input.setAttribute("value","ISL101010" + i);
        input.setAttribute("readonly",'');

        input2.setAttribute("placeholder",'Numero cuenta');
        input3.setAttribute("placeholder",'Fondos cuenta');
        input4.setAttribute("placeholder",'Banco cuenta');

        insert = $("#nameAccount").append(input);       
        insert = $("#numberAccount").append(input2);
        insert = $("#currentAccount").append(input3);   
        insert = $("#bankAccount").append(input4);
    });

        $("#botonDelete").click(function() {
            var lengthInputs = $("#nameAccount input").length;
            if (lengthInputs == 2) {
                $("#botonDelete").toggleClass('hiddenDIV');
            }
            var list = $("#nameAccount input:last-child");
            var list2 = $("#numberAccount input:last-child");
            var list3 = $("#currentAccount input:last-child");
            var list4 = $("#bankAccount input:last-child");

            var br = $("#bankAccount br");
            br.remove();
            var br = $(".br1");
            br.remove();
            var br = $(".br2");
            br.remove();
            var br = $(".br3");
            br.remove();
            var br = $(".br4");
            br.remove();
            list.remove();
            list2.remove();
            list3.remove();
            list4.remove();
        });


    </script>