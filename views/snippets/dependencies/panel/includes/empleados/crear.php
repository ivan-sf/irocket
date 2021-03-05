<?php
if(isset($_SESSION['adminUser']) OR isset($_SESSION['adminUserNew'])){
	$modelInventory = new models\Company();
	$con = new models\Conexion();
	$arrayInventory = $modelInventory->array();
}else{
	header("location:" . URL);
}


?>

<div id="page-wrapper">
	<div class="container-fluid">

		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Empleados</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="#">Panel</a></li>
					<li><a href="#">Empleados</a></li>
					<li class="active">Crear</li>
				</ol>
			</div>
		</div>

		<button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>empleados?catalogo" class="">Catalogo</a></button>
		<button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>empleados/tabla?index" class="">Tabla</a></button>
		<br>
		<br>


		<div class="white-box">
			<center><h3 class="box-title">Crear empleados</h3></center>
			<div class="row">

				<div class="col-sm-12">
					<div id="slimtest1">
						<div class="m-grid__item m-grid__item--fluid m-wrapper">

							<center><b><small>Puedes agregar hasta 5 empleados al sistema en cada consulta, para ampliar tu paquete de consultas visita  <a  target="_blank" href=" <?php echo URL_SITIO; ?> ">nuestro sitio web.</a></small></b><br><br>












								<form method="POST" onsubmit="return checkSubmit();" enctype="multipart/form-data" id="formulario">
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

														<div class="col-lg-12">
															<?php if (isset($_GET['success'])) {
																echo "
																<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-success alert-dismissible fade show' role='alert' id='alertabien'>
																<div class='m-alert__icon'>
																<i class='flaticon-rocket'></i>
																</div>
																<div class='m-alert__text'>
																<strong>
																Genial !
																</strong>
																Los datos se han registrado correctamente, puedes ver el resultado en la tabla y/o el catalogo de empleados si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '>nuestro sitio web.</a>
																</div>
																<div class='m-alert__close'>
																<button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
																</div>
																</div>";
															}elseif (isset($_GET['error'])){

																if ($_GET['error'] == 'documento') {
																	echo "
																	<div class='m-alert m-alert--icon m-alert--air m-alert--square alert alert-danger alert-dismissible fade show' role='alert' id='alertabien'>
																	<div class='m-alert__icon'>
																	<i class='flaticon-rocket'></i>
																	</div>
																	<div class='m-alert__text'>
																	<strong>
																	Lo sentimos !
																	</strong>
																	El documento que intentas ingresar ya pertenece a un empleado registrado en nuestra base de datos, si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '>nuestro sitio web.</a>
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
											</div>
											<div class="form-group m-form__group row" id="">
												<div class="col-lg-12">
													<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
														<center><b>Empresa <b>*</b> </b>
														</font></font>
														<span class="m-form__help"><br>
															<small>Por favor seleccione la empresa al que desea agregar el empleado y/o empleados</small>
														</span></center>
														<div class="m-input-icon" id="input9">

															<select id="optionvalue" name="idcompany" id="idInventary" class="form-control m-input m-input--air m-input--pill"">
																<?php while($datos1 = mysqli_fetch_array($arrayInventory)) { ?>
																<option id="">
																	<?php echo strtoupper($datos1['nameCompany']) . "<br>"; ?>	
																</option>
																<?php } ?>
															</select>

														</div>
														<br>
													</div>

													<div class="col-lg-12">

														<div class="col-lg-12">
															<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
																<b>Nombre <b>*</b> </b>
															</font></font>
															<span class="m-form__help"><br>
																<small>Nombre del empleado. </small>
															</span><br>
															<div class="m-input-icon" id="input2">
																<input type="hidden" class="form-control m-input m-input--air m-input--pill" name="idUser[]" id="idUser" value="<?php echo $_SESSION['adminUserNew']; ?>">

																<input autofocus="" type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Nombres" name="nameUser[]">

															</div>
														</div>
														<br>

														<div class="col-lg-12">
															<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
																<b>Primer apellido <b>*</b> </b>
															</font></font><br>
															<span class="m-form__help">
																<small><b>Primer apellido</b> del empleado.</small>
															</span>
															<div class="m-input-icon" id="input1">
																<input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Primer apellido" name="lastnameUser[]">

															</div>
														</div>
														<br>
														<div class="col-lg-12">
															<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
																<b>Documento <b>*</b> </b>
															</font></font>
															<span class="m-form__help"><br>
																<small>Documento del empleado.</b></small>
															</span>
															<div class="m-input-icon" id="input3">
																<input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Documento" name="documentUser[]">

															</div>
														</div>
														<br>

														<div class="col-lg-12">
															<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
																<b>Salario <b></b> </b>
															</font></font>
															<span class="m-form__help"><br>
																<small>Salario mensual del empleado.</b></small>
															</span>
															<div class="m-input-icon" id="input12">
																<input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Salario" name="salario[]">

															</div>
														</div>
														<br>



														<div class="m-input-icon" id="input6">
															<input type="hidden" class="form-control m-input m-input--air m-input--pill" placeholder="Empresa" name="companyUser[]">

														</div>


														<div class="col-lg-12">
															<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
																<b>Edad</b>
															</font></font><br>
															<span class="m-form__help">
																<small>Fecha de nacimiento del empleado. </small>
															</span>
															<div class="m-input-icon" id="input4">
																<input type="date" class="form-control m-input m-input--air m-input--pill" placeholder="Edad" name="age[]">
															</div>
														</div>

														<br>


														<div class="col-lg-12">
															<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
																<b>Telefono</b>
															</font></font>
															<span class="m-form__help"><br>
																<small>Telefono del empleado</small>

															</span>
															<div class="m-input-icon" id="input10">
																<input type="tel" class="form-control m-input m-input--air m-input--pill" placeholder="Telefono" name="phone[]">

															</div>
														</div>

														<br>
														<div class="col-lg-12">
															<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
																<b>Email</b>
															</font></font>
															<span class="m-form__help"><br>
																<small>Email de contacto del empleado</small>

															</span>
															<div class="m-input-icon" id="inputemail">
																<input type="email" class="form-control m-input m-input--air m-input--pill" placeholder="Email" name="email[]">

															</div>
														</div>
														<br>
													</div>

													<div class="col-lg-12">
														<div class="col-lg-12">
															<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
																<b>Descripcion</b>
															</font></font>
															<span class="m-form__help"><br>
																<small>Ingrese una descripcion o dato que desee guardar del empleado.</small>
															</span>
															<div class="m-input-icon" id="input7">
																<textarea name="description[]" class="form-control m-input m-input--air m-input--pill" rows="3"></textarea>
															</div>
														</div>
														<br>
													</div>



													<div class="col-lg-12">
														<div class="col-lg-12">
															<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
																<b>Foto</b>
															</font></font>
															<span class="m-form__help"><br>
																<small>Ingrese una foto para identificar el empleado.</small>
															</span>
															<div class="m-input-icon" id="input8">
																<input type="file" class="form-control m-input m-input--air m-input--pill" name="photo[]">
															</div>
														</div>
													</div>

													


												</div>

												<div class="col-lg-12">

													<center><button type="button" class="btn btn-block m-btn--square  btn-success m-btn m-btn--custom m-btn--bolder m-btn--uppercase" id="botonCrear">
														<h4 class="text-white">Crear empleado(s)</h4>
													</button></center><br>
												</div>


											</div>

										</form>














										

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
							url: "../../irocket/controllers/ajax/ajax_validationEmployees.php",
							data: datos,
							success:function (data) {
								if(data.indexOf('1') != -1){
									respuesta.removeClass('hiddenDIV');
									answer.html("Los campos con * son obligatorios.");
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
						url: "../../irocket/controllers/ajax/ajax_validationEmployees.php",
						data: datos,
						success:function (data) {
							if(data.indexOf('1') != -1){
								respuesta.removeClass('hiddenDIV');
								answer.html("Los campos con * son obligatorios.");
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
			var input12 = $("#input12 input:last-child");
			var input13 = $("#input13 input:last-child");
			var input7 = $("#input7 textarea:last-child");
			var inputemail = $("#inputemail input:last-child");
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
			input12.remove();
			input13.remove();
			inputemail.remove();
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
						dom.setAttribute("placeholder",'Primer apellido');
						dom.setAttribute("name",'lastnameUser[]');
						dom.setAttribute("type",'text');
						insert = $("#input1").append(dom);		
						if (insert) {
							var dom = document.createElement("input");
							dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
							dom.setAttribute("name",'nameUser[]');
							dom.setAttribute("type",'text');
							dom.setAttribute("placeholder",'Nombres');
							insert = $("#input2").append(dom);	
							if (insert) {
								var dom = document.createElement("input");
								dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
								dom.setAttribute("placeholder",'Documento');
								dom.setAttribute("name",'documentUser[]');
								dom.setAttribute("type",'text');
								insert = $("#input3").append(dom);	
							}
							if (insert) {
								var dom = document.createElement("input");
								dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
								dom.setAttribute("placeholder",'salario');
								dom.setAttribute("name",'salario[]');
								dom.setAttribute("type",'text');
								insert = $("#input12").append(dom);	
							}
							if (insert) {
								var dom = document.createElement("input");
								dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
								dom.setAttribute("placeholder",'fechadepago');
								dom.setAttribute("name",'fechadepago[]');
								dom.setAttribute("type",'date');
								insert = $("#input13").append(dom);	
							}
							if (insert) {
								var dom = document.createElement("input");
								dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
								dom.setAttribute("placeholder",'Edad');
								dom.setAttribute("name",'age[]');
								dom.setAttribute("type",'date');
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
								dom.setAttribute("placeholder",'Empresa');
								dom.setAttribute("name",'companyUser[]');
								dom.setAttribute("type",'hidden');
								insert = $("#input6").append(dom);	
							}
							if (insert) {
								var dom = document.createElement("textarea");
								dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
								dom.setAttribute("name",'description[]');
								dom.setAttribute("rows",'3');
								insert = $("#input7").append(dom);	
								if (insert) {
									$(".descprod").html("Agregar descripcion");
								}
								if (insert) {

									var dom = document.createElement("input");
									dom.setAttribute("type",'file');
									dom.setAttribute("name",'photo[]');
									dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
									insert = $("#input8").append(dom);	

									if (insert) {
										var dom = document.createElement("input");
										dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
										dom.setAttribute("placeholder",'Telefono');
										dom.setAttribute("name",'phone[]');
										dom.setAttribute("type",'tel');
										insert = $("#input10").append(dom);	
										if (insert) {
											var dom = document.createElement("input");
											dom.setAttribute("class",'form-control m-input m-input--air m-input--pill');
											dom.setAttribute("placeholder",'Email');
											dom.setAttribute("name",'email[]');
											dom.setAttribute("type",'email');
											insert = $("#inputemail").append(dom);	
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
						answer.html("no puede agregar mas de 5 empleados si quiere ampliar su paquete de consultas puede <b><a href=''> visitar nuestro sitio web.</a></b>");
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