<?php 
$modelInventory = new models\Inventory();
$con = new models\Conexion();
$arrayInventory = $modelInventory->array();
$rowInventory = $modelInventory->row();
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




                        <div class="m-grid__item m-grid__item--fluid m-wrapper">

                            <!-- END: Subheader -->

                            <div class="m-content">
                                <div class="col-lg-12">
                                    <div class="m-portlet">

                                        <div class="m-portlet__head ">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title col-lg-12">
                                                    <span class="m-portlet__head-icon m--hide">
                                                        <i class="la la-gear"></i>
                                                    </span>
                                                    <center><h3 class="box-title">Crear productos</h3></center>
                                                    <center><b><small>Puedes agregar hasta 5 productos a un inventario en cada consulta, para ampliar tu paquete de consultas visita  <a  target="_blank" href=" <?php echo URL_SITIO; ?> ">nuestro sitio web.</a></small></b>
                                                        <br><br>

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
                                                    }elseif (isset($_GET['error'])) {
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
                                                        }elseif ($_GET['error'] == 'code') {
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

                                        <!--begin::Form-->

                                        <form  onsubmit="return checkSubmit();" method="POST" enctype="multipart/form-data" id="formulario">
                                            <div class="m-portlet__body">
                                                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                                    <div class="m-form__actions m-form__actions--solid">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <center><button type="button" class="btn m-btn--pill m-btn--air btn-primary" id="botonPlus">
                                                                    Agregar fila
                                                                </button>
                                                                <button type="button" class="btn m-btn--pill m-btn--air btn-danger hiddenDIV" id="botonDelete">
                                                                    Eliminar fila
                                                                </button></center><br>
                                                                <center>
                                                                </div>
                                                                <div class="col-lg-12">


                                                                </div>





                                                            </div>
                                                        </div>
                                                    </div>

                                                   <div class="col-lg-12">
                                                       <center>
                                                            <?php 
                                                            if (isset($_GET['inventario'])) { ?>
                                                                 <h4>Inventario <b><?php echo ucfirst($_GET['inventario']); ?></b>
                                                                    <input type="hidden" name="idInventary" value="<?php echo $_GET['inventario'] ?>"><a href="<?php echo URL; ?>productos/crear"><small><small>Cambiar inventario</small></small></a></h4> 
                                                                    <input type="hidden" name="typeInventory" value="1"></h4>
                                                             <?php }else{ ?>

                                                             
                                                       </center>
                                                   </div>
                                                    <div class="form-group m-form__group row" id="">
                                                        <div class="col-lg-12">
                                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                                <center><b>Inventario</b>
                                                                </font></font>
                                                                <span class="m-form__help"><br>
                                                                    <small>Por favor seleccione el inventario al que desea agregar el producto y/o productos</small>
                                                                </span>
                                                            </center>
                                                            <div class="m-input-icon" id="input9">

                                                                    <input type="hidden" name="typeInventory" value="2"></h4>
                                                                <select id="optionvalue" name="idInventary" id="idInventary" class="form-control m-input m-input--air m-input--pill"">
                                                                    <?php while($datos1 = mysqli_fetch_array($arrayInventory)) { ?>
                                                                    <option id="">
                                                                        <?php echo strtoupper($datos1['nameInventory']) . "<br>"; ?>    
                                                                    </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <br>
                                                        </div>

                                                        <?php } ?>

                                                        <div class="col-lg-12">





                                                            <div class="col-lg-12">
                                                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                                    <b>Nombre *</b>
                                                                </font></font>
                                                                <span class="m-form__help"><br>
                                                                    <small>Ingrese el nombre del producto.</small>
                                                                </span><br>
                                                                <div class="m-input-icon" id="input2">
                                                                    <input type="text" class="form-control m-input m-input--air m-input--pill" autofocus=""  placeholder="Nombre producto" name="nameProduct[]" id="nameProduct">

                                                                </div>
                                                            </div>
                                                            <br>

                                                            <div class="col-lg-12">
                                                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                                    <b>Codigo *</b>
                                                                </font></font><br>
                                                                <span class="m-form__help">
                                                                    <small> <b>Codigo general del producto  </b> Este codigo sera utilizado para realizar compras y ventas del producto</small>
                                                                </span>
                                                                <div class="m-input-icon" id="input1">
                                                                    <input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Codigo general" name="codeProduct[]" id="codeProduct">

                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="col-lg-12">
                                                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                                    <b>Precio venta *</b>
                                                                </font></font>
                                                                <span class="m-form__help"><br>
                                                                    <small>Precio de venta general del <b>producto</b></small>
                                                                </span>
                                                                <div class="m-input-icon" id="input3">
                                                                    <input type="number" class="form-control m-input m-input--air m-input--pill" placeholder="Precio venta" name="priceProduct[]" id="priceProduct">

                                                                </div>
                                                            </div>
                                                            <br>




                                                            <div class="col-lg-12">
                                                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                                    <b>Precio venta en promocion</b>
                                                                </font></font>
                                                                <span class="m-form__help"><br>
                                                                    <small>Precio de promocion del producto<b> se asignara el precio de venta por defecto</b></small>

                                                                </span>
                                                                <div class="m-input-icon" id="input6">
                                                                    <input type="number" class="form-control m-input m-input--air m-input--pill" placeholder="Precio venta en promocion" name="pricePromProduct[]" id="pricePromProduct">

                                                                </div>
                                                            </div>
                                                            <br>
                                                            <!--
                                                            <div class="col-lg-12">
                                                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                                    <b>Codigo promocion *</b>
                                                                </font></font><br>
                                                                <span class="m-form__help">
                                                                    <small> <b>Codigo promocion del producto    </b> Este codigo sera utilizado para realizar compras y ventas del producto a precio de promocion</small>
                                                                </span>
                                                                <div class="m-input-icon" id="input4">
                                                                    <input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Codigo promocion" name="codePromProduct[]" id="codePromProduct">
                                                                </div>
                                                            </div>
                                                            <br>
                                                        -->
                                                            <div class="col-lg-12">
                                                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                                    <b>Precio compra</b>
                                                                </font></font>
                                                                <span class="m-form__help"><br>
                                                                    <small>Precio de compra general del producto<b> se asignara (cero 0) por defecto</b></small>
                                                                </span>
                                                                <div class="m-input-icon" id="input11">
                                                                    <input type="number" class="form-control m-input m-input--air m-input--pill" placeholder="Precio compra" name="priceProductSale[]" id="priceProductSale">

                                                                </div>
                                                            </div>
                                                            <br>
                                                           

                                                            <div class="col-lg-12">
                                                <!--
                                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                    <b>Precio compra en promocion</b>
                                                </font></font>
                                                <span class="m-form__help"><br>
                                                    <small>Precio de promocion del <b>producto</b> es <b>obligatorio (*) solamente si se ingresa el codigo de promocion.</b></small>
                                                    
                                                </span>-->
                                                <div id="input10">
                                                    <input type="hidden" class="form-control m-input m-input--air m-input--pill" placeholder="Precio compra en promocion" name="pricePromProductSale[]" id="pricePromProductSale">

                                                </div>
                                            </div>





                                        </div>


                                        <div class="col-lg-12">
                                            <div class="col-lg-12">
                                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                <!--    <b>Limite minimo de cantidad *</b>
                                                </font></font>
                                                <span class="m-form__help"><br>
                                                    <small>Este valor sera usado para notificar al administrador la escasez del producto.</small>
                                                </span>-->
                                                <div class="m-input-icon" id="input5">
                                                    <input value="1" type="hidden" class="form-control m-input m-input--air m-input--pill" placeholder="" name="limitProduct[]" id="limitProduct">
                                                </div>
                                            </div>
                                            



                                            <div class="col-lg-12">
                                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                    <b>Descripcion</b>
                                                </font></font>
                                                <span class="m-form__help"><br>
                                                    <small>Descripcion del producto.</small>
                                                </span>
                                                <div class="m-input-icon" id="input7">
                                                    <textarea name="descriptionProduct[]" id="descriptionProduct" class="form-control m-input m-input--air m-input--pill" id="exampleTextarea" rows="3"></textarea>
                                                </div>
                                            </div>

                                            <br>




                                            <div class="col-lg-12">
                                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                    <b>Foto</b>
                                                </font></font>
                                                <span class="m-form__help"><br>
                                                    <small>Foto del producto.</small>
                                                </span>
                                                <div class="m-input-icon" id="input8">
                                                    <input value="1" type="file" class="form-control m-input m-input--air m-input--pill" placeholder="" name="photoProduct[]" id="photoProduct">
                                                </div><br>
                                            </div>


                                            <div class="col-lg-12">

                                                <br><center><button type="button" class="btn btn-block m-btn--square  btn-success m-btn m-btn--custom m-btn--bolder m-btn--uppercase" id="botonCrear">
                                                    <h4 class="text-white">Crear producto(s)</h4>
                                                </button></center>
                                            </div>



                                    </div>

                                
                                    
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
</div>
<!-- /.right-sidebar -->
</div>
<!-- /.container-fluid -->
</div>








<script>
    $('#formulario').keyup(function(e) {
        if(e.keyCode == 13) {
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
                success:function (data) {
                    if(data.indexOf('1') != -1){
                        respuesta.removeClass('hiddenDIV');
                        answer.html("Los campos con * son obligatorios.");
                        respuesta2.removeClass('hiddenDIV');
                        answer2.html("Los campos con * son obligatorios.");
                    }else{
                        $("#formulario").submit();
                    }
                }
            });  
        }
    });

    $("#botonCrear").click(function () {

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
            success:function (data) {
                if(data.indexOf('1') != -1){
                    respuesta.removeClass('hiddenDIV');
                    answer.html("Los campos con * son obligatorios.");
                    respuesta2.removeClass('hiddenDIV');
                    answer2.html("Los campos con * son obligatorios.");
                }else{
                    $("#formulario").submit();
                }
            }
        });         
    })
</script>












<script>
    $("#botonDelete").click(function () {
        var lengthInputs = $("#input1 input").length;

        if (lengthInputs == 2) {
            $("#botonDelete").toggleClass("hiddenDIV");
        }else{
                //alert(lengthInputs);
            }
            var input1 = $("#input1 input:last-child");
            var input2 = $("#input2 input:last-child");
            var input3 = $("#input3 input:last-child");
            var input4 = $("#input4 input:last-child");
            var input5 = $("#input5 input:last-child");
            var input6 = $("#input6 input:last-child");
            var input8 = $("#input8 input:last-child");
            var input10 = $("#input10 input:last-child");
            var input11 = $("#input11 input:last-child");
            var input7 = $("#input7 textarea:last-child");
            input1.remove();
            input2.remove();
            input3.remove();
            input4.remove();
            input5.remove();
            input6.remove();
            input7.remove();
            input8.remove();
            input10.remove();
            input11.remove();
        })
    var i = 0;
    $("#botonPlus").click(function () {
        var lengthInputs = $("#input1 input").length;

        if (lengthInputs < 5) {
            if (lengthInputs > 0) {
                $("#botonDelete").removeClass("hiddenDIV");
            }
            var dom = document.createElement("input");
            dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
            dom.setAttribute("placeholder",'Codigo general');
            dom.setAttribute("name",'codeProduct[]');
            dom.setAttribute("id",'codeProduct');
            insert = $("#input1").append(dom);      
            if (insert) {
                var dom = document.createElement("input");
                dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
                dom.setAttribute("name",'nameProduct[]');
                dom.setAttribute("id",'nameProduct');
                dom.setAttribute("placeholder",'Nombre producto');
                insert = $("#input2").append(dom);  
                if (insert) {
                    var dom = document.createElement("input");
                    dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
                    dom.setAttribute("placeholder",'Precio venta');
                    dom.setAttribute("name",'priceProduct[]');
                    dom.setAttribute("id",'priceProduct');
                    dom.setAttribute("type",'number');
                    insert = $("#input3").append(dom);  
                }
                if (insert) {
                    var dom = document.createElement("input");
                    dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
                    dom.setAttribute("placeholder",'Codigo promocion');
                    dom.setAttribute("name",'codePromProduct[]');
                    dom.setAttribute("id",'codePromProduct');
                    insert = $("#input4").append(dom);  
                }
                if (insert) {
                    var dom = document.createElement("input");
                    dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
                    dom.setAttribute("value",'1');
                    dom.setAttribute("name",'limitProduct[]');
                    dom.setAttribute("id",'limitProduct');
                    dom.setAttribute("type",'hidden');
                    insert = $("#input5").append(dom);  
                }
                if (insert) {
                    var dom = document.createElement("input");
                    dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
                    dom.setAttribute("placeholder",'Precio venta en promocion');
                    dom.setAttribute("name",'pricePromProduct[]');
                    dom.setAttribute("id",'pricePromProduct');
                    dom.setAttribute("type",'number');
                    insert = $("#input6").append(dom);  
                }
                if (insert) {
                    var dom = document.createElement("textarea");
                    dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
                    dom.setAttribute("name",'descriptionProduct[]');
                    dom.setAttribute("id",'descriptionProduct');
                    dom.setAttribute("rows",'3');
                    insert = $("#input7").append(dom);  
                    if (insert) {
                        $(".descprod").html("Agregar descripcion");
                    }
                    if (insert) {

                        var dom = document.createElement("input");
                        dom.setAttribute("type",'file');
                        dom.setAttribute("name",'photoProduct[]');
                        dom.setAttribute("id",'photoProduct');
                        dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
                        insert = $("#input8").append(dom);  

                        if (insert) {

                            var dom = document.createElement("input");
                            dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
                            dom.setAttribute("placeholder",'Precio compra');
                            dom.setAttribute("name",'priceProductSale[]');
                            dom.setAttribute("id",'priceProductSale');
                            dom.setAttribute("type",'number');
                            insert = $("#input11").append(dom); 

                        }

                    }
                }
            }
        }else{
            var answer = $('#answerJS');
            var respuesta = $('#respuesta');

            var answer2 = $('#answerJS2');
            var respuesta2 = $('#respuesta2');

            var alertJS = $('#alertJS');
            respuesta2.removeClass('hiddenDIV');
            answer2.html("no puede agregar mas de 5 productos si quiere ampliar su paquete de consultas puede <b><a href=''> visitar nuestro sitio web.</a></b>");
        }

    })



</script>


<script>

    $(document).ready(function () {
                                            //$("#alertabien").slideUp(5000).delay(5000);

                                            $('#alertabien').delay(8000).slideToggle(1000, function () {
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