<?php 
$modelInventory = new models\Inventory();
$con = new models\Conexion();
$arrayInventory = $modelInventory->array();
$rowInventory = $modelInventory->row();
?>


<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Inventarios</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Panel</a></li>
                    <li><a href="#">Inventarios</a></li>
                    <li class="active">Tabla</li>
                </ol>
            </div>
        </div>
        
        <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>inventarios?catalogo" class="">Catalogo</a></button>
        <button class="btn m-btn--pill btn-badge"><a href="<?php echo URL; ?>inventarios/crear">Crear</a></button>
        <br>
        <br>
        
        
        <div class="white-box">


            <div class="row">

                <div class="col-sm-12">
                    <div id="slimtest1">
                        <div class="m-grid__item m-grid__item--fluid m-wrapper">

                            <?php if (isset($_GET['success_update'])) {
                                echo "
                                <div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-success alert-dismissible fade show' role='alert' id='alertabien'>
                                <div class='m-alert__icon'>
                                <i class='flaticon-rocket'></i>
                                </div>
                                <div class='m-alert__text'>
                                <strong>
                                Perfecto !
                                </strong>
                                Se editaron los datos correctamente puedes ver el resultado en la tabla.
                                </div>
                                <div class='m-alert__close'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                </div>
                                </div>";
                            }elseif(isset($_GET['success_delete'])){
                                echo "
                                <div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-success alert-dismissible fade show' role='alert' id='alertabien'>
                                <div class='m-alert__icon'>
                                <i class='flaticon-rocket'></i>
                                </div>
                                <div class='m-alert__text'>
                                <strong>
                                Perfecto !
                                </strong>
                                Se eliminaron los datos correctamente en adelante no tendras disponible el inventario en tus datos..
                                </div>
                                <div class='m-alert__close'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                </div>
                                </div>";
                            }elseif (isset($_GET['error'])) {
                                if ($_GET['error'] == 'delete') {
                                    echo "
                                    <div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-danger alert-dismissible fade show' role='alert' id='alertabien'>
                                    <div class='m-alert__icon'>
                                    <i class='flaticon-rocket'></i>
                                    </div>
                                    <div class='m-alert__text'>
                                    <strong>
                                    Lo sentimos !
                                    </strong>
                                    El inventario al que intentas acceder ha sido eliminado
                                    </div>
                                    <div class='m-alert__close'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                                    </div>
                                    </div>";
                                }
                            } ?>

                            
                            
                            <div class="table-responsive">
                                <br>
                                <table id="dt_inventory" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                    <thead>
                                        <tr role="row">
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Registro</th>                                           
                                        </tr>
                                    </thead>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


  
<script src="<?php echo (URL); ?>views/plugins/js/jquery-1.2.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/datatables.min.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/datatablebuttons.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/buttons.flash.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/jszip.min.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/pdfmake.min.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/vfs.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/buttonshtml5.js"></script>
<script src="<?php echo (URL); ?>views/plugins/js/button.print.js"></script>




<script>        
    function listar() {
        var table = $("#dt_inventory").DataTable({
            "ajax":{
                "method":"POST",
                "url": "../../irocket/controllers/ajax/listar.php"
            },
            "columns":[
            {"data":"nameInventory"},
            {"data":"descriptionInventory"},
            {"data":"date_register"},
            ],

            "language": idioma,
            dom: 'Bfrtlip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    }
    var idioma = {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
    listar();
</script>

























<script>
    $("#botonCrear").click(function () {

        var answer = $('#answerJS');
        var respuesta = $('#respuesta');
        var alertJS = $('#alertJS');
        var datos = $("#formulario").serialize();
        $.ajax({
            type: "POST",
            url: "../../irocket/controllers/ajax/ajax_validationProducts.php",
            data: datos,
            success:function (data) {
                if(data.indexOf('1') != -1){
                    respuesta.removeClass('hiddenDIV');
                    answer.html("al parecer no has ingresado los datos correctamente recuerda que los campos con (*) son obligatorios en todas las filas ademas si ingresaste el codigo de promocion tambien es obligatorio ingresar el precio de promocion, si el problema persiste contacta con el soporte.");
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
                    dom.setAttribute("type",'number');
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
                            dom.setAttribute("placeholder",'Precio compra en promocion');
                            dom.setAttribute("name",'pricePromProductSale[]');
                            dom.setAttribute("id",'pricePromProductSale');
                            dom.setAttribute("type",'number');
                            insert = $("#input10").append(dom); 
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
            }
        }else{
            var answer = $('#answerJS');
            var respuesta = $('#respuesta');
            var alertJS = $('#alertJS');
            respuesta.removeClass('hiddenDIV');
            alertJS.addClass('fade show');
            answer.html("no puede agregar mas de 5 inventarios si quiere ampliar su paquete de inventarios puede <b><a href=''> visitar nuestro sitio web.</a></b>");
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





                                    




