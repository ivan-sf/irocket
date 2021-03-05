<?php
$model = new models\Products();
$con = new models\Conexion();
$idGet = $_GET['id'];
$array = $model->set("idproduct", $idGet);
$data = $model->view();
$dataDef = $model->viewDef();
$dataDet = $model->viewDet();
$datos = mysqli_fetch_array($data);
$modelInventory = new models\Inventory();
$arrayInventory = $modelInventory->array();
$sql1 = "SELECT * FROM products WHERE idproducts='$idGet'";
$query1 = $con->returnConsulta($sql1);
$datos1 = mysqli_fetch_array($query1);
$idProducto = $datos['idproducts'];
$rowCodes = $model->rowCodes();
$rowLotes = $model->rowLotes();
$rowVencimiento = $model->rowVencimiento();
$rowPrices = $model->rowPrices();


if ($datos1['stateBD'] == 1 || $datos1['stateBD'] == 2) {
} else {
    header("location:" . URL . "productos?error=delete");
}
?>
<div id="page-wrapper" style="min-height: 953px;">

    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Productos</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Panel</a></li>
                    <li><a href="#">Productos</a></li>
                    <li class="active">Detalles</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>productos?catalogo" class="">Catalogo</a></button>
        <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>productos/tabla?index" class="">Tabla</a></button>
        <button class="btn m-btn--pill btn-badge"><a href="<?php echo URL; ?>productos/crear">Crear</a></button>
        <br>
        <br>
        <div class="modal fade bs-s-sm" tabindex="" role="" aria-labelledby="" style="display: none;" aria-hidden="">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel"></h4>
                    </div>
                    <div class="modal-body col-lg-9">
                        <img src="<?php echo URL . $datos['ruta']; ?>" width="480" alt="img">
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12 col-xs-12 col-lg-4">
                <div class="white-box">
                    <div class="user-bg"> <img width="100%" alt="user" src="<?php echo URL; ?>views/plugins/images/large/5.jpg">
                        <div class="overlay-box">
                            <div class="user-content">



                                <a href="javascript:void(0)" alt="default" data-toggle="modal" data-target=".bs-s-sm"><img src="<?php echo URL . $datos['ruta']; ?>" height="120" alt="img">
                                </a>
                                <h4 class="text-white"><?php echo strtolower($datos['nameProduct']); ?></h4>

                            </div>

                        </div>
                    </div>

                    <div class="white-box"><br>

                        <h3 class="box-title">
                            <center>Caracteristicas</center>
                        </h3>
                        <ul class="basic-list">
                            <li>Codigo<span class="pull-right label-warning label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&codigos=<?php echo strtolower($datos['codeProduct'])."&cod=1"; ?>" class=""><?php echo strtolower($datos['codeProduct']); ?></a></span></li>


                            <?php
                            if ($datos['codeProduct_promotion']) {
                            ?>
                                <li>Codigo #2<span class="pull-right label-warning label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&codigos=<?php echo strtolower($datos['codeProduct_promotion'])."&cod=2"; ?>" class=""><?php echo strtolower($datos['codeProduct_promotion']); ?></a></span></li>
                            <?php
                            }
                            ?>

                            <?php
                            if ($datos['codeProduct_promotion2']) {
                            ?>
                                <li>Codigo #3<span class="pull-right label-warning label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&codigos=<?php echo strtolower($datos['codeProduct_promotion2'])."&cod=3"; ?>" class=""><?php echo strtolower($datos['codeProduct_promotion2']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            
                            <?php
                            if ($datos['codeProduct_4']) {
                            ?>
                                <li>Codigo #4<span class="pull-right label-warning label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&codigos=<?php echo strtolower($datos['codeProduct_4']."&cod=4"); ?>" class=""><?php echo strtolower($datos['codeProduct_4']); ?></a></span></li>
                            <?php
                            }
                            ?>  
                            
                            <?php
                            if ($datos['codeProduct_5']) {
                            ?>
                                <li>Codigo #4<span class="pull-right label-warning label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&codigos=<?php echo strtolower($datos['codeProduct_5']."&cod=5"); ?>" class=""><?php echo strtolower($datos['codeProduct_5']); ?></a></span></li>
                            <?php
                            }
                            ?>  
                            
                            <?php
                            if ($datos['codeProduct_6']) {
                            ?>
                                <li>Codigo #4<span class="pull-right label-warning label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&codigos=<?php echo strtolower($datos['codeProduct_6'])."&cod=6"; ?>" class=""><?php echo strtolower($datos['codeProduct_6']); ?></a></span></li>
                            <?php
                            }
                            ?>  
                            

                            <?php
                            if ($datos['codeProduct_7']) {
                            ?>
                                <li>Codigo #4<span class="pull-right label-warning label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&codigos=<?php echo strtolower($datos['codeProduct_7'])."&cod=7"; ?>" class=""><?php echo strtolower($datos['codeProduct_7']); ?></a></span></li>
                            <?php
                            }
                            ?>  
                            

                            <?php
                            if ($datos['codeProduct_8']) {
                            ?>
                                <li>Codigo #4<span class="pull-right label-warning label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&codigos=<?php echo strtolower($datos['codeProduct_8'])."&cod=8"; ?>" class=""><?php echo strtolower($datos['codeProduct_8']); ?></a></span></li>
                            <?php
                            }
                            ?>  
                            

                            <?php
                            if ($datos['codeProduct_9']) {
                            ?>
                                <li>Codigo #4<span class="pull-right label-warning label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&codigos=<?php echo strtolower($datos['codeProduct_9'])."&cod=9"; ?>" class=""><?php echo strtolower($datos['codeProduct_9']); ?></a></span></li>
                            <?php
                            }
                            ?>  
                            

                            <?php
                            if ($datos['codeProduct_10']) {
                            ?>
                                <li>Codigo #4<span class="pull-right label-warning label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&codigos=<?php echo strtolower($datos['codeProduct_10'])."&cod=10"; ?>" class=""><?php echo strtolower($datos['codeProduct_10']); ?></a></span></li>
                            <?php
                            }
                            ?>  
                            



                            <li>Venta #1<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&precios=<?php echo strtolower($datos['precio'])."&precio=1"; ?>" class=""><?php echo strtolower($datos['precio']); ?></a></span></li>
                            <?php
                            if ($datos['precio_promotion']) {
                            ?>
                                <li>Venta #2<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&precios=<?php echo strtolower($datos['precio_promotion'])."&precio=2"; ?>" class=""><?php echo strtolower($datos['precio_promotion']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['precio_promotion2']) {
                            ?>
                                <li>Venta #3<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&precios=<?php echo strtolower($datos['precio_promotion2'])."&precio=3"; ?>" class=""><?php echo strtolower($datos['precio_promotion2']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['precio3']) {
                            ?>
                                <li>Venta #4<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&precios=<?php echo strtolower($datos['precio3'])."&precio=4"; ?>" class=""><?php echo strtolower($datos['precio3']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['precio4']) {
                            ?>
                                <li>Venta #5<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&precios=<?php echo strtolower($datos['precio4'])."&precio=5"; ?>" class=""><?php echo strtolower($datos['precio4']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['precio5']) {
                            ?>
                                <li>Venta #6<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&precios=<?php echo strtolower($datos['precio5'])."&precio=6"; ?>" class=""><?php echo strtolower($datos['precio5']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['precio6']) {
                            ?>
                                <li>Venta #7<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&precios=<?php echo strtolower($datos['precio6'])."&precio=7"; ?>" class=""><?php echo strtolower($datos['precio6']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['precio7']) {
                            ?>
                                <li>Venta #8<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&precios=<?php echo strtolower($datos['precio7'])."&precio=8"; ?>" class=""><?php echo strtolower($datos['precio7']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['precio8']) {
                            ?>
                                <li>Venta #9<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&precios=<?php echo strtolower($datos['precio8'])."&precio=9"; ?>" class=""><?php echo strtolower($datos['precio8']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['precio9']) {
                            ?>
                                <li>Venta #10<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&precios=<?php echo strtolower($datos['precio9'])."&precio=10"; ?>" class=""><?php echo strtolower($datos['precio9']); ?></a></span></li>
                            <?php
                            }
                            ?>

<?php
                            if ($datos['lote']) {
                            ?>
                                <li>Lote #1<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&lotes=<?php echo strtolower($datos['lote'])."&lote=1"; ?>" class=""><?php echo strtolower($datos['lote']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['lote2']) {
                            ?>
                                <li>Lote #2<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&lotes=<?php echo strtolower($datos['lote2'])."&lote=2"; ?>" class=""><?php echo strtolower($datos['lote2']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['lote3']) {
                            ?>
                                <li>Lote #3<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&lotes=<?php echo strtolower($datos['lote3'])."&lote=3"; ?>" class=""><?php echo strtolower($datos['lote3']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['lote4']) {
                            ?>
                                <li>Lote #4<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&lotes=<?php echo strtolower($datos['lote4'])."&lote=4"; ?>" class=""><?php echo strtolower($datos['lote4']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['lote5']) {
                            ?>
                                <li>Lote #5<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&lotes=<?php echo strtolower($datos['lote5'])."&lote=5"; ?>" class=""><?php echo strtolower($datos['lote5']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['lote6']) {
                            ?>
                                <li>Lote #6<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&lotes=<?php echo strtolower($datos['lote6'])."&lote=6"; ?>" class=""><?php echo strtolower($datos['lote6']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['lote7']) {
                            ?>
                                <li>Lote #7<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&lotes=<?php echo strtolower($datos['lote7'])."&lote=7"; ?>" class=""><?php echo strtolower($datos['lote7']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['lote8']) {
                            ?>
                                <li>Lote #8<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&lotes=<?php echo strtolower($datos['lote8'])."&lote=8"; ?>" class=""><?php echo strtolower($datos['lote8']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['lote9']) {
                            ?>
                                <li>Lote #9<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&lotes=<?php echo strtolower($datos['lote9'])."&lote=9"; ?>" class=""><?php echo strtolower($datos['lote9']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['lote10']) {
                            ?>
                                <li>Lote #10<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&lotes=<?php echo strtolower($datos['lote10'])."&lote=10"; ?>" class=""><?php echo strtolower($datos['lote10']); ?></a></span></li>
                            <?php
                            }
                            ?>

                            <?php
                            if ($datos['fechaVencimiento']) {
                            ?>
                                <li>Vencimiento #1<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&vencimientos=<?php echo strtolower($datos['lote10'])."&vencimiento=1"; ?>" class=""><?php echo strtolower($datos['fechaVencimiento']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['fechaVencimiento2']) {
                            ?>
                                <li>Vencimiento #2<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&vencimientos=<?php echo strtolower($datos['lote10'])."&vencimiento=2"; ?>" class=""><?php echo strtolower($datos['fechaVencimiento2']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['fechaVencimiento3']) {
                            ?>
                                <li>Vencimiento #3<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&vencimientos=<?php echo strtolower($datos['lote10'])."&vencimiento=3"; ?>" class=""><?php echo strtolower($datos['fechaVencimiento3']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['fechaVencimiento4']) {
                            ?>
                                <li>Vencimiento #4<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&vencimientos=<?php echo strtolower($datos['lote10'])."&vencimiento=4"; ?>" class=""><?php echo strtolower($datos['fechaVencimiento4']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['fechaVencimiento5']) {
                            ?>
                                <li>Vencimiento #5<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&vencimientos=<?php echo strtolower($datos['lote10'])."&vencimiento=3"; ?>" class=""><?php echo strtolower($datos['fechaVencimiento5']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['fechaVencimiento6']) {
                            ?>
                                <li>Vencimiento #6<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&vencimientos=<?php echo strtolower($datos['lote10'])."&vencimiento=3"; ?>" class=""><?php echo strtolower($datos['fechaVencimiento6']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['fechaVencimiento7']) {
                            ?>
                                <li>Vencimiento #7<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&vencimientos=<?php echo strtolower($datos['lote10'])."&vencimiento=3"; ?>" class=""><?php echo strtolower($datos['fechaVencimiento7']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['fechaVencimiento8']) {
                            ?>
                                <li>Vencimiento #8<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&vencimientos=<?php echo strtolower($datos['lote10'])."&vencimiento=3"; ?>" class=""><?php echo strtolower($datos['fechaVencimiento8']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['fechaVencimiento9']) {
                            ?>
                                <li>Vencimiento #9<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&vencimientos=<?php echo strtolower($datos['lote10'])."&vencimiento=3"; ?>" class=""><?php echo strtolower($datos['fechaVencimiento9']); ?></a></span></li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($datos['fechaVencimiento10']) {
                            ?>
                                <li>Vencimiento #10<span class="pull-right label-danger label"><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&vencimientos=<?php echo strtolower($datos['lote10'])."&vencimiento=3"; ?>" class=""><?php echo strtolower($datos['fechaVencimiento10']); ?></a></span></li>
                            <?php
                            }
                            ?>

                            
                            

                            <li>Compra<span class="pull-right label-danger label"><?php echo strtolower($datos['price_buy']); ?></span></li>
                            <li>Historial de compras<span class="pull-right label-info label"><?php echo strtolower($datos['totalBuy']); ?></span></li>
                            <li>Historial de ventas<span class="pull-right label-info label"><?php echo strtolower($datos['totalSales']); ?></span></li>
                            <li>Productos en inventario<span class="pull-right label-info label"><?php echo strtolower($datos['quantityProduct']); ?></span></li>
                            </center>
                            <br>











                            <br>


                            <center><button class="btn m-btn--square btn-info" alt="default" data-toggle="modal" data-target=".b30s-modal-sm" class="model_img img-responsive">HISTORIAL DE FACTURACION</button></center>


                            <div class="modal fade b30s-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="mySmallModalLabel">Historial de facturacion.</h4>
                                        </div>



                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th><b>
                                                            <center>Factura #</center>
                                                        </b></th>
                                                    <th><b>
                                                            <center>Producto</center>
                                                        </b></th>
                                                    <th><b>
                                                            <center>Tipo</center>
                                                        </b></th>
                                                    <th><b>
                                                            <center>Precio</center>
                                                        </b></th>
                                                    <th><b>
                                                            <center>Cantidad</center>
                                                        </b></th>
                                                    <th><b>
                                                            <center>Fecha</center>
                                                        </b></th>
                                                    <th><b>
                                                            <center>Devolucion</center>
                                                        </b></th>
                                                    <th><b>
                                                            <center>Cambio</center>
                                                        </b></th>
                                                    <th><b>
                                                            <center>Ver</center>
                                                        </b></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                while ($datosDet = mysqli_fetch_array($dataDet)) { ?>
                                                    <tr>
                                                        <th>
                                                            <center><?php echo $datosDet['bills_idbills']; ?></center>
                                                        </th>
                                                        <th>
                                                            <center><?php echo strtolower($datosDet['nombre']); ?></center>
                                                        </th>
                                                        <th>
                                                            <center><?php if ($datosDet['typeBill'] == 1) {
                                                                        echo "Venta";
                                                                    } else {
                                                                        echo "Compra";
                                                                    } ?></center>
                                                        </th>

                                                        <th>
                                                            <center><?php echo $datosDet['precioTotal']; ?></center>
                                                        </th>
                                                        <th>
                                                            <center><?php echo $datosDet['cantidad']; ?></center>
                                                        </th>
                                                        <th>
                                                            <center><?php echo $datosDet['dateRegister']; ?></center>
                                                        </th>
                                                        <th>
                                                            <a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $datosDet['bills_idbills']; ?>&devolucion=<?php echo $datosDet['idbillDetails']; ?>" class="btn m-btn--square btn-danger">DEVOLUCION</a>
                                                        </th>
                                                        <th>
                                                            <a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $datosDet['bills_idbills']; ?>&cambio=<?php echo $datosDet['idbillDetails']; ?>" class="btn m-btn--square btn-info">CAMBIO</a>
                                                        </th>
                                                        <th>
                                                            <a href="<?php echo URL; ?>facturas/detalles?id=<?php echo $datosDet['bills_idbills']; ?>&detalles" class="btn m-btn--square btn-success">VER</a>
                                                        </th>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>




                                        <div class="modal-body">
                                        </div>
                                    </div>
                                </div>
                            </div>






                        </ul>
<!--

                        <div class="user-btm-box">
                            <div class="col-md-12 col-sm-6 text-center">
                                <p class="text-success"><b>Ingresos</b></p>
                                <h4>
                                    <?php

                                   // echo "SUMA DE VENTAS DESDE LAS FACTURAS";
                                    ?>
                                </h4>
                            </div>
                            <div class="col-md-12 col-sm-6 text-center">
                                <p class="text-danger"><b>Gastos</b></p>
                                <h4>
                                    <?php

                                  //  echo "SUMA DE COMPRAS DESDE LAS FACTURAS";
                                    ?>
                                </h4>
                            </div>
                            <div class="col-md-12 col-sm-12 text-center">
                                <p class="text-blue"><b>Balance general</b></p>
                                <h3>
                                    <?php

                                   // echo "BALANCE DESDE LAS FACTURAS";
                                    ?>
                                </h3>
                            </div>
                        </div>

-->

                    </div>




                </div>
            </div>
            <div class="col-md-12 col-xs-12 col-lg-8">
                <div class="white-box">
                    <ul class="nav customtab nav-tabs" role="tablist">


















                        <li role="presentation" class="nav-item col-lg-12"><a href="#messages" class="nav-link active" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs">
                                    <center><b>Editar</b></center>
                                </span></a></li>



                    </ul>
                    <div class="tab-content">

                        <?php if (isset($_GET['configurar']) && isset($_SESSION['administrador']) OR isset($_SESSION['contable'])) { ?>


                            <div class="tab-pane active" id="productos" aria-expanded="false">
                                <?php
                                if ($datos1['stateBD'] == 1) { ?>
                                <?php if (isset($_SESSION['administrador']) OR isset($_SESSION['contable'])) { ?>

                                    <form id="formulario" method="POST" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">

                                        <input type="hidden" name="idProducto" value=" <?php echo $idGet; ?> ">
                                        <input type="hidden" name="codeProduct" value=" <?php echo $_GET['codigos']; ?> ">
                                        <input type="hidden" name="cod" value=" <?php echo $_GET['cod']; ?> ">
                                        <input type="hidden" name="precioID" value=" <?php echo $_GET['precio']; ?> ">
                                        <input type="hidden" name="loteID" value=" <?php echo $_GET['lote']; ?> ">
                                        <input type="hidden" name="vencimientoID" value=" <?php echo $_GET['vencimiento']; ?> ">

                                        <?php
                                        if (isset($_GET['inventario'])) { ?>



                                            <div class="form-group m-form__group">
                                                <label  for="">
                                                    Inventario
                                                </label>

                                                <input type="hidden" value="1" name="inventario">

                                                <select name="idInventory" id="idInventory" class="form-control">


                                                <?php while ($datos1 = mysqli_fetch_array($arrayInventory)) { ?>
                                                    <option value="<?php echo strtolower($datos1['nameInventory']); ?>"><?php echo strtolower($datos1['nameInventory']) . "<br>"; ?>
                                                    </option>
                                                <?php } ?>



                                                </select>

                                                <span class="m-form__help">
                                                </span>
                                                <span class="m--font-warning">
                                                    <small>Ingrese <b class="m--font-danger">nuevamente</b> el inventario en el cual desea guardar el producto.</small>
                                                </span>
                                            </div>
                                            <center>
                                        <?php } else { ?>
                                            <center>
                                            <label  for="">
                                                <b>Linea de producto:</b> <?php
                                                $idInventario = $datos['inventory_idinventory'];
                                                $sql = "SELECT * FROM inventorydetails WHERE inventory_idinventory=$idInventario";
                                                $query = $con->returnConsulta($sql);
                                                $array = mysqli_fetch_array($query);
                                                $name = $array['nameInventory'];
                                                $idInventory = $array['inventory_idinventory'];
                                                ?>
                                            </label>

                                            <input type="hidden" value="<?php echo strtolower($name); ?>" name="nameInventory">
                                            <input type="hidden" value="<?php echo strtolower($name); ?>" name="idInventory">
                                            <input type="hidden" value="0" name="inventario">
                                          
                                            <?php echo ucfirst($name); ?>
                                            <br>


                                <?php if (isset($_SESSION['administrador']) ) { ?>
                                            <div class="btn-group">
                                                <a class="btn btn-success active" href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&inventario">
                                                    <i class="glyphicon glyphicon-align-center" aria-hidden="true"></i>Cambiar de Inventario
                                                </a>
                                            </div>

                                        <?php } ?>
                                        <?php } ?>
                                        <?php if (isset($_SESSION['administrador']) ) { ?>


                                            <?php 
                                        if($rowCodes<=10){ ?>
                                        <div class="btn-group">
                                            <a class="btn btn-success active" href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&codigos=&cod=<?php echo $rowCodes; ?>">
                                                <i class="glyphicon glyphicon-align-center" aria-hidden="true"></i>Agregar Codigo
                                            </a>
                                        </div>
                                            <?php } ?>
                                            <?php } ?>

                                            <?php 
                                        if($rowLotes<=10){ /*?>
                                            <div class="btn-group">
                                            <a class="btn btn-success active" href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&lotes=&lote=<?php echo $rowLotes; ?>">
                                                    <i class="glyphicon glyphicon-align-center" aria-hidden="true"></i>Agregar Lote
                                                </a>   
                                            </div>
                                                <?php } ?>

                                        <?php 
                                        if($rowVencimiento<=10){ ?>
                                            <div class="btn-group">
                                            <a class="btn btn-success active" href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&vencimientos=&vencimiento=<?php echo $rowVencimiento; ?>">
                                                    <i class="glyphicon glyphicon-align-center" aria-hidden="true"></i>Agregar Fecha de vencimiento
                                                </a>   
                                            </div>
                                        <?php */} ?>

                                        


                                <?php if (isset($_SESSION['administrador']) ) { ?>
                                                

    
                                        <?php 
                                        if($rowPrices<=10){ ?>

                                        <div class="btn-group">
                                            <a class="btn btn-success active" href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&precios=&precio=<?php echo $rowPrices; ?>">
                                                <i class="glyphicon glyphicon-align-center" aria-hidden="true"></i>Agregar Precio
                                            </a>    
                                        </div>

                                        <?php } ?>
                                        

                                        <div class="btn-group">
                                            
                                            <a class="btn btn-success active" href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&cantidad=<?php echo $datos['totalItem']; ?>">
                                                <i class="glyphicon glyphicon-align-center" aria-hidden="true"></i>Modificar Cantidad
                                            </a>    
                                        </div>

                                    <?php } ?>
                                        


                                            </center>
                                            <br>
                                        <div class="form-group m-form__group">
                                            <label  for="nameProduct">
                                                Nombre
                                            </label>
                                            <input name='nameProduct' type="text" class="form-control m-input m-input--air m-input--pill" id="nameProduct"  value="<?php echo strtoupper($datos['nameProduct']); ?>">

                                        </div>

                                        <?php if (isset($_GET['codigos'])) { ?>


                                        <div class="row lg-12">
                                            <div class="col-lg-12">
                                                <div class="form-group m-form__group">
                                                    <label  for="codeProduct">
                                                        Codigo
                                                    </label>
                                                    <input name='codeProduct' type="text"  class="form-control m-input m-input--air m-input--pill" id="codeProduct"  value="<?php echo $_GET['codigos']; ?>">


                                                </div>
                                            </div>
                                           
                                        </div>



                                      


                                        <?php } 
                                        
                                        if(isset($_GET['precios'])){
                                        
                                        ?>

                                        <div class="row lg-12">
                                            <div class="col-lg-12">
                                                <div class="form-group m-form__group">
                                                    <label  for="">
                                                        Precio de venta
                                                    </label>
                                                    <input name='precioVenta' type="number" class="form-control m-input m-input--air m-input--pill" id=""  value="<?php echo $_GET['precios']; ?>">
                                                </div>
                                            </div>
                                        </div>

                                 

                                        
                                        <?php } 
                                        
                                        if(isset($_GET['cantidad'])){
                                        
                                        ?>

                                        <div class="row lg-12">
                                            <div class="col-lg-12">
                                                <div class="form-group m-form__group">
                                                    <label  for="">
                                                        Cantidad
                                                    </label>
                                                    <input name='cantidadProductos' type="number" class="form-control m-input m-input--air m-input--pill" id=""  value="<?php echo $_GET['cantidad']; ?>">
                                                </div>
                                            </div>
                                        </div>


                                        
                                        <?php
                                         }if(isset($_GET['lote'])){
                                        
                                            ?>
    
                                            <div class="row lg-12">
                                                <div class="col-lg-12">
                                                    <div class="form-group m-form__group">
                                                        <label  for="">
                                                            Lote
                                                        </label>
                                                        <input name='lote' type="text" class="form-control m-input m-input--air m-input--pill" id=""  value="<?php echo $_GET['lotes']; ?>">
                                                    </div>
                                                </div>
                                            </div>
    
    
                                            
                                        <?php
                                        ?>  <?php
                                         }if(isset($_GET['vencimiento'])){
                                   
                                       ?>

                                       <div class="row lg-12">
                                           <div class="col-lg-12">
                                               <div class="form-group m-form__group">
                                                   <label  for="">
                                                       Fecha de vencimiento
                                                   </label>
                                                   <input name='vencimiento' type="date" class="form-control m-input m-input--air m-input--pill" id=""  value="<?php echo $_GET['vencimientos']; ?>">
                                               </div>
                                           </div>
                                       </div>


                                       
                                   <?php
                                        }if(!isset($_GET['cantidad'])){
                                        
                                            ?>
    
                                            <div class="row lg-12">
                                                <div class="col-lg-12">
                                                    <div class="form-group m-form__group">
                                                     
                                                        <input name='cantidadProductos' type="hidden" class="form-control m-input m-input--air m-input--pill" id=""  value="<?php echo strtoupper($datos['quantityProduct']); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php 
                                         }                                         
                                        ?>

                                        <div class="form-group m-form__group">
                                            <label  for="">
                                                Precio de compra
                                            </label>
                                            <input name='priceBuy' type="number" class="form-control m-input m-input--air m-input--pill" id=""  value="<?php echo strtolower($datos['price_buy']); ?>">

                                            <span class="m-form__help">
                                                <span class="m--font-">
                                                    <small>Por favor ingrese los cambios a realizar en el precio de compra.</small>
                                                </span>
                                            </span>
                                        </div>

                                        <input name='unidadesCaja' type="hidden" class="form-control m-input m-input--air m-input--pill" id=""  value="<?php echo strtolower($datos['unidadesCaja']); ?>">
                                        <input name='presentacionFarmaceutica' type="hidden" class="form-control m-input m-input--air m-input--pill" id=""  value="<?php echo strtoupper($datos['presentacionFarmaceutica']); ?>">
                                        <input name='consentracion' type="hidden" class="form-control m-input m-input--air m-input--pill" id=""  value="<?php echo strtoupper($datos['consentracion']); ?>">
                                        <input name='laboratorio' type="hidden" class="form-control m-input m-input--air m-input--pill" id=""  value="<?php echo strtoupper($datos['laboratorio']); ?>">
                                        <input name='registroSanitario' type="hidden" class="form-control m-input m-input--air m-input--pill" id=""  value="<?php echo strtoupper($datos['registroSanitario']); ?>">
                                        
                                        <div class="form-group m-form__group">
                                            <label  for="">
                                                IVA
                                            </label>
                                            <?php 
                                        if($datos['iva']==19){
                                        ?>
                                        <select id="optionvalue" name="iva" id="iva" class="form-control m-input m-input--air m-input--pill"">
                                                <option value="19">19%</option>
                                                <option value="5">5%</option>
                                                <option value="0">0%</option>
                                        </select>
                                        <?php        
                                            }elseif($datos['iva']==5){
                                        ?>
                                        <select id="optionvalue" name="iva" id="iva" class="form-control m-input m-input--air m-input--pill"">
                                                <option value="5">5%</option>
                                                <option value="19">19%</option>
                                                <option value="0">0%</option>
                                        </select>
                                        <?php        
                                            }elseif($datos['iva']==0){
                                        ?>
                                        <select id="optionvalue" name="iva" id="iva" class="form-control m-input m-input--air m-input--pill"">
                                                <option value="0">0%</option>
                                                <option value="5">5%</option>
                                                <option value="19">19%</option>
                                        </select>
                                        <?php        
                                            }else{
                                        ?>
                                        <select id="optionvalue" name="iva" id="iva" class="form-control m-input m-input--air m-input--pill"">
                                                <option value="19">19%</option>
                                                <option value="5">5%</option>
                                                <option value="0">0%</option>
                                        </select>
                                        <?php        
                                            }
                                        ?>
                                        </div>

                                            
                                            <div class="form-group m-form__group">


                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    <b>Foto</b>
                                                </font>
                                            </font>
                                            <span class="m-form__help"><br>
                                                <small>Ingrese una nueva fotos si desea cambiar la actual.</small>
                                            </span>
                                            <div class="m-input-icon" id="input8">
                                                <input value="1" type="file" class="form-control m-input m-input--air m-input--pill" placeholder="" name="photoProduct" id="photoProduct">
                                            </div>
                                            <br>


                                            <label  for="">
                                                ELIMINAR
                                            </label>
                                            <select id="optionvalue" name="eliminarProducto" id="eliminarProducto" class="form-control m-input m-input--air m-input--pill"">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                            <br><br>

                                            <center><button class="btn m-btn--square btn-warning" type="button" id="botonEditar">EDITAR</button></center><br>

                                    </form>
                                   
                                <?php }  ?>


                            <?php } elseif ($datos1['stateBD'] == 2) { ?>

                                <h2>No se puede realizar cambios en un producto desactivado.</h2>

                            <?php } ?>
                            </div>


                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>


    </div>





<script>
$("#botonEditar").click(function() {

    var answer = $('#answerJS');
    var respuesta = $('#respuesta');
    var alertJS = $('#alertJS');

    var answer2 = $('#answerJS2');
    var respuesta2 = $('#respuesta2');

    var datos = $("#formulario").serialize();

    $.ajax({
        type: "POST",
        url: "../../irocket/controllers/ajax/ajax_validationProductsUpdate.php",
        data: datos,
        success: function(data) {
            if (data.indexOf('1') != -1) {
                respuesta2.removeClass('hiddenDIV');
                answer2.html("Recuerde que los campos con * son obligatorios o verifique que el codigo ingresado no esta en uso");
            } else {
                $("#formulario").submit();
            }
        }

    });
});

$('#formulario').keyup(function(e) {
    if(e.keyCode == 13) {
        var answer = $('#answerJS');
        var respuesta = $('#respuesta');
        var alertJS = $('#alertJS');

        var answer2 = $('#answerJS2');
        var respuesta2 = $('#respuesta2');

        var datos = $("#formulario").serialize();

        $.ajax({
            type: "POST",
            url: "../../irocket/controllers/ajax/ajax_validationProductsUpdate.php",
            data: datos,
            success: function(data) {
                if (data.indexOf('1') != -1) {
                    respuesta2.removeClass('hiddenDIV');
                    answer2.html("Recuerde que los campos con * son obligatorios o verifique que el codigo ingresado no esta en uso");
                } else {
                    $("#formulario").submit();
                }
            }

        });
    }
});

</script>


</div>
<!-- /.right-sidebar -->
</div>