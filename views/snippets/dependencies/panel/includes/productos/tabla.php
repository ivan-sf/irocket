<?php 
$modelInventory = new models\Products();
$con = new models\Conexion();
$arrayInventory = $modelInventory->array();
?>



<div id="page-wrapper" style="min-height: 953px;">

    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Productos</h4> </div>

                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Panel</a></li>
                        <li><a href="#">Productos</a></li>
                        <li class="active">Tabla</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>productos?catalogo" class="">Catalogo</a></button>
            <button class="btn m-btn--pill btn-badge"><a href="<?php echo URL; ?>productos/crear">Crear</a></button>
            <br>
            <br>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                       


                        
                        <div class="m-grid__item m-grid__item--fluid m-wrapper">

                            <!-- END: Subheader -->
                            
                            <div class="m-content">
                                <div class="col-lg-12">
                                    <div class="m-portlet">

                                        <div class="m-portlet__head ">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title col-lg-12">
                                                    <span class="m-portlet__head-icon m--hide">
                                                        <i class="la la-gear"></i>
                                                    </span>
                                                    
                                                    <?php if (isset($_GET['success_update'])) {
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
                                                        Se editaron los datos correctamente puedes ver el resultado en la tabla.

                                                        </center>
                                                        </div>
                                                        <div class='m-alert__close'>
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                                        </div>
                                                        </div>";
                                                    }elseif(isset($_GET['success_delete'])){
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
                                                        Se eliminaron los datos correctamente en adelante no tendras disponible el producto en tus datos.
                                                        </center>
                                                        </div>
                                                        <div class='m-alert__close'>
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                                        </div>
                                                        </div>";
                                                    }elseif (isset($_GET['error'])) {
                                                        if ($_GET['error'] == 'delete') {
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
                                                            El producto al que intentas acceder ha sido eliminado
                                                            </center>
                                                            </div>
                                                            <div class='m-alert__close'>
                                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                                            </div>
                                                            </div>";
                                                        }
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>

                                        <center><b><h4>INVENTARIO COMPLETO</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="dt_prod" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio compra</th>                                           
                                                        <th>Precio venta</th>                                           
                                                        <th>Promocion 1</th>                                           
                                                        <th>Promocion 2</th>                                           
                                                        <th>Cantidad</th>                                           
                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>

                                        <!--begin::Form-->
                                        <center><b><h4>ESTANTE 1</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv1" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                        <center><b><h4>ESTANTE 2</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv2" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                         <center><b><h4>ESTANTE 3</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv3" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                        <center><b><h4>ESTANTE 4</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv4" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                        <center><b><h4>ESTANTE 5</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv5" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                        <center><b><h4>ESTANTE 6</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv6" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                         <center><b><h4>ESTANTE 7</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv7" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                        <center><b><h4>ESTANTE 8</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv8" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>

                                        <center><b><h4>ESTANTE 9</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv9" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                        <center><b><h4>ESTANTE 10</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv10" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                         <center><b><h4>ESTANTE 11</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv11" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                        <center><b><h4>ESTANTE 12</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv12" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                        <center><b><h4>ESTANTE 13</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv13" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                        <center><b><h4>ESTANTE 14</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv14" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                        <center><b><h4>ESTANTE 15</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv15" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                        <center><b><h4>ESTANTE 16</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv16" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                         <center><b><h4>ESTANTE 17</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv17" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>


                                        <center><b><h4>ESTANTE 18</h4></b></center>
                                        <div class="table-responsive">
                                            <br>
                                            <table id="listar_inv18" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Producto</th>
                                                        <th>Codigo</th>
                                                        <th>Precio 1</th>                                           
                                                        <th>Precio 2</th>                                           
                                                        <th>Precio entrada</th>                                           
                                                        <th>Cantidad</th>                                           
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>

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



        <script>        
            function listar() {
                var table = $("#listar_inv1").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv1.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



        <script>        
            function listar() {
                var table = $("#listar_inv2").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv2.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



        <script>        
            function listar() {
                var table = $("#listar_inv3").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv3.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



        <script>        
            function listar() {
                var table = $("#listar_inv4").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv4.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



        <script>        
            function listar() {
                var table = $("#listar_inv5").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv5.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



        <script>        
            function listar() {
                var table = $("#listar_inv6").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv6.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



        <script>        
            function listar() {
                var table = $("#listar_inv7").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv7.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



        <script>        
            function listar() {
                var table = $("#listar_inv8").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv8.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>


        <script>        
            function listar() {
                var table = $("#listar_inv9").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv9.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



        <script>        
            function listar() {
                var table = $("#listar_inv10").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv10.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



        <script>        
            function listar() {
                var table = $("#listar_inv11").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv11.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



        <script>        
            function listar() {
                var table = $("#listar_inv12").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv12.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



        <script>        
            function listar() {
                var table = $("#listar_inv13").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv13.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



        <script>        
            function listar() {
                var table = $("#listar_inv14").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv14.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



        <script>        
            function listar() {
                var table = $("#listar_inv15").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv15.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



        <script>        
            function listar() {
                var table = $("#listar_inv16").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv16.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>


<script>        
            function listar() {
                var table = $("#listar_inv17").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv17.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>


<script>        
            function listar() {
                var table = $("#listar_inv18").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/inventarios/lista_inv18.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"price_buy"},
                    {"data":"quantityProduct"}
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>



         <script>        
            function listar() {
                var table = $("#dt_prod").DataTable({
                    "ajax":{
                        "method":"POST",
                        "url": "../../irocket/views/tables/listar_productos.php"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"nameProduct"},
                    {"data":"codeProduct"},
                    {"data":"price_buy"},
                    {"data":"precio"},
                    {"data":"precio_promotion"},
                    {"data":"precio_promotion2"},
                    {"data":"quantityProduct"},
                    
                    ],
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

                    language: idioma
                });

            }
            var idioma = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
            listar();
        </script>


    </div>
</div>
</div>
</div>

</div>
</div><div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
</div>
<!-- /.right-sidebar -->
</div>
<!-- /.container-fluid -->
<footer class="footer text-center"> 2017 © Elite Admin brought to you by themedesigner.in </footer>
</div>




<script>
    
    $(document).ready(function () {
        //$("#alertabien").slideUp(5000).delay(5000);

        $('#alertabien').delay(8000).slideToggle(1000, function () {
            $('#alertabien').removeClass("show");
        });
        return false;
    });

</script>


