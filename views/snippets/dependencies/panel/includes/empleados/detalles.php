<?php
$model = new models\Employees();
$con = new models\Conexion();
$idGet = $_GET['id'];
$array = $model->set("idproduct",$idGet);
$data = $model->view();
$queryNom = $model->queryNom();
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
    header("location:" . URL . "empleados?error=delete");
}


if (isset($_GET['configurar'])) {
    # code...

?>
<div id="page-wrapper" style="min-height: 953px;">

    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Empleados</h4> </div>

                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Panel</a></li>
                        <li><a href="#">Empleados</a></li>
                        <li class="active">Detalles</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>empleados?catalogo" class="">Catalogo</a></button>
            <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>empleados/tabla?index" class="">Tabla</a></button>
            <button class="btn m-btn--pill btn-badge"><a href="<?php echo URL; ?>empleados/crear">Crear</a></button>
            <br>

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
                    Se editaron los datos de tu empleado correctamente puedes ver el resultado acontinuacion.

                    </center>
                    </div>
                    <div class='m-alert__close'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                    </div>
                    </div>";
                }elseif (isset($_GET['error'])) {
                    if ($_GET['error']=='nomina') {
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
                        Ingresa un valor de nomina valido.

                        </center>
                        </div>
                        <div class='m-alert__close'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                        </div>
                        </div>";
                    }
                }?>
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
                                <h4 class="text-white"><b><?php echo strtoupper($datos['nameUser']); ?></b></h4>
                                <h5 class="text-white"><?php echo strtoupper($datos['userName']); ?></h5>

                            </div>

                        </div>
                    </div>

                    <div class="white-box"><br>
                        <center><h5><?php echo strtoupper($datos['documentUser']); ?></h5></center>

                        <h3 class="box-title"><center>Caracteristicas</center></h3>
                        <ul class="basic-list">
                            <li>Nombre<span class="pull-right label-danger label"><?php echo strtoupper($datos['nameUser']); ?></span></li>
                            <li>Apellido<span class="pull-right label-purple label"><?php echo strtoupper($datos['lastnameUser']); ?></span></li>
                            <li>Usuario<span class="pull-right label-success label"><?php echo strtoupper($datos['userName']); ?></span></li>
                            <li>Edad<span class="pull-right label-warning label"><?php echo strtoupper($datos['age']); ?></span></li>
                            <li>Fecha de registro<span class="pull-right label-info label"><?php echo strtoupper($datos['data_register']); ?></span></li>
                            <li>Cargo<span class="pull-right label-info label"><?php echo strtoupper($datos['jobTitle']); ?></span></li>
                            <li>Telefono<span class="pull-right label-info label"><?php echo strtoupper($datos['phone']); ?></span></li>
                            <li>Email<span class="pull-right label-info label"><?php echo strtoupper($datos['email']); ?></span></li>
                            <li>Salario<span class="pull-right label-info label"><?php echo number_format($datos['salary']); ?></span></li>
                            <li>Descripcion<span class="pull-right label-info label"><?php echo strtoupper($datos['description']); ?></span></li>
                        </ul>





                

                    </div>


                     <center><button class="btn m-btn--square btn-primary" alt="default" data-toggle="modal" data-target=".b20s-modal-sm" class="model_img img-responsive">ABONAR SALARIO</button></center>
                     <br>
                     <center><button class="btn m-btn--square btn-primary" alt="default" data-toggle="modal" data-target=".b20-modal-sm" class="model_img img-responsive">HISTORIAL DE ABONOS</button></center>
                        <br>
                        <!--
                        <center><button class="btn m-btn--square btn-primary" alt="default" data-toggle="modal" data-target=".b20-modal-sm" class="model_img img-responsive">HISTORIAL</button></center>
                        -->


























                    <div class="modal fade b20s-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="mySmallModalLabel">Por favor ingrese el abono de nomina.</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST">
                                            <input type="hidden" name="idNomina" value=" <?php echo $idGet; ?> ">
                                            <label for="exampleInputEmail1">
                                                Valor del pago
                                            </label>
                                            <input autofocus="" type="number" class="form-control m-input m-input--air m-input--pill" placeholder="Abono" name="abonoNom">
                                            <br>
                                            <label for="exampleInputEmail1">
                                                Motivo del pago
                                            </label>
                                            <input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Motivo del pago" name="motivoNom">
                                            <br>
                                            <center><button class="btn m-btn--square btn-success" class="model_img img-responsive" type="submit">AGREGAR</button></center>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="modal fade b20-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="mySmallModalLabel">Historial de nomina.</h4>
                                    </div>
                                    <div class="modal-body">




                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><b>Fecha</b></th>
                                                <th><b>Motivo</b></th>
                                                <th><b>Total</b></th>
                                                <th><b>Empleado</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ( $dataProd = mysqli_fetch_array($queryNom)) {
                                                     ?>
                                            <tr>
                                                
                                                
                                                <td><?php echo $dataProd['fecha']; ?></td>
                                                <td><?php echo $dataProd['tipo']; ?></td>
                                                <td><?php echo number_format($dataProd['total']); ?></td>
                                                <td><?php echo $dataProd['empleado']; ?></td>
                                      

                                        


                                            </tr>
                                             <?php } ?>
                                        </tbody>
                                    </table>
                                        






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

                        <?php if(isset($_SESSION['administrador'])){ ?>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Nombre de usuario 
                                </label>
                                <input name='idUser' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo $idGet;  ?>">
                                <input name='userName' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['userName']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Nombre de usuario para inicio de sesion.</small>
                                    </span>
                                </span>
                            </div>
                        <?php }?>

                        <?php if(isset($_SESSION['administrador']) OR isset($_GET['perfil'])){ ?>
                            <div class="form-group m-form__group">
                         <label for="exampleInputEmail1">
                                    Clave
                                </label>
                                <input name='pass' type="password" class="form-control m-input m-input--air m-input--pill" value="<?php echo base64_decode($datos['password']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Clave para inicio de sesion <b>por defecto se asigna el documento del empleado.</b></small>
                                    </span>
                                </span>
                            </div>
                        <?php }else{?>
                                <input name='pass' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo base64_decode($datos['password']); ?>">

                        <?php }?>
                               

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
                                        <small>Descripcion del empleado.</small>
                                    </span>
                                </div>
                            </div>

                            <br><br>

                            <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center><br><br>

                        </form>
        

                            
                    </div>


                    <div class="tab-pane" id="settings" aria-expanded="false">
                    <?php if(isset($_SESSION['administrador']) AND !isset($_GET['perfil'])){ ?>
                        <br>

                        <center> <div class="col-lg-12 alert alert-info"> Esta a punto de eliminar un empleado, recuerde que si realiza esta accion ya no tendra disponible este empleado en ningun modulo. </div></center>


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
                    <?php }elseif(isset($_GET['perfil'])){ ?>
                    <div class="alert alert-danger"> <center>No puedes eliminar tu cuenta, perderas el acceso al sistema.</center> </div>
                    <?php }else{ ?>
                    <div class="alert alert-danger"> No tienes permisos para eliminar los empleados, debes ingresar con una cuenta de administrador. </div>
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


                             <?php if(isset($_SESSION['administrador'])){ ?>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Nombre de usuario 
                                </label>
                                <input name='idUser' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo $idGet;  ?>">
                                <input name='userName' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['userName']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Nombre de usuario para inicio de sesion.</small>
                                    </span>
                                </span>
                            </div>
                        <?php }else{?>
                                <input name='idUser' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo $idGet;  ?>">

                                <input name='userName' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['userName']); ?>">

                        <?php } ?>


                       <?php if(isset($_SESSION['administrador']) OR isset($_GET['perfil'])){ ?>
                            <div class="form-group m-form__group">
                         <label for="exampleInputEmail1">
                                    Clave
                                </label>
                                <input name='pass' type="password" class="form-control m-input m-input--air m-input--pill" value="<?php echo base64_decode($datos['password']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Clave para inicio de sesion <b>por defecto se asigna el documento del empleado.</b></small>
                                    </span>
                                </span>
                            </div>
                        <?php }else{?>
                                <input name='pass' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo base64_decode($datos['password']); ?>">

                        <?php }?>

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
                                        <small>Descripcion del empleado.</small>
                                    </span>
                                </div>
                            </div>

                            <br><br>

                            <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center><br><br>

                        </form>
            </div>



            <div class="tab-pane" id="settings" aria-expanded="false">
                <?php if(isset($_SESSION['administrador']) AND !isset($_GET['perfil'])){ ?>
                        <br>
                        <center> <div class="col-lg-12 alert alert-info"> Esta a punto de eliminar un empleado, recuerde que si realiza esta accion ya no tendra disponible este empleado en ningun modulo. </div></center>


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
                    <?php }elseif(isset($_GET['perfil'])){ ?>
                    <div class="alert alert-danger"> <center>No puedes eliminar tu cuenta, perderas el acceso al sistema.</center> </div>
                    <?php }else{ ?>
                    <div class="alert alert-danger"> No tienes permisos para eliminar los empleados, debes ingresar con una cuenta de administrador. </div>
                    <?php } ?>
                       


        </div>

</div>

<?php } 











?>

</div>
</div>
</div>
</div>


</div>








</div>
<!-- /.right-sidebar -->
</div>
<?php }










































































































































































if (!isset($_GET['configurar'])) {
    # code...

?>
<div id="page-wrapper" style="min-height: 953px;">

    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Empleados</h4> </div>

                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Panel</a></li>
                        <li><a href="#">Empleados</a></li>
                        <li class="active">Detalles</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>empleados?catalogo" class="">Catalogo</a></button>
            <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>empleados/tabla?index" class="">Tabla</a></button>
            <button class="btn m-btn--pill btn-badge"><a href="<?php echo URL; ?>empleados/crear">Crear</a></button>
            <br>

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
                    Se editaron los datos de tu empleado correctamente puedes ver el resultado acontinuacion.

                    </center>
                    </div>
                    <div class='m-alert__close'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                    </div>
                    </div>";
                }elseif (isset($_GET['error'])) {
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
                    El empleado al que intentas acceder no existe o ha sido eliminado.

                    </center>
                    </div>
                    <div class='m-alert__close'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                    </div>
                    </div>";
                }?>
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
                                <h4 class="text-white"><b><?php echo strtoupper($datos['nameUser']); ?></b></h4>
                                <h5 class="text-white"><?php echo strtoupper($datos['userName']); ?></h5>

                            </div>

                        </div>
                    </div>

                    <div class="white-box"><br>
                        <center><h5><?php echo strtoupper($datos['documentUser']); ?></h5></center>

                        <h3 class="box-title"><center>Caracteristicas</center></h3>
                        <ul class="basic-list">
                            <li>Nombre<span class="pull-right label-danger label"><?php echo strtoupper($datos['nameUser']); ?></span></li>
                            <li>Apellido<span class="pull-right label-purple label"><?php echo strtoupper($datos['lastnameUser']); ?></span></li>
                            <li>Usuario<span class="pull-right label-success label"><?php echo strtoupper($datos['userName']); ?></span></li>
                            <li>Edad<span class="pull-right label-warning label"><?php echo strtoupper($datos['age']); ?></span></li>
                            <li>Fecha de registro<span class="pull-right label-info label"><?php echo strtoupper($datos['data_register']); ?></span></li>
                            <li>Cargo<span class="pull-right label-info label"><?php echo strtoupper($datos['jobTitle']); ?></span></li>
                            <li>Telefono<span class="pull-right label-info label"><?php echo strtoupper($datos['phone']); ?></span></li>
                            <li>Email<span class="pull-right label-info label"><?php echo strtoupper($datos['email']); ?></span></li>
                            <li>Descripcion<span class="pull-right label-info label"><?php echo strtoupper($datos['description']); ?></span></li>
                        </ul>
                        
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

                        <?php }elseif (!isset($_GET['configurar'])) { ?>
                         <li role="presentation" class="nav-item col-lg-6"><a href="#messages" class="nav-link " aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>

                        <li role="presentation" class="nav-item col-lg-6"><a href="#settings" class="nav-link active" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-times"></i></span> <span class="hidden-xs"><center><b>Eliminar</b></center></span></a></li>
                        <?php }else ?>
                    </ul>
                    <div class="tab-content">

                        <?php if (isset($_GET['detalles'])) { ?>
                 

                    <div class="tab-pane" id="messages" aria-expanded="false">


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

                        <?php if(isset($_SESSION['administrador'])){ ?>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Nombre de usuario 
                                </label>
                                <input name='idUser' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo $idGet;  ?>">
                                <input name='userName' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['userName']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Nombre de usuario para inicio de sesion.</small>
                                    </span>
                                </span>
                            </div>
                        <?php }?>

                        <?php if(isset($_SESSION['administrador']) OR isset($_GET['perfil'])){ ?>
                            <div class="form-group m-form__group">
                         <label for="exampleInputEmail1">
                                    Clave
                                </label>
                                <input name='pass' type="password" class="form-control m-input m-input--air m-input--pill" value="<?php echo base64_decode($datos['password']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Clave para inicio de sesion <b>por defecto se asigna el documento del empleado.</b></small>
                                    </span>
                                </span>
                            </div>
                        <?php }else{?>
                                <input name='pass' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo base64_decode($datos['password']); ?>">

                        <?php }?>
                               

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
                                        <small>Descripcion del empleado.</small>
                                    </span>
                                </div>
                            </div>

                            <br><br>

                            <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center><br><br>

                        </form>
        

                            
                    </div>


                    <div class="tab-pane" id="settings" aria-expanded="false">
                    <?php if(isset($_SESSION['administrador']) AND !isset($_GET['perfil'])){ ?>
                        <br>

                        <center> <div class="col-lg-12 alert alert-info"> Esta a punto de eliminar un empleado, recuerde que si realiza esta accion ya no tendra disponible este empleado en ningun modulo. </div></center>


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
                    <?php }elseif(isset($_GET['perfil'])){ ?>
                    <div class="alert alert-danger"> <center>No puedes eliminar tu cuenta, perderas el acceso al sistema.</center> </div>
                    <?php }else{ ?>
                    <div class="alert alert-danger"> No tienes permisos para eliminar los empleados, debes ingresar con una cuenta de administrador. </div>
                    <?php } ?>
                </div>
















                <?php }elseif(!isset($_GET['configurar'])) { ?>


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


                             <?php if(isset($_SESSION['administrador'])){ ?>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Nombre de usuario 
                                </label>
                                <input name='idUser' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo $idGet;  ?>">
                                <input name='userName' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['userName']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Nombre de usuario para inicio de sesion.</small>
                                    </span>
                                </span>
                            </div>
                        <?php }else{?>
                                <input name='idUser' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo $idGet;  ?>">

                                <input name='userName' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos['userName']); ?>">

                        <?php } ?>


                       <?php if(isset($_SESSION['administrador']) OR isset($_GET['perfil'])){ ?>
                            <div class="form-group m-form__group">
                         <label for="exampleInputEmail1">
                                    Clave
                                </label>
                                <input name='pass' type="password" class="form-control m-input m-input--air m-input--pill" value="<?php echo base64_decode($datos['password']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Clave para inicio de sesion <b>por defecto se asigna el documento del empleado.</b></small>
                                    </span>
                                </span>
                            </div>
                        <?php }else{?>
                                <input name='pass' type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo base64_decode($datos['password']); ?>">

                        <?php }?>

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
                                        <small>Descripcion del empleado.</small>
                                    </span>
                                </div>
                            </div>

                            <br><br>

                            <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center><br><br>

                        </form>
            </div>



            <div class="tab-pane active" id="settings" aria-expanded="false">
                <?php if(isset($_SESSION['administrador']) AND !isset($_GET['perfil'])){ ?>
                        <br>
                        <center> <div class="col-lg-12 alert alert-info"> Esta a punto de eliminar un empleado, recuerde que si realiza esta accion ya no tendra disponible este empleado en ningun modulo. </div></center>


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
                    <?php }elseif(isset($_GET['perfil'])){ ?>
                    <div class="alert alert-danger"> <center>No puedes eliminar tu cuenta, perderas el acceso al sistema.</center> </div>
                    <?php }else{ ?>
                    <div class="alert alert-danger"> No tienes permisos para eliminar los empleados, debes ingresar con una cuenta de administrador. </div>
                    <?php } ?>
                       


        </div>

</div>

<?php } 











?>

</div>
</div>
</div>
</div>


</div>








</div>
<!-- /.right-sidebar -->
</div>
<?php } ?> ?>












<script>
                                    
$(document).ready(function () {
//$("#alertabien").slideUp(5000).delay(5000);

    $('#alertabien').delay(5000).slideToggle(1000, function () {
        $('#alertabien').removeClass("show");
    });
    return false;
});

</script>
