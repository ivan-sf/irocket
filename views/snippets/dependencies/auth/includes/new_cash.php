<?php 
$modelCompany = new models\Company();
$modelUser = new models\User();
$modelDepositAccount = new models\DepositAccount();
$modelCash = new models\Cash();

$dataCompany = $modelCompany->list();
$dataUser = $modelUser->list();
$dataAccount = $modelDepositAccount->list();
$dataCash = $modelCash->list();
if ($dataCash >= 1) {
    header("location:" . URL);
}

$modelInventory = new models\DepositAccount();
$con = new models\Conexion();
$arrayInventory = $modelInventory->array();

 ?>




            <form class="form-horizontal form-material" method="POST" id="formulario" onsubmit="return checkSubmit();">

           <?php $datos1 = mysqli_fetch_array($arrayInventory); ?>
           <input type="hidden" name="deposit" id="deposit" value="<?php echo $datos1['numberAccount']; ?>" name="">

                     
                         
                

           
                        <input type="hidden" class="form-control m-input m-input--air m-input--pill" value="Caja 1" name="name[]" id="name1">
     
                        <input type="hidden" class="form-control m-input m-input--air m-input--pill" value="Caja 2" name="name[]" id="name2">
                 
                        <input type="hidden" class="form-control m-input m-input--air m-input--pill" value="Caja 3" name="name[]" id="name3">
                    

                
                        <input type="hidden" class="form-control m-input m-input--air m-input--pill" value="C1" name="code[]" id="code1">
          
                        <input type="hidden" class="form-control m-input m-input--air m-input--pill" value="C2" name="code[]" id="code2">
                  
                        <input type="hidden" class="form-control m-input m-input--air m-input--pill" value="C3" name="code[]" id="code3">
               

               
                        <input type="hidden" value="1" class="form-control m-input m-input--air m-input--pill" placeholder="" autofocus="" name="clave[]" id="clave1">
                   
                        <input type="hidden" value="1" class="form-control m-input m-input--air m-input--pill" placeholder="" name="clave[]" id="clave2">
                  

                        <input type="hidden" value="1" class="form-control m-input m-input--air m-input--pill" placeholder="" name="clave[]" id="clave3">
      

                
            </form>



        </div>
    </section>





<script>
    $(document).ready(function () {
        $("#formulario").submit();
    })
    $("#botonCash").click(function () {
        var name1 = $("#name1").val();
        var name2 = $("#name2").val();
        var name3 = $("#name3").val();

        var code1 = $("#code1").val();
        var code2 = $("#code2").val();
        var code3 = $("#code3").val();

        var clave1 = $("#clave1").val();
        var clave2 = $("#clave2").val();
        var clave3 = $("#clave3").val();

        var description1 = $("#description1").val();
        var description2 = $("#description2").val();
        var description3 = $("#description3").val();

        var n = $("#deposit").val();

        if (name1 == '' || name2 == '' || name3 == '' || code1 == '' || code2 == '' || code3 == '' || clave1 == '' || clave2 == '' || clave3 == '' || description1 == '' || description2 == '' || description3 == '') {
            $("#respuesta").removeClass("hiddenDIV1");
            $("#answerJS").html("todos los campos son obligatorios.");
        }else{
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