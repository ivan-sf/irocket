<?php 
$modelMov = new models\Movements();
$atA = $modelMov->dayActiveV($_GET['fecha']);
$atP = $modelMov->dayPassiveV($_GET['fecha']);
$atDA = $modelMov->daytimeActiveD($_GET['fecha']);
$atDP = $modelMov->daytimePassiveD($_GET['fecha']);

$totalA = 0;
while ($dataA = mysqli_fetch_array($atA)) {
    $totalA += $dataA['totalMoney'];
}
$totalP = 0;
while ($dataP = mysqli_fetch_array($atP)) {
    $totalP += $dataP['totalMoney'];
}
$totalDA = 0;
while ($dataDA = mysqli_fetch_array($atDA)) {
    $totalDA += $dataDA['totalMoney'];
}

$totalDP = 0;
while ($dataDP = mysqli_fetch_array($atDP)) {
    $totalDP += $dataDP['totalMoney'];
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
                            <li><a href="#">Ventas</a></li>
                            <li class="active">Diario</li>
                        </ol>
                    </div>
                    <!-- /.breadcrumb -->
                </div>
               
                <!-- .row -->
                <div class="row">

                    <div class="col-md-12">
                    	<div class="white-box">
                    		<form action="views/snippets/layout/pages/facturas/ventas/reportediario.php" method="GET" id="formulario">
                    			<div class="row">
                    				<div class="col-lg-6">
                        	 		<input class="form-control" type="date" id="fecha" name="fecha" value="<?php echo $_GET['fecha'] ?>"><br>
                    				
                    			</div>
                    			<div class="col-lg-6">
                    				<button type="submit" class="btn btn-block btn-outline btn-success">Consultar</button>
                    				
                    			</div>
                    			</div>
	
			                </form>
                    	</div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="white-box text-center bg-success">
                                    <h1 class="text-white counter"><?php echo number_format($totalA); ?> </h1>
                                    <p class="text-white">Ingreso total de ventas</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="white-box text-center bg-success">
                                    <h1 class="text-white counter"><?php echo number_format($totalDA); ?> </h1>
                                    <p class="text-white">Ingreso total de depositos</p>
                                </div>
                            </div>
                          

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="white-box text-center bg-danger">
                                    <h1 class="text-white counter"><?php echo number_format($totalP); ?> </h1>
                                    <p class="text-white">Gasto total de compras</p>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="white-box text-center bg-danger">
                                    <h1 class="text-white counter"><?php echo number_format($totalDP); ?> </h1>
                                    <p class="text-white">Retiro total de depositos</p>
                                </div>
                            </div>

                        </div>

                        


                        <div class="row">
                    <div class="col-md-6 col-lg-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Balance general</h3>
                            <div id="morris-donut-chart-day"></div>
                        </div>

                    </div>
<?php 
$atA = $modelMov->dayActive($_GET['fecha']);
$atP = $modelMov->dayPassive($_GET['fecha']);
$totalA = 0;
while ($dataA = mysqli_fetch_array($atA)) {
    $totalA += $dataA['totalMoney'];
}
$totalP = 0;
while ($dataP = mysqli_fetch_array($atP)) {
    $totalP += $dataP['totalMoney'];
}
 ?>
                    <div class="col-lg-6">
                        <div class="white-box">
                            <h4 class="box-title text-primary">INGRESOS TOTALES</h4>

                            <ul class="list-inline two-part">
                                <li><i class="ti-shopping-cart text-primary"></i></li>
                                   

                                <h3><li class="text-right text-primary">$<span class="counter"><?php echo number_format($totalA) ?></span></li></h3>
                            </ul>
                        </div>
                        <div class="white-box" style="margin-top: 20px">
                            <h4 class="box-title text-danger">GASTOS TOTALES</h4>

                            <ul class="list-inline two-part">
                                <li><i class="ti-cut text-danger"></i></li>
                                   

                                <h3><li class="text-right text-danger">$<span class="counter"><?php echo number_format($totalP) ?></span></li></h3><br>
                            </ul>
                        </div>
                    </div>
                    
                        
                    </div>


                        <div class="white-box">

			             
                        <div class="table-responsive">
                        <table id="dt_bills" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                            <h4>Lista de ventas</h4>

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

                    <div class="white-box">

                         
                        <div class="table-responsive">
                        <table id="dt_bills2" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                            <h4>Lista de compras</h4>

                            <thead>
                                <tr role="row">
                                    <th>F#</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Total</th>
                                    <th>Pago</th>
                                    <th>Saldo</th>
                                    <th>Proveedor</th>                                           
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

<?php 
$atA = $modelMov->dayActiveV($_GET['fecha']);
$atAR = mysqli_num_rows($atA);
if ($atAR>=1) { ?>

    function listar() {
    	var fecha = $("#fecha").val();
		var URL = "../../irocket/views/tables/reportes/venta/listar_facturas_diario.php?fecha=" + fecha;
        var table = $("#dt_bills").DataTable({
            "ajax":{
                method:"POST",
                url: URL,
				data: $("#formulario").serialize()
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
<?php } ?>
<?php 
$atA = $modelMov->dayPassiveV($_GET['fecha']);
$atAR = mysqli_num_rows($atA);
if ($atAR>0) { ?>
<script>


    function listar() {
        var fecha = $("#fecha").val();
        var URL = "../../irocket/views/tables/reportes/compra/listar_facturas_diario.php?fecha=" + fecha;
        var datos = $("#formulario").serialize();
        var table = $("#dt_bills2").DataTable({
            "destroy":false,
            "ajax":{
                method:"POST",
                url: URL,
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
<?php } ?>