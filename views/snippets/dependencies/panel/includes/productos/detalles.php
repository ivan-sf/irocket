<?php
$model = new models\Products();
$con = new models\Conexion();
$idGet = $_GET['id'];
$array = $model->set("idproduct",$idGet);
$data = $model->view();
$datos = mysqli_fetch_array($data);
$modelInventory = new models\Inventory();
$arrayInventory = $modelInventory->array();
$sql1 = "SELECT * FROM products WHERE idproducts='$idGet'";
$query1 = $con->returnConsulta($sql1);
$datos1 = mysqli_fetch_array($query1);
if ($datos1['stateBD'] == 1) {

}else{
    header("location:" . URL . "productos?error=delete");
}
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
                        <div class="modal-body col-lg-9" >
                           <img src="<?php echo URL . $datos['ruta']; ?>" width="480"  alt="img">
                       </div>
                   </div>
               </div>
           </div>
           <!-- /.row -->

           <div class="row">
            <div class="col-md-12 col-xs-12 col-lg-4">
                <div class="white-box">
                    <div class="user-bg"> <img width="100%" alt="user" src="<?php echo URL;?>views/plugins/images/large/5.jpg">
                        <div class="overlay-box">
                            <div class="user-content">



                                <a href="javascript:void(0)" alt="default" data-toggle="modal" data-target=".bs-s-sm"><img src="<?php echo URL . $datos['ruta']; ?>" height="120"  alt="img">
                                </a>
                                <h4 class="text-white"><?php echo strtoupper($datos['nameProduct']); ?></h4>

                            </div>

                        </div>
                    </div>

                    <div class="white-box"><br>

                        <h3 class="box-title"><center>Caracteristicas</center></h3>
                        <ul class="basic-list">
                            <li>Codigo<span class="pull-right label-danger label"><?php echo strtoupper($datos['codeProduct']); ?></span></li>
                            <li>Codigo  promocion<span class="pull-right label-purple label"><?php echo strtoupper($datos['codeProduct_promotion']); ?></span></li>
                            <li>Venta<span class="pull-right label-success label"><?php echo strtoupper($datos['precio']); ?></span></li>
                            <li>Venta promocion<span class="pull-right label-warning label"><?php echo strtoupper($datos['precio_promotion']); ?></span></li>
                            <li>Compra<span class="pull-right label-info label"><?php echo strtoupper($datos['price_buy']); ?></span></li>
                            <li>Historial de compras<span class="pull-right label-info label"><?php echo strtoupper($datos['totalBuy']); ?></span></li>
                            <li>Productos en inventario<span class="pull-right label-info label"><?php echo strtoupper($datos['totalItemsInventory']); ?></span></li>
                            <li>Ventas totales<span class="pull-right label-info label"><?php echo strtoupper($datos['totalSales']); ?></span></li>
                            <li>Ventas promocion totales<span class="pull-right label-info label"><?php echo strtoupper($datos['totalSales_prom']); ?></span></li>
                        <center><h5><?php echo ucfirst($datos['descriptionProduct']); ?></h5></center>
                        </ul>

                        
                        <div class="user-btm-box">
                            <div class="col-md-12 col-sm-6 text-center">
                                <p class="text-success"><b>Ingresos</b></p>
                                <h4>
                                    <?php 
                                    $totalIngresosGenerales = $datos['precio'] * $datos['totalSales'];
                                    $totalIngresosPromocion = $datos['precio_promotion'] * $datos['totalSales_prom'];
                                    $totalIngresos = $totalIngresosGenerales + $totalIngresosPromocion;
                                    echo "$" . number_format($totalIngresos); 
                                    ?>
                                </h4>
                            </div>
                            <div class="col-md-12 col-sm-6 text-center">
                                <p class="text-danger"><b>Gastos</b></p>
                                <h4>
                                    <?php 
                                    $totalGastosGenerales = $datos['price_buy'] * $datos['totalBuy'];
                                    $totalGastosPromocion = $datos['price_buy_prom'] * $datos['totalBuy_prom'];
                                    $totalGastos = $totalGastosGenerales + $totalGastosPromocion;
                                    echo "-$" . number_format($totalGastos); 
                                    ?>
                                </h4>
                            </div>
                            <div class="col-md-12 col-sm-12 text-center">
                                <p class="text-blue"><b>Balance general</b></p>
                                <h3>
                                    <?php 
                                    $ganancias = $totalIngresos - $totalGastos;
                                    echo "$" . number_format($ganancias); 
                                    ?>
                                </h3>
                            </div>
                        </div>
                    


                    </div>
                    



                </div>
            </div>
            <div class="col-md-12 col-xs-12 col-lg-8">
                <div class="white-box">
                    <ul class="nav customtab nav-tabs" role="tablist">















                        <?php if (isset($_GET['detalles'])) { ?>
                        

                        <li role="presentation" class="nav-item col-lg-6"><a href="#messages" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>

                        <li role="presentation" class="nav-item col-lg-6"><a href="#settings" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-times"></i></span> <span class="hidden-xs"><center><b>Eliminar</b></center></span></a></li>

                        <?php }elseif (isset($_GET['configurar'])) { ?>
                        

                        <li role="presentation" class="nav-item col-lg-6"><a href="#messages" class="nav-link active" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>

                        <li role="presentation" class="nav-item col-lg-6"><a href="#settings" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-times"></i></span> <span class="hidden-xs"><center><b>Eliminar</b></center></span></a></li>

                        <?php }elseif (isset($_GET['eliminar'])) { ?>
                     

                        <li role="presentation" class="nav-item col-lg-6"><a href="#messages" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>

                        <li role="presentation" class="nav-item col-lg-6"><a href="#settings" class="nav-link active" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-times"></i></span> <span class="hidden-xs"><center><b>Eliminar</b></center></span></a></li>

                        <?php }else ?>
                    </ul>
                    <div class="tab-content">

                        <?php if (isset($_GET['detalles'])) { ?>
                        <div class="tab-pane active" id="home" aria-expanded="true">


                            <div class="row">



                                <?php //while($datos1 = mysqli_fetch_array($arrayInventory)) { ?>
                                <div class="col-lg-4 col-md- col-sm-4 col-xs-12">
                                    <div class="white-box">
                                        <div class="product-img">
                                            <img src="<?php echo URL; ?>views/plugins/images/chair.jpg">
                                            <div class="pro-img-overlay"><a href="javascript:void(0)" class="bg-info"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="bg-danger"><i class="ti-trash"></i></a></div>
                                        </div>
                                        <div class="product-text">
                                            <span class="pro-price bg-danger"><?php //echo $datos1['idinventory']; ?>Y</span>
                                            <h3 class="box-title m-b-0">X</h3>
                                            <small class="text-muted db">Z</small>
                                        </div>
                                    </div>
                                </div>
                                <?php //} ?>




                            </div>

                        </div>

                        <div class="tab-pane" id="messages" aria-expanded="false">


                            <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >

                                <input type="hidden" name="idUpdate" value=" <?php echo $idGet; ?> ">
                                
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Inventario 
                                    </label>

                                    <select id="optionvalue" name="idInventory" id="idInventory" class="form-control m-input m-input--air m-input--pill"">


                                        <?php while($datos1 = mysqli_fetch_array($arrayInventory)) { ?>
                                        <option value="<?php echo strtoupper($datos1['nameInventory']);?>">
                                            <?php echo strtoupper($datos1['nameInventory']) . "<br>"; ?>    
                                        </option>
                                        <?php } ?>



                                    </select>
                                </select>

                                <span class="m-form__help">
                                </span>
                                <span class="m--font-warning">
                                    <small>Ingrese <b class="m--font-danger">nuevamente</b> el inventario en el cual desea guardar el producto.</small>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Nombre 
                                </label>
                                <input name='nombreProducto' type="text" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['nameProduct']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el nombre.</small>
                                    </span>
                                </span>
                            </div>

                                <input name='codeProduct' type="hidden" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['codeProduct']); ?>">

                                <input name='codeProductProm' type="hidden" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['codeProduct_promotion']); ?>">


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Precio de venta
                                </label>
                                <input name='priceSale' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['precio']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el precio de venta.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Precio de venta promocion
                                </label>
                                <input name='priceSaleProm' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['precio_promotion']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el precio de venta en promocion.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Precio de compra
                                </label>
                                <input name='priceBuy' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['price_buy']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el precio de compra.</small>
                                    </span>
                                </span>
                            </div>
                            

                            <input name='priceBuyProm' type="hidden" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['price_buy_prom']); ?>">

                            


                                <label for="exampleInputEmail1">
                                </label>
                                <input name='limit' type="hidden" class="form-control m-input m-input--air m-input--pill" id="limit" aria-describedby="emailHelp" value="<?php echo $datos['min_limit_items']; ?>">

                                <span class="m--font-">
                                </span>


                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                <b>Foto</b>
                            </font></font>
                            <span class="m-form__help"><br>
                                <small>Ingrese una nueva fotos si desea cambiar la actual.</small>
                            </span>
                            <div class="m-input-icon" id="input8">
                                <input value="1" type="file" class="form-control m-input m-input--air m-input--pill" placeholder="" name="photoProduct" id="photoProduct">
                            </div>
                            <br>




                            <div class="form-group m-form__group row">
                                <label class="col-form-label col-lg-12 col-sm-12">
                                    Descripcion
                                </label>
                                <div class="col-lg-12 col-md-9 col-sm-12">
                                    <textarea name="descripcionInventario" class="form-control m-input m-input--air m-input--pill" id="" maxlength="800" placeholder="" rows="6"><?php echo $datos['descriptionProduct']; ?></textarea>
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios para modificar la descripcion.</small>
                                    </span>
                                </div>
                            </div>

                            <br><br>

                            <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center><br><br>

                        </form>
                    </div>


                    <div class="tab-pane" id="settings" aria-expanded="false">
                        <?php if(isset($_SESSION['administrador'])){ ?>
                        <br>
                        <center> <div class="col-lg-12 alert alert-info"> Esta a punto de eliminar un producto, recuerde que si realiza esta accion ya no tendra disponible este producto en ningun modulo. </div></center>


                        <div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="mySmallModalLabel">Alerta! esta seguro de realizar esta accion?</h4>
                                    </div>
                                    <div class="modal-body">
                                       <form method="POST">
                                        <input type="hidden" name="iduser" value="<?php echo $_SESSION['adminUserNew']; ?>">
                                        <input type="hidden" name="idDelete" value=" <?php echo $idGet; ?> ">
                                        <button class="btn m-btn--square btn-danger" type="submit">Si</button>
                                        <button type="button" class="btn m-btn--square btn-success" data-dismiss="modal" aria-hidden="true">No</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br> 
                    <center><button class="btn m-btn--square btn-danger" alt="default" data-toggle="modal" data-target=".bs-modal-sm" class="model_img img-responsive">ELIMINAR PRODUCTO</button></center>
                        <?php }else{ ?>
                        <div class="alert alert-danger"> No tienes permisos para eliminar los productos, debes ingresar con una cuenta de administrador. </div>
                        <?php } ?>
                        
                        


                </div>
















                <?php }elseif(isset($_GET['configurar'])) { ?>


                <div class="tab-pane" id="home" aria-expanded="true">

                    <div class="row">

                        <?php //while($datos1 = mysqli_fetch_array($arrayInventory)) { ?>
                        <div class="col-lg-4 col-md- col-sm-4 col-xs-12">
                            <div class="white-box">
                                <div class="product-img">
                                    <img src="<?php echo URL; ?>views/plugins/images/chair.jpg">
                                    <div class="pro-img-overlay"><a href="javascript:void(0)" class="bg-info"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="bg-danger"><i class="ti-trash"></i></a></div>
                                </div>
                                <div class="product-text">
                                    <span class="pro-price bg-danger"><?php //echo $datos1['idinventory']; ?>Y</span>
                                    <h3 class="box-title m-b-0">X</h3>
                                    <small class="text-muted db">Z</small>
                                </div>
                            </div>
                        </div>
                        <?php //} ?>

                    </div>

                </div>

                <div class="tab-pane active" id="messages" aria-expanded="false">


                    <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >

                                <input type="hidden" name="idUpdate" value=" <?php echo $idGet; ?> ">

                                <?php 
                                if (isset($_GET['inventario'])) { ?>
                                     
                                 
                                
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Inventario 
                                    </label>

                                    <select id="optionvalue" name="idInventory" id="idInventory" class="form-control m-input m-input--air m-input--pill"">


                                        <?php while($datos1 = mysqli_fetch_array($arrayInventory)) { ?>
                                        <option value="<?php echo strtoupper($datos1['nameInventory']);?>">
                                            <?php echo strtoupper($datos1['nameInventory']) . "<br>"; ?>    
                                        </option>
                                        <?php } ?>



                                    </select>
                                </select>

                                <span class="m-form__help">
                                </span>
                                <span class="m--font-warning">
                                    <small>Ingrese <b class="m--font-danger">nuevamente</b> el inventario en el cual desea guardar el producto.</small>
                                </span>
                            </div>

                            <?php }else{ ?>
                                <label for="exampleInputEmail1">
                                    <b>Inventario:</b> <?php 
                                    $idInventario = $datos['inventory_idinventory'];
                                    $sql = "SELECT * FROM inventorydetails WHERE inventory_idinventory=$idInventario";
                                    $query = $con->returnConsulta($sql);
                                    $array = mysqli_fetch_array($query);
                                    $name = $array['nameInventory'];
                                    ?> 
                                </label>

                                        <input type="hidden"  value="<?php echo strtoupper($name);?>" name="idInventory">


                                    <?php echo ucfirst($name); ?><small><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&inventario"> cambiar inventario</a></small><br><br>
                            <?php } ?>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Nombre 
                                </label>
                                <input name='nombreProducto' type="text" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['nameProduct']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el nombre.</small>
                                    </span>
                                </span>
                            </div>

                            <input name='codeProduct' type="hidden" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['codeProduct']); ?>">

                            <input name='codeProductProm' type="hidden" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['codeProduct_promotion']); ?>">        


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Precio de venta
                                </label>
                                <input name='priceSale' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['precio']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el precio de venta.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Precio de venta promocion
                                </label>
                                <input name='priceSaleProm' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['precio_promotion']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el precio de venta en promocion.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Precio de compra
                                </label>
                                <input name='priceBuy' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['price_buy']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el precio de compra.</small>
                                    </span>
                                </span>
                            </div>
                            

                            <input name='priceBuyProm' type="hidden" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['price_buy_prom']); ?>">

                            


                                <label for="exampleInputEmail1">
                                </label>
                                <input name='limit' type="hidden" class="form-control m-input m-input--air m-input--pill" id="limit" aria-describedby="emailHelp" value="<?php echo $datos['min_limit_items']; ?>">

                                <span class="m--font-">
                                </span>


                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                <b>Foto</b>
                            </font></font>
                            <span class="m-form__help"><br>
                                <small>Ingrese una nueva fotos si desea cambiar la actual.</small>
                            </span>
                            <div class="m-input-icon" id="input8">
                                <input value="1" type="file" class="form-control m-input m-input--air m-input--pill" placeholder="" name="photoProduct" id="photoProduct">
                            </div>
                            <br>




                            <div class="form-group m-form__group row">
                                <label class="col-form-label col-lg-12 col-sm-12">
                                    Descripcion
                                </label>
                                <div class="col-lg-12 col-md-9 col-sm-12">
                                    <textarea name="descripcionInventario" class="form-control m-input m-input--air m-input--pill" id="" maxlength="800" placeholder="" rows="6"><?php echo $datos['descriptionProduct']; ?></textarea>
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios para modificar la descripcion.</small>
                                    </span>
                                </div>
                            </div>

                            <br><br>

                            <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center><br><br>

                        </form>
            </div>



            <div class="tab-pane" id="settings" aria-expanded="false">
                 <?php if(isset($_SESSION['administrador'])){ ?>
                        <br>
                        <center> <div class="col-lg-12 alert alert-info"> Esta a punto de eliminar un producto, recuerde que si realiza esta accion ya no tendra disponible este producto en ningun modulo. </div></center>


                        <div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="mySmallModalLabel">Alerta! esta seguro de realizar esta accion?</h4>
                                    </div>
                                    <div class="modal-body">
                                       <form method="POST">
                                        <input type="hidden" name="iduser" value="<?php echo $_SESSION['adminUserNew']; ?>">
                                        <input type="hidden" name="idDelete" value=" <?php echo $idGet; ?> ">
                                        <button class="btn m-btn--square btn-danger" type="submit">Si</button>
                                        <button type="button" class="btn m-btn--square btn-success" data-dismiss="modal" aria-hidden="true">No</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br> 
                    <center><button class="btn m-btn--square btn-danger" alt="default" data-toggle="modal" data-target=".bs-modal-sm" class="model_img img-responsive">ELIMINAR PRODUCTO</button></center>
                        <?php }else{ ?>
                        <div class="alert alert-danger"> No tienes permisos para eliminar los productos, debes ingresar con una cuenta de administrador. </div>
                        <?php } ?>


        </div>













        <?php }elseif(isset($_GET['eliminar'])) { ?>

        <div class="tab-pane" id="home" aria-expanded="true">

            <div class="row">

                <?php //while($datos1 = mysqli_fetch_array($arrayInventory)) { ?>
                <div class="col-lg-4 col-md- col-sm-4 col-xs-12">
                    <div class="white-box">
                        <div class="product-img">
                            <img src="<?php echo URL; ?>views/plugins/images/chair.jpg">
                            <div class="pro-img-overlay"><a href="javascript:void(0)" class="bg-info"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="bg-danger"><i class="ti-trash"></i></a></div>
                        </div>
                        <div class="product-text">
                            <span class="pro-price bg-danger"><?php //echo $datos1['idinventory']; ?>Y</span>
                            <h3 class="box-title m-b-0">X</h3>
                            <small class="text-muted db">Z</small>
                        </div>
                    </div>
                </div>
                <?php //} ?>

            </div>

        </div>

        <div class="tab-pane" id="messages" aria-expanded="false">


            <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >

                                <input type="hidden" name="idUpdate" value=" <?php echo $idGet; ?> ">
                                
                                <?php 
                                if (isset($_GET['inventario'])) { ?>
                                     
                                 
                                
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Inventario 
                                    </label>

                                    <select id="optionvalue" name="idInventory" id="idInventory" class="form-control m-input m-input--air m-input--pill"">


                                        <?php while($datos1 = mysqli_fetch_array($arrayInventory)) { ?>
                                        <option value="<?php echo strtoupper($datos1['nameInventory']);?>">
                                            <?php echo strtoupper($datos1['nameInventory']) . "<br>"; ?>    
                                        </option>
                                        <?php } ?>



                                    </select>
                                </select>

                                <span class="m-form__help">
                                </span>
                                <span class="m--font-warning">
                                    <small>Ingrese <b class="m--font-danger">nuevamente</b> el inventario en el cual desea guardar el producto.</small>
                                </span>
                            </div>

                            <?php }else{ ?>
                                <label for="exampleInputEmail1">
                                    <b>Inventario:</b> <?php 
                                    $idInventario = $datos['inventory_idinventory'];
                                    $sql = "SELECT * FROM inventorydetails WHERE inventory_idinventory=$idInventario";
                                    $query = $con->returnConsulta($sql);
                                    $array = mysqli_fetch_array($query);
                                    $name = $array['nameInventory'];
                                    ?> 
                                </label>
                                        <input type="hidden"  value="<?php echo strtoupper($name);?>" name="idInventory">
                                
                                    <?php echo ucfirst($name); ?><small><a href="<?php echo URL; ?>productos/detalles?id=<?php echo $_GET['id'] ?>&configurar&inventario"> cambiar inventario</a></small><br><br>
                            <?php } ?>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Nombre 
                                </label>
                                <input name='nombreProducto' type="text" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['nameProduct']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el nombre.</small>
                                    </span>
                                </span>
                            </div>

                            
                            <input name='codeProduct' type="hidden" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['codeProduct']); ?>">

                            <input name='codeProductProm' type="hidden" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['codeProduct_promotion']); ?>">        


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Precio de venta
                                </label>
                                <input name='priceSale' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['precio']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el precio de venta.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Precio de venta promocion
                                </label>
                                <input name='priceSaleProm' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['precio_promotion']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el precio de venta en promocion.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Precio de compra
                                </label>
                                <input name='priceBuy' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['price_buy']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el precio de compra.</small>
                                    </span>
                                </span>
                            </div>
                            

                            <input name='priceBuyProm' type="hidden" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos['price_buy_prom']); ?>">

                            


                                <label for="exampleInputEmail1">
                                </label>
                                <input name='limit' type="hidden" class="form-control m-input m-input--air m-input--pill" id="limit" aria-describedby="emailHelp" value="<?php echo $datos['min_limit_items']; ?>">

                                <span class="m--font-">
                                </span>


                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                <b>Foto</b>
                            </font></font>
                            <span class="m-form__help"><br>
                                <small>Ingrese una nueva fotos si desea cambiar la actual.</small>
                            </span>
                            <div class="m-input-icon" id="input8">
                                <input value="1" type="file" class="form-control m-input m-input--air m-input--pill" placeholder="" name="photoProduct" id="photoProduct">
                            </div>
                            <br>




                            <div class="form-group m-form__group row">
                                <label class="col-form-label col-lg-12 col-sm-12">
                                    Descripcion
                                </label>
                                <div class="col-lg-12 col-md-9 col-sm-12">
                                    <textarea name="descripcionInventario" class="form-control m-input m-input--air m-input--pill" id="" maxlength="800" placeholder="" rows="6"><?php echo $datos['descriptionProduct']; ?></textarea>
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios para modificar la descripcion.</small>
                                    </span>
                                </div>
                            </div>

                            <br><br>

                            <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center><br><br>

                        </form>
    </div>


    <div class="tab-pane active" id="settings" aria-expanded="false">
        <?php if(isset($_SESSION['administrador'])){ ?>
                        <br>
                        <center> <div class="col-lg-12 alert alert-info"> Esta a punto de eliminar un producto, recuerde que si realiza esta accion ya no tendra disponible este producto en ningun modulo. </div></center>


                        <div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="mySmallModalLabel">Alerta! esta seguro de realizar esta accion?</h4>
                                    </div>
                                    <div class="modal-body">
                                       <form method="POST">
                                        <input type="hidden" name="iduser" value="<?php echo $_SESSION['adminUserNew']; ?>">
                                        <input type="hidden" name="idDelete" value=" <?php echo $idGet; ?> ">
                                        <button class="btn m-btn--square btn-danger" type="submit">Si</button>
                                        <button type="button" class="btn m-btn--square btn-success" data-dismiss="modal" aria-hidden="true">No</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br> 
                    <center><button class="btn m-btn--square btn-danger" alt="default" data-toggle="modal" data-target=".bs-modal-sm" class="model_img img-responsive">ELIMINAR PRODUCTO</button></center>
                       <?php }else{ ?>
                        <div class="alert alert-danger"> No tienes permisos para eliminar los productos, debes ingresar con una cuenta de administrador. </div>
                        <?php } ?>


</div>

<?php } ?>
</div>
</div>
</div>
</div>


</div>








</div>
<!-- /.right-sidebar -->
</div>












