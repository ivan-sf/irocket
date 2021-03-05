<?php
$model = new models\Employees();
$con = new models\Conexion();
$modelTercero = new models\Tercero();
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

$arrayPaises = $modelTercero->arrayPaises();
$arrayDepartamentos = $modelTercero->arrayDepartamentos();
$arrayMunicipios = $modelTercero->arrayMunicipios();

if ($datos1['stateBD'] == 1) {

}else{
    header("location:" . URL . "empleados?error=delete");
}


if (isset($_GET['configurar']) or isset($_GET['eliminar'])) {
    # code...

?>
<div id="page-wrapper" style="min-height: 953px;">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Terceros</h4> </div>

                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Panel</a></li>
                        <li><a href="#">Terceros</a></li>
                        <li class="active">Detalles</li>
                    </ol>
                </div>

                
                <!-- /.col-lg-12 -->
            </div>
            <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>tercero/crear" class="">Crear tercero</a></button>
            <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>empleados?catalogo" class="">Empleados</a></button>
            <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>clientes?catalogo" class="">Clientes</a></button>
            <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>proveedores?catalogo" class="">Proveedores</a></button>
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
                    Se editaron los datos de tu tercero correctamente puedes ver el resultado acontinuacion.

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
                <div id="respuesta" class="hidden">

                    <div class="m-alert m-alert--icon m-alert--air alert alert-warning alert-dismissible fade show" role="alert" id="alertJS">
                        <div class="m-alert__icon">
                            <i class="la la-warning"></i>
                        </div>
                        <div class="m-alert__text">
                            <strong>
                                Lo sentimos,
                            </strong>
                            <span id="answerJS"></span>
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>

                </div>
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
                            <li>Nombres<span class="pull-right label-danger label"><?php echo strtoupper($datos['nameUser']); ?></span></li>
                            <li>Apellidos<span class="pull-right label-purple label"><?php echo strtoupper($datos['lastnameUser']); ?></span></li>
                            <li>Usuario<span class="pull-right label-success label"><?php echo strtoupper($datos['userName']); ?></span></li>
                            
                            <li>Fecha de registro<span class="pull-right label-info label"><?php echo strtoupper($datos['data_register']); ?></span></li>
                            
                            <li>Telefono<span class="pull-right label-info label"><?php echo strtoupper($datos['phone']); ?></span></li>
                            <li>Email<span class="pull-right label-info label"><?php echo strtoupper($datos['email']); ?></span></li>
                            
                            <li>Descripcion<span class="pull-right label-info label"><?php echo strtoupper($datos['description']); ?></span></li>
                        </ul>
                    </div>

                    <!--botones -->
                     <center><button class="btn m-btn--square btn-primary hidden" alt="default" data-toggle="modal" data-target=".b20s-modal-sm" class="model_img img-responsive">ABONAR SALARIO</button></center>
                     <br>
                     <center><button class="btn m-btn--square btn-primary hidden" alt="default" data-toggle="modal" data-target=".b20-modal-sm" class="model_img img-responsive">HISTORIAL DE ABONOS</button></center>
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
                        <?php if (isset($_GET['configurar'])) { ?>
                         <li role="presentation" class="nav-item col-lg-6"><a href="#messages" class="nav-link active" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>

                        <li role="presentation" class="nav-item col-lg-6"><a href="#settings" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-times"></i></span> <span class="hidden-xs"><center><b>Eliminar</b></center></span></a></li>

                        <?php }elseif (isset($_GET['eliminar'])) { ?>
                         <li role="presentation" class="nav-item col-lg-6"><a href="#messages" class="nav-link " aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>

                        <li role="presentation" class="nav-item col-lg-6"><a href="#settings" class="nav-link active" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-times"></i></span> <span class="hidden-xs"><center><b>Eliminar</b></center></span></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                    <?php if (isset($_GET['configurar'])) { ?>
                        <div class="tab-pane active" id="messages" aria-expanded="false">
                    <?php }else{ ?>
                        <div class="tab-pane" id="messages" aria-expanded="false">
                    <?php } ?>

                    <form method="POST" id="formulario" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >

                                <input type="hidden" name="idUpdate" value=" <?php echo $idGet; ?> ">
                                
                              

                         <?php if(isset($_SESSION['administrador'])){ ?>

                            <div class="row">
                                <div class="col-md-3">
                                    <?php if($datos['tipoCliente']==1){ ?>
                                    <input checked type="checkbox" class="" name="tipoCliente" value="1">
                                    <?php }else{0?>
                                    <input type="checkbox" class="" name="tipoCliente" value="1">
                                    <?php }?>
                                    <label for="tipoCliente">Cliente</label>	
                                </div>
                                <div class="col-md-3">
                                    <?php if($datos['tipoProveedor']==1){ ?>
                                        <input checked type="checkbox" class="" name="tipoProveedor" value="1">
                                    <?php }else{0?>
                                        <input type="checkbox" class="" name="tipoProveedor" value="1">
                                    <?php }?>
                                    <label for="scales">Proveedor</label>														</div>
                                <div class="col-md-3">
                                    <?php if($datos['tipoEmpleado']==1){ ?>
                                        <input checked type="checkbox" class="" name="tipoEmpleado" value="1">
                                    <?php }else{0?>
                                        <input type="checkbox" class="" name="tipoEmpleado" value="1">
                                    <?php }?>
                                    <label for="scales">Empleado</label>														</div>
                                <div class="col-md-3">
                                    <input type="checkbox" class="" name="tipoOtro" value="1">
                                    <label for="scales">Otro</label>								
                                </div>
                            </div>

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
                                        <small>Clave para inicio de sesion <b>por defecto se asigna el documento del tercero.</b></small>
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
                                        <small>Nombres del tercero.</small>
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
                                        <small>Primer apellido del tercero.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <div class="row">
                                <div class="col-md-12">
                                <label for="exampleInputEmail1">
                                Documento
                                </label>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-10">
                                <input name='documento' id="documentoviejo" type="hidden" class="form-control m-input m-input--air m-input--pill"  value="<?php echo strtoupper($datos['documentUser']); ?>">

                                <input name='document' id="documento" type="text" class="form-control m-input m-input--air m-input--pill"  value="<?php echo strtoupper($datos['documentUser']); ?>">
                                </div>
                                <div class="col-md-2">
                                <input name='dv' id="digVer" type="text" class="form-control m-input m-input--air m-input--pill"  value="<?php echo strtoupper($datos['dv']); ?>">
                                </div>
                                </div>

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Documento del tercero.</small>
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
                                        <small>Telefono del tercero.</small>
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
                                        <small>Email del tercero.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="row">
                            <div class="col-md-3">
                                    <b>Pais*</b><br>
                                        <small>Pais de residencia</small>
                                <select class="form-control" name="pais" id="">
                                    <option value="<?php echo strtoupper($datos['codigopais']); ?>"><?php echo strtoupper($datos['pais']); ?></option>	
                                <?php while($paisesData=mysqli_fetch_array($arrayPaises)){ ?>
                                    <?php if($paisesData['codigo']!=$datos['codigopais']){ ?>
                                    <option value="<?php echo $paisesData['codigo'] ?>"><?php echo $paisesData['nombre'] ?></option>	
                                    <?php } ?>
                                <?php } ?>
                                </select>
                                </div>

                                <div class="col-md-3">
                                    <b>Departamento*</b><br>
                                        <small>Departamento de residencia</small>
                                <select class="form-control" name="departamento" id="">
                                    <option value="<?php echo strtoupper($datos['codigodepartamento']); ?>"><?php echo strtoupper($datos['departamento']); ?></option>	
                                <?php while($departamentoData=mysqli_fetch_array($arrayDepartamentos)){ ?>
                                    <?php if($departamentoData['codigo']!=$datos['codigodepartamento']){ ?>
                                    <option value="<?php echo $departamentoData['codigo'] ?>"><?php echo strtoupper($departamentoData['nombre']) ?></option>	
                                    <?php } ?>
                                <?php } ?>
                                </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <b>Municipio*</b><br>
                                        <small>Municipio de residencia</small>
                                <select class="form-control" name="municipio" id="">
                                    <option value="<?php echo strtoupper($datos['codmunicipio']); ?>"><?php echo strtoupper($datos['municipio']); ?></option>	
                                <?php while($municipiosData=mysqli_fetch_array($arrayMunicipios)){ ?>
                                    <?php if($municipiosData['codigo']!=$datos['codmunicipio']){ ?>
                                    <option value="<?php echo $municipiosData['codigo'] ?>"><?php echo $municipiosData['nombre'] ?></option>	
                                    <?php } ?>
                                <?php } ?>
                                </select>
                                </div>

                                <div class="col-md-3">
                                    <b>Direccion*</b><br>
                                        <small>Direccion de residencia</small>
                                        <input type="text" name="direccion" class="form-control" value="<?php echo strtoupper($datos['direccion']); ?>">
                                </select>
                                </div>
                                </div>
                            

                                    <div class="row">
                                    <div class="col-md-12">
                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                      <br>  <b>Foto</b>
                                    </font></font>
                                    <span class="m-form__help"><br>
                                        <small>Ingrese foto si desea actualizar la actual.</small>
                                    </span>
                                    <div class="m-input-icon" id="input8">
                                        <input type="file" class="form-control m-input m-input--air m-input--pill" name="photo" >
                                    </div>
                                    <br>
                                    </div>
                                    </div>


                            <div class="form-group m-form__group row">
                                <label class="col-form-label col-lg-12 col-sm-12">
                                    Descripcion
                                </label>
                                <div class="col-lg-12 col-md-9 col-sm-12">
                                    <textarea name="description" class="form-control m-input m-input--air m-input--pill" id="" maxlength="2000" placeholder="" rows="6"><?php echo strtoupper($datos['description']); ?></textarea>
                                    <span class="m--font-">
                                        <small>Descripcion del tercero.</small>
                                    </span>
                                </div>
                            </div>

                            <br><br>

                            <center><button class="btn m-btn--square btn-warning" type="button"  id="btnEditar">EDITAR</button></center><br><br>

                        </form>
            </div>


            <?php if(isset($_GET['eliminar'])) { ?>
                <div class="tab-pane active" id="settings" aria-expanded="false">
            <?php }else{ ?>
                <div class="tab-pane" id="settings" aria-expanded="false">
            <?php } ?>
                <?php if(isset($_SESSION['administrador']) AND !isset($_GET['perfil'])){ ?>
                        <br>
                        <center> <div class="col-lg-12 alert alert-info"> Esta a punto de eliminar un tercero, recuerde que si realiza esta accion ya no tendra disponible este tercero en ningun servicio. </div></center>


                        <div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="mySmallModalLabel">Alerta! esta seguro de realizar esta accion?</h4>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" id="formDelete">
                                        <input type="hidden" name="iduser" value="<?php echo $_SESSION['adminUserNew']; ?>">
                                        <input type="hidden" name="documento" value="<?php echo $datos['documento']; ?>">
                                        <input type="hidden" name="idDelete" value=" <?php echo $idGet; ?> ">
                                        <button class="btn m-btn--square btn-danger" type="button" id="btnDelete">Si</button>
                                        <button type="button" class="btn m-btn--square btn-success" data-dismiss="modal" aria-hidden="true">No</button>
                                    </form><!-- configurar -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <br> 
                    <center><button class="btn m-btn--square btn-danger" alt="default" data-toggle="modal" data-target=".bs-modal-sm" class="model_img img-responsive">ELIMINAR TERCERO</button></center>
                    <?php }elseif(isset($_GET['perfil'])){ ?>
                    <div class="alert alert-danger"> <center>No puedes eliminar tu cuenta, perderas el acceso al sistema.</center> </div>
                    <?php }else{ ?>
                    <div class="alert alert-danger"> No tienes permisos para eliminar los terceros, debes ingresar con una cuenta de administrador. </div>
                    <?php } ?>
        </div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php } ?>












<script>

$('#formulario').keyup(function(e) {
    if(e.keyCode == 13) {
        ajaxForm()
    }
});
$('#formDelete').keyup(function(e) {
    if(e.keyCode == 13) {
        ajaxDelete()
    }
});
$("#btnEditar").click(function () {
	ajaxForm()
})
$("#btnDelete").click(function () {
    ajaxDelete()
})


function ajaxForm(){
    var answer = $('#answerJS');
    var respuesta = $('#respuesta');
    var alertJS = $('#alertJS');
    var datos = $("#formulario").serialize();
    $.ajax({
        type: "POST",
        url: "../../irocket/controllers/ajax/ajax_validationTerceroUpdate.php",
        data: datos,
        success:function (data) {
            if(data==2){
                $("#formulario").submit();
            }else{
                respuesta.removeClass('hidden');
                answer.html(data);	
            }
        }
    });
}

function ajaxDelete(){
    var answer = $('#answerJS');
    var respuesta = $('#respuesta');
    var alertJS = $('#alertJS');
    var datos = $("#formDelete").serialize();
    $.ajax({
        type: "POST",
        url: "../../irocket/controllers/ajax/ajax_validationTerceroDelete.php",
        data: datos,
        success:function (data) {
            if(data==2){
                //respuesta.removeClass('hidden');
                //answer.html(data);	
                $("#formDelete").submit();
            }else{
                respuesta.removeClass('hidden');
                answer.html(data);	
            }
        }
    });
}




$("#documento").keyup(function(){
	documento=$("#documento").val()
	documentoinvertido=""

	for(var i = documento.length-1; i>=0; i--)
	{
		documentoinvertido += documento[i];
	}

	if(documento.length==1){
		documentoInv=documentoinvertido+'00000000000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)
		
		
		
	}
	if(documento.length==2){
		documentoInv=documentoinvertido+'0000000000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

		
	}
	if(documento.length==3){
		documentoInv=documentoinvertido+'000000000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

		
	}
	if(documento.length==4){
		documentoInv=documentoinvertido+'00000000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

		
	}
	if(documento.length==5){
		documentoInv=documentoinvertido+'0000000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

		
	}
	if(documento.length==6){
		documentoInv=documentoinvertido+'000000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
	if(documento.length==7){
		documentoInv=documentoinvertido+'00000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
	if(documento.length==8){
		documentoInv=documentoinvertido+'0000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
	if(documento.length==9){
		documentoInv=documentoinvertido+'000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)
	}
	if(documento.length==10){
		documentoInv=documentoinvertido+'00000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)
		

	}
	if(documento.length==11){
		documentoInv=documentoinvertido+'0000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
	if(documento.length==12){
		documentoInv=documentoinvertido+'000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
	if(documento.length==13){
		documentoInv=documentoinvertido+'00'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
	if(documento.length==14){
		documentoInv=documentoinvertido+'0'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
	if(documento.length==15){
		documentoInv=documentoinvertido
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
});
                                    
$(document).ready(function () {
//$("#alertabien").slideUp(5000).delay(5000);

    $('#alertabien').delay(5000).slideToggle(1000, function () {
        $('#alertabien').removeClass("show");
    });
    return false;
});

</script>
