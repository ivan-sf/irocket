<?php 
$modelCompany = new models\DepositAccount();
$con = new models\Conexion();
$arrayCompany = $modelCompany->array();
$datos = mysqli_fetch_array($arrayCompany);

$idGet = $_GET['id'];
$arrayCompany1 = $modelCompany->set("iduser",$idGet);
$dataCompany = $modelCompany->dataCompany();
$datos1 = mysqli_fetch_array($dataCompany);

$modelCash = new models\Movements();
$arrayCash = $modelCash->todayListDepositAll();
$arrayCash2 = $modelCash->todayListRetreatsAll();

$modelMov = new models\Movements();
$atA = $modelMov->alltimeActive();
$atP = $modelMov->alltimePassive();
$totalA = 0;
while ($dataA = mysqli_fetch_array($atA)) {
    $totalA += $dataA['totalMoney'];
}
$totalP = 0;
while ($dataP = mysqli_fetch_array($atP)) {
    $totalP += $dataP['totalMoney'];
}
if (isset($_SESSION['administrador'])) {
    echo "1";
}else{
    header("location:" . URL . "");
}
?>

<div id="page-wrapper" style="min-height: 953px;">

            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Cuenta de depositos</h4> </div>

                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Panel</a></li>
                        <li><a href="#">Depositos</a></li>
                        <li class="active">Detalles</li>
                    </ol>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-lg-4">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="<?php echo URL;?>views/plugins/images/large/5.jpg">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="<?php echo URL;?>views/plugins/images/large/10.png" height="100" alt="img"></a>
                                        <h4 class="text-white"><?php echo strtoupper($datos1['numberAccount']); ?></h4>                                        
                                        <h5 class="text-white"><?php echo "$" . number_format($totalA-$totalP)."<br>"; ?></h5>
                                    </div>
                                </div>
                            </div>
                           

                            <div class="user-btm-box">
                                <h3 class="box-title"><center>Caracteristicas</center></h3>
                                <ul class="basic-list">
                                    <li>Codigo<span class="pull-right label-danger label"><?php echo strtoupper($datos1['codeAccount']); ?></span></li>
                                    <li>Banco<span class="pull-right label-purple label"><?php echo strtoupper($datos1['bank']); ?></span></li>
                                    <li>Fondos totales<span class="pull-right label-success label"><?php echo "$" . number_format($totalA-$totalP)."<br>"; ?></span></li>
                                   
                                </ul>
                                
                                
                            </div>
                            <div class="user-btm-box">
                               
                                 <div class="col-md-6 col-sm-6 text-center">
                                    <p class="text-success"><b>Ingresos</b></p>
                                    <h3> <?php  echo number_format($totalA); ?></h3>
                                </div>
                                <div class="col-md-6 col-sm-6 text-center">
                                    <p class="text-danger"><b>Gastos</b></p>
                                    <h3><?php  echo number_format($totalP); ?></h3>
                                </div>

                                <div class="col-md-12 col-sm-12 text-center">
                                    <p class="text-purple"><b>Balance general</b></p>
                                    <h3><?php  echo number_format($totalA-$totalP); ?></h3>
                                </div>
                
                          
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 col-lg-8">
                        <div class="white-box">
                            <ul class="nav customtab nav-tabs" role="tablist">















                                <?php if (isset($_GET['detalles'])) { ?>

                                    
                                    <li role="presentation" class="nav-item col-lg-4"><a href="#home" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-rocket"></i></span>
                                    <span class="hidden-xs"> <center><b>Movimientos</b></center></span></a>
                                    </li>

                                    <?php if ($_GET['tipo']=='activo'): ?>

                                    <li role="presentation" class="nav-item col-lg-4"><a href="#fondos" class="nav-link " aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-rocket"></i></span>
                                    <span class="hidden-xs"> <center><b>Deposito</b></center></span></a>
                                    </li>

                                        
                                    <?php endif ?>

                                    <?php if ($_GET['tipo']=='pasivo'): ?>

                                    <li role="presentation" class="nav-item col-lg-4"><a href="#fondos" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-rocket"></i></span>
                                    <span class="hidden-xs"> <center><b>Retiro</b></center></span></a>
                                    </li>

                                        
                                    <?php endif ?>
                                    
                                     

                                    <li role="presentation" class="nav-item col-lg-3"><a href="#messages" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>


                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane active" id="home" aria-expanded="true">






                                            <?php if (isset($_GET['success'])) {
                                                    echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-success alert-dismissible fade show' role='alert' id='alertabien'>
                                                        <div class='m-alert__icon'>
                                                        <i class='flaticon-rocket'></i>
                                                        </div>
                                                        <div class='m-alert__text'>
                                                        <strong>
                                                        Genial !
                                                        </strong>
                                                        El depositos se ha eliminado correctamente. Si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '>nuestro sitio web.</a>
                                                        </div>
                                                        <div class='m-alert__close'>
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                                        </div>
                                                        </div>";
                                            }
                                            ?>  
                                    
                                



                                <?php if (isset($_GET['eliminar'])) { ?>
                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                                <div class="white-box text-center bg-info">
                                                    <h5><p class="text-white"><b>¿Esta seguro de que desea eliminar el deposito?</b></p></h5>
                                                    <h5><p class="text-white">Para retirar ingrese el signo restar (-) al inicio de la suma de dinero (-100000).    </p></h5>
                                                </div>
                                            </div>

                                    

                                     <div class="col-lg-12">
                                        <form method="POST">
                                            <input type="hidden" name="idDeposit" value="<?php echo $_GET['eliminar']; ?>">
                                            <button class="btn btn-block btn-warning waves-effect waves-light" type="submit"><b>ELIMINAR DEPOSITO</b></button><br>

                                            <a href="<?php echo URL; ?>depositos/detalles?id=1&detalles&tipo=activo"><br>
                                             <button class="btn btn-block btn-danger waves-effect waves-light" type="button"><b>CANCELAR</b></button>
                                        </form>
                                            
                                    </div>
                                <?php } ?>














                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3 class="text-success"><center><b>Depositos</b></center></h3>
                                        <div class="row">
                                            <?php $i=mysqli_num_rows($arrayCash)+1; while($datos = mysqli_fetch_array($arrayCash)) { $i--?>
                                            <div class="col-lg-12 col-md12- col-sm-12 col-xs-12">
                                                <div class="white-box">
                                                    <div class="product-img">
                                                        <img width="80" class="img-circle" src="<?php echo URL ?>views/plugins/images/mov_add.png" >

                                                    </div>
                                                    <div class="product-text">
                                                        <center>
                                                            <a href="?id=1&detalles&eliminar=<?php echo $datos['idmovementDepositAccount'] ?>&tipo=activo"><p&tipo=activo class="">Eliminar</p></a>
                                                            <h6 class="box-title m-b-0"><small>Deposito #<?php echo $i; ?></small></h6>
                                                            <b><center><?php echo number_format($datos['totalMoney']); ?></center></b>
                                                            <b><center><?php echo $datos['typeDeposit']; ?></center></b>
                                                            <small>
                                                            <center><?php echo $datos['fecha']; ?></center>
                                                            </small>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <h3 class="text-danger"><center><b>Retiros</b></center></h3>
                                        <div class="row">
                                            <?php $i=mysqli_num_rows($arrayCash2)+1; while($datos = mysqli_fetch_array($arrayCash2)) { $i--?>
                                            <div class="col-lg-12 col-md12- col-sm-12 col-xs-12">
                                                <div class="white-box">
                                                    <div class="product-img">
                                                        <img class="img-circle" width="80" src="<?php echo URL ?>views/plugins/images/deposit_retirement.png" >

                                                    </div>
                                                    <div class="product-text">
                                                        <center>
                                                            <a href="?id=1&detalles&eliminar=<?php echo $datos['idmovementDepositAccount'] ?>&tipo=activo"><p class="">Eliminar</p></a>
                                                            <h6 class="box-title m-b-0"><small>Retiro #<?php echo $i; ?></small></h6>
                                                            <b><center><?php echo number_format($datos['totalMoney']); ?></center></b>
                                                            <b><center><?php echo $datos['typeDeposit']; ?></center></b>
                                                           
                                                            <small>
                                                            <center><?php echo $datos['fecha']; ?></center>
                                                            </small>

                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>


                                </div>































                                 <?php if ($_GET['tipo']=='activo'): ?>
                                    
                               


                            <div class="tab-pane" id="fondos" aria-expanded="false">

                                <div class="col-lg-12">
                                    <button type="button" class="btn waves-effect waves-light btn-warning">
                                        <a class="text-white" href="<?php echo URL ?>depositos/detalles?id=1&fondos&tipo=pasivo">Cambiar a retiros</a>
                                    </button>

                                </div>
                                <br>
                                  
                                    <div class="col-lg-12">
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
                                        Se editaron los fondos de la cuenta de depositos correctamente puedes ver el resultado acontinuacion.

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
                                        Tienes que ingresar una suma superior a 0, para ingresar un retiro presiona el boton superior.

                                        </center>
                                        </div>
                                        <div class='m-alert__close'>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                        </div>
                                        </div>";
                                    } ?>
                                    </div>
                                        <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >

                                            <input type="hidden" name="idFondos" value=" <?php echo $idGet; ?> ">

                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                <div class="white-box text-center bg-success">
                                                    <h5><p class="text-white"><b>Fondos actuales</b></p></h5>
                                                    <h1 class="text-white counter"><b><?php  echo number_format($totalA-$totalP); ?></b></h1>
                                                    <h5><p class="text-white">INGRESAR DEPOSITO1</p></h5>
                                                </div>
                                            </div><br>

                                            <div class="form-group m-form__group">
                                          

                                                <input name='fondos' type="hidden" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['currentAssets']); ?>">   
                                                <input type="hidden" name="tipoDeposito" value="activo"> 
                                                <input name='' disabled="" type="hidden" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo number_format($datos1['currentAssets']); ?>">                                            
                                            </div>

                                            <div class="form-group m-form__group">
                                                <div class="col-lg-12">


                                                <label for="exampleInputEmail1">
                                                    Tipo de ingreso
                                                </label>
                                                <input type="text" name="typeDeposit" autofocus class="form-control m-input m-input--air m-input--pill">
                                                <div class="col-lg-12">
                                                    <span class="m-form__help">
                                                        <span class="m--font-">
                                                            <small>Por favor seleccione el tipo de deposito que desea ingresar.</small>
                                                        </span>
                                                    </span>
                                                </div>
                                                <br>

                                                <label for="exampleInputEmail1">
                                                    Valor de ingreso
                                                </label>
                                                <input name='newfondos' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                                <span class="m-form__help">
                                                    <span class="m--font-">
                                                        <small>Por favor ingrese la suma de dinero que desea agregar de su cuenta de depositos.</small>
                                                    </span>
                                                </span>
                                                <br>
                                                
                                                </div>
                                                
                                            </div>

                                            <center><button class="btn m-btn--square btn-success" type="submit" >AGREGAR</button></center><br><br>
                                        </form>
                                
                                </div>









                            <div class="tab-pane" id="pasivo" aria-expanded="false">
                                  
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
                                        Se editaron los fondos de la cuenta de depositos correctamente puedes ver el resultado acontinuacion.

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
                                        Tienes que ingresar una suma superior a 0.

                                        </center>
                                        </div>
                                        <div class='m-alert__close'>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                        </div>
                                        </div>";
                                    } ?>
                                        <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >

                                            <input type="hidden" name="idFondos" value=" <?php echo $idGet; ?> ">

                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                <div class="white-box text-center bg-success">
                                                    <h5><p class="text-white"><b>Fondos actuales</b></p></h5>
                                                    <h1 class="text-white counter"><b><?php  echo number_format($totalA-$totalP); ?></b></h1>
                                                    <h5><p class="text-white">RETIRAR DEPOSITO</p></h5>
                                                </div>
                                            </div><br>

                                            <div class="form-group m-form__group">
                                          

                                                <input name='fondos' type="hidden" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['currentAssets']); ?>">                                            
                                                <input name='' disabled="" type="hidden" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo number_format($datos1['currentAssets']); ?>">                                            
                                            </div>

                                            <div class="form-group m-form__group">
                                                <div class="col-lg-12">
                                                <label for="exampleInputEmail1">
                                                    Tipo de egreso
                                                </label>
                                                
                                                <input type="text" name="typeDeposit" autofocus class="form-control m-input m-input--air m-input--pill">
                                                
                                                <div class="col-lg-12">
                                                    <span class="m-form__help">
                                                        <span class="m--font-">
                                                            <small>Por favor seleccione el tipo de deposito que desea retirar.</small>
                                                        </span>
                                                    </span>
                                                </div>
                                                <br>

                                                <label for="exampleInputEmail1">
                                                    Valor de egreso
                                                </label>
                                                <input autofocus="" autofocus="" name='newfondos' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                                <span class="m-form__help">
                                                    <span class="m--font-">
                                                        <small>Por favor ingrese la suma de dinero que desea retirar de su cuenta de depositos.</small>
                                                    </span>
                                                </span>
                                                <br>
                                                    
                                                </div>
                                                
                                            </div>

                                            <center><button class="btn m-btn--square btn-success" type="submit" >AGREGAR</button></center><br><br>
                                        </form>
                                
                                </div>

                                 <?php endif ?>




























































































                                <div class="tab-pane" id="messages" aria-expanded="false">
                                    


                            <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >
                                <input type="hidden" name="idUpdate" value=" <?php echo $idGet; ?> ">
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Nombre 
                                </label>
                                <input name='number' type="text" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['numberAccount']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el nombre de la cuenta.</small>
                                    </span>
                                </span>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Banco
                                </label>
                                <input name='bank' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['bank']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el banco de la cuenta.</small>
                                    </span>
                                </span><br><br>
                                <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center><br><br>
                            </div>
                  











































































                         <?php }elseif (isset($_GET['configurar'])){  ?>
                                    <li role="presentation" class="nav-item col-lg-4"><a href="#home" class="nav-link" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-rocket"></i></span>
                                    <span class="hidden-xs"> <center><b>Movimientos</b></center></span></a>
                                    </li>

                                    <?php if ($_GET['tipo']=='activo'): ?>

                                    <li role="presentation" class="nav-item col-lg-4"><a href="#fondos" class="nav-link " aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-rocket"></i></span>
                                    <span class="hidden-xs"> <center><b>Deposito</b></center></span></a>
                                    </li>

                                        
                                    <?php endif ?>

                                    <?php if ($_GET['tipo']=='pasivo'): ?>

                                    <li role="presentation" class="nav-item col-lg-4"><a href="#fondos" class="nav-link" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-rocket"></i></span>
                                    <span class="hidden-xs"> <center><b>Retiro</b></center></span></a>
                                    </li>

                                        
                                    <?php endif ?>
                                    
                                     

                                    <li role="presentation" class="nav-item col-lg-4"><a href="#messages" class="nav-link active" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>


                            </ul>
                            <div class="tab-content">

                                <?php if ($_GET['tipo']=='activo'): ?>
                                    
                               


                            <div class="tab-pane" id="fondos" aria-expanded="false">

                                <div class="col-lg-12">
                                    <button type="button" class="btn waves-effect waves-light btn-warning">
                                        <a class="text-white" href="<?php echo URL ?>depositos/detalles?id=1&fondos&tipo=pasivo">Cambiar a retiros</a>
                                    </button>

                                </div>
                                <br>
                                  
                                    <div class="col-lg-12">
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
                                        Se editaron los fondos de la cuenta de depositos correctamente puedes ver el resultado acontinuacion.

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
                                        Tienes que ingresar una suma superior a 0, para ingresar un retiro presiona el boton superior.

                                        </center>
                                        </div>
                                        <div class='m-alert__close'>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                        </div>
                                        </div>";
                                    } ?>
                                    </div>
                                        <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >

                                            <input type="hidden" name="idFondos" value=" <?php echo $idGet; ?> ">

                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                <div class="white-box text-center bg-success">
                                                    <h5><p class="text-white"><b>Fondos actuales</b></p></h5>
                                                    <h1 class="text-white counter"><b><?php  echo number_format($totalA-$totalP); ?></b></h1>
                                                    <h5><p class="text-white">INGRESAR DEPOSITO3</p></h5>
                                                </div>
                                            </div><br>

                                            <div class="form-group m-form__group">
                                          

                                                <input name='fondos' type="hidden" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['currentAssets']); ?>">   
                                                <input type="hidden" name="tipoDeposito" value="activo"> 
                                                <input name='' disabled="" type="hidden" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo number_format($datos1['currentAssets']); ?>">                                            
                                            </div>

                                            <div class="form-group m-form__group">
                                                <div class="col-lg-12">


                                                <label for="exampleInputEmail1">
                                                    Tipo de ingreso
                                                </label>
                                                
                                                <input type="text" name="typeDeposit" autofocus class="form-control m-input m-input--air m-input--pill">
                                                
                                                <div class="col-lg-12">
                                                    <span class="m-form__help">
                                                        <span class="m--font-">
                                                            <small>Por favor seleccione el tipo de deposito que desea ingresar.</small>
                                                        </span>
                                                    </span>
                                                </div>
                                                <br>

                                                <label for="exampleInputEmail1">
                                                    Valor de ingreso
                                                </label>
                                                <input autofocus="" autofocus="" name='newfondos' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                                <span class="m-form__help">
                                                    <span class="m--font-">
                                                        <small>Por favor ingrese la suma de dinero que desea agregar de su cuenta de depositos.</small>
                                                    </span>
                                                </span>
                                                <br>
                                                
                                                </div>
                                                
                                            </div>

                                            <center><button class="btn m-btn--square btn-success" type="submit" >AGREGAR</button></center><br><br>
                                        </form>
                                
                                </div>









                            <div class="tab-pane" id="pasivo" aria-expanded="false">
                                  
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
                                        Se editaron los fondos de la cuenta de depositos correctamente puedes ver el resultado acontinuacion.

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
                                        Tienes que ingresar una suma superior a 0.

                                        </center>
                                        </div>
                                        <div class='m-alert__close'>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                        </div>
                                        </div>";
                                    } ?>
                                        <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >

                                            <input type="hidden" name="idFondos" value=" <?php echo $idGet; ?> ">

                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                <div class="white-box text-center bg-success">
                                                    <h5><p class="text-white"><b>Fondos actuales</b></p></h5>
                                                    <h1 class="text-white counter"><b><?php  echo number_format($totalA-$totalP); ?></b></h1>
                                                    <h5><p class="text-white">RETIRAR DEPOSITO</p></h5>
                                                </div>
                                            </div><br>

                                            <div class="form-group m-form__group">
                                          

                                                <input name='fondos' type="hidden" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['currentAssets']); ?>">                                            
                                                <input name='' disabled="" type="hidden" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo number_format($datos1['currentAssets']); ?>">                                            
                                            </div>

                                            <div class="form-group m-form__group">
                                                <div class="col-lg-12">
                                                <label for="exampleInputEmail1">
                                                    Tipo de egreso
                                                </label>
                                               
                                                <input type="text" name="typeDeposit" autofocus class="form-control m-input m-input--air m-input--pill">
                                                

                                                <div class="col-lg-12">
                                                    <span class="m-form__help">
                                                        <span class="m--font-">
                                                            <small>Por favor seleccione el tipo de deposito que desea retirar.</small>
                                                        </span>
                                                    </span>
                                                </div>
                                                <br>

                                                <label for="exampleInputEmail1">
                                                    Valor de egreso
                                                </label>
                                                <input autofocus="" autofocus="" name='newfondos' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                                <span class="m-form__help">
                                                    <span class="m--font-">
                                                        <small>Por favor ingrese la suma de dinero que desea retirar de su cuenta de depositos.</small>
                                                    </span>
                                                </span>
                                                <br>
                                                    
                                                </div>
                                                
                                            </div>

                                            <center><button class="btn m-btn--square btn-success" type="submit" >AGREGAR</button></center><br><br>
                                        </form>
                                
                                </div>

                                 <?php endif ?>





                               <div class="tab-pane" id="home" aria-expanded="true">






                                            <?php if (isset($_GET['success'])) {
                                                    echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-success alert-dismissible fade show' role='alert' id='alertabien'>
                                                        <div class='m-alert__icon'>
                                                        <i class='flaticon-rocket'></i>
                                                        </div>
                                                        <div class='m-alert__text'>
                                                        <strong>
                                                        Genial !
                                                        </strong>
                                                        El depositos se ha eliminado correctamente. Si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '>nuestro sitio web.</a>
                                                        </div>
                                                        <div class='m-alert__close'>
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                                        </div>
                                                        </div>";
                                            }
                                            ?>  
                                    
                                



                                <?php if (isset($_GET['eliminar'])) { ?>
                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                                <div class="white-box text-center bg-info">
                                                    <h5><p class="text-white"><b>¿Esta seguro de que desea eliminar el deposito?</b></p></h5>
                                                    <h5><p class="text-white">Para retirar ingrese el signo restar (-) al inicio de la suma de dinero (-100000).    </p></h5>
                                                </div>
                                            </div>

                                    

                                     <div class="col-lg-12">
                                        <form method="POST">
                                            <input type="hidden" name="idDeposit" value="<?php echo $_GET['eliminar']; ?>">
                                            <button class="btn btn-block btn-warning waves-effect waves-light" type="submit"><b>ELIMINAR DEPOSITO</b></button><br>

                                            <a href="<?php echo URL; ?>depositos/detalles?id=1&detalles&tipo=activo"><br>
                                             <button class="btn btn-block btn-danger waves-effect waves-light" type="button"><b>CANCELAR</b></button>
                                        </form>
                                            
                                    </div>
                                <?php } ?>














                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3 class="text-success"><center><b>Depositos</b></center></h3>
                                        <div class="row">
                                            <?php $i=mysqli_num_rows($arrayCash)+1; while($datos = mysqli_fetch_array($arrayCash)) { $i--?>
                                            <div class="col-lg-12 col-md12- col-sm-12 col-xs-12">
                                                <div class="white-box">
                                                    <div class="product-img">
                                                        <img width="80" class="img-circle" src="<?php echo URL ?>views/plugins/images/mov_add.png" >

                                                    </div>
                                                    <div class="product-text">
                                                        <center>
                                                            <a href="?id=1&detalles&eliminar=<?php echo $datos['idmovementDepositAccount'] ?>&tipo=activo"><p class="">Eliminar</p></a>
                                                            <h6 class="box-title m-b-0"><small>Deposito #<?php echo $i; ?></small></h6>
                                                            <b><center><?php echo number_format($datos['totalMoney']); ?></center></b>
                                                            <b><center><?php echo $datos['typeDeposit']; ?></center></b>
                                                            <small>
                                                            <center><?php echo $datos['fecha']; ?></center>
                                                            </small>

                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <h3 class="text-danger"><center><b>Retiros</b></center></h3>
                                        <div class="row">
                                            <?php $i=mysqli_num_rows($arrayCash2)+1; while($datos = mysqli_fetch_array($arrayCash2)) { $i--?>
                                            <div class="col-lg-12 col-md12- col-sm-12 col-xs-12">
                                                <div class="white-box">
                                                    <div class="product-img">
                                                        <img class="img-circle" width="80" src="<?php echo URL ?>views/plugins/images/deposit_retirement.png" >

                                                    </div>
                                                    <div class="product-text">
                                                        <center>
                                                            <a href="?id=1&detalles&eliminar=<?php echo $datos['idmovementDepositAccount'] ?>&tipo=activo"><p class="">Eliminar</p></a>
                                                            <h6 class="box-title m-b-0"><small>Retiro #<?php echo $i; ?></small></h6>
                                                            <b><center><?php echo number_format($datos['totalMoney']); ?></center></b>
                                                            <b><center><?php echo $datos['typeDeposit']; ?></center></b>
                                                            <small>
                                                            <center><?php echo $datos['fecha']; ?></center>
                                                            </small>

                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
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
                                        Se editaron los fondos de la cuenta de depositos correctamente puedes ver el resultado acontinuacion.

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
                                <input name='number' type="text" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['numberAccount']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el nombre de la cuenta.</small>
                                    </span>
                                </span>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">
                                    Banco
                                </label>
                                <input name='bank' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['bank']); ?>">

                                <span class="m-form__help">
                                    <span class="m--font-">
                                        <small>Por favor ingrese los cambios a realizar en el banco de la cuenta.</small>
                                    </span>
                                </span><br><br>
                                <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center><br><br>
                            </div>
                  
                            









                        
                  
                            






































































                        <?php }elseif (isset($_GET['fondos'])){  ?>
                                    <li role="presentation" class="nav-item col-lg-4"><a href="#home" class="nav-link" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-rocket"></i></span>
                                    <span class="hidden-xs"> <center><b>Movimientos</b></center></span></a>
                                    </li>

                                    <?php if ($_GET['tipo']=='activo'): ?>

                                    <li role="presentation" class="nav-item col-lg-4"><a href="#fondos" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-rocket"></i></span>
                                    <span class="hidden-xs"> <center><b>Deposito</b></center></span></a>
                                    </li>

                                        
                                    <?php endif ?>

                                    <?php if ($_GET['tipo']=='pasivo'): ?>

                                    <li role="presentation" class="nav-item col-lg-4"><a href="#fondos" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-rocket"></i></span>
                                    <span class="hidden-xs"> <center><b>Retiro</b></center></span></a>
                                    </li>

                                        
                                    <?php endif ?>
                                    
                                     

                                    <li role="presentation" class="nav-item col-lg-3"><a href="#messages" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-refresh"></i></span> <span class="hidden-xs"><center><b>Editar</b></center></span></a></li>


                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane" id="home" aria-expanded="true">






                                            <?php if (isset($_GET['success'])) {
                                                    echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-success alert-dismissible fade show' role='alert' id='alertabien'>
                                                        <div class='m-alert__icon'>
                                                        <i class='flaticon-rocket'></i>
                                                        </div>
                                                        <div class='m-alert__text'>
                                                        <strong>
                                                        Genial !
                                                        </strong>
                                                        El depositos se ha eliminado correctamente. Si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '>nuestro sitio web.</a>
                                                        </div>
                                                        <div class='m-alert__close'>
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                                        </div>
                                                        </div>";
                                            }
                                            ?>  
                                    
                        

                                <?php if (isset($_GET['eliminar'])) { ?>
                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                                <div class="white-box text-center bg-info">
                                                    <h5><p class="text-white"><b>¿Esta seguro de que desea eliminar el deposito?</b></p></h5>
                                                    <h5><p class="text-white">Para retirar ingrese el signo restar (-) al inicio de la suma de dinero (-100000).    </p></h5>
                                                </div>
                                            </div>

                                    

                                     <div class="col-lg-12">
                                        <form method="POST">
                                            <input type="hidden" name="idDeposit" value="<?php echo $_GET['eliminar']; ?>">
                                            <button class="btn btn-block btn-warning waves-effect waves-light" type="submit"><b>ELIMINAR DEPOSITO</b></button><br>

                                            <a href="<?php echo URL; ?>depositos/detalles?id=1&detalles&tipo=activo"><br>
                                             <button class="btn btn-block btn-danger waves-effect waves-light" type="button"><b>CANCELAR</b></button>
                                        </form>
                                            
                                    </div>
                                <?php } ?>














                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3 class="text-success"><center><b>Depositos</b></center></h3>
                                        <div class="row">
                                            <?php $i=mysqli_num_rows($arrayCash)+1; while($datos = mysqli_fetch_array($arrayCash)) { $i--?>
                                            <div class="col-lg-12 col-md12- col-sm-12 col-xs-12">
                                                <div class="white-box">
                                                    <div class="product-img">
                                                        <img width="80" class="img-circle" src="<?php echo URL ?>views/plugins/images/mov_add.png" >

                                                    </div>
                                                    <div class="product-text">
                                                        <center>
                                                            <a href="?id=1&detalles&eliminar=<?php echo $datos['idmovementDepositAccount'] ?>&tipo=activo"><p class="">Eliminar</p></a>
                                                            <h6 class="box-title m-b-0"><small>Deposito #<?php echo $i; ?></small></h6>
                                                            <b><center><?php echo number_format($datos['totalMoney']); ?></center></b>
                                                            <b><center><?php echo $datos['typeDeposit']; ?></center></b>
                                                            <small>
                                                            <center><?php echo $datos['fecha']; ?></center>
                                                            </small>

                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <h3 class="text-danger"><center><b>Retiros</b></center></h3>
                                        <div class="row">
                                            <?php $i=mysqli_num_rows($arrayCash2)+1; while($datos = mysqli_fetch_array($arrayCash2)) { $i--?>
                                            <div class="col-lg-12 col-md12- col-sm-12 col-xs-12">
                                                <div class="white-box">
                                                    <div class="product-img">
                                                        <img class="img-circle" width="80" src="<?php echo URL ?>views/plugins/images/deposit_retirement.png" >

                                                    </div>
                                                    <div class="product-text">
                                                        <center>
                                                            <a href="?id=1&detalles&eliminar=<?php echo $datos['idmovementDepositAccount'] ?>&tipo=activo"><p class="">Eliminar</p></a>
                                                            <h6 class="box-title m-b-0"><small>Retiro #<?php echo $i; ?></small></h6>
                                                            <b><center><?php echo number_format($datos['totalMoney']); ?></center></b>
                                                            <b><center><?php echo $datos['typeDeposit']; ?></center></b>
                                                            <small>
                                                            <center><?php echo $datos['fecha']; ?></center>
                                                            </small>

                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>


                                </div>











































































                              
                                    
                               


                            <div class="tab-pane active" id="fondos" aria-expanded="false">
                                  <?php if ($_GET['tipo']=='activo'): ?>

                                <div class="col-lg-12">
                                    <button type="button" class="btn waves-effect waves-light btn-warning">
                                        <a class="text-white" href="<?php echo URL ?>depositos/detalles?id=1&fondos&tipo=pasivo">Cambiar a retiros</a>
                                    </button>

                                </div>
                                <br>
                                  
                                    <div class="col-lg-12">
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
                                        Se editaron los fondos de la cuenta de depositos correctamente puedes ver el resultado acontinuacion.

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
                                        Tienes que ingresar una suma superior a 0, para ingresar un retiro presiona el boton superior.

                                        </center>
                                        </div>
                                        <div class='m-alert__close'>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                        </div>
                                        </div>";
                                    } ?>
                                    </div>
                                        <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >

                                            <input type="hidden" name="idFondos" value=" <?php echo $idGet; ?> ">

                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                <div class="white-box text-center bg-success">
                                                    <h5><p class="text-white"><b>Fondos actuales</b></p></h5>
                                                    <h1 class="text-white counter"><b><?php  echo number_format($totalA-$totalP); ?></b></h1>
                                                    <h5><p class="text-white">INGRESAR DEPOSITO</p></h5>
                                                </div>
                                            </div><br>

                                            <div class="form-group m-form__group">
                                          

                                                <input name='fondos' type="hidden" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['currentAssets']); ?>">   
                                                <input type="hidden" name="tipoDeposito" value="activo"> 
                                                <input name='' disabled="" type="hidden" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo number_format($datos1['currentAssets']); ?>">                                            
                                            </div>

                                            <div class="form-group m-form__group">
                                                <div class="col-lg-12">


                                                <label for="exampleInputEmail1">
                                                    Tipo de ingreso
                                                </label>
                                                <?php 
                                                if (isset($_GET['motivo'])) { ?>
                                                <input autofocus="" autofocus="" name='typeDeposit' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                                <?php  }else{ ?>
                                                 
                                                <input type="text" name="typeDeposit" autofocus class="form-control m-input m-input--air m-input--pill">
                                                
                                                <?php  } ?>
                                                
                                                <div class="col-lg-12">
                                                    <span class="m-form__help">
                                                        <span class="m--font-">
                                                            <small>Por favor seleccione el tipo de deposito que desea ingresar. 
                                                            <?php if (isset($_GET['motivo'])) { ?>
                                                                <a href="<?php echo URL ?>depositos/detalles?id=1&fondos&tipo=activo">MOTIVOS GENERALES</a>
                                                                
                                                            <?php }else{ ?>
                                                                <a href="<?php echo URL ?>depositos/detalles?id=1&fondos&tipo=activo&motivo">OTRO MOTIVO</a>
                                                            <?php  } ?>
                                                            </small>
                                                        </span>
                                                    </span>
                                                </div>
                                                <br>

                                                <label for="exampleInputEmail1">
                                                    Valor de ingreso
                                                </label>
                                                <input autofocus="" autofocus="" name='newfondos' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                                <span class="m-form__help">
                                                    <span class="m--font-">
                                                        <small>Por favor ingrese la suma de dinero que desea agregar de su cuenta de depositos.</small>
                                                    </span>
                                                </span>
                                                <br>
                                                
                                                </div>
                                                
                                            </div>

                                            <center><button class="btn m-btn--square btn-success" type="submit" >AGREGAR</button></center><br><br>
                                        </form>
                                
                                </div>









                            <div class="tab-pane" id="pasivo" aria-expanded="false">
                                  
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
                                        Se editaron los fondos de la cuenta de depositos correctamente puedes ver el resultado acontinuacion.

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
                                        Tienes que ingresar una suma superior a 0.

                                        </center>
                                        </div>
                                        <div class='m-alert__close'>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                        </div>
                                        </div>";
                                    } ?>
                                        <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >

                                            <input type="hidden" name="idFondos" value=" <?php echo $idGet; ?> ">

                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                <div class="white-box text-center bg-success">
                                                    <h5><p class="text-white"><b>Fondos actuales</b></p></h5>
                                                    <h1 class="text-white counter"><b><?php  echo number_format($totalA-$totalP); ?></b></h1>
                                                    <h5><p class="text-white">RETIRAR DEPOSITO</p></h5>
                                                </div>
                                            </div><br>

                                            <div class="form-group m-form__group">
                                          

                                                <input name='fondos' type="hidden" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['currentAssets']); ?>">                                            
                                                <input name='' disabled="" type="hidden" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo number_format($datos1['currentAssets']); ?>">                                            
                                            </div>

                                            <div class="form-group m-form__group">
                                                <div class="col-lg-12">
                                                <label for="exampleInputEmail1">
                                                    Tipo de egreso
                                                </label>
                                                
                                                <input type="text" name="typeDeposit" autofocus class="form-control m-input m-input--air m-input--pill">
                                                
                                                <div class="col-lg-12">
                                                    <span class="m-form__help">
                                                        <span class="m--font-">
                                                            <small>Por favor seleccione el tipo de deposito que desea retirar.</small>
                                                        </span>
                                                    </span>
                                                </div>
                                                <br>

                                                <label for="exampleInputEmail1">
                                                    Valor de egreso
                                                </label>
                                                <input autofocus="" autofocus="" name='newfondos' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                                <span class="m-form__help">
                                                    <span class="m--font-">
                                                        <small>Por favor ingrese la suma de dinero que desea retirar de su cuenta de depositos.</small>
                                                    </span>
                                                </span>
                                                <br>
                                                    
                                                </div>
                                                
                                            </div>

                                            <center><button class="btn m-btn--square btn-success" type="submit" >AGREGAR</button></center><br><br>
                                        </form>
                                
                                </div>

                                 <?php endif ?>






























                                 <?php if ($_GET['tipo']=='pasivo'): ?>
                                    
                               
                            <div class="col-lg-12">
                                <button type="button" class="btn waves-effect waves-light btn-success">
                                        <a class="text-white" href="<?php echo URL ?>depositos/detalles?id=1&fondos&tipo=activo">Cambiar a depositos</a>
                                </button>
                            </div>
                            <br>

                           
                            <div class="tab-pane" id="pasivo" aria-expanded="false">
                                  
                                   <div class="col-lg-12">
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
                                        Se editaron los fondos de la cuenta de depositos correctamente puedes ver el resultado acontinuacion.

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
                                        Tienes que ingresar una suma superior a 0, para ingresar un deposito presiona el boton superior.

                                        </center>
                                        </div>
                                        <div class='m-alert__close'>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                        </div>
                                        </div>";
                                    } ?>
                                   </div>
                                        <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >

                                            <input type="hidden" name="idFondos" value=" <?php echo $idGet; ?> ">

                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                <div class="white-box text-center bg-warning">
                                                    <h5><p class="text-white"><b>Fondos actuales</b></p></h5>
                                                    <h1 class="text-white counter"><b><?php  echo number_format($totalA-$totalP); ?></b></h1>
                                                    <h5><p class="text-white">AGREGAR PASIVO</p></h5>
                                                </div>
                                            </div><br>

                                            <div class="form-group m-form__group">
                                          

                                                <input name='fondos' type="hidden" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['currentAssets']); ?>">                                            
                                                <input name='' disabled="" type="hidden" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo number_format($datos1['currentAssets']); ?>">                                            
                                            </div>

                                            <div class="form-group m-form__group">
                                                <div class="col-lg-12">
                                                <label for="exampleInputEmail1">
                                                    Tipo de ingreso
                                                </label>
                                                <?php if (isset($_GET['motivo'])) { ?>
                                                <input name='typeDeposit' type="text" class="form-control m-input m-input--air m-input--pill" id="" >
                                                <?php }else{ ?>
                                               
                                                    <input type="text" name="typeDeposit" autofocus class="form-control m-input m-input--air m-input--pill">
                                                
                                                <?php } ?>
                                                <div class="col-lg-12">
                                                    <span class="m-form__help">
                                                        <span class="m--font-">
                                                            <small>Por favor seleccione el tipo de deposito que desea ingresar. 
                                                            <?php if (isset($_GET['motivo'])) { ?>
                                                                <a href="<?php echo URL ?>depositos/detalles?id=1&fondos&tipo=pasivo">MOTIVOS GENERALES</a>
                                                                
                                                            <?php }else{ ?>
                                                                <a href="<?php echo URL ?>depositos/detalles?id=1&fondos&tipo=pasivo&motivo">OTRO MOTIVO</a>
                                                            <?php  } ?>
                                                            </small>
                                                        </span>
                                                    </span>
                                                </div>
                                                <br>

                                                <label for="exampleInputEmail1">
                                                    Fondos a ingresar
                                                </label>
                                                <input autofocus="" autofocus="" name='newfondos' type="number" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                                <span class="m-form__help">
                                                    <span class="m--font-">
                                                        <small>Por favor ingrese la suma de dinero que desea agregar o retirar a su cuenta de depositos.</small>
                                                    </span>
                                                </span>
                                                <br>
                                                <br>
                                                    
                                                </div>
                                                
                                            </div>

                                            <center><button class="btn m-btn--square btn-success" type="submit" >AGREGAR</button></center><br><br>
                                        </form>
                                
                                </div>



                                 <?php endif ?>






                       



































                        <?php if ($_GET['tipo']=='activo'): ?>
                                 <div class="tab-pane" id="messages" aria-expanded="false">
                            <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >
                                <input type="hidden" name="idUpdate" value=" <?php echo $idGet; ?> ">
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Nombre 
                                    </label>
                                    <input name='number' type="text" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['numberAccount']); ?>">

                                    <span class="m-form__help">
                                        <span class="m--font-">
                                            <small>Por favor ingrese los cambios a realizar en el nombre de la cuenta.</small>
                                        </span>
                                    </span>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Banco
                                    </label>
                                    <input name='bank' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['bank']); ?>">

                                    <span class="m-form__help">
                                        <span class="m--font-">
                                            <small>Por favor ingrese los cambios a realizar en el banco de la cuenta.</small>
                                        </span>
                                    </span>
                                </div>
                                <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center>
                            </form>
                        </div>
                            <?php endif ?>





























                  
                            
                        <?php  } ?>

                       






                            

                            </div>

                            <?php if ($_GET['tipo']=='pasivo'): ?>
                                 <div class="tab-pane" id="messages" aria-expanded="false">
                            <form method="POST" class="m-form m-form--fit m-form--label-align-right"  enctype="multipart/form-data" >
                                <input type="hidden" name="idUpdate" value=" <?php echo $idGet; ?> ">
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Nombre 
                                    </label>
                                    <input name='number' type="text" class="form-control m-input m-input--air m-input--pill" id="" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['numberAccount']); ?>">

                                    <span class="m-form__help">
                                        <span class="m--font-">
                                            <small>Por favor ingrese los cambios a realizar en el nombre de la cuenta.</small>
                                        </span>
                                    </span>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">
                                        Banco
                                    </label>
                                    <input name='bank' type="text" class="form-control m-input m-input--air m-input--pill" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo strtoupper($datos1['bank']); ?>">

                                    <span class="m-form__help">
                                        <span class="m--font-">
                                            <small>Por favor ingrese los cambios a realizar en el banco de la cuenta.</small>
                                        </span>
                                    </span>
                                </div>
                                <center><button class="btn m-btn--square btn-warning" type="submit" >EDITAR</button></center>
                            </form>
                        </div>
                            <?php endif ?>
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
