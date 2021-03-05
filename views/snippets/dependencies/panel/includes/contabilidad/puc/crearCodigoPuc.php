<?php
if(isset($_SESSION['adminUser']) OR isset($_SESSION['adminUserNew'])){
//echo $_SESSION['adminUser'];
    $modelUser = new models\User();
    $modelInventory = new models\Inventory();
    $array = $modelUser->inner();
    $arrayInv = $modelInventory->arrayCreate();
	$rowInv = $modelInventory->row();
	$rowPreFinal = $rowInv+1;
	$rowFinal = $rowPreFinal*1000;
											
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
            <li><a href="#">Panel</a></li>
            <li><a href="#">Contabilidad</a></li>
            <li class="active">Lista</li>
        </ol>
    </div>
        <!-- /.col-lg-12 -->
    </div>
    <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>contabilidad/crear?tipo=documento" class="">Crear documento</a></button>
    <button class="btn m-btn--pill btn-badge"><a href="<?php echo URL; ?>contabilidad">Lista</a></button>
    <button class="btn m-btn--pill btn-badge"><a href="<?php echo URL; ?>contabilidad/table">Tabla basica</a></button>
    <br>
    <br>

                	
				<div class="white-box">
					<center><h3 class="box-title">Crear codigos del plan unico de cuentas</h3></center>
					<div class="row"><br>
					

						<div class="col-sm-12">
							<div id="slimtest1">
								<div class="m-grid__item m-grid__item--fluid m-wrapper">


					
					

										<form method="POST" enctype="multipart/form-data" id="formulario" onsubmit="return checkSubmit();">
											<input type="hidden" name="iduser" value=" <?php echo $array['idusers']; ?> ">
											<input type="hidden" name="nameUser" value=" <?php echo $array['nameUser']; ?> ">
											<input type="hidden" name="codeCurrent" value=" <?php echo $rowFinal; ?> ">
											
											<input type="hidden" name="iduser" value="">
											<div class="m-portlet__body">
												<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
													<div class="m-form__actions m-form__actions--solid">
														<div class="row">
															
															<div class="col-lg-12">
																<?php if (isset($_GET['success'])) {
																	echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-success alert-dismissible fade show' role='alert' id='alertabien'>
																		<div class='m-alert__icon'>
																		<i class='flaticon-rocket'></i>
																		</div>
																		<div class='m-alert__text'>
																		<center>
																		<strong>
																		Genial !
																		</strong>
																		Los datos se han registrado correctamente, ahora puedes agregar productos a tu inventario recuerda que puedes ampliar tu plan de inventarios por medio de nuestro  <a target='_blank' href=' " .URL_SITIO . "'>nuestro sitio web.</a>
	
																		</center>
																		
																		</div>
																		<div class='m-alert__close'>
																		<button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
																		</div>
																		</div>";
																}elseif (isset($_GET['error'])){
																	if ($_GET['error'] == 2) {
																		echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-danger alert-dismissible fade show' role='alert' id='alertabien'>
																			<div class='m-alert__icon'>
																			<i class='flaticon-rocket'></i>
																			</div>
																			<div class='m-alert__text'>
																			<center>
																				<strong>
																				Lo sentimos !
																				</strong>
																				Ya has agregado los 4 inventarios permitidos en tu paquete actual recuerda que puedes ampliar tu plan de inventarios por medio de nuestro  <a target='_blank' href=' " .URL_SITIO . "'>nuestro sitio web.</a>
																			</center>
																			
																			</div>
																			<div class='m-alert__close'>
																			<button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
																			</div>
																			</div>";
																	}else{
																		echo "<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-danger alert-dismissible fade show' role='alert' id='alertabien'>
																			<div class='m-alert__icon'>
																			<i class='flaticon-rocket'></i>
																			</div>
																			<div class='m-alert__text'>
																			<center>
																			<strong>
																			Lo sentimos !
																			</strong>
																			El codigo ingresado ya existe.</a>
																			</center>
																			</div>
																			<div class='m-alert__close'>
																			<button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
																			</div>
																			</div>";
																		}
																	} 
																?>
																</div>
															</div>
														</div>
													</div>

													<div class="form-group m-form__group row" id="">
														<div class="col-lg-4">
																<b>Codigo *</b><br>	
															<br>
															<div class="m-input-icon" id="input1">
																<input require autofocus="" type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Codigo" name="codigoPuc" id="codigoPuc">
															</div>
														</div>

														<div class="col-lg-4">
															<b>Nombre *</b>
																<br>
																<br>
															<div class="m-input-icon" id="input2">
																<input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Nombre" name="nombrePuc" id="nombrePuc">
															</div>
														</div>

														<div class="col-lg-4">
															<b>Detalle</b>
																<br>
																<br>
															<div class="m-input-icon" id="input3">
																<input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Detalle" name="detalle" id="detalle">
															</div>
														</div>

													</div>

													<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
														<div class="m-form__actions m-form__actions--solid">
															<div class="row">
																<div class="col-lg-12">

																	<center><button type="button" class="btn btn-block m-btn--square  btn-success m-btn m-btn--custom m-btn--bolder m-btn--uppercase" id="botonCrear">
																		<h4 class="text-white">Crear codigos</h4>
																	</button></center><br>
																</div>

															</div>
														</div>
													</div>

													<div id="respuesta" class="hiddenDIV">
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

                                                </div>
                                                
                                            </form>
                                            
                                            <div class="table-responsive">
                                <br>

                                hola mundo 
                                
                                <table id="dt_contabilidad" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                                    <thead>
                                        <tr role="row">
                                            
                                            <th>Codigo</th>
                                            <th>Nombre</th>
                                            <th>Detalle</th>
											<th>Editar</th>
                                            <th>Eliminar</th>
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
            
            

										<script>
											$('#formulario').keyup(function(e) {
											    if(e.keyCode == 13) {
											    	var answer = $('#answerJS');
													var respuesta = $('#respuesta');
													var alertJS = $('#alertJS');
													var datos = $("#formulario").serialize();
													$.ajax({
														type: "POST",
														url: "../../irocket/controllers/ajax/ajax_validationInventory.php",
														data: datos,
														success:function (data) {
															if(data.indexOf('1') != -1){
																respuesta.removeClass('hiddenDIV');
																answer.html("debe agregar un nombre y una descripcion para su inventario.");
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
												var datos = $("#formulario").serialize();
												$.ajax({
													type: "POST",
													url: "../../irocket/controllers/ajax/ajax_validationInventory.php",
													data: datos,
													success:function (data) {
														if(data.indexOf('1') != -1){
															respuesta.removeClass('hiddenDIV');
															answer.html("debe agregar un nombre y una descripcion para su inventario.");
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
													
													input1.remove();
													input2.remove();

													
												})

											$("#botonPlus").click(function () {

												var lengthInputs = $("#input1 input").length;


												if (lengthInputs >= 1 && lengthInputs <=30) {
													$("#botonDelete").removeClass("hiddenDIV");

													var dom = document.createElement("input");
													var br = document.createElement("br");
													dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
													dom.setAttribute("placeholder",'Nombre inventario');
													dom.setAttribute("name",'nameInventary[]');
													dom.setAttribute("id",'nameInventary');
													insert = $("#input1").append(dom);	
													if (insert) {
														var dom = document.createElement("input");
														dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
														dom.setAttribute("placeholder",'Descripcion inventario');
														dom.setAttribute("name",'descriptionInventary[]');
														dom.setAttribute("id",'descriptionInventary');
														insert = $("#input2").append(dom);	
														if (insert) {

														}
													}
												}else{
													var answer = $('#answerJS');
													var respuesta = $('#respuesta');
													var alertJS = $('#alertJS');
													respuesta.removeClass('hiddenDIV');
													alertJS.addClass('fade show');
													answer.html("no puede agregar mas de 4 inventarios si quiere ampliar su paquete de inventarios puede <b><a  target='_blank' href='" + URL_SITIO + "'>nuestro sitio web.</a></b>");

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
var table = $("#dt_contabilidad").DataTable({
    "ajax":{
        "method":"POST",
        "url": "../../irocket/views/tables/contabilidad/listar_puc_completo.php"
    },
    dom:"Bfrtlip",
    columns:[
        {"data":"codigo"},
        {"data":"nombre"},
        {"data":"detalle"},
		{
            sortable: false,
            "render": function ( data, type, full, meta ) {
                var idpuc = ""+full.idpuc;
                return '<a href='+'http://localhost/irocket/contabilidad/editar?tipo=codigo&id='+idpuc+' class="btn btn-warning rolloverBtn" role="button">Editar</a>';
            }
        },
        {
            sortable: false,
            "render": function ( data, type, full, meta ) {
                var codigo = ""+full.codigo;
                return '<a href='+'http://localhost/irocket/contabilidad/puc/eliminar?'+codigo+' class="btn btn-danger rolloverBtn" role="button">Eliminar</a>';
            }
        }
        
        
    ],
    buttons: [
    ],

    language: idioma
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
            "sSearch":         "BUSCAR:",
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