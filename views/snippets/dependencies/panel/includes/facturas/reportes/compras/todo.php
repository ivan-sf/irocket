
<?php 
$modelMov = new models\Movements();
$atA = $modelMov->alltimeActive();
$atP = $modelMov->alltimePassive();
$totalA = 0;
while ($dataA = mysqli_fetch_array($atA)) {
    $totalA += $dataA['totalMoney'];
}
$totalP = 0;
while ($dataP = mysqli_fetch_array($atP)) {
    $totalP += $dataP['totalMoney'];
}
 ?>
 <div id="page-wrapper" style="min-height: 923px;">
            <div class="container-fluid">
                <div class="row bg-title">
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Reportes</h4>
                    </div>
                    <!-- /.page title -->
                    <!-- .breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Reportes</a></li>
                            <li><a href="#">Compras</a></li>
                            <li class="active">Todo</li>
                        </ol>
                    </div>
                    <!-- /.breadcrumb -->
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title"><i class="ti-shopping-cart text-success"></i> Ingresos</h3>
                            <div class="text-right"> <span class="text-muted">Ingresos totales</span>
                                <h1><sup><i class="ti-arrow-up text-success"></i></sup>
                                   <?php echo number_format($totalA); ?>                                </h1>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title"><i class="ti-cut text-danger"></i> Gastos</h3>
                            <div class="text-right"> <span class="text-muted">Gastos totales</span>
                                <h1><sup><i class="ti-arrow-down text-danger"></i></sup>
                                   <?php echo number_format($totalP); ?>                                </h1>
                                
                                </h1>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title"><i class="ti-stats-up"></i> Balance general</h3>
                            <div class="text-right"> <span class="text-muted">Balance total</span>
                                <h1><sup><i class="ti-arrow-up text-inverse"></i></sup> $
                                   <?php echo number_format($totalA-$totalP); ?>                                </h1>
                            </div>
                         
                        </div>
                    </div>

                </div>

                
                <!-- .row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                        <div class="table-responsive">
                        <table id="dt_bills" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                            <h4>Lista de facturas</h4>
                            <thead>
                                <tr role="row">
                                    <th>F#</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Total</th>
                                    <th>Pago</th>
                                    <th>Saldo</th>
                                    <th>Cliente</th>                                           
                                    <th>Caja</th>                                           
                                </tr>
                            </thead>
                            
                        </table>
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
        var table = $("#dt_bills").DataTable({
            "ajax":{
                "method":"POST",
                "url": "../../irocket/views/tables/reportes/compra/listar_facturas.php"
            },
            dom:"Bfrtlip",
            columns:[
                {"data":"bills_idbills"},
                {"data":"fecha"},
                {"data":"typeBill"},
                {"data":"total"},
                {"data":"pago"},
                {"data":"saldo"},
                {"data":"cliente"},
                {"data":"caja"}
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