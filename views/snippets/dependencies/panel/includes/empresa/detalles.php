<?php 
$modelCompany = new models\Company();
$con = new models\Conexion();
$arrayCompany = $modelCompany->array();
$datos = mysqli_fetch_array($arrayCompany);

$idGet = $_GET['id'];
$arrayCompany1 = $modelCompany->set("iduser",$idGet);
$dataCompany = $modelCompany->dataCompany();
$datos1 = mysqli_fetch_array($dataCompany);
$datos1A = mysqli_num_rows($dataCompany);

$modelProducts = new models\Inventory();
$arrayProducts = $modelProducts->array();

$modelCompany = new models\DepositAccount();
$arrayCompany1 = $modelCompany->set("iduser",$idGet);
$dataCompany = $modelCompany->dataCompany();
$datos2 = mysqli_fetch_array($dataCompany);

$modelMovements = new models\Movements();
$dataTodayPassive = $modelMovements->alltimePassive();
$dataTodayActive = $modelMovements->alltimeActive();

$totalP = 0;
while ( $totalPassive = mysqli_fetch_array($dataTodayPassive)) {
     $totalP += $totalPassive['totalMoney']; 
 }
 $totalA = 0;
while ( $totalActive = mysqli_fetch_array($dataTodayActive)) {
     $totalA += $totalActive['totalMoney']; 
 }

$modelPP = new models\Products();

?>
<div id="page-wrapper" style="min-height: 953px;">

            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Empresa</h4> </div>

                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Panel</a></li>
                        <li><a href="#">Empresa</a></li>
                        <li class="active">Detalles</li>
                    </ol>
                </div>
                    <!-- /.col-lg-12 -->
                </div>
       <!--  <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php // echo URL ?>inventarios" class="">Ver inventarios</a></button><br><br>

                <!-- /.row -->

                <div class="row">
                    <div class="col-md-12 col-xs-12 col-lg-4">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="<?php echo URL;?>views/plugins/images/large/5.jpg">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="<?php echo URL . $datos1['rutaLogoCompany'];?>" height="100" alt="img"></a>
                                        <h4 class="text-white"><?php echo strtoupper($datos1['nameCompany']); ?></h4>
                                        <h5 class="text-white"><?php echo strtoupper($datos1['nitCompany']); ?></h5>
                                    </div>
                                </div>
                            </div>
                           

                            <div class="user-btm-box">
                                <h3 class="box-title"><center>Caracteristicas</center></h3>
                                <ul class="basic-list">
                                    <li>Direccion<span class="pull-right label-danger label"><?php echo strtoupper($datos1['directionCompany']); ?></span></li>
                                    <li>Ciudad<span class="pull-right label-purple label"><?php echo strtoupper($datos1['cityCompany']); ?></span></li>
                                    <li>Email<span class="pull-right label-success label"><?php echo strtoupper($datos1['emailCompany']); ?></span></li>
                                    <li>Celular<span class="pull-right label-info label"><?php echo strtoupper($datos1['phoneCompany']); ?></span></li>
                                   
                                </ul>
                                
                                
                            </div>
                            <div class="user-btm-box">
                               
                                <div class="col-md-12 col-xs-12 col-sm-6">
                                    <div class="white-box text-center bg-success">
                                        <h1 class="text-white counter"><b>$<?php echo number_format($totalA - $totalP); ?> COP</b></h1>
                                        <h5><p class="text-white"><b>Balance general</b></p></h5>
                                    </div>
                                </div>

                                
                
                          
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 col-lg-8">
                        <div class="white-box">
                            <ul class="nav customtab nav-tabs" role="tablist">















                                <?php if (isset($_GET['detalles'])) { ?>

                                   
                                    <li role="presentation" class="nav-item col-lg-12"><a href="#messages" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>
                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane active" id="home" aria-expanded="true">
                                        <div class="row">
                                            <?php 
                                            $dataArray = mysqli_num_rows($arrayProducts);
                                            if ($dataArray == 0) { ?>
                                <div class="col-lg-12">
                                    <center>
                        <h4><b>No se encontraron inventarios activos.</b></h4>
                         <button class="btn m-btn--pill btn-success"><a class="text-white" href="<?php echo URL; ?>inventarios/crear">Crear inventarios</a></button>
                         </center>
                                </div>
                                            <?php  } ?>

                                <?php while($datos = mysqli_fetch_array($arrayProducts)) { ?>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="white-box">
                                        <div class="product-img">
                                            <img src="<?php echo URL ?>views/plugins/images/warehouse.png" >
                                            <div class="pro-img-overlay">
                                                <a href="<?php echo URL; ?>inventarios/detalles?id=<?php echo $datos['idinventory']; ?>&detalles" class="bg-info"><i class="ti-eye"></i></a> 
                                                <a href="<?php echo URL; ?>inventarios/detalles?id=<?php echo $datos['idinventory']; ?>&configurar" class="bg-warning"><i class="ti-marker-alt"></i></a> 
                                                <a href="<?php echo URL; ?>inventarios/detalles?id=<?php echo $datos['idinventory']; ?>&eliminar" class="bg-danger"><i class="ti-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-text">
                                            <?php $arrayPP = $modelPP->arrayInventory($datos['idinventoryDetails']); ?>
                                            <span class="pro-price bg-danger">
                                                <?php 
                                                    $numPP = mysqli_num_rows($arrayPP);
                                                    echo $numPP;
                                                ?>
                                            </span>
                                            <h3 class="box-title m-b-0"><?php echo $datos['nameInventory']; ?></h3>
                                            <small class="text-muted db"><?php echo $datos['descriptionInventory']; ?></small>
                                        </div>
                                    </div>
                                </div>
                                 <?php } ?>
                                        </div>
                                </div>
                                <div class="tab-pane" id="messages" aria-expanded="false">
                                    <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >
                                <input type="hidden" name="idUpdate" value=" <?php echo $idGet; ?> ">
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Nombre 
                                </label>
                                <input name='name' type="text" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['nameCompany']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el nombre.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    NIT
                                </label>
                                <input name='nit' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['nitCompany']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el NIT.</small>
                                    </span>
                                </span>
                            </div>

                            

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Direccion
                                </label>
                                <input name='direction' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['directionCompany']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en la direccion.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Ciudad
                                </label>
                                <input name='city' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['cityCompany']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en la ciudad de ubicacion.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Telefono
                                </label>
                                <input name='phone' type="tel" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['phoneCompany']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el telefono de contacto.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Email
                                </label>
                                <input name='email' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['emailCompany']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el Email.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Foto
                                </label>
                                <input name='photo' type="file" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" >

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en la foto de la empresa.</small>
                                    </span>
                                </span>
                            </div>














                         <?php }else{  ?>

                        
                                    
                                    <li role="presentation" class="nav-item col-lg-12"><a href="#messages" class="nav-link active" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>
                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane" id="home" aria-expanded="true">
                                    <div class="steamline">
                                        <div class="row">
                                            <?php 
                                            $dataArray = mysqli_num_rows($arrayProducts);
                                            if ($dataArray == 0) { ?>
                                <div class="col-lg-12">
                                    <center>
                        <h4><b>No se encontraron inventarios activos.</b></h4>
                         <button class="btn m-btn--pill btn-success"><a class="text-white" href="<?php echo URL; ?>inventarios/crear">Crear inventarios</a></button>
                         </center>
                                </div>
                                            <?php  } ?>
                                 <?php while($datos = mysqli_fetch_array($arrayProducts)) { ?>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="white-box">
                                        <div class="product-img">
                                            <img src="<?php echo URL ?>views/plugins/images/warehouse.png" >
                                            <div class="pro-img-overlay">
                                                <a href="<?php echo URL; ?>inventarios/detalles?id=<?php echo $datos['idinventory']; ?>&detalles" class="bg-info"><i class="ti-eye"></i></a> 
                                                <a href="<?php echo URL; ?>inventarios/detalles?id=<?php echo $datos['idinventory']; ?>&configurar" class="bg-warning"><i class="ti-marker-alt"></i></a> 
                                                <a href="<?php echo URL; ?>inventarios/detalles?id=<?php echo $datos['idinventory']; ?>&eliminar" class="bg-danger"><i class="ti-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-text">
                                             <?php $arrayPP = $modelPP->arrayInventory($datos['idinventoryDetails']); ?>
                                            <span class="pro-price bg-danger">
                                                <?php 
                                                    $numPP = mysqli_num_rows($arrayPP);
                                                    echo $numPP;
                                                ?>
                                            </span>
                                            <h3 class="box-title m-b-0"><?php echo $datos['nameInventory']; ?></h3>
                                            <small class="text-muted db"><?php echo $datos['descriptionInventory']; ?></small>
                                        </div>
                                    </div>
                                </div>
                                 <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane active" id="messages" aria-expanded="false">
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
                                            Se editaron los datos correctamente puedes ver el resultado acontinuacion.

                                            </center>
                                            </div>
                                            <div class='m-alert__close'>
                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                            </div>
                                            </div>";
                        } ?>
                                    <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >
                                <input type="hidden" name="idUpdate" value=" <?php echo $idGet; ?> ">
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Nombre 
                                </label>
                                <input name='name' type="text" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['nameCompany']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el nombre.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Nit
                                </label>
                                <input name='nit' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['nitCompany']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el NIT.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Resolucion
                                </label>
                                <input name='resolucion' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['resolucion']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el Resolucion.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="">
                                    Prefijo Inicial
                                </label>
                                <input name='prefijoInicial' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos1['prefijoInicial']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el prefijo inicial.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="form-group m-form__group">
                                <label>
                                    Prefijo Final
                                </label>
                                <input name='prefijoFinal' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos1['prefijoFinal']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el Prefijo final.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Direccion
                                </label>
                                <input name='direction' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['directionCompany']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en la direccion.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Ciudad
                                </label>
                                <input name='city' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['cityCompany']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en la ciudad de ubicacion.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Telefono
                                </label>
                                <input name='phone' type="tel" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['phoneCompany']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el telefono de contacto.</small>
                                    </span>
                                </span>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Email
                                </label>
                                <input name='email' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['emailCompany']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el Email.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="form-group m-form__group">
                                <label>
                                    Mensaje Pie de Factura
                                </label>
                                <input name='pieFactura' type="text" class="form-control m-input m-input--air m-input--pill" value="<?php echo strtoupper($datos1['pieFactura']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el Email.</small>
                                    </span>
                                </span>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Foto
                                </label>
                                <input name='photo' type="file" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" >

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en la foto de la empresa.</small>
                                    </span>
                                </span>
                            </div>
                        <?php  } ?>














                            <br><br>

                            <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center><br><br>

                        </form>
                                </div>


                            

                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
            </div>

<script>
                                    
$(document).ready(function () {
//$("#alertabien").slideUp(5000).delay(5000);

    $('#alertabien').delay(5000).slideToggle(1000, function () {
        $('#alertabien').removeClass("show");
    });
    return false;
});

</script>
