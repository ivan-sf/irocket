<?php
$model = new models\Employees();
$con = new models\Conexion();
$idGet = $_GET['id'];
$array = $model->set("idproduct",$idGet);
$data = $model->view();
$datos = mysqli_fetch_array($data);
$modelInventory = new models\Inventory();
$arrayInventory = $modelInventory->array();
$sql1 = "SELECT * FROM users WHERE idusers='$idGet'";
$query1 = $con->returnConsulta($sql1);
$datos1 = mysqli_fetch_array($query1);
$modelInventory = new models\Company();
    $arrayInventory = $modelInventory->array();
if ($datos1['stateBD'] == 1) {

}else{
    header("location:" . URL . "proveedores?error=delete");
}

$sqlProd = "SELECT * FROM products INNER JOIN productdetails 
ON idproducts=products_idproducts 
WHERE providerID='$idGet'";
$queryProd = $con->returnConsulta($sqlProd);

?>
<div id="page-wrapper" style="min-height: 953px;">

    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Proveedores</h4> </div>

                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Panel</a></li>
                        <li><a href="#">Proveedores</a></li>
                        <li class="active">Detalles</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>proveedores?catalogo" class="">Catalogo</a></button>
            <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>proveedores/tabla?index" class="">Tabla</a></button>
            <button class="btn m-btn--pill btn-badge"><a href="<?php echo URL; ?>proveedores/crear">Crear</a></button>
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
                                <h4 class="text-white"><?php echo strtoupper($datos['nameUser']); ?></h4>

                            </div>

                        </div>
                    </div>

                    <div class="white-box"><br>
                        <center><h5><?php echo strtoupper($datos['documentUser']); ?></h5></center>

                        <h3 class="box-title"><center>Caracteristicas</center></h3>
                        <ul class="basic-list">
                            <li>Nombre<span class="pull-right label-danger label"><?php echo strtoupper($datos['nameUser']); ?></span></li>
                            <li>Apellido<span class="pull-right label-purple label"><?php echo strtoupper($datos['lastnameUser']); ?></span></li>
                            <li>Nombre de usuario<span class="pull-right label-success label"><?php echo strtoupper($datos['userName']); ?></span></li>
                            <li>Edad<span class="pull-right label-warning label"><?php echo strtoupper($datos['age']); ?></span></li>
                            <li>Fecha de registro<span class="pull-right label-info label"><?php echo strtoupper($datos['data_register']); ?></span></li>
                            <li>Cargo<span class="pull-right label-info label"><?php echo strtoupper($datos['jobTitle']); ?></span></li>
                            <li>Telefono<span class="pull-right label-info label"><?php echo strtoupper($datos['phone']); ?></span></li>
                            <li>Email<span class="pull-right label-info label"><?php echo strtoupper($datos['email']); ?></span></li>
                            <li>Descripcion<span class="pull-right label-info label"><?php echo strtoupper($datos['description']); ?></span></li>
                        </ul>


                        <br>
                        <center><button class="btn m-btn--square btn-primary" alt="default" data-toggle="modal" data-target=".b20s-modal-sm" class="model_img img-responsive">Productos distribuidos</button></center>


                        <div class="modal fade b20s-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="mySmallModalLabel">Productos distribuidos por <?php echo strtoupper($datos['userName']); ?>.</h4>
                                    </div>
                                    <div class="modal-body">
                                    
                                        <?php while ($dataProd=mysqli_fetch_array($queryProd)) { ?>

                                    <div class="row">
                                            
                                        
                                        <div class="col-lg-4">
                                            <b><center>Producto</center></b>  

                                            <div class="m-input-icon" id="input1">
                                                <center><b><h2><?php echo ucfirst($dataProd['nameProduct']); ?></h2></b></center>
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <b><center>Precio</center></b>
                                            
                                            <div class="m-input-icon" id="input2">
                                                <center><b><h2><?php echo ucfirst($dataProd['price_buy']); ?></h2></b></center>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <b><center>Cantidad</center></b>
                                            
                                            <div class="m-input-icon" id="input2">
                                                <center><b><h2><?php echo ucfirst($dataProd['quantityProduct']); ?></h2></b></center>
                                            </div>
                                        </div>
                                    </div>
                                        <?php } ?>

   
                                </div>
                            </div>
                        </div>
                    </div>

                        
                    </div>
                    



                </div>
            </div>
            <div class="col-md-12 col-xs-12 col-lg-8">
                <div class="white-box">
                    <ul class="nav customtab nav-tabs" role="tablist">















                        <?php if (isset($_GET['detalles'])) { ?>
                        

                        <li role="presentation" class="nav-item col-lg-6"><a href="#messages" class="nav-link active" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>

                        <li role="presentation" class="nav-item col-lg-6"><a href="#settings" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-times"></i></span> <span class="hidden-xs"><center><b>Eliminar</b></center></span></a></li>

                        <?php }elseif (isset($_GET['configurar'])) { ?>
                         <li role="presentation" class="nav-item col-lg-6"><a href="#messages" class="nav-link active" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>

                        <li role="presentation" class="nav-item col-lg-6"><a href="#settings" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-times"></i></span> <span class="hidden-xs"><center><b>Eliminar</b></center></span></a></li>

                        <?php }elseif (isset($_GET['eliminar'])) { ?>
                         <li role="presentation" class="nav-item col-lg-6"><a href="#messages" class="nav-link " aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>

                        <li role="presentation" class="nav-item col-lg-6"><a href="#settings" class="nav-link active" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-times"></i></span> <span class="hidden-xs"><center><b>Eliminar</b></center></span></a></li>
                        <?php }else ?>
                    </ul>
                    <div class="tab-content">

                        <?php if (isset($_GET['detalles'])) { ?>
                 

                    <div class="tab-pane active" id="messages" aria-expanded="false">


                        <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >

                                <input type="hidden" name="idUpdate" value=" <?php echo $idGet; ?> ">
                                
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Empresa 
                                    </label>

                                    <select id="optionvalue" name="nameCompany" class="form-control m-input m-input--air m-input--pill"">


                                        <?php while($datos1 = mysqli_fetch_array($arrayInventory)) { ?>
                                        <option value="<?php echo strtoupper($datos1['nameCompany']);?>">
                                            <?php echo strtoupper($datos1['nameCompany']) . "<br>"; ?>  
                                        </option>
                                        <?php } ?>



                                    </select>
                                </select>

                                <span class="m-form__help">
                                </span>
                                <span class="m--font-">
                                    <small>Empresa a la que pertenece el empleado.</small>
                                </span>
                            </div>


                    
                            <!--  Nombre de usuario -->
                                   
                                <input name='idUser' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo $idGet;  ?>">
                                <input name='userName' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['userName']); ?>">

                            
                            <!-- Clave-->
                                <input name='pass' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['password']); ?>">

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Nombres
                                </label>
                                <input name='nameUser' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['nameUser']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Nombres del empleado.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Apellidos
                                </label>
                                <input name='lastname' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['lastnameUser']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Primer apellido del empleado.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Documento
                                </label>
                                <input name='document' type="text" class="form-control m-input m-input--air m-input--pill"  value="<?php echo strtoupper($datos['documentUser']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Documento del empleado.</small>
                                    </span>
                                </span>
                            </div>


                        
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Edad
                                </label>
                                <input name='age' type="date" class="form-control m-input m-input--air m-input--pill"  value="<?php echo strtoupper($datos['age']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Fecha de nacimiento del empleado.</small>
                                    </span>
                                </span>
                            </div>


                            
                                <input name='companyUser' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['company']); ?>">


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Telefono
                                </label>
                                <input name='phone' type="tel" class="form-control m-input m-input--air m-input--pill"  value="<?php echo strtoupper($datos['phone']); ?>">

                                
                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Telefono del empleado.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Email
                                </label>
                                <input name='email' type="email" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['email']); ?>">

                                
                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Email del empleado.</small>
                                    </span>
                                </span>
                            </div>


                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                        <b>Foto</b>
                                    </font></font>
                                    <span class="m-form__help"><br>
                                        <small>Ingrese foto si desea actualizar la actual.</small>
                                    </span>
                                    <div class="m-input-icon" id="input8">
                                        <input type="file" class="form-control m-input m-input--air m-input--pill" name="photo" >
                                    </div>
                                    <br>




                            <div class="form-group m-form__group row">
                                <label class="col-form-label col-lg-12 col-sm-12">
                                    Descripcion
                                </label>
                                <div class="col-lg-12 col-md-9 col-sm-12">
                                    <textarea name="description" class="form-control m-input m-input--air m-input--pill" id="" maxlength="2000" placeholder="" rows="6"><?php echo strtoupper($datos['description']); ?></textarea>
                                    <span class="m--font-">
                                        <small>Descripcion del proveedor.</small>
                                    </span>
                                </div>
                            </div>

                            <br><br>

                            <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center><br><br>

                        </form>
        

                            
                    </div>


                    <div class="tab-pane" id="settings" aria-expanded="false">
                        <br>
                        <center> <div class="col-lg-12 alert alert-info"> Esta a punto de eliminar un proveedor, recuerde que si realiza esta accion ya no tendra disponible este proveedor en ningun modulo. </div></center>


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
                    <center><button class="btn m-btn--square btn-danger" alt="default" data-toggle="modal" data-target=".bs-modal-sm" class="model_img img-responsive">ELIMINAR EMPLEADO</button></center>


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
                                
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Empresa 
                                    </label>

                                    <select id="optionvalue" name="nameCompany" class="form-control m-input m-input--air m-input--pill"">


                                        <?php while($datos1 = mysqli_fetch_array($arrayInventory)) { ?>
                                        <option value="<?php echo strtoupper($datos1['nameCompany']);?>">
                                            <?php echo strtoupper($datos1['nameCompany']) . "<br>"; ?>  
                                        </option>
                                        <?php } ?>



                                    </select>
                                </select>

                                <span class="m-form__help">
                                </span>
                                <span class="m--font-">
                                    <small>Empresa a la que pertenece el proveedor.</small>
                                </span>
                            </div>


                        
                            <!--  Nombre de usuario -->
                                   
                                <input name='idUser' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo $idGet;  ?>">
                                <input name='userName' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['userName']); ?>">
                           
                            <!-- Clave-->
                                <input name='pass' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['password']); ?>">

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Nombres
                                </label>
                                <input name='nameUser' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['nameUser']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Nombres del proveedor.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Apellidos
                                </label>
                                <input name='lastname' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['lastnameUser']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Primer apellido del proveedor.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Documento
                                </label>
                                <input name='document' type="text" class="form-control m-input m-input--air m-input--pill"  value="<?php echo strtoupper($datos['documentUser']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Documento del proveedor.</small>
                                    </span>
                                </span>
                            </div>


                        
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Edad
                                </label>
                                <input name='age' type="date" class="form-control m-input m-input--air m-input--pill"  value="<?php echo strtoupper($datos['age']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Fecha de nacimiento del proveedor.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Empresa
                                </label>
                                <input name='companyUser' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['company']); ?>">

                                <span class="m--font-">
                                    
                                </span>
                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Empresa a la cual pertenece el proveedor.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Telefono
                                </label>
                                <input name='phone' type="tel" class="form-control m-input m-input--air m-input--pill"  value="<?php echo strtoupper($datos['phone']); ?>">

                                
                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Telefono del proveedor.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Email
                                </label>
                                <input name='email' type="email" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['email']); ?>">

                                
                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Email del proveedor.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                        <b>Foto</b>
                                    </font></font>
                                    <span class="m-form__help"><br>
                                        <small>Ingrese foto si desea actualizar la actual.</small>
                                    </span>
                                    <div class="m-input-icon" id="input8">
                                        <input type="file" class="form-control m-input m-input--air m-input--pill" name="photo" >
                                    </div>
                                </div>
                            </div>




                            <div class="form-group m-form__group row">
                                <label class="col-form-label col-lg-12 col-sm-12">
                                    Descripcion
                                </label>
                                <div class="col-lg-12 col-md-9 col-sm-12">
                                    <textarea name="description" class="form-control m-input m-input--air m-input--pill" id="" maxlength="2000" placeholder="" rows="6"><?php echo strtoupper($datos['description']); ?></textarea>
                                    <span class="m--font-">
                                        <small>Descripcion del proveedor.</small>
                                    </span>
                                </div>
                            </div>

                            <br><br>

                            <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center><br><br>

                        </form>
            </div>



            <div class="tab-pane" id="settings" aria-expanded="false">
                 <br>
                        <center> <div class="col-lg-12 alert alert-info"> Esta a punto de eliminar un proveedor, recuerde que si realiza esta accion ya no tendra disponible este proveedor en ningun modulo. </div></center>


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
                    <center><button class="btn m-btn--square btn-danger" alt="default" data-toggle="modal" data-target=".bs-modal-sm" class="model_img img-responsive">ELIMINAR PROVEEDOR</button></center>


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


                            <div class="col-lg-12">

                                <div class="col-lg-12">

                                </div>

                            </div>
                            <div class="col-lg-12">

                                <div class="col-lg-12">

                                </div>

                            </div>
               <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >

                                <input type="hidden" name="idUpdate" value=" <?php echo $idGet; ?> ">
                                
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Empresa 
                                    </label>

                                    <select id="optionvalue" name="nameCompany" class="form-control m-input m-input--air m-input--pill"">


                                        <?php while($datos1 = mysqli_fetch_array($arrayInventory)) { ?>
                                        <option value="<?php echo strtoupper($datos1['nameCompany']);?>">
                                            <?php echo strtoupper($datos1['nameCompany']) . "<br>"; ?>  
                                        </option>
                                        <?php } ?>



                                    </select>
                                </select>

                                <span class="m-form__help">
                                </span>
                                <span class="m--font-">
                                    <small>Empresa a la que pertenece el proveedor.</small>
                                </span>
                            </div>


                            <!--  Nombre de usuario -->
                                   
                                <input name='idUser' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo $idGet;  ?>">
                                <input name='userName' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['userName']); ?>">


                           
                            <!-- Clave-->
                                <input name='pass' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['password']); ?>">

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Nombres
                                </label>
                                <input name='nameUser' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['nameUser']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Nombres del proveedor.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Apellidos
                                </label>
                                <input name='lastname' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['lastnameUser']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Primer apellido del proveedor.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Documento
                                </label>
                                <input name='document' type="text" class="form-control m-input m-input--air m-input--pill"  value="<?php echo strtoupper($datos['documentUser']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Documento del proveedor.</small>
                                    </span>
                                </span>
                            </div>


                        
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Edad
                                </label>
                                <input name='age' type="date" class="form-control m-input m-input--air m-input--pill"  value="<?php echo strtoupper($datos['age']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Fecha de nacimiento del proveedor.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Empresa
                                </label>
                                <input name='companyUser' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['company']); ?>">

                                <span class="m--font-">
                                    
                                </span>
                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Empresa a la cual pertenece el proveedor.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Telefono
                                </label>
                                <input name='phone' type="tel" class="form-control m-input m-input--air m-input--pill"  value="<?php echo strtoupper($datos['phone']); ?>">

                                
                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Telefono del proveedor.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Email
                                </label>
                                <input name='email' type="email" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['email']); ?>">

                                
                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Email del proveedor.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                        <b>Foto</b>
                                    </font></font>
                                    <span class="m-form__help"><br>
                                        <small>Ingrese foto si desea actualizar la actual.</small>
                                    </span>
                                    <div class="m-input-icon" id="input8">
                                        <input type="file" class="form-control m-input m-input--air m-input--pill" name="photo" >
                                    </div>
                                </div>
                            </div>




                            <div class="form-group m-form__group row">
                                <label class="col-form-label col-lg-12 col-sm-12">
                                    Descripcion
                                </label>
                                <div class="col-lg-12 col-md-9 col-sm-12">
                                    <textarea name="description" class="form-control m-input m-input--air m-input--pill" id="" maxlength="2000" placeholder="" rows="6"><?php echo strtoupper($datos['description']); ?></textarea>
                                    <span class="m--font-">
                                        <small>Descripcion del proveedor.</small>
                                    </span>
                                </div>
                            </div>

                            <br><br>

                            <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center><br><br>

                        </form>
    </div>


    <div class="tab-pane active" id="settings" aria-expanded="false">
      <br>
                        <center> <div class="col-lg-12 alert alert-info"> Esta a punto de eliminar un proveedor, recuerde que si realiza esta accion ya no tendra disponible este proveedor en ningun modulo. </div></center>


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
                    <center><button class="btn m-btn--square btn-danger" alt="default" data-toggle="modal" data-target=".bs-modal-sm" class="model_img img-responsive">ELIMINAR PROVEEDOR</button></center>


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












