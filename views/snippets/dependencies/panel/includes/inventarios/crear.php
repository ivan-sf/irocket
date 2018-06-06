<?php
if(isset($_SESSION['adminUser']) OR isset($_SESSION['adminUserNew'])){
//echo $_SESSION['adminUser'];
    $modelUser = new models\User();
    $array = $modelUser->inner();
}else{
    header("location:" . URL);
}


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
						<li class="active">Crear</li>
					</ol>
				</div>
			</div>
			
				<button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>inventarios?catalogo" class="">Catalogo</a></button>
			 	<button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>inventarios/tabla?index" class="">Tabla</a></button>
			<br>
			<br>

                	
				<div class="white-box">
					<center><h3 class="box-title">Crear inventarios</h3></center>
					<div class="row">

						<div class="col-sm-12">
							<div id="slimtest1">
								<div class="m-grid__item m-grid__item--fluid m-wrapper">

									<center><b><small>Puedes crear un total de 4 inventarios, para ampliar su paquete de inventarios visite nuestro <a  target="_blank" href=" <?php echo URL_SITIO; ?> ">nuestro sitio web.</a></small></b><br><br>

										<form method="POST" enctype="multipart/form-data" id="formulario" onsubmit="return checkSubmit();">
											<input type="hidden" name="iduser" value=" <?php echo $array['idusers']; ?> ">
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
																			Ya tienes un inventario con este mismo nombre, recuerda que puedes ampliar tu plan de inventarios por medio de nuestro  <a target='_blank' href=' " .URL_SITIO . "'>nuestro sitio web.</a>
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
														<div class="col-lg-6">
																<b>Nombre de inventario *</b><br>	
															<br>
															<div class="m-input-icon" id="input1">
																<input autofocus="" type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Nombre inventario" name="nameInventary[]" id="nameInventary">
															</div>
														</div>

														<div class="col-lg-6">
															<b>Descripcion *</b>
																<br>
																<br>
															<div class="m-input-icon" id="input2">
																<input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Descripcion inventario" name="descriptionInventary[]" id="descriptionInventary">
															</div>
														</div>
													</div>

													<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
														<div class="m-form__actions m-form__actions--solid">
															<div class="row">
																<div class="col-lg-12">

																	<center><button type="button" class="btn btn-block m-btn--square  btn-success m-btn m-btn--custom m-btn--bolder m-btn--uppercase" id="botonCrear">
																		<h4 class="text-white">Crear inventario(s)</h4>
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


												if (lengthInputs >= 1 && lengthInputs <=3) {
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