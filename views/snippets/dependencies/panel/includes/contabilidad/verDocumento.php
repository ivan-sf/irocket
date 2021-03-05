
<?php
if(isset($_SESSION['adminUser']) OR isset($_SESSION['adminUserNew'])){
//echo $_SESSION['adminUser'];


    $modelContabilidad = new models\Contabilidad();
    $modelCompany = new models\Company();
    $con = new models\Conexion();
    $comprobante = $_GET['comprobante'];
    $numero = $_GET['numero'];
    $array = $modelContabilidad->set("comprobante", $comprobante);
    $array2 = $modelContabilidad->set("numero", $numero);
    $arrayComprobantes = $modelContabilidad->arrayDocumento();
    $arrayRegistros = $modelContabilidad->arrayRegistros();
    $datosComprobante = mysqli_fetch_array($arrayComprobantes);
    $arrayCompany = $modelCompany->dataCompany();
    $datosCompany = mysqli_fetch_array($arrayCompany);
}else{
    header("location:" . URL);
}


?>

<div id="page-wrapper" style="min-height: 601px;">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Contabilidad</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Comprobantes contables</a></li>
                    <li class="active">Documento</li>
                </ol>
            </div>
        </div>
<?php if (isset($_GET['success'])) {
    if ($_GET['success'] == 'deposito') {
        echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-success alert-dismissible fade show' role='alert' id='alertabien'>
            <div class='m-alert__icon'>
            <i class='flaticon-rocket'></i>
            </div>
            <div class='m-alert__text'>
            <strong>
            Genial !
            </strong>
            has ingresado el abono de saldo correctamente. Si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '>nuestro sitio web.</a>
            </div>
            <div class='m-alert__close'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
            </div>
            </div>";
    }  
}
?>  
        <!-- /.row -->
        
        <div class="row">
            
            <div class="col-md-12">                
                  
                    <div class="btn-group m-r-10">
                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle waves-effect waves-light" type="button">ACCIONES <span class="caret"></span></button>
                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir</span> </button>
                        <ul role="menu" class="dropdown-menu">
                            
                            <li><a href="<?php echo URL; ?>contabilidad/crear?tipo=documento">Crear comprobante</a></li>
                            <li><a href="<?php echo URL; ?>contabilidad/crear?tipo=comprobante">Lista de comprobantes</a></li>
                            <li><a href="<?php echo URL; ?>contabilidad/editar?tipo=documento&numero=<?php echo $_GET['numero'] ?>&comprobante=<?php echo $_GET['comprobante'] ?>">Editar comprobante</a></li>
                            <li><a href="<?php echo URL; ?>contabilidad/eliminar?tipo=documento&numero=<?php echo $_GET['numero'] ?>&comprobante=<?php echo $_GET['comprobante'] ?>">Eliminar comprobante</a></li>
                            <li><a href="<?php echo URL; ?>contabilidad/duplicar?tipo=documento&numero=<?php echo $_GET['numero'] ?>&comprobante=<?php echo $_GET['comprobante'] ?>">Duplicar comprobante</a></li>
                                
                            <!--
                            <li class="divider"></li>
                            <li><a href="<?php //echo URL; ?>facturas/detalles?id=<?php //echo $_GET['id']; ?>&cancelar">Eliminar factura</a></li>-->
                        </ul>
                    </div>
                  
                    <br><br>
                <div class="white-box printableArea">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                <center>
                                <img src="<?php echo URL.$datosCompany['rutaLogoCompany'] ?>" alt="" width="250">
                                </center>
                                <br><b>Tercero:</b> <?php echo strtoupper($datosComprobante['terceroNombre']); ?><br>
                                <b>Documento:</b> <?php echo $datosComprobante['terceroDocumento']; ?>
                       
                                </th>
                                <th>
                                <div class="col-lg-12"  style="
                            margin-left: 0px;">
                               <center>
                                    <h5><b><?php echo strtoupper($datosCompany['propietario']); ?></b> </h5>
                                    <h5>NIT <?php echo strtoupper($datosCompany['nitCompany']); ?> </h5>
                                    <h5><?php echo strtoupper($datosCompany['directionCompany']); ?> </h5>
                                    <h5>TELEFONO: <?php echo strtoupper($datosCompany['phoneCompany']); ?> </h5>
                                    <h5><?php echo strtoupper($datosCompany['cityCompany']); ?> </h5>
                                </center>
                                <?php if($datosComprobante['descripcion']!=""){

?>
<div class="col-lg-12" style="border-style: solid;
margin-left: 0px;">
<center><?php echo $datosComprobante['descripcion']; ?></center>
</div>
<?php } ?>
                               </div>
                                </th>
                                <th>
                                <div class="col-lg-12" style="border-style: solid;
                            margin-left: 0px;">
                                <center>
                                <h4><b><?php echo $datosComprobante['tipoComprobante']; ?></b> </h4>
                                <h5>NUMERO: <?php echo $datosComprobante['prefijo']."-".$datosComprobante['comprobante']; ?></h5>
                                <h5>FECHA: <?php echo $datosComprobante['fechaDMA']; ?></h5>
                                <h5>HORA: <?php echo $datosComprobante['fechaHMs']; ?></h5>
                                </center>
                                
                            </div>
                            <br>

                            
                                </th>
                            </tr>
                        </thead>
                    </table>

                    

                   
                    
                
                    
                    <hr>


                    <div class="row">
                        <div class="col-md-12">

                        <table class="table table-striped table-bordered" >
                                    <thead>
                                        <tr >
                                            <th scope="col" class="border" style="margin:12%;">
                                                #
                                            </th>
                                            <th scope="col" class="border">
                                                Codigo PUC
                                            </th>
                                            <th scope="col" class="border">
                                                Cuenta contable
                                            </th>
                                            <th scope="col" class="border">
                                                Detalle
                                            </th>
                                            <th scope="col" class="border">
                                                Tercero
                                            </th>
                                            <th scope="col" class="border">
                                                Base
                                            </th>
                                            <th scope="col" class="border">
                                                Debito
                                            </th>
                                            <th scope="col" class="border">
                                                Credito
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0;$totaldebito=0;$totalcredito=0;$totalbase=0;
                                            while($datosRegistros = mysqli_fetch_array($arrayRegistros)){ 
                                                $i++; 
                                                $totalbase+=$datosRegistros['base'];
                                                $totaldebito+=$datosRegistros['debito'];
                                                $totalcredito+=$datosRegistros['credito'];
                                        ?>
                                        <tr>
                                            
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo strtoupper($datosRegistros['codigo']); ?></td>
                                            <td><?php echo strtoupper($datosRegistros['nombre']); ?></td>
                                            <td><?php echo strtoupper($datosRegistros['detalle']); ?></td>
                                            <td><?php echo strtoupper($datosRegistros['terceroNombre']); ?></td>
                                            <td><?php echo number_format($datosRegistros['base'], 2, ',', ' '); ?></td>
                                            <td><?php echo number_format($datosRegistros['debito'], 2, ',', ' '); ?></td>
                                            <td><?php echo number_format($datosRegistros['credito'], 2, ',', ' '); ?></td>
                                                
                                            
                                        </tr>
                                        <?php }  ?>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>Total</b></td>
                                            <td><?php echo number_format($totalbase, 2, ',', ' ') ?></td>
                                            <td><?php echo number_format($totaldebito, 2, ',', ' ') ?></td>
                                            <td><?php echo number_format($totalcredito, 2, ',', ' ') ?></td>
                                        </tr>
                                       
                                        
                                    </tbody>
                                    
                                </table>
                        </div>
                    </div>
                </div>
            </div>
 
        </div>
    </div>

    <script>

        $(document.body).keyup(function(e) {
            console.log(e.which)
            if (e.which == 27) {
                window.history.go(-1);
            }
        })


    $(document).ready(function () {
        $('#alertabien').delay(8000).slideToggle(1000, function () {
            $('#alertabien').removeClass("show");
        });
        return false;
    });

</script>
                         