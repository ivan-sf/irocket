<?php 
$modelInventory = new models\Inventory();
$con = new models\Conexion();
$arrayInventory = $modelInventory->array();
$datos = mysqli_fetch_array($arrayInventory);
$rowInventory = $modelInventory->row();

$idGet = $_GET['id'];
$arrayInventory1 = $modelInventory->set("iduser",$idGet);
$dataUser = $modelInventory->dataUser();
$datos1 = mysqli_fetch_array($dataUser);

$modelProducts = new models\Products();
$con = new models\Conexion();
$arrayProducts = $modelProducts->arrayInventory($_GET['id']);
$arrayProducts2 = $modelProducts->arrayInventory2($_GET['id']);

  if ($datos1['stateBD'] == 1) {
        
    }else{
        header("location:" . URL . "inventarios?error=delete");
    }

?>
<div id="page-wrapper" style="min-height: 953px;">



            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Inventarios</h4> </div>

                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Panel</a></li>
                        <li><a href="#">Inventarios</a></li>
                        <li class="active">Detalles</li>
                    </ol>
                </div>
                    <!-- /.col-lg-12 -->
                </div>
                         <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>inventarios?catalogo" class="">Catalogo</a></button>
                        <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>inventarios/tabla?index" class="">Tabla</a></button>
                        <button class="btn m-btn--pill btn-badge"><a href="<?php echo URL; ?>inventarios/crear">Crear</a></button>
                    <br>
                    <br>

                    <div class="row">

                   

                    <div class="col-md-12 col-xs-12 col-lg-12">
                       
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="<?php echo URL;?>views/plugins/images/large/6.jpg">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="<?php echo URL;?>views/plugins/images/w.jpg" class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white"><?php echo strtoupper($datos1['nameInventory']); ?></h4>
                                        <h5 class="text-white"><?php echo strtoupper($datos1['descriptionInventory']); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box">
                                <div class="col-md-6 col-sm-6 text-center">
                                    <p class="text-purple"><b>Productos</b></p>
                                    <h1>

                                        <?php 
                                        $datos = mysqli_num_rows($arrayProducts2);
                                        echo $datos;
                                         ?>

                                    </h1>
                                </div>
                               <div class="col-md-6 col-sm-6 text-center">
                                    <p class="text-purple"><b>Items</b></p>
                                    <h1>

                                        <?php 
                                        $idInventario=$datos1['inventory_idinventory'];
                                        $sql = "SELECT * FROM products
                                                INNER JOIN productdetails
                                                ON idproducts=products_idproducts
                                                WHERE stateBD=1 AND inventory_idinventory='$idInventario'";
                                        $query = $con->returnConsulta($sql);
                                        $row = mysqli_num_rows($query);
                                        
                                        
                                        $total = 0;
                                        while ($array = mysqli_fetch_array($query)) {
                                            $total += $array['quantityProduct'];
                                        }
                                            echo $total;
                                         ?>

                                    </h1>
                                </div>
                               
                                
                            </div>

                        

                            <div class="user-btm-box">
                                <div class="col-md-12 col-sm-12 text-center">
                                    <p class="text-purple"><b>Valor total inventario</b></p>
                                    <h1>

                                        <?php 
                                        $sql3 = "SELECT * FROM movementdepositaccount
                                                WHERE typeMovement = 9";
                                        $query3 = $con->returnConsulta($sql3);
                                        $total3 = 0;
                                        while ($array3 = mysqli_fetch_array($query3)) {
                                            $total3 += $array3['saldo'];
                                        }
                                        if ($total3 <= 0) {
                                            $id = $_GET['id'];
                                            $sql = "SELECT * FROM products
                                                    INNER JOIN productdetails
                                                    ON idproducts=products_idproducts 
                                                    WHERE stateBD = 1 AND inventory_idinventory='$id'";
                                            $query = $con->returnConsulta($sql);
                                            $datos = mysqli_num_rows($query);
                                            $total = 0;
                                            while ($array = mysqli_fetch_array($query)) {
                                                $total += $array['price_buy']*$array['quantityProduct'];
                                            }
                                            $sql2 = "SELECT * FROM movementdepositaccount
                                                    WHERE typeMovement = 9";
                                            $query2 = $con->returnConsulta($sql2);
                                            $total2 = 0;
                                            while ($array = mysqli_fetch_array($query2)) {
                                                $total2 += $array['saldo'];
                                            }
                                            echo number_format($total);
                                        }else{
                                        
                                         ?>

                                    </h1>
                                    <h2>
                                        <small><small><small>No es posible obtener el valor actual del inventario por que tienes cuentas pendientes por pagar, debe cancelar los pagos correspondientes.</small></small></small><br>
                                        <?php 
                                        if ($total3>0) {
                                            echo "Saldo de inventarios <b> ".number_format($total3)."</b>";
                                        } 
                                        }
                                         ?>
                                    </h2>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 col-lg-12">
                        <div class="white-box">
                            <ul class="nav customtab nav-tabs" role="tablist">











                                <?php if (isset($_GET['configurar'])) { ?>

                                <li role="presentation" class="nav-item col-lg-4"><a href="#home" class="nav-link" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                                <span class="visible-xs"><i class="fa fa-rocket"></i></span>
                                <span class="hidden-xs"> <center><b>Productos</b></center></span></a>
                                </li>
                                
                                <li role="presentation" class="nav-item col-lg-4"><a href="#messages" class="nav-link active" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>

                                <li role="presentation" class="nav-item col-lg-4"><a href="#settings" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-times"></i></span> <span class="hidden-xs"><center><b>Eliminar</b></center></span></a>
                                </li>  
                                    
                                <?php }elseif (isset($_GET['detalles'])) { ?>

                                <li role="presentation" class="nav-item col-lg-4"><a href="#home" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                                <span class="visible-xs"><i class="fa fa-rocket"></i></span>
                                <span class="hidden-xs"> <center><b>Productos</b></center></span></a>
                                </li>
                                
                                <li role="presentation" class="nav-item col-lg-4"><a href="#messages" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>

                                <li role="presentation" class="nav-item col-lg-4"><a href="#settings" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-times"></i></span> <span class="hidden-xs"><center><b>Eliminar</b></center></span></a>
                                </li>  


                                <?php }elseif (isset($_GET['eliminar'])) { ?>

                                <li role="presentation" class="nav-item col-lg-4"><a href="#home" class="nav-link" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                                <span class="visible-xs"><i class="fa fa-rocket"></i></span>
                                <span class="hidden-xs"> <center><b>Productos</b></center></span></a>
                                </li>
                                
                                <li role="presentation" class="nav-item col-lg-4"><a href="#messages" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>

                                <li role="presentation" class="nav-item col-lg-4"><a href="#settings" class="nav-link active" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-times"></i></span> <span class="hidden-xs"><center><b>Eliminar</b></center></span></a>
                                </li>  

                                <?php } ?>















                            </ul>
                            <div class="tab-content">
                        













                            <?php if (isset($_GET['configurar'])) { ?>
                            <div class="tab-pane" id="home" aria-expanded="true">
                                    <h4><center>Productos en inventario</center></h4>
                                        
    
                                        <div class="row">

                                <?php 
                                 $row = mysqli_num_rows($arrayProducts2);
                                 ?>

                                 <div class="col-lg-12">
                                        <?php $row=mysqli_num_rows($arrayProducts);
                                        if ($row <= 0) { ?>
                                             <center>
                                            <h4><b>No se encontraron productos en el inventario.</b></h4>
                                             <button class="btn m-btn--pill btn-success"><a class="text-white" href="<?php echo URL; ?>productos/crear?inventario=<?php echo $datos1['nameInventory']; ?>">Crear productos</a></button>
                                             </center>
                                         <?php } ?>
                                    </div>



                                <?php while($datos = mysqli_fetch_array($arrayProducts)) { ?>
                                
                                <div class="col-lg-4 col-md- col-sm-4 col-xs-12">
                                    <div class="white-box">
                                        
                                        <div class="product-img">
                                            <img src="<?php echo URL .$datos['ruta']; ?>" height="200">
                                            <div class="pro-img-overlay">
                                                 
                                                <a href="<?php echo URL; ?>productos/detalles?id=<?php echo $datos['idproducts']; ?>&configurar" class="bg-warning"><i class="ti-marker-alt"></i></a> 
                                                <a href="<?php echo URL; ?>productos/detalles?id=<?php echo $datos['idproducts']; ?>&eliminar" class="bg-danger"><i class="ti-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-text">
                                            <span class="pro-price bg-danger"><?php echo $datos['totalItemsInventory']; ?></span>
                                            <h3 class="box-title m-b-0"><?php echo $datos['nameProduct']; ?></h3>
                                            <small class="text-muted db">
                                                
                                                 <?php 


                                                    $texto = $datos['codeProduct'];
                                                    
                                                    echo $texto;  


                                                    ?>
                                    
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                 <?php } ?>
                                            
                                </div>

                                </div>

                                <div class="tab-pane active" id="messages" aria-expanded="false">
                                    <?php if(isset($_SESSION['administrador'])){ ?>
                                    <h4><center>Editar datos de inventario</center></h4>

                                    <form method="POST">
                                    <input type="hidden" name="iduser" value="<?php echo $_SESSION['adminUserNew']; ?>">
                                <input type="hidden" name="idUpdate" value=" <?php echo $idGet; ?> ">
                                
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Nombre 
                                    </label>
                                    <input name='nombreInventario' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['nameInventory']); ?>">

                                    <span class="m-form__help">
                                        Por favor ingrese los cambios en el nombre.
                                    </span>
                                </div>

                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Codigo de inventario 
                                    </label>
                                    <input name='codeCurrent' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['codeCurrent']); ?>">

                                    <span class="m-form__help">
                                        Por favor ingrese los cambios en el codigo de inventario.
                                    </span>
                                </div>

                                <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-12 col-sm-12">
                                            Descripcion
                                        </label>
                                        <div class="col-lg-12 col-md-9 col-sm-12">
                                            <textarea name="descripcionInventario" class="form-control m-input m-input--air m-input--pill" id="" maxlength="800" placeholder="" rows="6"><?php echo strtoupper($datos1['descriptionInventory']); ?></textarea>
                                            <span class="m-form__help">
                                                Por favor ingrese los cambios en la descripcion.
                                            </span>
                                        </div>
                                    </div>

                                  

                                <br><br>

                                <button class="btn m-btn--square  btn-warning" type="submit">EDITAR</button>

                            </form>
                                   <?php }else{ ?>
                                    <div class="alert alert-danger"> No tienes permisos para editar los inventarios, debes ingresar con una cuenta de administrador. </div>
                                    <?php } ?>
                                    
                                </div>


                            <div class="tab-pane" id="settings" aria-expanded="false">
                                    <?php if(isset($_SESSION['administrador'])){ ?>
                                <h4><center>Eliminar inventario</center></h4>
                                <br>
                               <center> <div class="col-lg-12 alert alert-info"> Esta a punto de eliminar un inventario, recuerde que podria alterar el sistema y causar conflictos en los diferentes reportes, para evitarlos <b>NO</b> le recomendamos realizar esta accion, atravez de nuestro <a target="_blank" href=" <?php echo URL_SITIO; ?> "><b>Sitio web</b></a> usted puede ampliar su paquete de inventarios. </div></center>
                               

                                <div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="mySmallModalLabel">Alerta! esta seguro de realizar esta accion?</h4>
                                            </div>
                                            <div class="modal-body">
                                             <form method="POST" id="formularioDelete">
                                            <input type="hidden" name="idDelete" value=" <?php echo $idGet; ?> ">

                                                    <div class="modal-body">
                                                        <p>
                                                            ¿Esta seguro de que desea eliminar el inventario? Si realiza esta accion no podra tener acceso a el nunca mas.
                                                        </p>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        Cerrar
                                                    </button>
                                                    <button type="submit" class="btn btn-danger" id="eliminabtn">
                                                        Eliminar
                                                    </button>
                                                </div>
                                        </form>
                                         </div>
                                        </div>
                                    </div>
                                </div>

                               <br> 
                               <center><button class="btn m-btn--square btn-danger" alt="default" data-toggle="modal" data-target=".bs-modal-sm" class="model_img img-responsive">ELIMINAR INVENTARIO</button></center>
                                <?php }else{ ?>
                                    <div class="alert alert-danger"> No tienes permisos para eliminar los inventarios, debes ingresar con una cuenta de administrador. </div>
                                    <?php } ?>
                               

                            </div>
                            <?php } ?>



                            <?php if (isset($_GET['detalles'])) { ?>
                            <div class="tab-pane active" id="home" aria-expanded="true">
                                    <h4><center>Productos en inventario</center></h4>

                                     <?php 
                                 $row = mysqli_num_rows($arrayProducts2);
                                 ?>

                                 <div class="col-lg-12">
                                        <?php $row=mysqli_num_rows($arrayProducts);
                                        if ($row <= 0) { ?>
                                             <center>
                                            <h4><b>No se encontraron productos en el inventario.</b></h4>
                                             <button class="btn m-btn--pill btn-success"><a class="text-white" href="<?php echo URL; ?>productos/crear?inventario=<?php echo $datos1['nameInventory']; ?>">Crear productos</a></button>
                                             </center>
                                         <?php } ?>
                                    </div>  
                                        
    
                                        <div class="row">



                                 <?php while($datos = mysqli_fetch_array($arrayProducts)) { ?>
                                
                                <div class="col-lg-4 col-md- col-sm-4 col-xs-12">
                                    <div class="white-box">
                                        
                                        <div class="product-img">
                                            <img src="<?php echo URL .$datos['ruta']; ?>" height="200">
                                            <div class="pro-img-overlay">
                                                 
                                                <a href="<?php echo URL; ?>productos/detalles?id=<?php echo $datos['idproducts']; ?>&configurar" class="bg-warning"><i class="ti-marker-alt"></i></a> 
                                                <a href="<?php echo URL; ?>productos/detalles?id=<?php echo $datos['idproducts']; ?>&eliminar" class="bg-danger"><i class="ti-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-text">
                                            <span class="pro-price bg-danger"><?php echo $datos['totalItemsInventory']; ?></span>
                                            <h3 class="box-title m-b-0"><?php echo $datos['nameProduct']; ?></h3>
                                            <small class="text-muted db">
                                                
                                                 <?php 


                                                    $texto = $datos['codeProduct'];
                                                    
                                                    echo $texto;  


                                                    ?>
                                    
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                 <?php } ?>
                                            
                                </div>

                                </div>

                                <div class="tab-pane" id="messages" aria-expanded="false">
                                    <?php if(isset($_SESSION['administrador'])){ ?>
                                    <h4><center>Editar datos de inventario</center></h4>

                                    <form method="POST">
                                    <input type="hidden" name="iduser" value="<?php echo $_SESSION['adminUserNew']; ?>">
                                <input type="hidden" name="idUpdate" value=" <?php echo $idGet; ?> ">
                                
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Nombre 
                                    </label>
                                    <input name='nombreInventario' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['nameInventory']); ?>">

                                    <span class="m-form__help">
                                        Por favor ingrese los cambios en el nombre.
                                    </span>
                                </div>

                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Codigo de inventario 
                                    </label>
                                    <input name='codeCurrent' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['codeCurrent']); ?>">

                                    <span class="m-form__help">
                                        Por favor ingrese los cambios en el codigo de inventario.
                                    </span>
                                </div>

                                <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-12 col-sm-12">
                                            Descripcion
                                        </label>
                                        <div class="col-lg-12 col-md-9 col-sm-12">
                                            <textarea name="descripcionInventario" class="form-control m-input m-input--air m-input--pill" id="" maxlength="800" placeholder="" rows="6"><?php echo strtoupper($datos1['descriptionInventory']); ?></textarea>
                                            <span class="m-form__help">
                                                Por favor ingrese los cambios en la descripcion.
                                            </span>
                                        </div>
                                    </div>

                                <br><br>

                                <button class="btn m-btn--square  btn-warning" type="submit">EDITAR</button>

                            </form>
                                    <?php }else{ ?>
                                    <div class="alert alert-danger"> No tienes permisos para editar los inventarios, debes ingresar con una cuenta de administrador. </div>
                                    <?php } ?>
                                </div>


                            <div class="tab-pane" id="settings" aria-expanded="false">
                                    <?php if(isset($_SESSION['administrador'])){ ?>
                                <h4><center>Eliminar inventario</center></h4>
                                <br>
                               <center> <div class="col-lg-12 alert alert-info"> Esta a punto de eliminar un inventario, recuerde que podria alterar el sistema y causar conflictos en los diferentes reportes, para evitarlos <b>NO</b> le recomendamos realizar esta accion, atravez de nuestro <a target="_blank" href=" <?php echo URL_SITIO; ?> "><b>Sitio web</b></a> usted puede ampliar su paquete de inventarios. </div></center>
                               

                                <div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="mySmallModalLabel">Alerta! esta seguro de realizar esta accion?</h4>
                                            </div>
                                            <div class="modal-body">
                                             <form method="POST" id="formularioDelete">
                                            <input type="hidden" name="idDelete" value=" <?php echo $idGet; ?> ">

                                                    <div class="modal-body">
                                                        <p>
                                                            ¿Esta seguro de que desea eliminar el inventario? Si realiza esta accion no podra tener acceso a el nunca mas.
                                                        </p>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        Cerrar
                                                    </button>
                                                    <button type="submit" class="btn btn-danger" id="eliminabtn">
                                                        Eliminar
                                                    </button>
                                                </div>
                                        </form>
                                         </div>
                                        </div>
                                    </div>
                                </div>

                               <br> 
                               <center><button class="btn m-btn--square btn-danger" alt="default" data-toggle="modal" data-target=".bs-modal-sm" class="model_img img-responsive">ELIMINAR INVENTARIO</button></center>
                                <?php }else{ ?>
                                    <div class="alert alert-danger"> No tienes permisos para eliminar los inventarios, debes ingresar con una cuenta de administrador. </div>
                                    <?php } ?>
                               

                            </div>
                            <?php } ?>


                            <?php if (isset($_GET['eliminar'])) { ?>
                            <div class="tab-pane" id="home" aria-expanded="true">
                                    <h4><center>Productos en inventario</center></h4>
                                     <?php 
                                 $row = mysqli_num_rows($arrayProducts2);
                                 ?>

                                 <div class="col-lg-12">
                                        <?php $row=mysqli_num_rows($arrayProducts);
                                        if ($row <= 0) { ?>
                                             <center>
                                            <h4><b>No se encontraron productos en el inventario.</b></h4>
                                             <button class="btn m-btn--pill btn-success"><a class="text-white" href="<?php echo URL; ?>productos/crear?inventario=<?php echo $datos1['nameInventory']; ?>">Crear productos</a></button>
                                             </center>
                                         <?php } ?>
                                    </div>
                                        
    
                                        <div class="row">



                                 <?php while($datos = mysqli_fetch_array($arrayProducts)) { ?>
                                
                                <div class="col-lg-4 col-md- col-sm-4 col-xs-12">
                                    <div class="white-box">
                                        
                                        <div class="product-img">
                                            <img src="<?php echo URL .$datos['ruta']; ?>" height="200">
                                            <div class="pro-img-overlay">
                                                 
                                                <a href="<?php echo URL; ?>productos/detalles?id=<?php echo $datos['idproducts']; ?>&configurar" class="bg-warning"><i class="ti-marker-alt"></i></a> 
                                                <a href="<?php echo URL; ?>productos/detalles?id=<?php echo $datos['idproducts']; ?>&eliminar" class="bg-danger"><i class="ti-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-text">
                                            <span class="pro-price bg-danger"><?php echo $datos['totalItemsInventory']; ?></span>
                                            <h3 class="box-title m-b-0"><?php echo $datos['nameProduct']; ?></h3>
                                            <small class="text-muted db">
                                                
                                                 <?php 


                                                    $texto = $datos['descriptionProduct'];
                                                    
                                                    echo substr($texto,0,75) . "...";  


                                                    ?>
                                    
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                 <?php } ?>
                                            
                                </div>

                                </div>

                                <div class="tab-pane" id="messages" aria-expanded="false">
                                     <?php if(isset($_SESSION['administrador'])){ ?>
                                    <h4><center>Editar datos de inventario</center></h4>

                                    <form method="POST">
                                    <input type="hidden" name="iduser" value="<?php echo $_SESSION['adminUserNew']; ?>">
                                <input type="hidden" name="idUpdate" value=" <?php echo $idGet; ?> ">
                                
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Nombre 
                                    </label>
                                    <input name='nombreInventario' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['nameInventory']); ?>">

                                    <span class="m-form__help">
                                        Por favor ingrese los cambios en el nombre.
                                    </span>
                                </div>

                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Codigo de inventario 
                                    </label>
                                    <input name='codeCurrent' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['codeCurrent']); ?>">

                                    <span class="m-form__help">
                                        Por favor ingrese los cambios en el codigo de inventario.
                                    </span>
                                </div>

                                <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-12 col-sm-12">
                                            Descripcion
                                        </label>
                                        <div class="col-lg-12 col-md-9 col-sm-12">
                                            <textarea name="descripcionInventario" class="form-control m-input m-input--air m-input--pill" id="" maxlength="800" placeholder="" rows="6"><?php echo strtoupper($datos1['descriptionInventory']); ?></textarea>
                                            <span class="m-form__help">
                                                Por favor ingrese los cambios en la descripcion.
                                            </span>
                                        </div>
                                    </div>

                                <br><br>

                                <button class="btn m-btn--square  btn-warning" type="submit">EDITAR</button>

                            </form>
                                    <?php }else{ ?>
                                    <div class="alert alert-danger"> No tienes permisos para editar los inventarios, debes ingresar con una cuenta de administrador. </div>
                                    <?php } ?>
                                </div>


                            <div class="tab-pane active" id="settings" aria-expanded="false">

                                <?php if(isset($_SESSION['administrador'])){ ?>
                                <h4><center>Eliminar inventario</center></h4>
                                <br>
                               <center> <div class="col-lg-12 alert alert-info"> Esta a punto de eliminar un inventario, recuerde que podria alterar el sistema y causar conflictos en los diferentes reportes, para evitarlos <b>NO</b> le recomendamos realizar esta accion, atravez de nuestro <a target="_blank" href=" <?php echo URL_SITIO; ?> "><b>Sitio web</b></a> usted puede ampliar su paquete de inventarios. </div></center>
                               

                                <div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="mySmallModalLabel">Alerta! esta seguro de realizar esta accion?</h4>
                                            </div>
                                            <div class="modal-body">
                                             <form method="POST" id="formularioDelete">
                                            <input type="hidden" name="idDelete" value=" <?php echo $idGet; ?> ">

                                                    <div class="modal-body">
                                                        <p>
                                                            ¿Esta seguro de que desea eliminar el inventario? Si realiza esta accion no podra tener acceso a el nunca mas.
                                                        </p>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        Cerrar
                                                    </button>
                                                    <button type="submit" class="btn btn-danger" id="eliminabtn">
                                                        Eliminar
                                                    </button>
                                                </div>
                                        </form>
                                         </div>
                                        </div>
                                    </div>
                                </div>

                               <br> 
                               <center><button class="btn m-btn--square btn-danger" alt="default" data-toggle="modal" data-target=".bs-modal-sm" class="model_img img-responsive">ELIMINAR INVENTARIO</button></center>
                                <?php }else{ ?>
                                    <div class="alert alert-danger"> No tienes permisos para eliminar los inventarios, debes ingresar con una cuenta de administrador. </div>
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
           





                                                    




