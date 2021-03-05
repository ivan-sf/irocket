<?php
$modelInventory = new models\Inventory();
$con = new models\Conexion();
$arrayInventory = $modelInventory->array();
$rowInventory = $modelInventory->row();

$modelProducts = new models\Products();
$arrayProducts = $modelProducts->arrayCrear();
if(isset($_GET['inventario'])){
    $inventarioGet = $_GET['inventario'];
    $arrayCode = $modelProducts->set("inventarioGet",$inventarioGet);
    $dataCode = $modelProducts->viewInv();
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
                    <li class="active">Crear</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>productos?catalogo" class="">Catalogo</a></button>
        <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>productos/tabla?index" class="">Tabla</a></button>
        <br>
        <br>

        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">

                    <!--INICIO ENCABEZADO-->
                    <div class="m-portlet__head ">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title col-lg-12">

                                <center>
                                    <h3 class="box-title">Crear productos</h3>
                                </center>

                                <div class="col-lg-12">
                                    <div id="respuesta2" class="hiddenDIV">

                                        <div class="m-alert m-alert--icon m-alert--air alert alert-warning alert-dismissible fade show" role="alert" id="alertJS">
                                            <div class="m-alert__icon">
                                                <i class="la la-warning"></i>
                                            </div>
                                            <div class="m-alert__text">
                                                <center> <strong>
                                                        Lo sentimos,
                                                    </strong>
                                                    <span id="answerJS2"></span></center>
                                            </div>
                                            <div class="m-alert__close">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <?php if (isset($_GET['success'])) {
                                    echo "
                                                        <div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-success alert-dismissible fade show' role='alert' id='alertabien'>
                                                        <div class='m-alert__icon'>
                                                        <i class='flaticon-rocket'></i>
                                                        </div>
                                                        <div class='m-alert__text'>
                                                        <center> 
                                                        <strong>
                                                        Genial !
                                                        </strong>
                                                        Los datos se han registrado correctamente, ahora puedes comprar o vender productos por medio de las cajas, no olvides que para mayor informacion de los paquetes puedes visitar nuestro <a target='_blank' href='<?php URL_SITIO ?> '>nuestro sitio web.</a>
                                                        </center>
                                                        </div>
                                                        <div class='m-alert__close'>
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                                        </div>
                                                        </div>";
                                } elseif (isset($_GET['error'])) {
                                    if ($_GET['error'] == 'existe') {
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
                                                            Ya existe un producto con el mismo codigo de venta y/o codigo de promocion.
                                                            </center>
                                                            </div>
                                                            <div class='m-alert__close'>
                                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                                            </div>
                                                            </div>";
                                    } elseif ($_GET['error'] == 'code') {
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
                                                            El codigo de venta no puede ser igual que el codigo de promocion.
                                                            </center>
                                                            </div>
                                                            <div class='m-alert__close'>
                                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                                            </div>
                                                            </div>";
                                    }
                                } ?>

                            </div>
                        </div>
                    </div>
                    <!--FINAL ENCABEZADO-->

                    <!--INICIO FORMULARIO-->
                    <form onsubmit="return checkSubmit();" method="POST" enctype="multipart/form-data" id="formulario">

                        <div class="col-lg-12">
                            <center>
                                <?php
                                if (isset($_GET['inventario'])) { ?>
                                    <h4>Inventario <b><?php echo ucfirst($_GET['inventario']); ?></b>
                                        <input type="hidden" name="idInventary" value="<?php echo $_GET['inventario'] ?>"><a href="<?php echo URL; ?>productos/crear"><small><small>Cambiar inventario</small></small></a></h4>
                                    <input type="hidden" name="typeInventory" value="1"></h4>
                                <?php } else { ?>
                            </center>
                        </div>
                        <?php
                            if(!isset($_GET['inventario'])){
                        ?>
                        








                    <!--INICIO LINEA DE PRODUCTOS-->

                        <div class="col-lg-12">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">
                                <center><b>LINEA DE PRODUCTOS</b>
                            </font>
                        </font>
                        <span class="m-form__help"><br>
                            <small>Por favor seleccione la linea de productos al que desea agregar el producto</small>
                        </span>
                        </center>
                        <div class="m-input-icon" id="input9">

                            <input type="hidden" name="typeInventory" value="2"></h4>
                            <select id="optionvalue" name="idInventary" id="idInventary" class="form-control m-input m-input--air m-input--pill"">
                                <?php while ($datos1 = mysqli_fetch_array($arrayInventory)) { ?>
                                <option id="">
                                    <?php echo strtoupper($datos1['nameInventory']) . "<br>"; ?>    
                                </option>
                                <?php } ?>
                            </select>
                                
                            </div>
                            <br>
                        </div>

                        <?php } ?>
                    <!--FINAL LINEA DE PRODUCTOS-->
                      <!--INICIO BOTON-->
                    <div class="row col-lg-12">
                        <div class="col-lg-12">
                            <br>
                            <center>
                                <button type="button" class="btn btn-block m-btn--square btn-rounded btn-success" id="botonSeleccionarInventario">
                                    <h4 class="text-black">Seleccionar inventario</h4>
                                </button>
                            </center>
                        </div>
                    </div>
                    <!--FINAL BOTON-->





















                        <?php
                            }
                        if(isset($_GET['inventario'])){
                        ?>
                        
                    <!--INICIO NOMBRE DE PRODUCTOS-->
                        <div class=" col-lg-12">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    <b>Nombre *</b>
                                </font>
                            </font>

                            <br>
                            <span class="m-form__help">
                                <small> <b>Nombre del producto </b></small>
                            </span>
                            <div class="m-input-icon" id="">
                                <input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Nombre del producto" name="nameProduct" id="nameProduct">

                            </div>
                        </div>
                    <!--FINAL NOMBRE DE PRODUCTOS-->
                    <!--INICIO CODIGO Y PRECIO VENTA DE PRODUCTOS-->
                        <br>
                        <div class="row col-lg-12">

                            <div class="col-lg-6">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        <b>Codigo *</b>
                                    </font>
                                </font>
                                <button type="button" class="btn btn-rounded btn-outline-success" id="botonCodes">
                                    +
                                </button>
                                <br>
                                <span class="m-form__help">
                                    <small> <b>Codigo del producto *primer codigo obligatorio* </b> </small>
                                </span>
                                <div class="m-input-icon" id="input1">
                                <?php 
                                    while ($datosCod = mysqli_fetch_array($dataCode)) {
                                   
                                ?>
                                    <input type="text" disabled class="form-control m-input m-input--air m-input--pill" value="<?php echo $datosCod['codeCurrent']+1 ?>" id="">
                                    <input type="hidden" class="form-control m-input m-input--air m-input--pill" value="<?php echo $datosCod['codeCurrent']+1 ?>" name="codeProduct_1" id="">

                                </div>  
                                <?php 
                                 }
                                ?>
                            </div>

                            <br>

                            <div class="col-lg-6">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        <b>Precio de venta*</b>
                                    </font>
                                </font>
                                <button type="button" class="btn btn-rounded btn-outline-success" id="botonPrecios">
                                    +
                                </button>
                                <br>
                                <span class="m-form__help">
                                    <small> <b>Precio de venta del producto *primer precio obligatorio* </b></small>
                                </span>
                                <div class="m-input-icon" id="input2">
                                    <input type="number" class="form-control m-input m-input--air m-input--pill" placeholder="Precio de venta" name="priceProduct_1" id="codeProduct">

                                </div>
                            </div>
                        </div>
                    <!--FINAL CODIGO Y PRECIO VENTA DE PRODUCTOS-->
                    <!--INICIO PRECIO DE COMPRA E IVA-->
                        <br>
                        <div class="row col-lg-12">
                            <div class="col-lg-6">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">
                                            <b>Precio de compra*</b>
                                        </font>
                                    </font>

                                    <br>
                                    <span class="m-form__help">
                                        <small> <b>Precio de compra del producto </b></small>
                                    </span>

                                    <div class="m-input-icon" id="">
                                        <input type="number" class="form-control m-input m-input--air m-input--pill" placeholder="Precio de compra" name="priceBuy" id="priceBuy">

                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">
                                            <b>IVA*</b>
                                        </font>
                                    </font>

                                    <br>
                                    <span class="m-form__help">
                                        <small> <b>IVA del producto </b></small>
                                    </span>

                                    <div class="form-group">
                                        <select class="form-control" name="ivaProduct">
                                            <option value="19">19%</option>
                                            <option value="5">5%</option>
                                            <option value="0">0%</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                    <!--FINAL PRECIO DE COMPRA E IVA-->



                    <!--INICIO UNIDADES / PRESENTACION-->
                    <input type="hidden" class="form-control m-input m-input--air m-input--pill" placeholder="Unidades por caja" name="unidadesCaja" id="unidadesCaja">
                    <input type="hidden" class="form-control m-input m-input--air m-input--pill" placeholder="Presentacion farmaceutica" name="presentacionFarmaceutica" id="presentacionFarmaceutica">
                    <input type="hidden" class="form-control m-input m-input--air m-input--pill" placeholder="Concentracion" name="consentracion" id="consentracion">
                    <!--FINAL UNIDADES / PRESENTACION-->

                    
                     <!--INICIO LABORATORIO  / LOTE -->
                        <input type="hidden" class="form-control m-input m-input--air m-input--pill" placeholder="Laboratorio del producto" name="laboratorio" id="laboratorio">
                        <input type="hidden" class="form-control m-input m-input--air m-input--pill" placeholder="Lote del producto" name="lote" id="lote">
                        <input type="hidden" class="form-control m-input m-input--air m-input--pill" placeholder="Registro sanitario del producto" name="registroSanitario" id="registroSanitario">

                    <!--FINAL LABORATORIO  / LOTE -->

                     <!--INICIO REGISTRO SANITARIO / VENCIMIENTO -->
                    
                        <input type="hidden" class="form-control m-input m-input--air m-input--pill" name="fechaVencimiento" id="fechaVencimiento">

                    <!--FINAL REGISTRO SANITARIO / VENCIMIENTO -->

                    
                 <!--INICIO UBICACION-->
                    <div class="row col-lg-12">
                            <div class="col-lg-6">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        <b>Ubicacion almacen</b>
                                    </font>
                                </font>

                                <br>
                                <span class="m-form__help">
                                    <small> <b>Ubicacion en el almacen del producto </b></small>
                                </span>

                                <div class="m-input-icon" id="">
                                    <input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Ubicacion almacen" name="ubicacionAlmacen" id="ubicacionAlmacen">

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        <b>Ubicacion bodega</b>
                                    </font>
                                </font>

                                <br>
                                <span class="m-form__help">
                                    <small> <b>Ubicacion en bodega del producto </b></small>
                                </span>

                                <div class="m-input-icon" id="">
                                    <input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Ubicacion bodega" name="ubicacionBodega" id="ubicacionBodega">

                                </div>
                            </div>
                        </div>
                <!--FINAL UBICACION-->



                    <!--INICIO FOTO-->
                        <div class="row col-lg-12">
                            <div class="col-lg-12">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        <b>Foto</b>
                                    </font>
                                </font>
                                <span class="m-form__help"><br>
                                    <small>Foto del producto.</small>
                                </span>
                                <div class="m-input-icon" id="input8">
                                    <input value="1" type="file" class="form-control m-input m-input--air m-input--pill" placeholder="" name="photoProduct" id="photoProduct">
                                </div><br>
                            </div>
                        </div>
                    <!--FINAL FOTO-->
                    <!--INICIO BOTON-->
                    <div class="row col-lg-12">
                        <div class="col-lg-12">
                            <br>
                            <center><button type="button" class="btn btn-block m-btn--square btn-rounded btn-success" id="botonCrear">
                                    <h4 class="text-black">Crear producto</h4>
                                </button></center>
                        </div>
                    </div>
                    <!--FINAL BOTON-->
                    <?php
                        }
                    ?>
                        



                    </form>
                    <!--FINAL FORMULARIO-->


                </div>
            </div>
        </div>
    </div>

</div>
</div>
<div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div>
<div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
</div>
</div>
<!-- /.right-sidebar -->
</div>
<!-- /.container-fluid -->
</div>








<script>
    $('#formulario').keyup(function(e) {
        if (e.keyCode == 13) {
            var answer = $('#answerJS');
            var respuesta = $('#respuesta');
            var alertJS = $('#alertJS');

            var answer2 = $('#answerJS2');
            var respuesta2 = $('#respuesta2');

            var datos = $("#formulario").serialize();
            $.ajax({
                type: "POST",
                url: "../../irocket/controllers/ajax/ajax_validationProducts.php",
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

    $('#formulario').keyup(function(e) {
        if (e.keyCode == 13) {
            var answer = $('#answerJS');
            var respuesta = $('#respuesta');
            var alertJS = $('#alertJS');

            var answer2 = $('#answerJS2');
            var respuesta2 = $('#respuesta2');

            var datos = $("#formulario").serialize();
            $.ajax({
                type: "POST",
                url: "../../irocket/controllers/ajax/ajax_validationProducts.php",
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

    $("#botonCrear").click(function() {

        var answer = $('#answerJS');
        var respuesta = $('#respuesta');
        var alertJS = $('#alertJS');

        var answer2 = $('#answerJS2');
        var respuesta2 = $('#respuesta2');

        var datos = $("#formulario").serialize();
        $.ajax({
            type: "POST",
            url: "../../irocket/controllers/ajax/ajax_validationProducts.php",
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


    $("#botonSeleccionarInventario").click(function() {

    var answer = $('#answerJS');
    var respuesta = $('#respuesta');
    var alertJS = $('#alertJS');

    var answer2 = $('#answerJS2');
    var respuesta2 = $('#respuesta2');

    var datos = $("#formulario").serialize();
    $.ajax({
        type: "POST",
        url: "../../irocket/controllers/ajax/ajax_validationSeleccionar_inventario.php",
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
</script>






<script>
    var ibc = 1;
    $("#botonCodes  ").click(function() {
        ibc++
        var lengthInputs = $("#input1 input").length;

        if (lengthInputs < 11) {

            var dom = document.createElement("input");
            dom.setAttribute("class", 'form-control m-input m-input--air m-input--pill');
            dom.setAttribute("placeholder", "Codigo  " + ibc);
            dom.setAttribute("name", 'codeProduct_' + ibc);
            dom.setAttribute("id", 'codeProduct');
            insert = $("#input1").append(dom);

        }
    })
</script>

<script>
    var ibp = 1;
    $("#botonPrecios  ").click(function() {
        ibp++
        var lengthInputs = $("#input2 input").length;

        if (lengthInputs < 10) {

            var dom = document.createElement("input");
            dom.setAttribute("class", 'form-control m-input m-input--air m-input--pill');
            dom.setAttribute("placeholder", "Precio  " + ibp);
            dom.setAttribute("name", 'priceProduct_' + ibp);
            dom.setAttribute("id", 'priceProduct');
            insert = $("#input2").append(dom);

        }
    })
</script>


<script>
    $(document).ready(function() {
        //$("#alertabien").slideUp(5000).delay(5000);

        $('#alertabien').delay(8000).slideToggle(1000, function() {
            $('#alertabien').removeClass("show");
        });
        return false;
    });
</script>





<script>
    var statSend = false;

    function checkSubmit() {
        if (!statSend) {
            statSend = true;
            return true;
        } else {

            return false;
        }
    }
</script>