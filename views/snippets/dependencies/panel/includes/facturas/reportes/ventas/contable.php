<?php 
$con = new models\Conexion();
$day=$_GET['fecha'];
$dayY=$_GET['fechaY'];
$modelMov = new models\Movements();
$modelBills = new models\Bills();
$totalDiaVentas = $modelBills->ingresosDiaPosFDMes($_GET['fecha'],$_GET['fechaY']);
$totalDiaVentasElec = $modelBills->ingresosDiaElecFDMes($_GET['fecha'],$_GET['fechaY']);
$totalDiaVentasRem = $modelBills->ingresosDiaRemFDMes($_GET['fecha'],$_GET['fechaY']);

$comprasDiaPosFD = $modelBills->comprasDiaPosFDMes($_GET['fecha'],$_GET['fechaY']);
$comprasDiaElecFD = $modelBills->comprasDiaElecFDMes($_GET['fecha'],$_GET['fechaY']);
$comprasDiaRemFD = $modelBills->comprasDiaRemFDMes($_GET['fecha'],$_GET['fechaY']);

$totalDiaCompras = $modelBills->comprasDia($_GET['fecha']);
$iva19 = $modelBills->iva19Mes($_GET['fecha'],$_GET['fechaY']);
$iva5 = $modelBills->iva5Mes($_GET['fecha'],$_GET['fechaY']);
$iva19C = $modelBills->iva19CMes($_GET['fecha'],$_GET['fechaY']);
$iva5C = $modelBills->iva5CMes($_GET['fecha'],$_GET['fechaY']);


$listaDevoluciones = $modelMov->listaDevoluciones();


$totalVentasDiario = 0;
$totalVentasDiarioElec = 0;
$totalVentasDiarioRem = 0;

$totalComprasDiario = 0;
$totalComprasDiarioElec = 0;
$totalComprasDiarioRem = 0;

$totalIva19 = 0;
$totalIva5 = 0;

$totalIva19C = 0;
$totalIva5C = 0;

while ($dataA = mysqli_fetch_array($totalDiaVentas)) {
    $totalVentasDiario += $dataA['precioTotal'];
}

while ($dataAA = mysqli_fetch_array($totalDiaVentasElec)) {
    $totalVentasDiarioElec += $dataAA['total'];
}

while ($dataAAA = mysqli_fetch_array($totalDiaVentasRem)) {
    $totalVentasDiarioRem += $dataAAA['precioTotal'];
}

while ($dataA = mysqli_fetch_array($comprasDiaPosFD)) {
    $totalComprasDiario += $dataA['precioTotal'];
}

while ($dataAA = mysqli_fetch_array($comprasDiaElecFD)) {
    $totalComprasDiarioElec += $dataAA['total'];
}

while ($dataAAA = mysqli_fetch_array($comprasDiaRemFD)) {
    $totalComprasDiarioRem += $dataAAA['precioTotal'];
}

while ($dataI19 = mysqli_fetch_array($iva19)) {
    $totalIva19 += $dataI19['impuesto']*$dataI19['cantidad'];
}



while ($dataI5 = mysqli_fetch_array($iva5)) {
    $totalIva5 += $dataI5['impuesto']*$dataI5['cantidad'];
}

while ($dataI19 = mysqli_fetch_array($iva19C)) {
    $totalIva19C += $dataI19['impuesto']*$dataI19['cantidad'];
}



while ($dataI5 = mysqli_fetch_array($iva5C)) {
    $totalIva5C += $dataI5['impuesto']*$dataI5['cantidad'];
}



$atA = $modelMov->dayActiveV($_GET['fecha']);
$atA = $modelMov->dayActiveV($_GET['fecha']);
$atB = $modelMov->dayActiveV($_GET['fecha']);
$atP = $modelMov->dayPassiveV($_GET['fecha']);
$atDA = $modelMov->daytimeActiveD($_GET['fecha']);
$atDP = $modelMov->daytimePassiveD($_GET['fecha']);
$totalA = 0;
while ($dataA = mysqli_fetch_array($atA)) {
    $totalA += $dataA['totalMoney'];
}

$sql = "SELECT * FROM bills INNER JOIN billdetails ON bills.idbills=billdetails.bills_idbills 
WHERE
bills.typeBill=1 AND stateBillDetail=2 AND typeBillDetail=1 AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' OR
bills.typeBill=3 AND stateBillDetail=2 AND typeBillDetail=1 AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY'
";
$query = $con->returnConsulta($sql);
$datosA = mysqli_num_rows($query);
$totalB = 0;
while ($datosB=mysqli_fetch_array($query)) {
    $totalB += $datosB['pUnidadCompra']*$datosB['cantidad'];
}
$totalC = $totalVentasDiario+$totalVentasDiarioElec-$totalB;


/*
 $idBill = $dataA['bills_idbills'];
    $sql = "SELECT * FROM billdetails WHERE bills_idbills='$idBill'";
    $query = $con->returnConsulta($sql);
    $totalB += $dataA['totalMoney'];
*/
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
                            <form action="views/snippets/layout/pages/facturas/ventas/reporteContable.php" method="GET" id="formulario">
                                <div class="row">
                                <div class="col-lg-3">
                                <select  class="form-control" id="fecha" name="fecha">
                                    <option value="<?php echo date('m'); ?>">Seleccionar Mes</option> 
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                                </div>
                                <div class="col-lg-3">
                                    <select  class="form-control" id="fechaA" name="fechaA">
                                        <option value="<?php echo date('Y'); ?>">Seleccionar Año</option> 
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                    </select>
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
                                    <h1 class="text-white counter"><?php echo number_format($totalVentasDiario); ?> </h1>
                                    <p class="text-white">Ingreso total de ventas POS</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="white-box text-center bg-success">
                                    <h1 class="text-white counter"><?php echo number_format($totalVentasDiarioElec); ?> </h1>
                                    <p class="text-white">Ingreso total de ventas Electronica</p>
                                </div>
                            </div>
                           

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <div class="white-box text-center bg-success">
                                    <h1 class="text-white counter"><?php echo number_format($totalIva19); ?> </h1>
                                    <p class="text-white">Iva 19% Facturas de venta</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <div class="white-box text-center bg-success">
                                    <h1 class="text-white counter"><?php echo number_format($totalIva5); ?> </h1>
                                    <p class="text-white">Iva 5% Facturas de venta</p>
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="white-box text-center bg-danger">
                                    <h1 class="text-white counter"><?php echo number_format($totalComprasDiario); ?> </h1>
                                    <p class="text-white">Gasto total de compras POS</p>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="white-box text-center bg-danger">
                                    <h1 class="text-white counter"><?php echo number_format($totalComprasDiarioElec); ?> </h1>
                                    <p class="text-white">Gasto total de compras Electronica</p>
                                </div>
                            </div>

                            

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <div class="white-box text-center bg-danger">
                                    <h1 class="text-white counter"><?php echo number_format($totalIva19C); ?> </h1>
                                    <p class="text-white">Iva 19% Facturas de compra legales</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <div class="white-box text-center bg-danger">
                                    <h1 class="text-white counter"><?php echo number_format($totalIva5C); ?> </h1>
                                    <p class="text-white">Iva 5% Facturas de compra legales</p>
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
                                    <h1 class="text-white counter"><?php echo number_format($totalDP); ?> </h1>
                                    <p class="text-white">Retiro total de depositos + Devoluciones</p>
                                </div>
                            </div>

                        
                                        <?php 
                                        $totalDev=0;
                                                while ( $listDeposits = mysqli_fetch_array($listaDevoluciones)) {
                                                $totalDev += $listDeposits['totalMoney'];   ?>
                                        <a href="facturas/detalles?id=<?php echo $listDeposits['bills_idbills']; ?>&detalles">
                                        

                                            <input type="hidden" class="list-group-item">
                                                <span class="badge badge-success"><?php //echo number_format($listDeposits['totalMoney']); ?></span>
                                                <?php if($listDeposits['typeMovement']==2){
                                                 //  echo "Factura  de venta #" . $listDeposits['bills_idbills']; 
                                                } ?>
                                                <?php if($listDeposits['typeMovement']==1){
                                                  //  echo "Factura  de compra #" . $listDeposits['bills_idbills']; 
                                                } ?>
                                            </button></a>
                                            <?php } ?>       
                     

                        </div>

                        <div class="row">

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <div class="white-box text-center bg-primary">
                                    <h1 class="text-white counter"><?php echo number_format($totalVentasDiario+$totalVentasDiarioElec-$totalDev); ?> </h1>
                                    <p class="text-white">Ingreso total (VENTAS)</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <div class="white-box text-center bg-primary">
                                    <h1 class="text-white counter"><?php echo number_format($totalComprasDiario+$totalComprasDiarioElec); ?> </h1>
                                    <p class="text-white">Inversion total (COMPRAS)</p>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4 col-xs-12">
                                <div class="white-box text-center bg-success">
                                    <h1 class="text-white counter"><?php echo number_format($totalVentasDiario+$totalVentasDiarioElec-$totalDev); ?> </h1>
                                    <p class="text-white">Total de ventas</p>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4 col-xs-12">
                                <div class="white-box text-center bg-danger">
                                    <h1 class="text-white counter"><?php echo number_format($totalB); ?> </h1>
                                    <p class="text-white">Costo de productos</p>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4 col-xs-12">
                                <div class="white-box text-center bg-info">
                                    <h1 class="text-white counter"><?php echo number_format($totalC-$totalDev); ?> </h1>
                                    <p class="text-white">Ganancia ventas</p>
                                </div>
                            </div>
                        </div>

                       



                  

                    </div>

                    <div class="table-responsive">
                        <table id="listar_inv1" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                            <h4>Informe de ventas</h4>

                            <thead>
                                <tr role="row">
                                    <th>FACTURA #</th>
                                    <th>FECHA</th>
                                    <th>PRODUCTO</th>
                                    <th>IVA %</th>
                                    <th>VALOR IVA UNIDAD</th>
                                    <th>VALOR PRODUCTO UNIDAD</th>                                           
                                    <th>CANTIDAD</th>
                                    <th>VENDEDOR</th>                                           
                                    <th>CLIENTE</th>                                           
                                </tr>
                            </thead>
                            
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table id="listar_inv4" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                            <h4>Informe de compras</h4>

                            <thead>
                                <tr role="row">
                                    <th>FACTURA #</th>
                                    <th>FECHA</th>
                                    <th>PRODUCTO</th>
                                    <th>IVA %</th>
                                    <th>VALOR IVA UNIDAD</th>
                                    <th>VALOR PRODUCTO UNIDAD</th>                                           
                                    <th>CANTIDAD</th>
                                    <th>VENDEDOR</th>                                           
                                    <th>CLIENTE</th>                                           
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                   
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" value="<?php echo $_GET['fecha']; ?>" name="mesDato" id="mesDato">
                    <input type="hidden" value="<?php echo $_GET['fechaY']; ?>" name="añoDato" id="añoDato">


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
		        var mes = $("#mesDato").val();
		        var año = $("#añoDato").val();
                var table = $("#listar_inv1").DataTable({
                    "ajax":{
                        "method":"GET",
                        "url": "../../irocket/views/tables/inventarios/informeMensualContable.php?mes="+mes+"&año="+año+"&año2=2020"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"idbills"},
                    {"data":"dateRegister"},
                    {"data":"nombre"},
                    {"data":"ivaPorcentaje"},
                    {"data":"impuesto"},
                    {"data":"precioUnidad"},
                    {"data":"cantidad"},
                    {"data":"nameUser"},
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

<script>
        function listar() {
		        var mes = $("#mesDato").val();
		        var año = $("#añoDato").val();
                var table = $("#listar_inv4").DataTable({
                    "ajax":{
                        "method":"GET",
                        "url": "../../irocket/views/tables/inventarios/informeMensualPosC.php?mes="+mes+"&año="+año+"&año2=2020"
                    },
                    dom:"Bfrtlip",
                    columns:[
                    {"data":"idbills"},
                    {"data":"dateRegister"},
                    {"data":"nombre"},
                    {"data":"ivaPorcentaje"},
                    {"data":"impuesto"},
                    {"data":"precioUnidad"},
                    {"data":"cantidad"},
                    {"data":"nameUser"},
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