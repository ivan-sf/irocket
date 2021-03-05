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
                            <li><a href="#">Depositos</a></li>
                            <li class="active">Todo</li>
                        </ol>
                    </div>
                    <!-- /.breadcrumb -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                        <div class="table-responsive">
                        <table id="dt_bills" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                            <h4>Lista de activos</h4>
                            <thead>
                                <tr role="row">
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Pago</th>
                                    <th>Saldo</th>
                                    <th>Caja</th>
                                    <th>Cliente</th>
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
                "url": "../../irocket/views/tables/reportes/pendientes/listar_cobrar.php"
            },
            dom:"Bfrtlip",
            columns:[
                {"data":"fecha"},
                {"data":"total"},
                {"data":"pago"},
                {"data":"saldo"},
                {"data":"caja"},
                {"data":"cliente"}

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