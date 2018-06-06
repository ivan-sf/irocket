<?php 
    $modelInventory = new models\Products();
    $arrayProducts = $modelInventory->array();
    $con = new models\Conexion();
?>



<div id="page-wrapper">
        <div class="container-fluid">

            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Productos</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Panel</a></li>
                        <li><a href="#">Productos</a></li>
                        <li class="active">Catalogo</li>
                    </ol>
                </div>
            </div>

                
            

                    <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>productos/tabla?index" class="">Tabla</a></button>
                    <button class="btn m-btn--pill btn-badge"><a href="<?php echo URL; ?>productos/crear">Crear</a></button><br>
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
                    Se editaron los datos del producto correctamente puedes ver el resultado acontinuacion.

                    </center>
                    </div>
                    <div class='m-alert__close'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                    </div>
                    </div>";
                }elseif (isset($_GET['error'])) {
                    if ($_GET['error'] == "delete") {
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
                    El producto al que intentas acceder no existe o ha sido eliminado.

                    </center>
                    </div>
                    <div class='m-alert__close'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                    </div>
                    </div>";
                    }elseif ($_GET['error'] == "code") {
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
                    El codigo que quieres asignar al producto ya existe.

                    </center>
                    </div>
                    <div class='m-alert__close'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                    </div>
                    </div>";
                    }
                }?>

                <div class="col-lg-12">
                    <?php $row=mysqli_num_rows($arrayProducts);
                    if ($row <= 0) { ?>
                         <center>
                        <h4><b>No se encontraron productos activos.</b></h4>
                         <button class="btn m-btn--pill btn-success"><a class="text-white" href="<?php echo URL; ?>productos/crear">Crear productos</a></button>
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
        url : 'models/search/productos.php',
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

