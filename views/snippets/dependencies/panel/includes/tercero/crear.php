<?php
if(isset($_SESSION['adminUser']) OR isset($_SESSION['adminUserNew'])){
	$modelCompany = new models\Company();
	$modelTercero = new models\Tercero();
	$con = new models\Conexion();

	$arrayCompany = $modelCompany->array();
	$arrayPaises = $modelTercero->arrayPaises();
	$arrayDepartamentos = $modelTercero->arrayDepartamentos();
	$arrayMunicipios = $modelTercero->arrayMunicipios();
	
	$departamentosData=mysqli_fetch_array($arrayDepartamentos);
	$municipiosData=mysqli_fetch_array($arrayMunicipios);
}else{
	header("location:" . URL);
}
?>

<div id="page-wrapper">
	<div class="container-fluid">

		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Terceros</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="#">Panel</a></li>
					<li><a href="#">Terceros</a></li>
					<li class="active">Crear</li>
				</ol>
			</div>
		</div>

		<button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>clientes?catalogo" class="">Clientes</a></button>
		<button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>empleados?catalogo" class="">Empleados</a></button>
		<button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>proveedores?catalogo" class="">Proveedores</a></button>
		<br>
		<br>


		<div class="white-box">
			<center><h3 class="box-title">Crear terceros</h3></center>
			<div class="row">

				<div class="col-sm-12">
					<div id="slimtest1">
						<div class="m-grid__item m-grid__item--fluid m-wrapper">















								<form method="POST" enctype="multipart/form-data" id="formulario" onsubmit="return checkSubmit();">
									<div class="m-portlet__body">
										<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
											<div class="m-form__actions m-form__actions--solid">
												<div class="row">
													<div class="col-lg-12">
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
																Los datos se han registrado correctamente, puedes ver el resultado en la tabla y/o el catalogo de terceros si tiene dudas o problemas contactenos por medio de <a target='_blank' href='<?php URL_SITIO ?> '>nuestro sitio web.</a>
																</div>
																<div class='m-alert__close'>
																<button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
																</div>
																</div>";
															}else{

															} ?>
														</div>



													</div>
												</div>
											</div>
											<div class="form-group m-form__group row" id="">
												<div class="col-lg-12">
													<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
														<center><b>Tipo de persona <b>*</b> </b>
														</font></font>
														<span class="m-form__help"><br>
															<small>Por favor seleccione el tipo de persona a registrar</small>
														</span></center>
														<div class="m-input-icon" id="input9">

                                                        <select name="tipoPersona" id="tipoPersona" class="form-control">
                                                            <option value="1">Persona</option>
                                                            <option value="2">Empresa</option>
                                                        </select>

														</div>
														<br>
													</div>
													
													

													<div class="col-lg-12">

													<div class="row">
														<div class="col-md-3">
															<input checked type="checkbox" class="" name="tipoCliente" value="1">
															<label for="tipoCliente">Cliente</label>	
														</div>
														<div class="col-md-3">
															<input type="checkbox" class="" name="tipoProveedor" value="1">
															<label for="scales">Proveedor</label>														</div>
														<div class="col-md-3">
															<input type="checkbox" class="" name="tipoEmpleado" value="1">
															<label for="scales">Empleado</label>														</div>
														<div class="col-md-3">
															<input type="checkbox" class="" name="tipoOtro" value="1">
															<label for="scales">Otro</label>								
                                                        </div>
													</div>
														<div class="row">

														
                                                            <div class="col-lg-6">
                                                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                                    <b>Nombres <b>*</b> </b>
                                                                </font></font>
                                                                <span class="m-form__help"><br>
                                                                    <small>Nombres del tercero. </small>
                                                                </span><br>
                                                                <div class="m-input-icon" id="input2">
                                                                    <input type="hidden" class="form-control m-input m-input--air m-input--pill" name="idUser" id="idUser" value="<?php echo $_SESSION['adminUser']; ?>">

                                                                    <input autofocus="" type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Nombres" name="nombres">

                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                                    <b>Apellidos <b>*</b> </b>
                                                                </font></font><br>
                                                                <span class="m-form__help">
                                                                    <small><b>Apellidos del tercero</b></small>
                                                                </span>
                                                                <div class="m-input-icon" id="input1">
                                                                    <input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Apellidos" name="apellidos">

                                                                </div>
                                                            </div>
														</div>
														<br>
														<div class="row" id="razonSocial">
														<div class="col-lg-6">
															<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
																<b>Razon social *</b>
															</font></font>
															<span class="m-form__help"><br>
																<small>Nombre de razon social</small>

															</span>
															<div class="m-input-icon" id="input6">
																<input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Razon social" name="razonSocial">

															</div>
														</div>
														

														<div class="col-lg-6">
															<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
																<b>Nombre comercial *</b>
															</font></font>
															<span class="m-form__help"><br>
																<small>Nombre de comercial de la empresa</small>

															</span>
															<div class="m-input-icon" id="input6">
																<input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Nombre comercial" name="nombreComercial">

															</div>
														</div>
														</div>
														<br>
														<div class="row">
														<div class="col-lg-6">
															<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
																<b>Tipo de documento <b>*</b> </b>
															</font></font>
															<span class="m-form__help"><br>
																<small>Tipo de documento del tercero.</b></small>
															</span>
															<div class="m-input-icon" id="input3">
																<select name="tipodocumento" id="" class="form-control">
																	<option value="13">Cedula de ciudadania</option>
																	<option value="31">NIT</option>
																	<option value="11">Registro civil de nacimiento</option>
																	<option value="12">Tarjeta de identidad</option>
																	<option value="22">Cedula de extranjeria</option>
																	<option value="21">Tarjeta de extranjeria</option>
																	<option value="41">Pasaporte</option>
																	<option value="42">Tipo de documento extranjero</option>
																</select>
															</div>
														</div>
														<div class="col-lg-5">
															<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
																<b>Documento <b>*</b> </b>
															</font></font>
															<span class="m-form__help"><br>
																<small>Documento del tercero.</b></small>
															</span>
															<div class="m-input-icon" id="input3">
																<input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="Documento" name="documento" id="documento">

															</div>
														</div>

														<div class="col-lg-1">
															<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
																<b>DV <b>*</b> </b>
															</font></font>
															<span class="m-form__help"><br>
																<small>Dig ver.</b></small>
															</span>
															<div class="m-input-icon" id="input3">
																<input type="text" class="form-control m-input m-input--air m-input--pill" placeholder="DV" name="digVer" id="digVer">

															</div>
														</div>
														</div>
														<br>
														
											<!--
											<div class="col-lg-12">
												<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
													<b>Genero</b>
												</font></font>
												<span class="m-form__help"><br>
													<small>Ingrese el genero del proveedor.</small>
												</span>
												<div class="m-input-icon" id="input11">
													<select id="optionvalue" name="genere" id="idInventary" class="form-control m-input m-input--air m-input--pill"">
													<option id="">Femenino</option>
													<option id="">Masculino</option>
													<option id="">Otro</option>
												</select>
												</div>
											</div>
											<br>
										-->
									


										<div class="row">
										<div class="col-lg-6">
											<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
												<b>Telefono</b>
											</font></font>
											<span class="m-form__help"><br>
												<small>Telefono del tercero</small>

											</span>
											<div class="m-input-icon" id="input10">
												<input type="tel" class="form-control m-input m-input--air m-input--pill" placeholder="Telefono" name="phone">

											</div>
										</div>

										<div class="col-lg-6">
											<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
												<b>Email</b>
											</font></font>
											<span class="m-form__help"><br>
												<small>Email de contacto del tercero</small>

											</span>
											<div class="m-input-icon" id="inputemail">
												<input type="email" class="form-control m-input m-input--air m-input--pill" placeholder="Email" name="email">

											</div>
										</div>
										<br>
									</div>
									</div>

									<div class="row">
									<div class="col-md-3">
									<br>
											<b>Pais*</b><br>
												<small>Pais de residencia</small>
										<select class="form-control" name="pais" id="">
											<option value="169">COLOMBIA</option>	
										<?php while($paisesData=mysqli_fetch_array($arrayPaises)){ ?>
											<?php if($paisesData['codigo']!=169){ ?>
											<option value="<?php echo $paisesData['codigo'] ?>"><?php echo $paisesData['nombre'] ?></option>	
											<?php } ?>
										<?php } ?>
										</select>
										</div>

										<div class="col-md-3">
										<br>
											<b>Departamento*</b><br>
												<small>Departamento de residencia</small>
										<select class="form-control" name="departamento" id="">
											<option value="86">PUTUMAYO</option>	
										<?php while($departamentoData=mysqli_fetch_array($arrayDepartamentos)){ ?>
											<?php if($departamentoData['codigo']!=169){ ?>
											<option value="<?php echo $departamentoData['codigo'] ?>"><?php echo strtoupper($departamentoData['nombre']) ?></option>	
											<?php } ?>
										<?php } ?>
										</select>
										</div>
										
										<div class="col-md-3">
										<br>
											<b>Municipio*</b><br>
												<small>Municipio de residencia</small>
										<select class="form-control" name="municipio" id="">
											<option value="757">SAN MIGUEL - LA DORADA</option>	
										<?php while($municipiosData=mysqli_fetch_array($arrayMunicipios)){ ?>
											<?php if($municipiosData['codigo']!=757){ ?>
											<option value="<?php echo $municipiosData['codigo'] ?>"><?php echo $municipiosData['nombre'] ?></option>	
											<?php } ?>
										<?php } ?>
										</select>
										</div>

										<div class="col-md-3">
										<br>
											<b>Direccion*</b><br>
												<small>Direccion de residencia</small>
												<input type="text" name="direccion" class="form-control">
										</select>
										</div>
										</div>

									<div class="col-lg-6">
									<br>
											<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
												<b>Descripcion</b>
											</font></font>
											<span class="m-form__help"><br>
												<small>Ingrese una descripcion o dato que desee guardar del tercero.</small>
											</span>
											<div class="m-input-icon" id="input7">
												<textarea name="description" class="form-control m-input m-input--air m-input--pill" rows="1"></textarea>
											</div>
									</div>



									<div class="col-lg-6">
									<br>
											<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
												<b>Foto</b>
											</font></font>
											<span class="m-form__help"><br>
												<small>Ingrese una foto para identificar el tercero.</small>
											</span>
											<div class="m-input-icon" id="input8">
												<input type="file" class="form-control m-input m-input--air m-input--pill" name="photo">
											</div>
									</div>


								</div>

								




								<div class="col-lg-12">

												<br><center><button type="button" class="btn btn-block m-btn--square  btn-success m-btn m-btn--custom m-btn--bolder m-btn--uppercase" id="botonCrear">
													<h4 class="text-white">Crear tercero</h4>
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

$("#documento").keyup(function(){
	documento=$("#documento").val()
	documentoinvertido=""

	for(var i = documento.length-1; i>=0; i--)
	{
		documentoinvertido += documento[i];
	}

	if(documento.length==1){
		documentoInv=documentoinvertido+'00000000000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)
		
		
		
	}
	if(documento.length==2){
		documentoInv=documentoinvertido+'0000000000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

		
	}
	if(documento.length==3){
		documentoInv=documentoinvertido+'000000000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

		
	}
	if(documento.length==4){
		documentoInv=documentoinvertido+'00000000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

		
	}
	if(documento.length==5){
		documentoInv=documentoinvertido+'0000000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

		
	}
	if(documento.length==6){
		documentoInv=documentoinvertido+'000000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
	if(documento.length==7){
		documentoInv=documentoinvertido+'00000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
	if(documento.length==8){
		documentoInv=documentoinvertido+'0000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
	if(documento.length==9){
		documentoInv=documentoinvertido+'000000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)
	}
	if(documento.length==10){
		documentoInv=documentoinvertido+'00000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)
		

	}
	if(documento.length==11){
		documentoInv=documentoinvertido+'0000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
	if(documento.length==12){
		documentoInv=documentoinvertido+'000'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
	if(documento.length==13){
		documentoInv=documentoinvertido+'00'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
	if(documento.length==14){
		documentoInv=documentoinvertido+'0'
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
	if(documento.length==15){
		documentoInv=documentoinvertido
		console.log("--")
		caracter1=documentoInv[0]*3
		caracter2=documentoInv[1]*7
		caracter3=documentoInv[2]*13
		caracter4=documentoInv[3]*17
		caracter5=documentoInv[4]*19
		caracter6=documentoInv[5]*23
		caracter7=documentoInv[6]*29
		caracter8=documentoInv[7]*37
		caracter9=documentoInv[8]*41
		caracter10=documentoInv[9]*43
		caracter11=documentoInv[10]*47
		caracter12=documentoInv[11]*53
		caracter13=documentoInv[12]*59
		caracter14=documentoInv[13]*67
		caracter15=documentoInv[14]*71
		caracterTotal=parseFloat(caracter1)+parseFloat(caracter2)+parseFloat(caracter3)+parseFloat(caracter4)+parseFloat(caracter5)+parseFloat(caracter6)+parseFloat(caracter7)+parseFloat(caracter8)+parseFloat(caracter9)+parseFloat(caracter10)+parseFloat(caracter11)+parseFloat(caracter12)+parseFloat(caracter13)+parseFloat(caracter14)+parseFloat(caracter15)
		residuoTotal=caracterTotal%11
		if(residuoTotal<=1){
			dv=residuoTotal
		}else{
			dv=11-residuoTotal
		}
		$("#digVer").val(dv)

	}
});



</script>
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




	$('#formulario').keyup(function(e) {
		if(e.keyCode == 13) {
			var answer = $('#answerJS');
			var respuesta = $('#respuesta');
			var alertJS = $('#alertJS');
			var datos = $("#formulario").serialize();
			$.ajax({
				type: "POST",
				url: "../../irocket/controllers/ajax/ajax_validationTercero.php",
				data: datos,
				success:function (data) {
					if(data==2){
						$("#formulario").submit();
					}else{
						respuesta.removeClass('hiddenDIV');
						answer.html(data);	
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
			url: "../../irocket/controllers/ajax/ajax_validationTercero.php",
			data: datos,
			success:function (data) {
				if(data==2){
					$("#formulario").submit();
				}else{
					respuesta.removeClass('hiddenDIV');
					answer.html(data);	
				}
			}
		});			
	})
</script>


<script>

	$(document).ready(function () {
        
        $('select#tipoPersona').on('change',function(){
            if($('select#tipoPersona').val()==1){
                $("#razonSocial").hide()
            }else{
                $("#razonSocial").show()
            }
        });

        if($('select#tipoPersona').val()==1){
            $("#razonSocial").hide()
        }

        

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