<?php
if(isset($_SESSION['adminUser']) OR isset($_SESSION['adminUserNew'])){
//echo $_SESSION['adminUser'];
    $modelContabilidad = new models\Contabilidad();
    $con = new models\Conexion();
    $arrayPuc = $modelContabilidad->arrayPuc();
    $arrayUsers = $modelContabilidad->arrayUsers();
    $arrayComprobantes = $modelContabilidad->arrayComprobantes();
    $comprobante = $_GET['comprobante'];
    $numero = $_GET['numero'];
    $array = $modelContabilidad->set("comprobante", $comprobante);
    $array2 = $modelContabilidad->set("numero", $numero);
    $arrayComprobante = $modelContabilidad->arrayDocumento();
    $datosComprobante = mysqli_fetch_array($arrayComprobante);
    $arrayRegistros = $modelContabilidad->arrayRegistros();										
}else{
    header("location:" . URL);
}


?>

<div id="page-wrapper">
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Contabilidad</h4> </div>

        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#"><?php //echo $_SESSION['adminUserNew']; ?>Panel</a></li>
            <li><a href="#">Contabilidad</a></li>
            <li class="active">Lista</li>
        </ol>
    </div>
        <!-- /.col-lg-12 -->
    </div>
    
    <div class="btn-group m-r-10">
        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle waves-effect waves-light" type="button">ACCIONES <span class="caret"></span></button>
        <ul role="menu" class="dropdown-menu">
            
            <li><a href="<?php echo URL; ?>contabilidad/ver?tipo=documento&numero=<?php echo $_GET['numero'] ?>&comprobante=<?php echo $_GET['comprobante'] ?>">Ver comprobante</a></li>
            <li><a href="<?php echo URL; ?>contabilidad/crear?tipo=documento">Crear comprobante</a></li>
            <li><a href="<?php echo URL; ?>contabilidad/eliminar?tipo=documento&numero=<?php echo $_GET['numero'] ?>&comprobante=<?php echo $_GET['comprobante'] ?>">Eliminar comprobante</a></li>
            <li><a href="<?php echo URL; ?>contabilidad/editar?tipo=documento&numero=<?php echo $_GET['numero'] ?>&comprobante=<?php echo $_GET['comprobante'] ?>">Editar comprobante</a></li>
            <li><a href="<?php echo URL; ?>contabilidad/crear?tipo=comprobante">Lista de comprobantes</a></li>
                
            <!--
            <li class="divider"></li>
            <li><a href="<?php //echo URL; ?>facturas/detalles?id=<?php //echo $_GET['id']; ?>&cancelar">Eliminar factura</a></li>-->
        </ul>
    </div>
    
    <br>
    <br>

                	
				<div class="white-box">
                    <?php if(isset($_GET['error'])){ ?>
                    <div class="alert alert-danger" role="alert">
                        <center>NO ES POSIBLE DUPLICAR COMPROBANTES DE COMPRA O VENTA</center>
                    </div>
                    <?php } ?>
					<div class="row"><br>
					

						<div class="col-sm-12">
                        <div class="alert alert-primary" role="alert">
                            <center>¿SEGURO QUE DESEA DUPLICAR <?php echo $datosComprobante['tipoComprobante'] ?> # <?php echo $datosComprobante['comprobante'] ?>?</center>
                            <form action="" id="formulario" method="POST">
                                <input type="hidden" name="numeracion" value="<?php echo $datosComprobante['comprobante'] ?>">
                                <input type="hidden" name="tipo" value="<?php echo $datosComprobante['tipoNotacontable'] ?>">
                        </div>
                        <input type="submit" value="DUPLICAR DOCUMENTO" class="btn btn-success btn-block">
                        </form>

                            
						</div>
					</div>
				</div>
            </div> 
            
            <?php if(isset($_GET['error']) OR isset($_GET['success'])){
?>												
<script>
$(document.body).keyup(function(e) {
           // console.log(e.which)
	if (e.which == 27) {
		window.history.go(-2);
	}
})
</script>
<?php }else{ ?>		
<script>
$(document.body).keyup(function(e) {
           // console.log(e.which)
	if (e.which == 27) {
		window.history.go(-1);
	}
})
</script>										
<?php } ?>		

<script>
    $(document).ready(function(){


        $(document.body).keyup(function(e) {
           // console.log(e.which)
            if (e.which == 27) {
                window.history.go(-1);
            }
        })


        

        

        
        $(document.body).click(function () {
            var datos = $("#formulario").serialize();
            $.ajax({
                type: "POST",
                url: "viewcomprobantes",
                data: datos,
                success:function (data) {
                    if(data){
                        json = JSON.parse(data)
                        numeracion=json.numeracion
                        //$("#numeracion").val(numeracion)
                        //$(".numeracion").html(numeracion)
                        //console.log(json.nombre)
                    }else{
                     //   console.log(data)
                    }
                }
            });
           // console.log ($("#comprobante").val())
        })

        $(document.body).keypress(function () {
            var datos = $("#formulario").serialize();
            $.ajax({
                type: "POST",
                url: "viewcomprobantes",
                data: datos,
                success:function (data) {
                    if(data){
                        json = JSON.parse(data)
                        numeracion=json.numeracion
                        //$("#numeracion").val(numeracion)
                        //$(".numeracion").html(numeracion)
                        //console.log(json.nombre)
                    }else{
                        //console.log(data)
                    }
                }
            });
           // console.log ($("#comprobante").val())
        })
