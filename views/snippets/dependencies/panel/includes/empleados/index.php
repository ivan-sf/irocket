<?php 
$modelProducts = new models\Employees();
$arrayProducts = $modelProducts->array();
 ?>

<div id="page-wrapper">
        <div class="container-fluid">

            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Empleados</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Panel</a></li>
                        <li><a href="#">Empleados</a></li>
                        <li class="active">Catalogo</li>
                    </ol>
                </div>
            </div>

                
            

                    <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>tercero/crear" class="">Crear tercero</a></button>
                    <button class="btn m-btn--pill btn-badge"><a href="<?php echo URL; ?>clientes?catalogo">Clientes</a></button>
                    <button class="btn m-btn--pill btn-badge"><a href="<?php echo URL; ?>proveedores?catalogo">Proveedores</a></button><br>
                <br>
                    <?php  if (isset($_GET['success_update'])) {
                    echo "
                    <div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-success alert-dismissible fade show' role='alert' id='alertabien'>
                    <div class='m-alert__icon'>
                    <i class='flaticon-rocket'></i>
                    </div>
                    <div class='m-alert__text'>
                    <center>
                        <strong>
                    Perfecto !
                    </strong>
                    Se editaron los datos de tu empleado correctamente puedes ver el resultado acontinuacion.

                    </center>
                    </div>
                    <div class='m-alert__close'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                    </div>
                    </div>";
                }elseif (isset($_GET['error'])) {
                    echo "
                    <div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-danger alert-dismissible fade show' role='alert' id='alertabien'>
                    <div class='m-alert__icon'>
                    <i class='flaticon-rocket'></i>
                    </div>
                    <div class='m-alert__text'>
                    <center>
                        <strong>
                    Lo sentimos !
                    </strong>
                    El empleado al que intentas acceder no existe o ha sido eliminado.

                    </center>
                    </div>
                    <div class='m-alert__close'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                    </div>
                    </div>";
                }?>
                <div class="col-lg-12">
                    <?php $row=mysqli_num_rows($arrayProducts);
                    if ($row <= 0) { ?>
                         <center>
                        <h4><b>No se encontraron empleados activos.</b></h4>
                         <button class="btn m-btn--pill btn-success"><a class="text-white" href="<?php echo URL; ?>empleados/crear">Crear empleados</a></button>
                         </center>
                     <?php }else{ ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="">
                                  <input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Buscar producto" name="busqueda" id="busqueda" autofocus="">  
                                </form>
                                
                            </div>
                        </div>
                     <?php  } ?>
                </div>   
                

 <br>






<script>
    $(obtener_registros());

function obtener_registros(alumnos)
{
    $.ajax({
        url : 'models/search/empleados.php',
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

<div class="row" id="">
    <div class="col-lg-12" id="tabla_resultado"></div>
</div>
            </div>

</div>

<script>
                                    
$(document).ready(function () {
//$("#alertabien").slideUp(5000).delay(5000);

    $('#alertabien').delay(5000).slideToggle(1000, function () {
        $('#alertabien').removeClass("show");
    });
    return false;
});

</script>
