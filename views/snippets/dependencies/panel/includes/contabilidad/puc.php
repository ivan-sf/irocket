



<div id="page-wrapper" style="min-height: 953px;">

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Contabilidad</h4> </div>

        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Panel</a></li>
            <li><a href="#">Contabilidad</a></li>
            <li class="active">Lista</li>
        </ol>
    </div>
        <!-- /.col-lg-12 -->
    </div>
    <button class="btn m-btn--pill btn-badge"><a href="<?php echo URL; ?>contabilidad/crear?tipo=codigo">Crear codigo</a></button>
    <br>
    <br>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
             


            <?php 
    $modelInventory = new models\Products();
    $arrayProducts = $modelInventory->array();
    $con = new models\Conexion();
?>



                    <?php $row=mysqli_num_rows($arrayProducts);
                     ?>
                         
                                <form id="formulario">
                                  <input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Buscar producto" name="busqueda" id="busqueda" autofocus="" autocomplete="off">  
                                </form>
<br>

                            <div class="row" id="">
                                <div class="col-md-12">
                                <table class="col-lg-12 table" id="tabla_resultado">
                                    
                                
                                </table>
                                </div>
                            </div>






<script>




$("#formulario").keypress(function(e){
    if(e.which==13){
        return false
    }
})
    $(obtener_registros());

function obtener_registros(alumnos)
{
    $.ajax({
        url : 'viewgrupos',
        type : 'POST',
        dataType : 'html',
        data : { alumnos: alumnos },
        })

    .done(function(resultado){
        $("#tabla_resultado").html(resultado);
    })
}

$(document).on('keyup', '#busqueda', function()
{
    var valorBusqueda=$(this).val();
    if (valorBusqueda!="")
    {
        obtener_registros(valorBusqueda);
    }
    else
        {
            obtener_registros();
        }
});


</script>


                <div class="m-grid__item m-grid__item--fluid m-wrapper">

<!-- END: Subheader -->

<div class="m-content">
<div class="col-lg-12">
<div class="m-portlet">


                            


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo (URL); ?>views/plugins/js/jquery-1.2.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/datatables.min.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/datatablebuttons.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/buttons.flash.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/jszip.min.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/pdfmake.min.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/vfs.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/buttonshtml5.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/button.print.js"></script>




            </div>
        </div>
    </div>





<script>
                  
$(document.body).keyup(function(e) {
           // console.log(e.which)
            if (e.which == 27) {
                window.history.go(-1);
            }
        })              
$(document).ready(function () {
//$("#alertabien").slideUp(5000).delay(5000);

$('#alertabien').delay(8000).slideToggle(1000, function () {
    $('#alertabien').removeClass("show");
});
return false;
});

</script>


