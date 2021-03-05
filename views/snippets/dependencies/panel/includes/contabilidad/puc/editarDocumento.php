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
            <li><a href="<?php echo URL; ?>contabilidad/duplicar?tipo=documento&numero=<?php echo $_GET['numero'] ?>&comprobante=<?php echo $_GET['comprobante'] ?>">Duplicar comprobante</a></li>
            <li><a href="<?php echo URL; ?>contabilidad/crear?tipo=comprobante">Lista de comprobantes</a></li>
                
            <!--
            <li class="divider"></li>
            <li><a href="<?php //echo URL; ?>facturas/detalles?id=<?php //echo $_GET['id']; ?>&cancelar">Eliminar factura</a></li>-->
        </ul>
    </div>
                  
    
    <br>
    <br>
                  
				<div class="white-box">
					<div class="row"><br>

                    
					

						<div class="col-sm-12">
                            <?php if(isset($_GET['tipodocumento'])){  ?>
                            <div class="alert alert-success erroresNot" role="alert">
                                <strong>Ha creado un nuevo comprobante contable </strong> <a class="text-white" href="<?php echo URL ?>contabilidad/ver?tipo=documento&numero=<?php echo $_GET['documento'] ?>&comprobante=<?php echo $_GET['tipodocumento'] ?>"><u>ver nuevo documento</u></a> o puede <a class="text-white" href="<?php echo URL ?>contabilidad/documentos"><u>ver lista de documentos</u></a>
                            </div>
                            <?php } ?>
                            <h2>Editar comprobante contable</h2>
                            <div class="alert alert-primary erroresNot hidden" role="alert">
                                <strong>Error - </strong> <b class="errores"> </b>
                            </div>
							<div id="slimtest1">

								<div class="m-grid__item m-grid__item--fluid m-wrapper">
                                <form id="formulario" action="" method="POST">
                                <input type="hidden" autocomplete="off" name="idusuario" value="<?php echo $_SESSION['adminUserNew']; ?>">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        
                                        <select value="5" name="comprobante" id="comprobante" class="form-control m-input m-input--air m-input--pill hidden">
                                            <option value="<?php echo $datosComprobante['tipoNotacontable']; ?>"><?php echo $datosComprobante['tipoComprobante']; ?></option>
                                        <?php while ($datos1 = mysqli_fetch_array($arrayComprobantes)) { ?>
                                            <?php  if($datos1['tipo']!=$_GET['comprobante']){ ?>
                                            <option value="<?php echo $datos1['tipo']; ?>">
                                                <?php
                                                   
                                                       echo strtoupper($datos1['nombre']); 
                                                    
                                                 ?>    
                                            </option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>

                                   
                                            Numero comprobante automatico <br>
                                            <h3 class="numeracion"><?php echo $datosComprobante['comprobante'] ?></h3>
                                            <input class="form-control" name="numeracion" id="numeracion" type="hidden" value="<?php echo $datosComprobante['comprobante'] ?>" autocomplete="off" autofocus>
                                    </div>
                                </div>
                                <br>
                                

                               <div class="row">
                               <div class="col-md-4">
                                    Tercero 
                                        <input value="<?php echo $datosComprobante['terceroNombre'] ?>" class="form-control col-md-3 tercero1" autofocus name="tercero" id="tag" type="text" autocomplete="off">
                                </div>
                                <div class="col md-6">
                                    <br> <b>Documento</b>: <p class="documentoTercero"><?php echo $datosComprobante['terceroDocumento'] ?></p>
                                    <input type="hidden" autocomplete="off" name="nombreTercero" class="nombreTercero" value="<?php echo $datosComprobante['terceroNombre'] ?>">
                                    <input type="hidden" autocomplete="off" name="idTercero" class="idTercero">
                                    <input type="hidden" value="<?php echo $datosComprobante['terceroDocumento'] ?>" autocomplete="off" name="documentoTer" class="documentoTer">
                                </div>
                                <div class="col-md-2">
                                    Fecha
                                    <input class="form-control" name="fecha" type="date" value="<?php echo $datosComprobante['fechaDMA'] ?>">
                                </div>
                               </div>
                               <br>

                               
                                

                                  
                                       
                                            <div class="row">

                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <label for="tag">Codigo</label>
                                                            </th>
                                                            <th>
                                                                <label for="nombre">Nombre</label>    
                                                            </th>
                                                            <th>
                                                                <label for="detalle">Detalle</label>
                                                            </th>
                                                            <th>
                                                                <label for="detalle">Tercero</label>
                                                            </th>
                                                            <th>
                                                                <label for="base">Base retencion</label>   
                                                            </th>
                                                            <th>
                                                                <label for="debito">Debito</label>
                                                            </th>
                                                            <th>
                                                               <label for="credito">Credito</label> 
                                                            </th>
                                                            <th>
                                                               <label for="credito">Eliminar</label> 
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            
                                                        <?php $i=0; while($datosRegistros = mysqli_fetch_array($arrayRegistros)){ $i++ ?>

                                                        
                                                        <tr>

                                                            <th>
                                                                <input class="form-control idRegistroC<?php echo $i ?>" name="idRegistroC[]" id="tag<?php echo $i ?>" type="hidden" autocomplete="off" value="<?php echo $datosRegistros['idregistrocontable'] ?>">
                                                                <input class="form-control tag<?php echo $i ?>" name="tag[]" id="tag<?php echo $i ?>" type="text" autocomplete="off" value="<?php echo $datosRegistros['codigo'] ?>">
                                                            </th>
                                                            <th>
                                                                <input class="form-control" name="nombre[]" id="nombre<?php echo $i ?>" type="text" autocomplete="off" value="<?php echo $datosRegistros['nombre'] ?>">
                                                            </th>
                                                            <th>
                                                                <input class="form-control" name="detalle[]" id="detalle<?php echo $i ?>" type="text" autocomplete="off" value="<?php echo $datosRegistros['detalle'] ?>">
                                                            </th>
                                                            <th>
                                                                <input class="form-control" name="tercerolista[]" id="tercerolista<?php echo $i ?>" type="text" autocomplete="off"  value="<?php echo $datosRegistros['terceroNombre'] ?>">

                                                                <input class="form-control" name="tercerolistadoc[]" id="tercerolistadoc<?php echo $i ?>" type="hidden" autocomplete="off"  value="<?php echo $datosRegistros['terceroDocumento'] ?>">
                                                                <input class="form-control" name="tercerolistanombre[]" id="tercerolistanombre<?php echo $i ?>" type="hidden" autocomplete="off"  value="<?php echo $datosRegistros['terceroNombre'] ?>">
                                                            </th>
                                                            <th>
                                                                <input class="form-control" name="base[]" id="base<?php echo $i ?>" type="text" autocomplete="off"  value="<?php echo $datosRegistros['base'] ?>">
                                                            </th>
                                                            
                                                            <th>
                                                                <input  class="form-control" name="debito[]"  value="<?php echo $datosRegistros['debito'] ?>"  value="0" id="debito<?php echo $i ?>" type="text" autocomplete="off">
                                                            </th>
                                                            <th>    
                                                                <input class="form-control credito" name="credito[]"  value="<?php echo $datosRegistros['credito'] ?>"  value="0" id="credito<?php echo $i ?>" type="text" autocomplete="off"> 
                                                            </th>
                                                            <th>
                                                                <button style="margin-top:5%" class="btn btn-danger"  type="button"  value="<?php echo $i ?>" id="btneliminar<?php echo $i ?>" type="button" autocomplete="off">x</button> <div class="br"></div> 
                                                            </th>
                                                        </tr>
                                                        

                                                        <?php } ?>

                                                        <?php while($i<=201){ $i++ ?>
                                                        <tr class="hidden troculto<?php echo $i ?>">
                                                            <th>
                                                                <input class="form-control idRegistroC<?php echo $i ?>" name="idRegistroC[]" id="tag<?php echo $i ?>" type="hidden" autocomplete="off" value="">
                                                                <input class="form-control tag<?php echo $i ?>" name="tag[]" id="tag<?php echo $i ?>" type="text" autocomplete="off" value="">
                                                            </th>
                                                            <th>
                                                                <input class="form-control" name="nombre[]" id="nombre<?php echo $i ?>" type="text" autocomplete="off" value="">
                                                            </th>
                                                            <th>
                                                                <input class="form-control" name="detalle[]" id="detalle<?php echo $i ?>" type="text" autocomplete="off" value="">
                                                            </th>
                                                            <th>
                                                                <input class="form-control" name="tercerolista[]" id="tercerolista<?php echo $i ?>" type="text" autocomplete="off" value="">
                                                                <input class="form-control" name="tercerolistadoc[]" id="tercerolistadoc<?php echo $i ?>" type="hidden" autocomplete="off">
                                                                <input class="form-control" name="tercerolistanombre[]" id="tercerolistanombre<?php echo $i ?>" type="hidden" autocomplete="off"  value="">
                                                            </th>
                                                            <th>
                                                                <input class="form-control" name="base[]" id="base<?php echo $i ?>" type="text" autocomplete="off" value="">
                                                            </th>
                                                            <th>
                                                                <input class="form-control" name="debito[]" id="debito<?php echo $i ?>" type="text" disabled autocomplete="off" value="0">
                                                            </th>
                                                            <th>
                                                                <input class="form-control credito" name="credito[]" id="credito<?php echo $i ?>" type="text" disabled autocomplete="off" value="0">
                                                            </th>
                                                            <th>
                                                                <button style="margin-top:5%" class="btn btn-danger"  type="button"  value="<?php echo $i ?>" id="btneliminar<?php echo $i ?>" type="button" autocomplete="off">x</button> <div class="br"></div> 
                                                            </th>
                                                            
                                                        </tr>
                                                        <?php } ?>

                                                        <th>
                                                <th>
                                                <?php $i=0; while($i<=201){ $i++ ?>
                                                <input class="form-control terceropuc" name="terceropuc[]" id="terceropuc<?php echo $i ?>" type="hidden" autocomplete="off">
                                                <input class="form-control basepor" name="basepor[]" id="basepor<?php echo $i ?>" type="hidden" autocomplete="off">
                                                <input class="form-control" name="tagoculto[]"   id="tagoculto<?php echo $i ?>" type="hidden" autocomplete="off">
                                                <?php } ?>
                                                



                                        
                                                            
                                                    </tbody>
                                                </table>
                                                
                                                
                                            </div>
                                            <br>


                                       
                                            
                                                        
                                            <br>

                                            <div class="row col-md-12">
                                                <div class="col-md-4">
                                                    <center> <b>Total debito</b> 
                                                    <input class="form-control totaldebito" type="text" autocomplete="off" disabled>
                                                    <br></center>
                                                    <input class="form-control totaldebito" type="hidden" autocomplete="off" value="0"  name="totaldebito">
                                                    <br></center> 
                                                </div>
                                                <div class="col-md-4">
                                                    <center> <b>Total credito</b> 
                                                    <input class="form-control totalcredito" type="text" autocomplete="off" disabled>
                                                    <br></center>
                                                    <input class="form-control totalcredito" type="hidden" autocomplete="off" value="0"  name="totalcredito">
                                                    <br></center>
                                                </div>
                                                <div class="col-md-4">
                                                    <center> <b>Diferencia</b> 
                                                    <input class="form-control diferencia" type="text" autocomplete="off" disabled>
                                                    <br></center>
                                                    <input class="form-control diferencia" type="hidden" autocomplete="off" value="0"  name="diferencia">
                                                    <br></center>
                                                </div>
                                            </div>


                                            <div class="row col-md-12">
                                                <textarea class="form-control" rows="6" placeholder="Observaciones" name="observaciones"><?php echo $datosComprobante['descripcion'] ?></textarea>
                                            </div>

         
                                            <div class="row col-md-12">
                                                <br>
                                            <div class="col-lg-4">
                                                </div>
                                                
                                            <div class="col-lg-12">
                                                    <input class="form-control btn-success" name="procesar" id="procesar" type="button" value="Procesar">
                                                </div>
                                                
                                                <div class="col-lg-4">
                                                </div>
                                            </div>


                                </form>


								<br><br>    


                                <?php 
                                $array = array();
                                while ( $dataPuc = mysqli_fetch_array($arrayPuc)) { ?>
                                    <?php
                                        $codigo = $dataPuc['codigo'];
                                        $nombre = $dataPuc['nombre'];
                                        array_push($array,$codigo);
                                    ?>
                                <?php } ?>

                                <?php 
                                $array2 = array();
                                while ( $dataUser = mysqli_fetch_array($arrayUsers)) { ?>
                                    <?php
                                        $nombre = $dataUser['nameUser'] ." ". $dataUser['lastnameUser'];
                                        $idusers = $dataUser['idusers'];
                                        $iduser = $dataUser['idusers']." - ".$dataUser['nameUser'] ." ". $dataUser['lastnameUser']." ". $dataUser['documentUser'];
                                        array_push( $array2,$iduser);
                                    ?>
                                <?php } 
                                ?>

                                <?php 
                                $array3 = array();
                                while ( $dataUser2 = mysqli_fetch_array($arrayUsers)) { ?>
                                    <?php
                                     $nombre = $dataUser2['nameUser'] ." ". $dataUser2['lastnameUser'];
                                     $idusers = $dataUser2['idusers'];
                                     $iduser = $dataUser2['idusers']." - ".$dataUser2['nameUser'] ." ". $dataUser2['lastnameUser']." ". $dataUser2['documentUser'];
                                     array_push( $array3,$iduser);
                                    ?>
                                <?php } 
                                ?>
                                

                                

                                

                                

                                

										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
            </div>            

<script>
    function nuevaFilaEnter() {   
        if($(".tag1").val()!="" && $("#tagoculto2").val()==0){
            $(".troculto2").removeClass("hidden")
            if(($("#debito1").val())!=0){
                if(($("#nombre2").val())==""){
                    $("#credito2").val($("#debito1").val())
                }
            }
            if(($("#credito1").val())!=""){
                if(($("#nombre2").val())==""){
                    $("#debito2").val($("#credito1").val())
                }
            }
            $(".tag2").get(0).type = 'text';
            $("#nombre2").get(0).type = 'text';
            $("#detalle2").get(0).type = 'text';
            $("#base2").get(0).type = 'text';
            $("#debito2").get(0).type = 'text';
            $("#credito2").get(0).type = 'text';
            $(".br1").html("<br>")
            $("#btneliminar2").removeClass("hidden");
            $("#tercerolista2").get(0).type = 'text';
            $(".tag2").focus();
        }

        contenidodetalle=$("#detalle1").val()
        i=2
        while(i<=201){
            i2=i+1
            if($("#detalle"+i2).val()==""){
                $("#detalle"+i2).val(contenidodetalle)
            }
            if($(".tag"+i).val()!="" && $("#tagoculto"+i2).val()==0)
            {
                $(".troculto"+i2).removeClass("hidden")
                $(".tag"+i2).get(0).type = 'text';
                $(".tag"+i2).focus();
            }
           i++
        }
        console.log(i)
    }


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

        
        
        numTag=1
        
        $($("input.tag1")).keyup(function(){
            numTag=1
        });

        $($("input.tag2")).keyup(function(){
            numTag=2
           
        });
        $($("input.tag3")).keyup(function(){
            numTag=3
        });
        $($("input.tag4")).keyup(function(){
            numTag=4
        });
        $($("input.tag5")).keyup(function(){
            numTag=5
        });
        $($("input.tag6")).keyup(function(){
            numTag=6
        });
        $($("input.tag7")).keyup(function(){
            numTag=7
        });
        $($("input.tag8")).keyup(function(){
            numTag=8
        });
        $($("input.tag9")).keyup(function(){
            numTag=9
        });
        $($("input.tag10")).keyup(function(){
            numTag=10
        });
        $($("input.tag11")).keyup(function(){
            numTag=11
        });
        $($("input.tag12")).keyup(function(){
            numTag=12
        });
        $($("input.tag13")).keyup(function(){
            numTag=13
        });
        $($("input.tag14")).keyup(function(){
            numTag=14
        });$($("input.tag15")).keyup(function(){
            numTag=15
        });$($("input.tag16")).keyup(function(){
            numTag=16
        });$($("input.tag17")).keyup(function(){
            numTag=17
        });$($("input.tag18")).keyup(function(){
            numTag=18
        });$($("input.tag19")).keyup(function(){
            numTag=19
        });
        $($("input.tag20")).keyup(function(){
            numTag=20
        });
        $($("input.tag21")).keyup(function(){
            numTag=21
        });
        $($("input.tag22")).keyup(function(){
            numTag=22
        });
        $($("input.tag23")).keyup(function(){
            numTag=23
        });
        $($("input.tag24")).keyup(function(){
            numTag=24
        });$($("input.tag25")).keyup(function(){
            numTag=25
        });$($("input.tag26")).keyup(function(){
            numTag=26
        });$($("input.tag27")).keyup(function(){
            numTag=27
        });$($("input.tag28")).keyup(function(){
            numTag=28
        });$($("input.tag29")).keyup(function(){
            numTag=29
        });
        $($("input.tag30")).keyup(function(){
            numTag=30
        });
        $($("input.tag31")).keyup(function(){
            numTag=31
        });
        $($("input.tag32")).keyup(function(){
            numTag=32
        });
        $($("input.tag33")).keyup(function(){
            numTag=33
        });
        $($("input.tag34")).keyup(function(){
            numTag=34
        });$($("input.tag35")).keyup(function(){
            numTag=35
        });$($("input.tag36")).keyup(function(){
            numTag=36
        });$($("input.tag37")).keyup(function(){
            numTag=37
        });$($("input.tag38")).keyup(function(){
            numTag=38
        });$($("input.tag39")).keyup(function(){
            numTag=39
        });
        $($("input.tag40")).keyup(function(){
            numTag=40
        });
        $($("input.tag41")).keyup(function(){
            numTag=41
        });
        $($("input.tag42")).keyup(function(){
            numTag=42
        });
        $($("input.tag43")).keyup(function(){
            numTag=43
        });
        $($("input.tag44")).keyup(function(){
            numTag=44
        });$($("input.tag45")).keyup(function(){
            numTag=45
        });$($("input.tag46")).keyup(function(){
            numTag=46
        });$($("input.tag47")).keyup(function(){
            numTag=47
        });$($("input.tag48")).keyup(function(){
            numTag=48
        });$($("input.tag49")).keyup(function(){
            numTag=49
        });
        $($("input.tag50")).keyup(function(){
            numTag=50
        });
        $($("input.tag51")).keyup(function(){
            numTag=51
        });
        $($("input.tag52")).keyup(function(){
            numTag=52
        });
        $($("input.tag53")).keyup(function(){
            numTag=53
        });
        $($("input.tag54")).keyup(function(){
            numTag=54
        });$($("input.tag55")).keyup(function(){
            numTag=55
        });$($("input.tag56")).keyup(function(){
            numTag=56
        });$($("input.tag57")).keyup(function(){
            numTag=57
        });$($("input.tag58")).keyup(function(){
            numTag=58
        });$($("input.tag59")).keyup(function(){
            numTag=59
        });
        $($("input.tag60")).keyup(function(){
            numTag=60
        });
        $($("input.tag61")).keyup(function(){
            numTag=61
        });
        $($("input.tag62")).keyup(function(){
            numTag=62
        });
        $($("input.tag63")).keyup(function(){
            numTag=63
        });
        $($("input.tag64")).keyup(function(){
            numTag=64
        });$($("input.tag65")).keyup(function(){
            numTag=65
        });$($("input.tag66")).keyup(function(){
            numTag=66
        });$($("input.tag67")).keyup(function(){
            numTag=67
        });$($("input.tag68")).keyup(function(){
            numTag=68
        });$($("input.tag69")).keyup(function(){
            numTag=69
        });
        $($("input.tag70")).keyup(function(){
            numTag=70
        });
        $($("input.tag71")).keyup(function(){
            numTag=71
        });
        $($("input.tag72")).keyup(function(){
            numTag=72
        });
        $($("input.tag73")).keyup(function(){
            numTag=73
        });
        $($("input.tag74")).keyup(function(){
            numTag=74
        });$($("input.tag75")).keyup(function(){
            numTag=75
        });$($("input.tag76")).keyup(function(){
            numTag=76
        });$($("input.tag77")).keyup(function(){
            numTag=77
        });$($("input.tag78")).keyup(function(){
            numTag=78
        });$($("input.tag79")).keyup(function(){
            numTag=79
        });$($("input.tag80")).keyup(function(){
            numTag=80
        });
        $($("input.tag80")).keyup(function(){
            numTag=80
        });
        $($("input.tag81")).keyup(function(){
            numTag=81
        });
        $($("input.tag82")).keyup(function(){
            numTag=82
        });
        $($("input.tag83")).keyup(function(){
            numTag=83
        });
        $($("input.tag84")).keyup(function(){
            numTag=84
        });$($("input.tag85")).keyup(function(){
            numTag=85
        });$($("input.tag86")).keyup(function(){
            numTag=86
        });$($("input.tag87")).keyup(function(){
            numTag=87
        });$($("input.tag88")).keyup(function(){
            numTag=88
        });$($("input.tag89")).keyup(function(){
            numTag=89
        });
        $($("input.tag90")).keyup(function(){
            numTag=90
        });
        $($("input.tag91")).keyup(function(){
            numTag=91
        });
        $($("input.tag92")).keyup(function(){
            numTag=92
        });
        $($("input.tag93")).keyup(function(){
            numTag=93
        });
        $($("input.tag94")).keyup(function(){
            numTag=94
        });$($("input.tag95")).keyup(function(){
            numTag=95
        });$($("input.tag96")).keyup(function(){
            numTag=96
        });$($("input.tag97")).keyup(function(){
            numTag=97
        });$($("input.tag98")).keyup(function(){
            numTag=98
        });$($("input.tag99")).keyup(function(){
            numTag=99
        });$($("input.tag100")).keyup(function(){
            numTag=100
        });$($("input.tag101")).keyup(function(){
            numTag=101
        });$($("input.tag102")).keyup(function(){
            numTag=102
        });$($("input.tag103")).keyup(function(){
            numTag=103
        });$($("input.tag104")).keyup(function(){
            numTag=104
        });$($("input.tag105")).keyup(function(){
            numTag=105
        });$($("input.tag106")).keyup(function(){
            numTag=106
        });$($("input.tag107")).keyup(function(){
            numTag=107
        });$($("input.tag108")).keyup(function(){
            numTag=108
        });$($("input.tag109")).keyup(function(){
            numTag=109
        });$($("input.tag110")).keyup(function(){
            numTag=110
        });$($("input.tag111")).keyup(function(){
            numTag=111
        });$($("input.tag112")).keyup(function(){
            numTag=112
        });$($("input.tag113")).keyup(function(){
            numTag=113
        });$($("input.tag114")).keyup(function(){
            numTag=114
        });$($("input.tag115")).keyup(function(){
            numTag=115
        });$($("input.tag116")).keyup(function(){
            numTag=116
        });$($("input.tag117")).keyup(function(){
            numTag=117
        });$($("input.tag118")).keyup(function(){
            numTag=118
        });$($("input.tag119")).keyup(function(){
            numTag=119
        });$($("input.tag120")).keyup(function(){
            numTag=120
        });$($("input.tag121")).keyup(function(){
            numTag=121
        });$($("input.tag122")).keyup(function(){
            numTag=122
        });$($("input.tag123")).keyup(function(){
            numTag=123
        });$($("input.tag124")).keyup(function(){
            numTag=124
        });$($("input.tag125")).keyup(function(){
            numTag=125
        });$($("input.tag126")).keyup(function(){
            numTag=126
        });$($("input.tag127")).keyup(function(){
            numTag=127
        });$($("input.tag128")).keyup(function(){
            numTag=128
        });$($("input.tag129")).keyup(function(){
            numTag=129
        });$($("input.tag130")).keyup(function(){
            numTag=130
        });$($("input.tag131")).keyup(function(){
            numTag=131
        });$($("input.tag132")).keyup(function(){
            numTag=132
        });$($("input.tag133")).keyup(function(){
            numTag=133
        });$($("input.tag134")).keyup(function(){
            numTag=134
        });$($("input.tag135")).keyup(function(){
            numTag=135
        });$($("input.tag136")).keyup(function(){
            numTag=136
        });$($("input.tag137")).keyup(function(){
            numTag=137
        });$($("input.tag138")).keyup(function(){
            numTag=138
        });$($("input.tag139")).keyup(function(){
            numTag=139
        });$($("input.tag140")).keyup(function(){
            numTag=140
        });$($("input.tag141")).keyup(function(){
            numTag=141
        });$($("input.tag142")).keyup(function(){
            numTag=142
        });$($("input.tag143")).keyup(function(){
            numTag=143
        });$($("input.tag144")).keyup(function(){
            numTag=144
        });$($("input.tag145")).keyup(function(){
            numTag=145
        });$($("input.tag146")).keyup(function(){
            numTag=146
        });$($("input.tag147")).keyup(function(){
            numTag=147
        });$($("input.tag148")).keyup(function(){
            numTag=148
        });$($("input.tag149")).keyup(function(){
            numTag=149
        });$($("input.tag150")).keyup(function(){
            numTag=150
        });
        $($("input.tag151")).keyup(function(){
            numTag=151
        });$($("input.tag152")).keyup(function(){
            numTag=152
        });$($("input.tag153")).keyup(function(){
            numTag=153
        });$($("input.tag154")).keyup(function(){
            numTag=154
        });$($("input.tag155")).keyup(function(){
            numTag=155
        });$($("input.tag156")).keyup(function(){
            numTag=156
        });$($("input.tag157")).keyup(function(){
            numTag=157
        });$($("input.tag158")).keyup(function(){
            numTag=158
        });$($("input.tag159")).keyup(function(){
            numTag=159
        });$($("input.tag160")).keyup(function(){
            numTag=160
        });$($("input.tag161")).keyup(function(){
            numTag=161
        });$($("input.tag162")).keyup(function(){
            numTag=162
        });$($("input.tag163")).keyup(function(){
            numTag=163
        });$($("input.tag164")).keyup(function(){
            numTag=164
        });$($("input.tag165")).keyup(function(){
            numTag=165
        });$($("input.tag166")).keyup(function(){
            numTag=166
        });$($("input.tag167")).keyup(function(){
            numTag=167
        });$($("input.tag168")).keyup(function(){
            numTag=168
        });$($("input.tag169")).keyup(function(){
            numTag=169
        });$($("input.tag170")).keyup(function(){
            numTag=170
        });$($("input.tag171")).keyup(function(){
            numTag=171
        });$($("input.tag172")).keyup(function(){
            numTag=172
        });$($("input.tag173")).keyup(function(){
            numTag=173
        });$($("input.tag174")).keyup(function(){
            numTag=174
        });$($("input.tag175")).keyup(function(){
            numTag=175
        });$($("input.tag176")).keyup(function(){
            numTag=176
        });$($("input.tag177")).keyup(function(){
            numTag=177
        });$($("input.tag178")).keyup(function(){
            numTag=178
        });$($("input.tag179")).keyup(function(){
            numTag=179
        });$($("input.tag180")).keyup(function(){
            numTag=180
        });$($("input.tag181")).keyup(function(){
            numTag=181
        });$($("input.tag182")).keyup(function(){
            numTag=182
        });$($("input.tag183")).keyup(function(){
            numTag=183
        });$($("input.tag184")).keyup(function(){
            numTag=184
        });$($("input.tag185")).keyup(function(){
            numTag=185
        });$($("input.tag186")).keyup(function(){
            numTag=186
        });$($("input.tag187")).keyup(function(){
            numTag=187
        });$($("input.tag188")).keyup(function(){
            numTag=188
        });$($("input.tag189")).keyup(function(){
            numTag=189
        });$($("input.tag190")).keyup(function(){
            numTag=190
        });$($("input.tag191")).keyup(function(){
            numTag=191
        });$($("input.tag192")).keyup(function(){
            numTag=192
        });$($("input.tag193")).keyup(function(){
            numTag=193
        });$($("input.tag194")).keyup(function(){
            numTag=194
        });$($("input.tag195")).keyup(function(){
            numTag=195
        });$($("input.tag196")).keyup(function(){
            numTag=196
        });$($("input.tag197")).keyup(function(){
            numTag=197
        });$($("input.tag198")).keyup(function(){
            numTag=198
        });$($("input.tag199")).keyup(function(){
            numTag=199
        });$($("input.tag200")).keyup(function(){
            numTag=200
        });$($("input.tag201")).keyup(function(){
            numTag=201
        });$($("input.tag202")).keyup(function(){
            numTag=202
        });$($("input.tag203")).keyup(function(){
            numTag=203
        });$($("input.tag204")).keyup(function(){
            numTag=204
        });$($("input.tag205")).keyup(function(){
            numTag=205
        });$($("input.tag206")).keyup(function(){
            numTag=206
        });$($("input.tag207")).keyup(function(){
            numTag=207
        });$($("input.tag208")).keyup(function(){
            numTag=208
        });$($("input.tag209")).keyup(function(){
            numTag=209
        });$($("input.tag210")).keyup(function(){
            numTag=210
        });$($("input.tag211")).keyup(function(){
            numTag=211
        });$($("input.tag212")).keyup(function(){
            numTag=212
        });$($("input.tag213")).keyup(function(){
            numTag=213
        });$($("input.tag214")).keyup(function(){
            numTag=214
        });$($("input.tag215")).keyup(function(){
            numTag=215
        });$($("input.tag216")).keyup(function(){
            numTag=216
        });$($("input.tag217")).keyup(function(){
            numTag=217
        });$($("input.tag218")).keyup(function(){
            numTag=218
        });$($("input.tag219")).keyup(function(){
            numTag=219
        });$($("input.tag220")).keyup(function(){
            numTag=220
        
        });$($("input.tag221")).keyup(function(){
            numTag=221
        });$($("input.tag222")).keyup(function(){
            numTag=222
        });$($("input.tag223")).keyup(function(){
            numTag=223
        });$($("input.tag224")).keyup(function(){
            numTag=224
        });$($("input.tag225")).keyup(function(){
            numTag=225
        });$($("input.tag226")).keyup(function(){
            numTag=226
        });$($("input.tag227")).keyup(function(){
            numTag=227
        });$($("input.tag228")).keyup(function(){
            numTag=228
        });$($("input.tag229")).keyup(function(){
            numTag=229
        });$($("input.tag230")).keyup(function(){
            numTag=230
        });$($("input.tag231")).keyup(function(){
            numTag=231
        });$($("input.tag232")).keyup(function(){
            numTag=232
        });$($("input.tag233")).keyup(function(){
            numTag=233
        });$($("input.tag234")).keyup(function(){
            numTag=234
        });$($("input.tag235")).keyup(function(){
            numTag=235
        });$($("input.tag236")).keyup(function(){
            numTag=236
        });$($("input.tag237")).keyup(function(){
            numTag=237
        });$($("input.tag238")).keyup(function(){
            numTag=238
        });$($("input.tag239")).keyup(function(){
            numTag=239
        });$($("input.tag240")).keyup(function(){
            numTag=240
        });$($("input.tag241")).keyup(function(){
            numTag=241
        });$($("input.tag242")).keyup(function(){
            numTag=242
        });$($("input.tag243")).keyup(function(){
            numTag=243
        });$($("input.tag244")).keyup(function(){
            numTag=244
        });$($("input.tag245")).keyup(function(){
            numTag=245
        });$($("input.tag246")).keyup(function(){
            numTag=246
        });$($("input.tag247")).keyup(function(){
            numTag=247
        });$($("input.tag248")).keyup(function(){
            numTag=248
        });$($("input.tag249")).keyup(function(){
            numTag=249
        });$($("input.tag250")).keyup(function(){
            numTag=250
        });
        $($("input.tag251")).keyup(function(){
            numTag=251
        });$($("input.tag252")).keyup(function(){
            numTag=252
        });$($("input.tag253")).keyup(function(){
            numTag=253
        });$($("input.tag254")).keyup(function(){
            numTag=254
        });$($("input.tag255")).keyup(function(){
            numTag=255
        });$($("input.tag256")).keyup(function(){
            numTag=256
        });$($("input.tag257")).keyup(function(){
            numTag=257
        });$($("input.tag258")).keyup(function(){
            numTag=258
        });$($("input.tag259")).keyup(function(){
            numTag=259
        });$($("input.tag260")).keyup(function(){
            numTag=260
        });$($("input.tag261")).keyup(function(){
            numTag=261
        });$($("input.tag262")).keyup(function(){
            numTag=262
        });$($("input.tag263")).keyup(function(){
            numTag=263
        });$($("input.tag264")).keyup(function(){
            numTag=264
        });$($("input.tag265")).keyup(function(){
            numTag=265
        });$($("input.tag266")).keyup(function(){
            numTag=266
        });$($("input.tag267")).keyup(function(){
            numTag=267
        });$($("input.tag268")).keyup(function(){
            numTag=268
        });$($("input.tag269")).keyup(function(){
            numTag=269
        });$($("input.tag270")).keyup(function(){
            numTag=270
        });$($("input.tag271")).keyup(function(){
            numTag=271
        });$($("input.tag272")).keyup(function(){
            numTag=272
        });$($("input.tag273")).keyup(function(){
            numTag=273
        });$($("input.tag274")).keyup(function(){
            numTag=274
        });$($("input.tag275")).keyup(function(){
            numTag=275
        });$($("input.tag276")).keyup(function(){
            numTag=276
        });$($("input.tag277")).keyup(function(){
            numTag=277
        });$($("input.tag278")).keyup(function(){
            numTag=278
        });$($("input.tag279")).keyup(function(){
            numTag=279
        });$($("input.tag280")).keyup(function(){
            numTag=280
        });$($("input.tag281")).keyup(function(){
            numTag=281
        });$($("input.tag282")).keyup(function(){
            numTag=282
        });$($("input.tag283")).keyup(function(){
            numTag=283
        });$($("input.tag284")).keyup(function(){
            numTag=284
        });$($("input.tag285")).keyup(function(){
            numTag=285
        });$($("input.tag286")).keyup(function(){
            numTag=286
        });$($("input.tag287")).keyup(function(){
            numTag=287
        });$($("input.tag288")).keyup(function(){
            numTag=288
        });$($("input.tag289")).keyup(function(){
            numTag=289
        });$($("input.tag290")).keyup(function(){
            numTag=290
        });$($("input.tag291")).keyup(function(){
            numTag=291
        });$($("input.tag292")).keyup(function(){
            numTag=292
        });$($("input.tag293")).keyup(function(){
            numTag=293
        });$($("input.tag294")).keyup(function(){
            numTag=294
        });$($("input.tag295")).keyup(function(){
            numTag=295
        });$($("input.tag296")).keyup(function(){
            numTag=296
        });$($("input.tag297")).keyup(function(){
            numTag=297
        });$($("input.tag298")).keyup(function(){
            numTag=298
        });$($("input.tag299")).keyup(function(){
            numTag=299
        });$($("input.tag300")).keyup(function(){
            numTag=300
        });;$($("input.tag301")).keyup(function(){
            numTag=301
        });$($("input.tag302")).keyup(function(){
            numTag=302
        });$($("input.tag303")).keyup(function(){
            numTag=303
        });$($("input.tag304")).keyup(function(){
            numTag=304
        });$($("input.tag305")).keyup(function(){
            numTag=305
        });$($("input.tag306")).keyup(function(){
            numTag=306
        });$($("input.tag307")).keyup(function(){
            numTag=307
        });$($("input.tag308")).keyup(function(){
            numTag=308
        });$($("input.tag309")).keyup(function(){
            numTag=309
        });$($("input.tag310")).keyup(function(){
            numTag=310
        });$($("input.tag311")).keyup(function(){
            numTag=311
        });$($("input.tag312")).keyup(function(){
            numTag=312
        });$($("input.tag313")).keyup(function(){
            numTag=313
        });$($("input.tag314")).keyup(function(){
            numTag=314
        });$($("input.tag315")).keyup(function(){
            numTag=315
        });$($("input.tag316")).keyup(function(){
            numTag=316
        });$($("input.tag317")).keyup(function(){
            numTag=317
        });$($("input.tag318")).keyup(function(){
            numTag=318
        });$($("input.tag319")).keyup(function(){
            numTag=319
        });$($("input.tag320")).keyup(function(){
            numTag=320
        });$($("input.tag321")).keyup(function(){
            numTag=321
        });$($("input.tag322")).keyup(function(){
            numTag=322
        });$($("input.tag323")).keyup(function(){
            numTag=323
        });$($("input.tag324")).keyup(function(){
            numTag=324
        });$($("input.tag325")).keyup(function(){
            numTag=325
        });$($("input.tag326")).keyup(function(){
            numTag=326
        });$($("input.tag327")).keyup(function(){
            numTag=327
        });$($("input.tag328")).keyup(function(){
            numTag=328
        });$($("input.tag329")).keyup(function(){
            numTag=329
        });$($("input.tag330")).keyup(function(){
            numTag=330
        });$($("input.tag331")).keyup(function(){
            numTag=331
        });$($("input.tag332")).keyup(function(){
            numTag=332
        });$($("input.tag333")).keyup(function(){
            numTag=333
        });$($("input.tag334")).keyup(function(){
            numTag=334
        });$($("input.tag335")).keyup(function(){
            numTag=335
        });$($("input.tag336")).keyup(function(){
            numTag=336
        });$($("input.tag337")).keyup(function(){
            numTag=337
        });$($("input.tag338")).keyup(function(){
            numTag=338
        });$($("input.tag339")).keyup(function(){
            numTag=339
        });$($("input.tag340")).keyup(function(){
            numTag=340
        });$($("input.tag341")).keyup(function(){
            numTag=341
        });$($("input.tag342")).keyup(function(){
            numTag=342
        });$($("input.tag343")).keyup(function(){
            numTag=343
        });$($("input.tag344")).keyup(function(){
            numTag=344
        });$($("input.tag345")).keyup(function(){
            numTag=345
        });$($("input.tag346")).keyup(function(){
            numTag=346
        });$($("input.tag347")).keyup(function(){
            numTag=347
        });$($("input.tag348")).keyup(function(){
            numTag=348
        });$($("input.tag349")).keyup(function(){
            numTag=349
        });$($("input.tag350")).keyup(function(){
            numTag=350
        });
        $($("input.tag351")).keyup(function(){
            numTag=351
        });$($("input.tag352")).keyup(function(){
            numTag=352
        });$($("input.tag353")).keyup(function(){
            numTag=353
        });$($("input.tag354")).keyup(function(){
            numTag=354
        });$($("input.tag355")).keyup(function(){
            numTag=355
        });$($("input.tag356")).keyup(function(){
            numTag=356
        });$($("input.tag357")).keyup(function(){
            numTag=357
        });$($("input.tag358")).keyup(function(){
            numTag=358
        });$($("input.tag359")).keyup(function(){
            numTag=359
        });$($("input.tag360")).keyup(function(){
            numTag=360
        });$($("input.tag361")).keyup(function(){
            numTag=361
        });$($("input.tag362")).keyup(function(){
            numTag=362
        });$($("input.tag363")).keyup(function(){
            numTag=363
        });$($("input.tag364")).keyup(function(){
            numTag=364
        });$($("input.tag365")).keyup(function(){
            numTag=365
        });$($("input.tag366")).keyup(function(){
            numTag=366
        });$($("input.tag367")).keyup(function(){
            numTag=367
        });$($("input.tag368")).keyup(function(){
            numTag=368
        });$($("input.tag369")).keyup(function(){
            numTag=369
        });$($("input.tag370")).keyup(function(){
            numTag=370
        });$($("input.tag371")).keyup(function(){
            numTag=371
        });$($("input.tag372")).keyup(function(){
            numTag=372
        });$($("input.tag373")).keyup(function(){
            numTag=373
        });$($("input.tag374")).keyup(function(){
            numTag=374
        });$($("input.tag375")).keyup(function(){
            numTag=375
        });$($("input.tag376")).keyup(function(){
            numTag=376
        });$($("input.tag377")).keyup(function(){
            numTag=377
        });$($("input.tag378")).keyup(function(){
            numTag=378
        });$($("input.tag379")).keyup(function(){
            numTag=379
        });$($("input.tag380")).keyup(function(){
            numTag=380
        });$($("input.tag381")).keyup(function(){
            numTag=381
        });$($("input.tag382")).keyup(function(){
            numTag=382
        });$($("input.tag383")).keyup(function(){
            numTag=383
        });$($("input.tag384")).keyup(function(){
            numTag=384
        });$($("input.tag385")).keyup(function(){
            numTag=385
        });$($("input.tag386")).keyup(function(){
            numTag=386
        });$($("input.tag387")).keyup(function(){
            numTag=387
        });$($("input.tag388")).keyup(function(){
            numTag=388
        });$($("input.tag389")).keyup(function(){
            numTag=389
        });$($("input.tag390")).keyup(function(){
            numTag=390
        });$($("input.tag391")).keyup(function(){
            numTag=391
        });$($("input.tag392")).keyup(function(){
            numTag=392
        });$($("input.tag393")).keyup(function(){
            numTag=393
        });$($("input.tag394")).keyup(function(){
            numTag=394
        });$($("input.tag395")).keyup(function(){
            numTag=395
        });$($("input.tag396")).keyup(function(){
            numTag=396
        });$($("input.tag397")).keyup(function(){
            numTag=397
        });$($("input.tag398")).keyup(function(){
            numTag=398
        });$($("input.tag399")).keyup(function(){
            numTag=399
        });$($("input.tag400")).keyup(function(){
            numTag=400
        });;$($("input.tag401")).keyup(function(){
            numTag=401
        });$($("input.tag402")).keyup(function(){
            numTag=402
        });$($("input.tag403")).keyup(function(){
            numTag=403
        });$($("input.tag404")).keyup(function(){
            numTag=404
        });$($("input.tag405")).keyup(function(){
            numTag=405
        });$($("input.tag406")).keyup(function(){
            numTag=406
        });$($("input.tag407")).keyup(function(){
            numTag=407
        });$($("input.tag408")).keyup(function(){
            numTag=408
        });$($("input.tag409")).keyup(function(){
            numTag=409
        });$($("input.tag410")).keyup(function(){
            numTag=410
        });$($("input.tag411")).keyup(function(){
            numTag=411
        });$($("input.tag412")).keyup(function(){
            numTag=412
        });$($("input.tag413")).keyup(function(){
            numTag=413
        });$($("input.tag414")).keyup(function(){
            numTag=414
        });$($("input.tag415")).keyup(function(){
            numTag=415
        });$($("input.tag416")).keyup(function(){
            numTag=416
        });$($("input.tag417")).keyup(function(){
            numTag=417
        });$($("input.tag418")).keyup(function(){
            numTag=418
        });$($("input.tag419")).keyup(function(){
            numTag=419
        });$($("input.tag420")).keyup(function(){
            numTag=420
        });$($("input.tag421")).keyup(function(){
            numTag=421
        });$($("input.tag422")).keyup(function(){
            numTag=422
        });$($("input.tag423")).keyup(function(){
            numTag=423
        });$($("input.tag424")).keyup(function(){
            numTag=424
        });$($("input.tag425")).keyup(function(){
            numTag=425
        });$($("input.tag426")).keyup(function(){
            numTag=426
        });$($("input.tag427")).keyup(function(){
            numTag=427
        });$($("input.tag428")).keyup(function(){
            numTag=428
        });$($("input.tag429")).keyup(function(){
            numTag=429
        });$($("input.tag430")).keyup(function(){
            numTag=430
        });$($("input.tag431")).keyup(function(){
            numTag=431
        });$($("input.tag432")).keyup(function(){
            numTag=432
        });$($("input.tag433")).keyup(function(){
            numTag=433
        });$($("input.tag434")).keyup(function(){
            numTag=434
        });$($("input.tag435")).keyup(function(){
            numTag=435
        });$($("input.tag436")).keyup(function(){
            numTag=436
        });$($("input.tag437")).keyup(function(){
            numTag=437
        });$($("input.tag438")).keyup(function(){
            numTag=438
        });$($("input.tag439")).keyup(function(){
            numTag=439
        });$($("input.tag440")).keyup(function(){
            numTag=440
        });$($("input.tag441")).keyup(function(){
            numTag=441
        });$($("input.tag442")).keyup(function(){
            numTag=442
        });$($("input.tag443")).keyup(function(){
            numTag=443
        });$($("input.tag444")).keyup(function(){
            numTag=444
        });$($("input.tag445")).keyup(function(){
            numTag=445
        });$($("input.tag446")).keyup(function(){
            numTag=446
        });$($("input.tag447")).keyup(function(){
            numTag=447
        });$($("input.tag448")).keyup(function(){
            numTag=448
        });$($("input.tag449")).keyup(function(){
            numTag=449
        });$($("input.tag450")).keyup(function(){
            numTag=450
        });
        $($("input.tag451")).keyup(function(){
            numTag=451
        });$($("input.tag452")).keyup(function(){
            numTag=452
        });$($("input.tag453")).keyup(function(){
            numTag=453
        });$($("input.tag454")).keyup(function(){
            numTag=454
        });$($("input.tag455")).keyup(function(){
            numTag=455
        });$($("input.tag456")).keyup(function(){
            numTag=456
        });$($("input.tag457")).keyup(function(){
            numTag=457
        });$($("input.tag458")).keyup(function(){
            numTag=458
        });$($("input.tag459")).keyup(function(){
            numTag=459
        });$($("input.tag460")).keyup(function(){
            numTag=460
        });$($("input.tag461")).keyup(function(){
            numTag=461
        });$($("input.tag462")).keyup(function(){
            numTag=462
        });$($("input.tag463")).keyup(function(){
            numTag=463
        });$($("input.tag464")).keyup(function(){
            numTag=464
        });$($("input.tag465")).keyup(function(){
            numTag=465
        });$($("input.tag466")).keyup(function(){
            numTag=466
        });$($("input.tag467")).keyup(function(){
            numTag=467
        });$($("input.tag468")).keyup(function(){
            numTag=468
        });$($("input.tag469")).keyup(function(){
            numTag=469
        });$($("input.tag470")).keyup(function(){
            numTag=470
        });$($("input.tag471")).keyup(function(){
            numTag=471
        });$($("input.tag472")).keyup(function(){
            numTag=472
        });$($("input.tag473")).keyup(function(){
            numTag=473
        });$($("input.tag474")).keyup(function(){
            numTag=474
        });$($("input.tag475")).keyup(function(){
            numTag=475
        });$($("input.tag476")).keyup(function(){
            numTag=476
        });$($("input.tag477")).keyup(function(){
            numTag=477
        });$($("input.tag478")).keyup(function(){
            numTag=478
        });$($("input.tag479")).keyup(function(){
            numTag=479
        });$($("input.tag480")).keyup(function(){
            numTag=480
        });$($("input.tag481")).keyup(function(){
            numTag=481
        });$($("input.tag482")).keyup(function(){
            numTag=482
        });$($("input.tag483")).keyup(function(){
            numTag=483
        });$($("input.tag484")).keyup(function(){
            numTag=484
        });$($("input.tag485")).keyup(function(){
            numTag=485
        });$($("input.tag486")).keyup(function(){
            numTag=486
        });$($("input.tag487")).keyup(function(){
            numTag=487
        });$($("input.tag488")).keyup(function(){
            numTag=488
        });$($("input.tag489")).keyup(function(){
            numTag=489
        });$($("input.tag490")).keyup(function(){
            numTag=490
        });$($("input.tag491")).keyup(function(){
            numTag=491
        });$($("input.tag492")).keyup(function(){
            numTag=492
        });$($("input.tag493")).keyup(function(){
            numTag=493
        });$($("input.tag494")).keyup(function(){
            numTag=494
        });$($("input.tag495")).keyup(function(){
            numTag=495
        });$($("input.tag496")).keyup(function(){
            numTag=496
        });$($("input.tag497")).keyup(function(){
            numTag=497
        });$($("input.tag498")).keyup(function(){
            numTag=498
        });$($("input.tag499")).keyup(function(){
            numTag=499
        });$($("input.tag500")).keyup(function(){
            numTag=500
        });;$($("input.tag501")).keyup(function(){
            numTag=501
        });$($("input.tag502")).keyup(function(){
            numTag=502
        });$($("input.tag503")).keyup(function(){
            numTag=503
        });$($("input.tag504")).keyup(function(){
            numTag=504
        });$($("input.tag505")).keyup(function(){
            numTag=505
        });$($("input.tag506")).keyup(function(){
            numTag=506
        });$($("input.tag507")).keyup(function(){
            numTag=507
        });$($("input.tag508")).keyup(function(){
            numTag=508
        });$($("input.tag509")).keyup(function(){
            numTag=509
        });$($("input.tag510")).keyup(function(){
            numTag=510
        });$($("input.tag511")).keyup(function(){
            numTag=511
        });$($("input.tag512")).keyup(function(){
            numTag=512
        });$($("input.tag513")).keyup(function(){
            numTag=513
        });$($("input.tag514")).keyup(function(){
            numTag=514
        });$($("input.tag515")).keyup(function(){
            numTag=515
        });$($("input.tag516")).keyup(function(){
            numTag=516
        });$($("input.tag517")).keyup(function(){
            numTag=517
        });$($("input.tag518")).keyup(function(){
            numTag=518
        });$($("input.tag519")).keyup(function(){
            numTag=519
        });$($("input.tag520")).keyup(function(){
            numTag=520
        });$($("input.tag521")).keyup(function(){
            numTag=521
        });$($("input.tag522")).keyup(function(){
            numTag=522
        });$($("input.tag523")).keyup(function(){
            numTag=523
        });$($("input.tag524")).keyup(function(){
            numTag=524
        });$($("input.tag525")).keyup(function(){
            numTag=525
        });$($("input.tag526")).keyup(function(){
            numTag=526
        });$($("input.tag527")).keyup(function(){
            numTag=527
        });$($("input.tag528")).keyup(function(){
            numTag=528
        });$($("input.tag529")).keyup(function(){
            numTag=529
        });$($("input.tag530")).keyup(function(){
            numTag=530
        });$($("input.tag531")).keyup(function(){
            numTag=531
        });$($("input.tag532")).keyup(function(){
            numTag=532
        });$($("input.tag533")).keyup(function(){
            numTag=533
        });$($("input.tag534")).keyup(function(){
            numTag=534
        });$($("input.tag535")).keyup(function(){
            numTag=535
        });$($("input.tag536")).keyup(function(){
            numTag=536
        });$($("input.tag537")).keyup(function(){
            numTag=537
        });$($("input.tag538")).keyup(function(){
            numTag=538
        });$($("input.tag539")).keyup(function(){
            numTag=539
        });$($("input.tag540")).keyup(function(){
            numTag=540
        });$($("input.tag541")).keyup(function(){
            numTag=541
        });$($("input.tag542")).keyup(function(){
            numTag=542
        });$($("input.tag543")).keyup(function(){
            numTag=543
        });$($("input.tag544")).keyup(function(){
            numTag=544
        });$($("input.tag545")).keyup(function(){
            numTag=545
        });$($("input.tag546")).keyup(function(){
            numTag=546
        });$($("input.tag547")).keyup(function(){
            numTag=547
        });$($("input.tag548")).keyup(function(){
            numTag=548
        });$($("input.tag549")).keyup(function(){
            numTag=549
        });$($("input.tag550")).keyup(function(){
            numTag=550
        });
        $($("input.tag551")).keyup(function(){
            numTag=551
        });$($("input.tag552")).keyup(function(){
            numTag=552
        });$($("input.tag553")).keyup(function(){
            numTag=553
        });$($("input.tag554")).keyup(function(){
            numTag=554
        });$($("input.tag555")).keyup(function(){
            numTag=555
        });$($("input.tag556")).keyup(function(){
            numTag=556
        });$($("input.tag557")).keyup(function(){
            numTag=557
        });$($("input.tag558")).keyup(function(){
            numTag=558
        });$($("input.tag559")).keyup(function(){
            numTag=559
        });$($("input.tag560")).keyup(function(){
            numTag=560
        });$($("input.tag561")).keyup(function(){
            numTag=561
        });$($("input.tag562")).keyup(function(){
            numTag=562
        });$($("input.tag563")).keyup(function(){
            numTag=563
        });$($("input.tag564")).keyup(function(){
            numTag=564
        });$($("input.tag565")).keyup(function(){
            numTag=565
        });$($("input.tag566")).keyup(function(){
            numTag=566
        });$($("input.tag567")).keyup(function(){
            numTag=567
        });$($("input.tag568")).keyup(function(){
            numTag=568
        });$($("input.tag569")).keyup(function(){
            numTag=569
        });$($("input.tag570")).keyup(function(){
            numTag=570
        });$($("input.tag571")).keyup(function(){
            numTag=571
        });$($("input.tag572")).keyup(function(){
            numTag=572
        });$($("input.tag573")).keyup(function(){
            numTag=573
        });$($("input.tag574")).keyup(function(){
            numTag=574
        });$($("input.tag575")).keyup(function(){
            numTag=575
        });$($("input.tag576")).keyup(function(){
            numTag=576
        });$($("input.tag577")).keyup(function(){
            numTag=577
        });$($("input.tag578")).keyup(function(){
            numTag=578
        });$($("input.tag579")).keyup(function(){
            numTag=579
        });$($("input.tag580")).keyup(function(){
            numTag=580
        });$($("input.tag581")).keyup(function(){
            numTag=581
        });$($("input.tag582")).keyup(function(){
            numTag=582
        });$($("input.tag583")).keyup(function(){
            numTag=583
        });$($("input.tag584")).keyup(function(){
            numTag=584
        });$($("input.tag585")).keyup(function(){
            numTag=585
        });$($("input.tag586")).keyup(function(){
            numTag=586
        });$($("input.tag587")).keyup(function(){
            numTag=587
        });$($("input.tag588")).keyup(function(){
            numTag=588
        });$($("input.tag589")).keyup(function(){
            numTag=589
        });$($("input.tag590")).keyup(function(){
            numTag=590
        });$($("input.tag591")).keyup(function(){
            numTag=591
        });$($("input.tag592")).keyup(function(){
            numTag=592
        });$($("input.tag593")).keyup(function(){
            numTag=593
        });$($("input.tag594")).keyup(function(){
            numTag=594
        });$($("input.tag595")).keyup(function(){
            numTag=595
        });$($("input.tag596")).keyup(function(){
            numTag=596
        });$($("input.tag597")).keyup(function(){
            numTag=597
        });$($("input.tag598")).keyup(function(){
            numTag=598
        });$($("input.tag599")).keyup(function(){
            numTag=599
        });$($("input.tag600")).keyup(function(){
            numTag=600
        });
        
        


        
        
        $("#btneliminar1").click(function(){
            idbtn=$("#btneliminar1").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');   
        })

        $("#btneliminar2").click(function(){
            idbtn=$("#btneliminar2").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
            $("#tagoculto"+idbtn).value(1);           
        })

        $("#btneliminar3").click(function(){
            idbtn=$("#btneliminar3").val()
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
              
        })

        $("#btneliminar4").click(function(){
            idbtn=$("#btneliminar4").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                    
        })

        $("#btneliminar5").click(function(){
            idbtn=$("#btneliminar5").val()
            
            $("#tagoculto"+idbtn).val("1");       
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
        })

        $("#btneliminar6").click(function(){
            idbtn=$("#btneliminar6").val()
            
            $("#tagoculto"+idbtn).val("1");      
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
              
        })

        $("#btneliminar7").click(function(){
            idbtn=$("#btneliminar7").val()
            
            $("#tagoculto"+idbtn).val("1");    
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                
        })

        $("#btneliminar8").click(function(){
            idbtn=$("#btneliminar8").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                    
        })

        $("#btneliminar9").click(function(){
            idbtn=$("#btneliminar9").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
        })

        $("#btneliminar11").click(function(){
            idbtn=$("#btneliminar11").val()
            
            $("#tagoculto"+idbtn).val("1");    
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
               
        })

        $("#btneliminar10").click(function(){
            idbtn=$("#btneliminar10").val()
            
            $("#tagoculto"+idbtn).val("1");    
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
             
        })

        $("#btneliminar12").click(function(){
            idbtn=$("#btneliminar12").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
            
        })
        $("#btneliminar13").click(function(){
            idbtn=$("#btneliminar13").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                 
        })
        $("#btneliminar14").click(function(){
            idbtn=$("#btneliminar14").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
        })
        $("#btneliminar15").click(function(){
            idbtn=$("#btneliminar15").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar16").click(function(){
            idbtn=$("#btneliminar16").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
        })
        $("#btneliminar17").click(function(){
            idbtn=$("#btneliminar17").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
              
        })
        $("#btneliminar18").click(function(){
            idbtn=$("#btneliminar18").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                    
        })
        $("#btneliminar19").click(function(){
            idbtn=$("#btneliminar19").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
            
        })
        $("#btneliminar20").click(function(){
            idbtn=$("#btneliminar20").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
                  
        })

        
        $("#btneliminar21").click(function(){
            idbtn=$("#btneliminar21").val()
            
            $("#tagoculto"+idbtn).val("1");    
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
             
        })

        $("#btneliminar22").click(function(){
            idbtn=$("#btneliminar22").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
            
        })
        $("#btneliminar23").click(function(){
            idbtn=$("#btneliminar23").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                 
        })
        $("#btneliminar24").click(function(){
            idbtn=$("#btneliminar24").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
        })
        $("#btneliminar25").click(function(){
            idbtn=$("#btneliminar25").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar26").click(function(){
            idbtn=$("#btneliminar26").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
        })
        $("#btneliminar27").click(function(){
            idbtn=$("#btneliminar27").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
              
        })
        $("#btneliminar28").click(function(){
            idbtn=$("#btneliminar28").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                    
        })
        $("#btneliminar29").click(function(){
            idbtn=$("#btneliminar29").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar30").click(function(){
            idbtn=$("#btneliminar30").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
            
        })

        $("#btneliminar30").click(function(){
            idbtn=$("#btneliminar30").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
                  
        })

        
        $("#btneliminar31").click(function(){
            idbtn=$("#btneliminar31").val()
            
            $("#tagoculto"+idbtn).val("1");    
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
             
        })

        $("#btneliminar32").click(function(){
            idbtn=$("#btneliminar32").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
            
        })
        $("#btneliminar33").click(function(){
            idbtn=$("#btneliminar33").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                 
        })
        $("#btneliminar34").click(function(){
            idbtn=$("#btneliminar34").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
        })
        $("#btneliminar35").click(function(){
            idbtn=$("#btneliminar35").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar36").click(function(){
            idbtn=$("#btneliminar36").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
        })
        $("#btneliminar37").click(function(){
            idbtn=$("#btneliminar37").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
              
        })
        $("#btneliminar38").click(function(){
            idbtn=$("#btneliminar38").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                    
        })
        $("#btneliminar39").click(function(){
            idbtn=$("#btneliminar39").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
       

        $("#btneliminar40").click(function(){
            idbtn=$("#btneliminar40").val()
            
            $("#tagoculto"+idbtn).val("1");    
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
             
        })
        $("#btneliminar41").click(function(){
            idbtn=$("#btneliminar41").val()
            
            $("#tagoculto"+idbtn).val("1");    
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
               
        })

        $("#btneliminar42").click(function(){
            idbtn=$("#btneliminar42").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
            
        })
        $("#btneliminar43").click(function(){
            idbtn=$("#btneliminar43").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                 
        })
        $("#btneliminar44").click(function(){
            idbtn=$("#btneliminar44").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
        })
        $("#btneliminar45").click(function(){
            idbtn=$("#btneliminar45").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar46").click(function(){
            idbtn=$("#btneliminar46").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
        })
        $("#btneliminar47").click(function(){
            idbtn=$("#btneliminar47").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
              
        })
        $("#btneliminar48").click(function(){
            idbtn=$("#btneliminar48").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                    
        })
        $("#btneliminar49").click(function(){
            idbtn=$("#btneliminar49").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
            
        })
        $("#btneliminar50").click(function(){
            idbtn=$("#btneliminar50").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
                  
        })

        
        $("#btneliminar51").click(function(){
            idbtn=$("#btneliminar51").val()
            
            $("#tagoculto"+idbtn).val("1");    
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
             
        })

        $("#btneliminar52").click(function(){
            idbtn=$("#btneliminar52").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
            
        })
        $("#btneliminar53").click(function(){
            idbtn=$("#btneliminar53").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                 
        })
        $("#btneliminar54").click(function(){
            idbtn=$("#btneliminar54").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
        })
        $("#btneliminar55").click(function(){
            idbtn=$("#btneliminar55").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar56").click(function(){
            idbtn=$("#btneliminar56").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
        })
        $("#btneliminar57").click(function(){
            idbtn=$("#btneliminar57").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
              
        })
        $("#btneliminar58").click(function(){
            idbtn=$("#btneliminar58").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                    
        })
        $("#btneliminar59").click(function(){
            idbtn=$("#btneliminar59").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
    
        $("#btneliminar60").click(function(){
            idbtn=$("#btneliminar60").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
                  
        })

        
        $("#btneliminar61").click(function(){
            idbtn=$("#btneliminar61").val()
            
            $("#tagoculto"+idbtn).val("1");    
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
             
        })

        $("#btneliminar62").click(function(){
            idbtn=$("#btneliminar62").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
            
        })
        $("#btneliminar63").click(function(){
            idbtn=$("#btneliminar63").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                 
        })
        $("#btneliminar64").click(function(){
            idbtn=$("#btneliminar64").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
        })
        $("#btneliminar65").click(function(){
            idbtn=$("#btneliminar65").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar66").click(function(){
            idbtn=$("#btneliminar66").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
        })
        $("#btneliminar67").click(function(){
            idbtn=$("#btneliminar67").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
              
        })
        $("#btneliminar68").click(function(){
            idbtn=$("#btneliminar68").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                    
        })
        $("#btneliminar69").click(function(){
            idbtn=$("#btneliminar69").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })

        $("#btneliminar70").click(function(){
            idbtn=$("#btneliminar70").val()
            
            $("#tagoculto"+idbtn).val("1");    
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
             
        })
        $("#btneliminar71").click(function(){
            idbtn=$("#btneliminar71").val()
            
            $("#tagoculto"+idbtn).val("1");    
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
               
        })


        $("#btneliminar72").click(function(){
            idbtn=$("#btneliminar72").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
            
        })
        $("#btneliminar73").click(function(){
            idbtn=$("#btneliminar73").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                 
        })
        $("#btneliminar74").click(function(){
            idbtn=$("#btneliminar74").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
        })
        $("#btneliminar75").click(function(){
            idbtn=$("#btneliminar75").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar76").click(function(){
            idbtn=$("#btneliminar76").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
        })
        $("#btneliminar77").click(function(){
            idbtn=$("#btneliminar77").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
              
        })
        $("#btneliminar78").click(function(){
            idbtn=$("#btneliminar78").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                    
        })
        $("#btneliminar79").click(function(){
            idbtn=$("#btneliminar79").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
            
        })
        $("#btneliminar80").click(function(){
            idbtn=$("#btneliminar80").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
                  
        })

        
        $("#btneliminar81").click(function(){
            idbtn=$("#btneliminar81").val()
            
            $("#tagoculto"+idbtn).val("1");    
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
             
        })

        $("#btneliminar82").click(function(){
            idbtn=$("#btneliminar82").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
            
        })
        $("#btneliminar83").click(function(){
            idbtn=$("#btneliminar83").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                 
        })
        $("#btneliminar84").click(function(){
            idbtn=$("#btneliminar84").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
        })
        $("#btneliminar85").click(function(){
            idbtn=$("#btneliminar85").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar86").click(function(){
            idbtn=$("#btneliminar86").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
        })
        $("#btneliminar87").click(function(){
            idbtn=$("#btneliminar87").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
              
        })
        $("#btneliminar88").click(function(){
            idbtn=$("#btneliminar88").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                    
        })
        $("#btneliminar89").click(function(){
            idbtn=$("#btneliminar89").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar90").click(function(){
            idbtn=$("#btneliminar90").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
            
        })

        
        
        $("#btneliminar91").click(function(){
            idbtn=$("#btneliminar91").val()
            
            $("#tagoculto"+idbtn).val("1");    
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
             
        })

        $("#btneliminar92").click(function(){
            idbtn=$("#btneliminar92").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
            
        })
        $("#btneliminar93").click(function(){
            idbtn=$("#btneliminar93").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                 
        })
        $("#btneliminar94").click(function(){
            idbtn=$("#btneliminar94").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
            
        })
        $("#btneliminar95").click(function(){
            idbtn=$("#btneliminar95").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar96").click(function(){
            idbtn=$("#btneliminar96").val()
            
            $("#tagoculto"+idbtn).val("1");               
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
        })
        $("#btneliminar97").click(function(){
            idbtn=$("#btneliminar97").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
              
        })
        $("#btneliminar98").click(function(){
            idbtn=$("#btneliminar98").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
             
                    
        })
        $("#btneliminar99").click(function(){
            idbtn=$("#btneliminar99").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar100").click(function(){
            idbtn=$("#btneliminar100").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar101").click(function(){
            idbtn=$("#btneliminar101").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar102").click(function(){
            idbtn=$("#btneliminar102").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar103").click(function(){
            idbtn=$("#btneliminar103").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar104").click(function(){
            idbtn=$("#btneliminar104").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar105").click(function(){
            idbtn=$("#btneliminar105").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar106").click(function(){
            idbtn=$("#btneliminar106").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar107").click(function(){
            idbtn=$("#btneliminar107").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar108").click(function(){
            idbtn=$("#btneliminar108").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar109").click(function(){
            idbtn=$("#btneliminar109").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar110").click(function(){
            idbtn=$("#btneliminar110").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar111").click(function(){
            idbtn=$("#btneliminar111").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar112").click(function(){
            idbtn=$("#btneliminar112").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar113").click(function(){
            idbtn=$("#btneliminar113").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar114").click(function(){
            idbtn=$("#btneliminar114").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar115").click(function(){
            idbtn=$("#btneliminar115").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar116").click(function(){
            idbtn=$("#btneliminar116").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar117").click(function(){
            idbtn=$("#btneliminar117").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar118").click(function(){
            idbtn=$("#btneliminar118").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar119").click(function(){
            idbtn=$("#btneliminar119").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar120").click(function(){
            idbtn=$("#btneliminar120").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar121").click(function(){
            idbtn=$("#btneliminar121").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar122").click(function(){
            idbtn=$("#btneliminar122").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar123").click(function(){
            idbtn=$("#btneliminar123").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar124").click(function(){
            idbtn=$("#btneliminar124").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar125").click(function(){
            idbtn=$("#btneliminar125").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar126").click(function(){
            idbtn=$("#btneliminar126").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar127").click(function(){
            idbtn=$("#btneliminar127").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar128").click(function(){
            idbtn=$("#btneliminar128").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar129").click(function(){
            idbtn=$("#btneliminar129").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar130").click(function(){
            idbtn=$("#btneliminar130").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar131").click(function(){
            idbtn=$("#btneliminar131").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar132").click(function(){
            idbtn=$("#btneliminar132").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar133").click(function(){
            idbtn=$("#btneliminar133").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar134").click(function(){
            idbtn=$("#btneliminar134").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar135").click(function(){
            idbtn=$("#btneliminar135").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar136").click(function(){
            idbtn=$("#btneliminar136").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar137").click(function(){
            idbtn=$("#btneliminar137").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar138").click(function(){
            idbtn=$("#btneliminar138").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar139").click(function(){
            idbtn=$("#btneliminar139").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar140").click(function(){
            idbtn=$("#btneliminar140").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar141").click(function(){
            idbtn=$("#btneliminar141").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar142").click(function(){
            idbtn=$("#btneliminar142").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar143").click(function(){
            idbtn=$("#btneliminar143").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar144").click(function(){
            idbtn=$("#btneliminar144").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar145").click(function(){
            idbtn=$("#btneliminar145").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar146").click(function(){
            idbtn=$("#btneliminar146").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar147").click(function(){
            idbtn=$("#btneliminar147").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar148").click(function(){
            idbtn=$("#btneliminar148").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar149").click(function(){
            idbtn=$("#btneliminar149").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar150").click(function(){
            idbtn=$("#btneliminar150").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar151").click(function(){
            idbtn=$("#btneliminar151").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar152").click(function(){
            idbtn=$("#btneliminar152").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar153").click(function(){
            idbtn=$("#btneliminar153").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar154").click(function(){
            idbtn=$("#btneliminar154").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar155").click(function(){
            idbtn=$("#btneliminar155").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar156").click(function(){
            idbtn=$("#btneliminar156").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar157").click(function(){
            idbtn=$("#btneliminar157").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar158").click(function(){
            idbtn=$("#btneliminar158").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar159").click(function(){
            idbtn=$("#btneliminar159").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar160").click(function(){
            idbtn=$("#btneliminar160").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar161").click(function(){
            idbtn=$("#btneliminar161").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar162").click(function(){
            idbtn=$("#btneliminar162").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar163").click(function(){
            idbtn=$("#btneliminar163").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar164").click(function(){
            idbtn=$("#btneliminar164").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar165").click(function(){
            idbtn=$("#btneliminar165").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar166").click(function(){
            idbtn=$("#btneliminar166").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar167").click(function(){
            idbtn=$("#btneliminar167").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar168").click(function(){
            idbtn=$("#btneliminar168").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar169").click(function(){
            idbtn=$("#btneliminar169").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar170").click(function(){
            idbtn=$("#btneliminar170").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar171").click(function(){
            idbtn=$("#btneliminar171").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar172").click(function(){
            idbtn=$("#btneliminar172").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar173").click(function(){
            idbtn=$("#btneliminar173").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar174").click(function(){
            idbtn=$("#btneliminar174").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar175").click(function(){
            idbtn=$("#btneliminar175").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar176").click(function(){
            idbtn=$("#btneliminar176").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar177").click(function(){
            idbtn=$("#btneliminar177").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar178").click(function(){
            idbtn=$("#btneliminar178").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar179").click(function(){
            idbtn=$("#btneliminar179").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar180").click(function(){
            idbtn=$("#btneliminar180").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar181").click(function(){
            idbtn=$("#btneliminar181").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar182").click(function(){
            idbtn=$("#btneliminar182").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar183").click(function(){
            idbtn=$("#btneliminar183").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar184").click(function(){
            idbtn=$("#btneliminar184").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar185").click(function(){
            idbtn=$("#btneliminar185").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar186").click(function(){
            idbtn=$("#btneliminar186").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar187").click(function(){
            idbtn=$("#btneliminar187").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar188").click(function(){
            idbtn=$("#btneliminar188").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar189").click(function(){
            idbtn=$("#btneliminar189").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar190").click(function(){
            idbtn=$("#btneliminar190").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar191").click(function(){
            idbtn=$("#btneliminar191").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar192").click(function(){
            idbtn=$("#btneliminar192").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar193").click(function(){
            idbtn=$("#btneliminar193").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar194").click(function(){
            idbtn=$("#btneliminar194").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar195").click(function(){
            idbtn=$("#btneliminar195").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar196").click(function(){
            idbtn=$("#btneliminar196").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar197").click(function(){
            idbtn=$("#btneliminar197").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar198").click(function(){
            idbtn=$("#btneliminar198").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar199").click(function(){
            idbtn=$("#btneliminar199").val()
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar200").click(function(){
            idbtn=$("#btneliminar200").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar201").click(function(){
            idbtn=$("#btneliminar201").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar202").click(function(){
            idbtn=$("#btneliminar202").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar203").click(function(){
            idbtn=$("#btneliminar203").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar204").click(function(){
            idbtn=$("#btneliminar204").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar205").click(function(){
            idbtn=$("#btneliminar205").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar206").click(function(){
            idbtn=$("#btneliminar206").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar207").click(function(){
            idbtn=$("#btneliminar207").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar208").click(function(){
            idbtn=$("#btneliminar208").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar209").click(function(){
            idbtn=$("#btneliminar209").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar210").click(function(){
            idbtn=$("#btneliminar210").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar211").click(function(){
            idbtn=$("#btneliminar211").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar212").click(function(){
            idbtn=$("#btneliminar212").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar213").click(function(){
            idbtn=$("#btneliminar213").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar214").click(function(){
            idbtn=$("#btneliminar214").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar215").click(function(){
            idbtn=$("#btneliminar215").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar216").click(function(){
            idbtn=$("#btneliminar216").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar217").click(function(){
            idbtn=$("#btneliminar217").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar218").click(function(){
            idbtn=$("#btneliminar218").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar219").click(function(){
            idbtn=$("#btneliminar219").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar220").click(function(){
            idbtn=$("#btneliminar220").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar221").click(function(){
            idbtn=$("#btneliminar221").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar222").click(function(){
            idbtn=$("#btneliminar222").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar223").click(function(){
            idbtn=$("#btneliminar223").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar224").click(function(){
            idbtn=$("#btneliminar224").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar225").click(function(){
            idbtn=$("#btneliminar225").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar226").click(function(){
            idbtn=$("#btneliminar226").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar227").click(function(){
            idbtn=$("#btneliminar227").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar228").click(function(){
            idbtn=$("#btneliminar228").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar229").click(function(){
            idbtn=$("#btneliminar229").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar230").click(function(){
            idbtn=$("#btneliminar230").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar231").click(function(){
            idbtn=$("#btneliminar231").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar232").click(function(){
            idbtn=$("#btneliminar232").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar233").click(function(){
            idbtn=$("#btneliminar233").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar234").click(function(){
            idbtn=$("#btneliminar234").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar235").click(function(){
            idbtn=$("#btneliminar235").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar236").click(function(){
            idbtn=$("#btneliminar236").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar237").click(function(){
            idbtn=$("#btneliminar237").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar238").click(function(){
            idbtn=$("#btneliminar238").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar239").click(function(){
            idbtn=$("#btneliminar239").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar240").click(function(){
            idbtn=$("#btneliminar240").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar241").click(function(){
            idbtn=$("#btneliminar241").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar242").click(function(){
            idbtn=$("#btneliminar242").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar243").click(function(){
            idbtn=$("#btneliminar243").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar244").click(function(){
            idbtn=$("#btneliminar244").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar245").click(function(){
            idbtn=$("#btneliminar245").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar246").click(function(){
            idbtn=$("#btneliminar246").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar247").click(function(){
            idbtn=$("#btneliminar247").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar248").click(function(){
            idbtn=$("#btneliminar248").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar249").click(function(){
            idbtn=$("#btneliminar249").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar250").click(function(){
            idbtn=$("#btneliminar250").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar251").click(function(){
            idbtn=$("#btneliminar251").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar252").click(function(){
            idbtn=$("#btneliminar252").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar253").click(function(){
            idbtn=$("#btneliminar253").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar254").click(function(){
            idbtn=$("#btneliminar254").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar255").click(function(){
            idbtn=$("#btneliminar255").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar256").click(function(){
            idbtn=$("#btneliminar256").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar257").click(function(){
            idbtn=$("#btneliminar257").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar258").click(function(){
            idbtn=$("#btneliminar258").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar259").click(function(){
            idbtn=$("#btneliminar259").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar260").click(function(){
            idbtn=$("#btneliminar260").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar261").click(function(){
            idbtn=$("#btneliminar261").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar262").click(function(){
            idbtn=$("#btneliminar262").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar263").click(function(){
            idbtn=$("#btneliminar263").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar264").click(function(){
            idbtn=$("#btneliminar264").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar265").click(function(){
            idbtn=$("#btneliminar265").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar266").click(function(){
            idbtn=$("#btneliminar266").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar267").click(function(){
            idbtn=$("#btneliminar267").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar268").click(function(){
            idbtn=$("#btneliminar268").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar269").click(function(){
            idbtn=$("#btneliminar269").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar270").click(function(){
            idbtn=$("#btneliminar270").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar271").click(function(){
            idbtn=$("#btneliminar271").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar272").click(function(){
            idbtn=$("#btneliminar272").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar273").click(function(){
            idbtn=$("#btneliminar273").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar274").click(function(){
            idbtn=$("#btneliminar274").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar275").click(function(){
            idbtn=$("#btneliminar275").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar276").click(function(){
            idbtn=$("#btneliminar276").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar277").click(function(){
            idbtn=$("#btneliminar277").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar278").click(function(){
            idbtn=$("#btneliminar278").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar279").click(function(){
            idbtn=$("#btneliminar279").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar280").click(function(){
            idbtn=$("#btneliminar280").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar281").click(function(){
            idbtn=$("#btneliminar281").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar282").click(function(){
            idbtn=$("#btneliminar282").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar283").click(function(){
            idbtn=$("#btneliminar283").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar284").click(function(){
            idbtn=$("#btneliminar284").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar285").click(function(){
            idbtn=$("#btneliminar285").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar286").click(function(){
            idbtn=$("#btneliminar286").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar287").click(function(){
            idbtn=$("#btneliminar287").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar288").click(function(){
            idbtn=$("#btneliminar288").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar289").click(function(){
            idbtn=$("#btneliminar289").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar290").click(function(){
            idbtn=$("#btneliminar290").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar291").click(function(){
            idbtn=$("#btneliminar291").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar292").click(function(){
            idbtn=$("#btneliminar292").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar293").click(function(){
            idbtn=$("#btneliminar293").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar294").click(function(){
            idbtn=$("#btneliminar294").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar295").click(function(){
            idbtn=$("#btneliminar295").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar296").click(function(){
            idbtn=$("#btneliminar296").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar297").click(function(){
            idbtn=$("#btneliminar297").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar298").click(function(){
            idbtn=$("#btneliminar298").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar299").click(function(){
            idbtn=$("#btneliminar299").val()
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar300").click(function(){
            idbtn=$("#btneliminar300").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar301").click(function(){
            idbtn=$("#btneliminar301").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar302").click(function(){
            idbtn=$("#btneliminar302").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar303").click(function(){
            idbtn=$("#btneliminar303").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar304").click(function(){
            idbtn=$("#btneliminar304").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar305").click(function(){
            idbtn=$("#btneliminar305").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar306").click(function(){
            idbtn=$("#btneliminar306").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar307").click(function(){
            idbtn=$("#btneliminar307").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar308").click(function(){
            idbtn=$("#btneliminar308").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar309").click(function(){
            idbtn=$("#btneliminar309").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar310").click(function(){
            idbtn=$("#btneliminar310").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar311").click(function(){
            idbtn=$("#btneliminar311").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar312").click(function(){
            idbtn=$("#btneliminar312").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar313").click(function(){
            idbtn=$("#btneliminar313").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar314").click(function(){
            idbtn=$("#btneliminar314").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar315").click(function(){
            idbtn=$("#btneliminar315").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar316").click(function(){
            idbtn=$("#btneliminar316").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar317").click(function(){
            idbtn=$("#btneliminar317").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar318").click(function(){
            idbtn=$("#btneliminar318").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar319").click(function(){
            idbtn=$("#btneliminar319").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar320").click(function(){
            idbtn=$("#btneliminar320").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar321").click(function(){
            idbtn=$("#btneliminar321").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar322").click(function(){
            idbtn=$("#btneliminar322").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar323").click(function(){
            idbtn=$("#btneliminar323").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar324").click(function(){
            idbtn=$("#btneliminar324").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar325").click(function(){
            idbtn=$("#btneliminar325").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar326").click(function(){
            idbtn=$("#btneliminar326").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar327").click(function(){
            idbtn=$("#btneliminar327").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar328").click(function(){
            idbtn=$("#btneliminar328").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar329").click(function(){
            idbtn=$("#btneliminar329").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar330").click(function(){
            idbtn=$("#btneliminar330").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar331").click(function(){
            idbtn=$("#btneliminar331").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar332").click(function(){
            idbtn=$("#btneliminar332").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar333").click(function(){
            idbtn=$("#btneliminar333").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar334").click(function(){
            idbtn=$("#btneliminar334").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar335").click(function(){
            idbtn=$("#btneliminar335").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar336").click(function(){
            idbtn=$("#btneliminar336").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar337").click(function(){
            idbtn=$("#btneliminar337").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar338").click(function(){
            idbtn=$("#btneliminar338").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar339").click(function(){
            idbtn=$("#btneliminar339").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar340").click(function(){
            idbtn=$("#btneliminar340").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar341").click(function(){
            idbtn=$("#btneliminar341").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar342").click(function(){
            idbtn=$("#btneliminar342").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar343").click(function(){
            idbtn=$("#btneliminar343").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar344").click(function(){
            idbtn=$("#btneliminar344").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar345").click(function(){
            idbtn=$("#btneliminar345").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar346").click(function(){
            idbtn=$("#btneliminar346").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar347").click(function(){
            idbtn=$("#btneliminar347").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar348").click(function(){
            idbtn=$("#btneliminar348").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar349").click(function(){
            idbtn=$("#btneliminar349").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar350").click(function(){
            idbtn=$("#btneliminar350").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar351").click(function(){
            idbtn=$("#btneliminar351").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar352").click(function(){
            idbtn=$("#btneliminar352").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar353").click(function(){
            idbtn=$("#btneliminar353").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar354").click(function(){
            idbtn=$("#btneliminar354").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar355").click(function(){
            idbtn=$("#btneliminar355").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar356").click(function(){
            idbtn=$("#btneliminar356").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar357").click(function(){
            idbtn=$("#btneliminar357").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar358").click(function(){
            idbtn=$("#btneliminar358").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar359").click(function(){
            idbtn=$("#btneliminar359").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar360").click(function(){
            idbtn=$("#btneliminar360").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar361").click(function(){
            idbtn=$("#btneliminar361").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar362").click(function(){
            idbtn=$("#btneliminar362").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar363").click(function(){
            idbtn=$("#btneliminar363").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar364").click(function(){
            idbtn=$("#btneliminar364").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar365").click(function(){
            idbtn=$("#btneliminar365").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar366").click(function(){
            idbtn=$("#btneliminar366").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar367").click(function(){
            idbtn=$("#btneliminar367").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar368").click(function(){
            idbtn=$("#btneliminar368").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar369").click(function(){
            idbtn=$("#btneliminar369").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar370").click(function(){
            idbtn=$("#btneliminar370").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar371").click(function(){
            idbtn=$("#btneliminar371").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar372").click(function(){
            idbtn=$("#btneliminar372").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar373").click(function(){
            idbtn=$("#btneliminar373").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar374").click(function(){
            idbtn=$("#btneliminar374").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar375").click(function(){
            idbtn=$("#btneliminar375").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar376").click(function(){
            idbtn=$("#btneliminar376").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar377").click(function(){
            idbtn=$("#btneliminar377").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar378").click(function(){
            idbtn=$("#btneliminar378").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar379").click(function(){
            idbtn=$("#btneliminar379").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar380").click(function(){
            idbtn=$("#btneliminar380").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar381").click(function(){
            idbtn=$("#btneliminar381").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar382").click(function(){
            idbtn=$("#btneliminar382").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar383").click(function(){
            idbtn=$("#btneliminar383").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar384").click(function(){
            idbtn=$("#btneliminar384").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar385").click(function(){
            idbtn=$("#btneliminar385").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar386").click(function(){
            idbtn=$("#btneliminar386").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar387").click(function(){
            idbtn=$("#btneliminar387").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar388").click(function(){
            idbtn=$("#btneliminar388").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar389").click(function(){
            idbtn=$("#btneliminar389").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar390").click(function(){
            idbtn=$("#btneliminar390").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar391").click(function(){
            idbtn=$("#btneliminar391").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar392").click(function(){
            idbtn=$("#btneliminar392").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar393").click(function(){
            idbtn=$("#btneliminar393").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar394").click(function(){
            idbtn=$("#btneliminar394").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar395").click(function(){
            idbtn=$("#btneliminar395").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar396").click(function(){
            idbtn=$("#btneliminar396").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar397").click(function(){
            idbtn=$("#btneliminar397").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar398").click(function(){
            idbtn=$("#btneliminar398").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar399").click(function(){
            idbtn=$("#btneliminar399").val()
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar400").click(function(){
            idbtn=$("#btneliminar400").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar401").click(function(){
            idbtn=$("#btneliminar401").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar402").click(function(){
            idbtn=$("#btneliminar402").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar403").click(function(){
            idbtn=$("#btneliminar403").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar404").click(function(){
            idbtn=$("#btneliminar404").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar405").click(function(){
            idbtn=$("#btneliminar405").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar406").click(function(){
            idbtn=$("#btneliminar406").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar407").click(function(){
            idbtn=$("#btneliminar407").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar408").click(function(){
            idbtn=$("#btneliminar408").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar409").click(function(){
            idbtn=$("#btneliminar409").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar410").click(function(){
            idbtn=$("#btneliminar410").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar411").click(function(){
            idbtn=$("#btneliminar411").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar412").click(function(){
            idbtn=$("#btneliminar412").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar413").click(function(){
            idbtn=$("#btneliminar413").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar414").click(function(){
            idbtn=$("#btneliminar414").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar415").click(function(){
            idbtn=$("#btneliminar415").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar416").click(function(){
            idbtn=$("#btneliminar416").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar417").click(function(){
            idbtn=$("#btneliminar417").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar418").click(function(){
            idbtn=$("#btneliminar418").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar419").click(function(){
            idbtn=$("#btneliminar419").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar420").click(function(){
            idbtn=$("#btneliminar420").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar421").click(function(){
            idbtn=$("#btneliminar421").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar422").click(function(){
            idbtn=$("#btneliminar422").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar423").click(function(){
            idbtn=$("#btneliminar423").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar424").click(function(){
            idbtn=$("#btneliminar424").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar425").click(function(){
            idbtn=$("#btneliminar425").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar426").click(function(){
            idbtn=$("#btneliminar426").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar427").click(function(){
            idbtn=$("#btneliminar427").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar428").click(function(){
            idbtn=$("#btneliminar428").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar429").click(function(){
            idbtn=$("#btneliminar429").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar430").click(function(){
            idbtn=$("#btneliminar430").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar431").click(function(){
            idbtn=$("#btneliminar431").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar432").click(function(){
            idbtn=$("#btneliminar432").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar433").click(function(){
            idbtn=$("#btneliminar433").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar434").click(function(){
            idbtn=$("#btneliminar434").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar435").click(function(){
            idbtn=$("#btneliminar435").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar436").click(function(){
            idbtn=$("#btneliminar436").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar437").click(function(){
            idbtn=$("#btneliminar437").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar438").click(function(){
            idbtn=$("#btneliminar438").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar439").click(function(){
            idbtn=$("#btneliminar439").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar440").click(function(){
            idbtn=$("#btneliminar440").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar441").click(function(){
            idbtn=$("#btneliminar441").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar442").click(function(){
            idbtn=$("#btneliminar442").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar443").click(function(){
            idbtn=$("#btneliminar443").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar444").click(function(){
            idbtn=$("#btneliminar444").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar445").click(function(){
            idbtn=$("#btneliminar445").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar446").click(function(){
            idbtn=$("#btneliminar446").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar447").click(function(){
            idbtn=$("#btneliminar447").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar448").click(function(){
            idbtn=$("#btneliminar448").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar449").click(function(){
            idbtn=$("#btneliminar449").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar450").click(function(){
            idbtn=$("#btneliminar450").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar451").click(function(){
            idbtn=$("#btneliminar451").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar452").click(function(){
            idbtn=$("#btneliminar452").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar453").click(function(){
            idbtn=$("#btneliminar453").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar454").click(function(){
            idbtn=$("#btneliminar454").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar455").click(function(){
            idbtn=$("#btneliminar455").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar456").click(function(){
            idbtn=$("#btneliminar456").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar457").click(function(){
            idbtn=$("#btneliminar457").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar458").click(function(){
            idbtn=$("#btneliminar458").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar459").click(function(){
            idbtn=$("#btneliminar459").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar460").click(function(){
            idbtn=$("#btneliminar460").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar461").click(function(){
            idbtn=$("#btneliminar461").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar462").click(function(){
            idbtn=$("#btneliminar462").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar463").click(function(){
            idbtn=$("#btneliminar463").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar464").click(function(){
            idbtn=$("#btneliminar464").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar465").click(function(){
            idbtn=$("#btneliminar465").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar466").click(function(){
            idbtn=$("#btneliminar466").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar467").click(function(){
            idbtn=$("#btneliminar467").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar468").click(function(){
            idbtn=$("#btneliminar468").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar469").click(function(){
            idbtn=$("#btneliminar469").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar470").click(function(){
            idbtn=$("#btneliminar470").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar471").click(function(){
            idbtn=$("#btneliminar471").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar472").click(function(){
            idbtn=$("#btneliminar472").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar473").click(function(){
            idbtn=$("#btneliminar473").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar474").click(function(){
            idbtn=$("#btneliminar474").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar475").click(function(){
            idbtn=$("#btneliminar475").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar476").click(function(){
            idbtn=$("#btneliminar476").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar477").click(function(){
            idbtn=$("#btneliminar477").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar478").click(function(){
            idbtn=$("#btneliminar478").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar479").click(function(){
            idbtn=$("#btneliminar479").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar480").click(function(){
            idbtn=$("#btneliminar480").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar481").click(function(){
            idbtn=$("#btneliminar481").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar482").click(function(){
            idbtn=$("#btneliminar482").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar483").click(function(){
            idbtn=$("#btneliminar483").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar484").click(function(){
            idbtn=$("#btneliminar484").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar485").click(function(){
            idbtn=$("#btneliminar485").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar486").click(function(){
            idbtn=$("#btneliminar486").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar487").click(function(){
            idbtn=$("#btneliminar487").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar488").click(function(){
            idbtn=$("#btneliminar488").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar489").click(function(){
            idbtn=$("#btneliminar489").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar490").click(function(){
            idbtn=$("#btneliminar490").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar491").click(function(){
            idbtn=$("#btneliminar491").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar492").click(function(){
            idbtn=$("#btneliminar492").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar493").click(function(){
            idbtn=$("#btneliminar493").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar494").click(function(){
            idbtn=$("#btneliminar494").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar495").click(function(){
            idbtn=$("#btneliminar495").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar496").click(function(){
            idbtn=$("#btneliminar496").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar497").click(function(){
            idbtn=$("#btneliminar497").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar498").click(function(){
            idbtn=$("#btneliminar498").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar499").click(function(){
            idbtn=$("#btneliminar499").val()
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar500").click(function(){
            idbtn=$("#btneliminar500").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar501").click(function(){
            idbtn=$("#btneliminar501").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar502").click(function(){
            idbtn=$("#btneliminar502").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar503").click(function(){
            idbtn=$("#btneliminar503").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar504").click(function(){
            idbtn=$("#btneliminar504").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar505").click(function(){
            idbtn=$("#btneliminar505").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar506").click(function(){
            idbtn=$("#btneliminar506").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar507").click(function(){
            idbtn=$("#btneliminar507").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar508").click(function(){
            idbtn=$("#btneliminar508").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar509").click(function(){
            idbtn=$("#btneliminar509").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar510").click(function(){
            idbtn=$("#btneliminar510").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar511").click(function(){
            idbtn=$("#btneliminar511").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar512").click(function(){
            idbtn=$("#btneliminar512").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar513").click(function(){
            idbtn=$("#btneliminar513").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar514").click(function(){
            idbtn=$("#btneliminar514").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar515").click(function(){
            idbtn=$("#btneliminar515").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar516").click(function(){
            idbtn=$("#btneliminar516").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar517").click(function(){
            idbtn=$("#btneliminar517").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar518").click(function(){
            idbtn=$("#btneliminar518").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar519").click(function(){
            idbtn=$("#btneliminar519").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar520").click(function(){
            idbtn=$("#btneliminar520").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar521").click(function(){
            idbtn=$("#btneliminar521").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar522").click(function(){
            idbtn=$("#btneliminar522").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar523").click(function(){
            idbtn=$("#btneliminar523").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar524").click(function(){
            idbtn=$("#btneliminar524").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar525").click(function(){
            idbtn=$("#btneliminar525").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar526").click(function(){
            idbtn=$("#btneliminar526").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar527").click(function(){
            idbtn=$("#btneliminar527").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar528").click(function(){
            idbtn=$("#btneliminar528").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar529").click(function(){
            idbtn=$("#btneliminar529").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar530").click(function(){
            idbtn=$("#btneliminar530").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar531").click(function(){
            idbtn=$("#btneliminar531").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar532").click(function(){
            idbtn=$("#btneliminar532").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar533").click(function(){
            idbtn=$("#btneliminar533").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar534").click(function(){
            idbtn=$("#btneliminar534").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar535").click(function(){
            idbtn=$("#btneliminar535").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar536").click(function(){
            idbtn=$("#btneliminar536").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar537").click(function(){
            idbtn=$("#btneliminar537").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar538").click(function(){
            idbtn=$("#btneliminar538").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar539").click(function(){
            idbtn=$("#btneliminar539").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar540").click(function(){
            idbtn=$("#btneliminar540").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar541").click(function(){
            idbtn=$("#btneliminar541").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar542").click(function(){
            idbtn=$("#btneliminar542").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar543").click(function(){
            idbtn=$("#btneliminar543").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar544").click(function(){
            idbtn=$("#btneliminar544").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar545").click(function(){
            idbtn=$("#btneliminar545").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar546").click(function(){
            idbtn=$("#btneliminar546").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar547").click(function(){
            idbtn=$("#btneliminar547").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar548").click(function(){
            idbtn=$("#btneliminar548").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar549").click(function(){
            idbtn=$("#btneliminar549").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar550").click(function(){
            idbtn=$("#btneliminar550").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar551").click(function(){
            idbtn=$("#btneliminar551").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar552").click(function(){
            idbtn=$("#btneliminar552").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar553").click(function(){
            idbtn=$("#btneliminar553").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar554").click(function(){
            idbtn=$("#btneliminar554").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar555").click(function(){
            idbtn=$("#btneliminar555").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar556").click(function(){
            idbtn=$("#btneliminar556").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar557").click(function(){
            idbtn=$("#btneliminar557").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar558").click(function(){
            idbtn=$("#btneliminar558").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar559").click(function(){
            idbtn=$("#btneliminar559").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar560").click(function(){
            idbtn=$("#btneliminar560").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar561").click(function(){
            idbtn=$("#btneliminar561").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar562").click(function(){
            idbtn=$("#btneliminar562").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar563").click(function(){
            idbtn=$("#btneliminar563").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar564").click(function(){
            idbtn=$("#btneliminar564").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar565").click(function(){
            idbtn=$("#btneliminar565").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar566").click(function(){
            idbtn=$("#btneliminar566").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar567").click(function(){
            idbtn=$("#btneliminar567").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar568").click(function(){
            idbtn=$("#btneliminar568").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar569").click(function(){
            idbtn=$("#btneliminar569").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar570").click(function(){
            idbtn=$("#btneliminar570").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar571").click(function(){
            idbtn=$("#btneliminar571").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar572").click(function(){
            idbtn=$("#btneliminar572").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar573").click(function(){
            idbtn=$("#btneliminar573").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar574").click(function(){
            idbtn=$("#btneliminar574").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar575").click(function(){
            idbtn=$("#btneliminar575").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar576").click(function(){
            idbtn=$("#btneliminar576").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar577").click(function(){
            idbtn=$("#btneliminar577").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar578").click(function(){
            idbtn=$("#btneliminar578").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar579").click(function(){
            idbtn=$("#btneliminar579").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar580").click(function(){
            idbtn=$("#btneliminar580").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar581").click(function(){
            idbtn=$("#btneliminar581").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar582").click(function(){
            idbtn=$("#btneliminar582").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar583").click(function(){
            idbtn=$("#btneliminar583").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar584").click(function(){
            idbtn=$("#btneliminar584").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar585").click(function(){
            idbtn=$("#btneliminar585").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar586").click(function(){
            idbtn=$("#btneliminar586").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar587").click(function(){
            idbtn=$("#btneliminar587").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar588").click(function(){
            idbtn=$("#btneliminar588").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar589").click(function(){
            idbtn=$("#btneliminar589").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar590").click(function(){
            idbtn=$("#btneliminar590").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar591").click(function(){
            idbtn=$("#btneliminar591").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar592").click(function(){
            idbtn=$("#btneliminar592").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar593").click(function(){
            idbtn=$("#btneliminar593").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar594").click(function(){
            idbtn=$("#btneliminar594").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar595").click(function(){
            idbtn=$("#btneliminar595").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar596").click(function(){
            idbtn=$("#btneliminar596").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar597").click(function(){
            idbtn=$("#btneliminar597").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar598").click(function(){
            idbtn=$("#btneliminar598").val()
            
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })
        $("#btneliminar599").click(function(){
            idbtn=$("#btneliminar599").val()
            $("#tagoculto"+idbtn).val("1");   
            $("#debito"+idbtn).val(0);
            $("#credito"+idbtn).val(0);
            $("#nombre"+idbtn).val("eliminar");
            $("#detalle"+idbtn).val("");
            $("#tercerolista"+idbtn).val("");
            $("#base"+idbtn).val("");
            $(".tag"+idbtn).get(0).type = 'hidden';
            $("#debito"+idbtn).get(0).type = 'hidden';
            $("#credito"+idbtn).get(0).type = 'hidden';
            $("#nombre"+idbtn).get(0).type = 'hidden';
            $("#detalle"+idbtn).get(0).type = 'hidden';
            $("#tercerolista"+idbtn).get(0).type = 'hidden';
            $("#base"+idbtn).get(0).type = 'hidden';
            $("#btneliminar"+idbtn).addClass('hidden');
        })

                
                


      
       

        $(document.body).keyup(function(){

            var items =
            <?= json_encode($array2); ?>
            
            $(".tercero"+numTag).autocomplete({
                source:items,
                select: function(event,item){
                    var params = {
                        codigo:item.item.value
                    };
                    $.get("getPuc2",params, function(response){
                        var json = JSON.parse(response);
                        //console.log(json)
                        if(json.status==200){
                            //console.log(json.nameUser)
                            $(".nombreTercero").val(json.nameUser+" "+json.lastnameUser);
                            $(".idTercero").val(json.users_idusers);
                            $(".documentoTer").val(json.documentUser);
                            $(".documentoTercero").html(json.documentUser);
                            $(".tag1").focus( );
                            //console.log(json)
                        }else{
                            //console.log(0)
                        }
                    });
                }
            });
        });

            
        $(".credito").keypress(function(e){

           
                      
            if (e.which==13) {
                if($("#credito"+numTag).val()==""){
                    $("#credito"+numTag).val(0)
                }else{
                    console.log($("#credito"+numTag).val())
                }
                nuevaFilaEnter()
                
                //console.log("hello friend")
            }
            
        });

        $(document.body).keyup(function(){

            $("#detalle"+numTag).keypress
            (function(e) {
                //console.log(e.which)
                if (e.which == 13) {
                    $("#tercerolista"+numTag).focus()
                }
            })
            $("#tercerolista"+numTag).keyup(function(e) {
                //console.log(e.which)
                if (e.which == 13) {
                    $("#base"+numTag).focus()
                }
            })

            $("#base"+numTag).keypress(function(e) {
            //console.log(e.which)
                if (e.which == 13) {
                    if($("#basepor"+numTag)!=0){
                        numTagMe=numTag-1
                        if($("#credito"+numTagMe).val()==0){
                            retencion=$("#base"+numTag).val()/100
                            retencionF=retencion*$("#basepor"+numTag).val()
                            $("#credito"+numTag).val(retencionF)
                        }if($("#debito"+numTagMe).val()==0){
                            retencion=$("#base"+numTag).val()/100
                            retencionF=retencion*$("#basepor"+numTag).val()
                            $("#debito"+numTag).val(retencionF)
                        }   
                        if($("#debito"+numTag).val()==0){
                            $("#debito"+numTag).val("")
                            $("#debito"+numTag).focus()
                        }if($("#debito"+numTag).val()!=0){
                            $("#debito"+numTag).focus()
                        }

                    }
            }
            })
       

            $("#debito"+numTag).keypress(function(e) {
                if (e.which == 13) {
                    if($("#debito"+numTag).val()==""){
                        $("#debito"+numTag).val("0")
                    }
                    if($("#credito"+numTag).val()==0){
                        $("#credito"+numTag).val("")
                        $("#credito"+numTag).focus()
                    }
                    if($("#credito"+numTag).val()!=0){
                        $("#credito"+numTag).focus()
                    }
            }
        })

       

            
            
        var items =
        <?= json_encode($array); ?>
        
        $(".tag"+numTag).autocomplete({
            source:items,
            select: function(event,item){
                var params = {
                    codigo:item.item.value
                };
                $.get("getPuc",params, function(response){
                    var json = JSON.parse(response);
                    console.log(json)
                    if(json.status==200){
                        var nombre=$("#nombre"+numTag).val(json.nombre);
                        var codigo=json.codigo;
                        var base=json.base;
                        var tercero=json.tercero;
                        $("#codigo"+numTag).removeAttr("autofocus");
                        $("#detalle"+numTag).focus()
                        $("#debito"+numTag).removeAttr("disabled")
                        $("#credito"+numTag).removeAttr("disabled")
                        $("#basepor"+numTag).val(base)
                        $("#terceropuc"+numTag).val(tercero)
                        //console.log(codigo)
                    }
                });
            }
        });

        var items =
        <?= json_encode($array2); ?>
        
        $("#tercerolista"+numTag).autocomplete({
            source:items,
            select: function(event,item){
                var params = {
                    codigo:item.item.value
                };
                $.get("getPuc2",params, function(response){
                    var json = JSON.parse(response);
                    //console.log(json)
                    if(json.status==200){
                        var codigo=json.idusers;
                        var nombre=json.nameUser+" "+json.lastnameUser;
                        var doc=json.documentUser;
                        $("#tercerolistaid"+numTag).val(codigo)
                        $("#tercerolistanombre"+numTag).val(nombre)
                        $("#tercerolistadoc"+numTag).val(doc)
                    }
                });
            }
        });


        

        
    });

        
    


        $("#formulario").keypress(function(e) {
            if (e.which == 13) {
                i=1
                debito=0
                credito=0
                while(i<=201){
                    debito+=parseFloat($("#debito"+i).val())
                    credito+=parseFloat($("#credito"+i).val())
                    i++
                }
                $(".totalcredito").val(credito)
                $(".totaldebito").val(debito)
                $(".diferencia").val(debito-credito)
            }
        });   

        
        $("#procesar").click(function () {
                i=1
                debito=0
                credito=0
                while(i<=201){
                    debito+=parseFloat($("#debito"+i).val())
                    credito+=parseFloat($("#credito"+i).val())
                    i++
                }
                $(".totalcredito").val(credito)
                $(".totaldebito").val(debito)
                $(".diferencia").val(debito-credito)


                

                if($("#terceropuc"+1).val()==1 && $("#tercerolista"+1).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+1).val()+"</b>")
                }
                else if($("#terceropuc"+2).val()==1 && $("#tercerolista"+2).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+2).val()+"</b>")
                }
                else if($("#terceropuc"+3).val()==1 && $("#tercerolista"+3).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+3).val()+"</b>")
                }
                else if($("#terceropuc"+4).val()==1 && $("#tercerolista"+4).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+4).val()+"</b>")
                }
                else if($("#terceropuc"+5).val()==1 && $("#tercerolista"+5).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+5).val()+"</b>")
                }
                else if($("#terceropuc"+6).val()==1 && $("#tercerolista"+6).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+6).val()+"</b>")
                }
                else if($("#terceropuc"+7).val()==1 && $("#tercerolista"+7).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+7).val()+"</b>")
                }
                else if($("#terceropuc"+8).val()==1 && $("#tercerolista"+8).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+8).val()+"</b>")
                }
                else if($("#terceropuc"+9).val()==1 && $("#tercerolista"+9).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+9).val()+"</b>")
                }
                else if($("#terceropuc"+10).val()==1 && $("#tercerolista"+10).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+10).val()+"</b>")
                }
                else if($("#terceropuc"+11).val()==1 && $("#tercerolista"+11).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+11).val()+"</b>")
                }
                else if($("#terceropuc"+12).val()==1 && $("#tercerolista"+12).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+12).val()+"</b>")
                }
                else if($("#terceropuc"+13).val()==1 && $("#tercerolista"+13).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+13).val()+"</b>")
                }
                else if($("#terceropuc"+14).val()==1 && $("#tercerolista"+14).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+14).val()+"</b>")
                }
                else if($("#terceropuc"+15).val()==1 && $("#tercerolista"+15).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+15).val()+"</b>")
                }
                else if($("#terceropuc"+16).val()==1 && $("#tercerolista"+16).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+16).val()+"</b>")
                }
                else if($("#terceropuc"+17).val()==1 && $("#tercerolista"+17).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+17).val()+"</b>")
                }
                else if($("#terceropuc"+18).val()==1 && $("#tercerolista"+18).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+18).val()+"</b>")
                }
                else if($("#terceropuc"+19).val()==1 && $("#tercerolista"+19).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+19).val()+"</b>")
                }
                else if($("#terceropuc"+20).val()==1 && $("#tercerolista"+20).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar el tercero en el codigo correspondiente <b>"+$(".tag"+20).val()+"</b>")
                }
                
                else if($("#basepor"+1).val()!=0 && $("#base"+1).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+1).val()+"</b>")
                }
                else if($("#basepor"+2).val()!=0 && $("#base"+2).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+2).val()+"</b>")
                }
                else if($("#basepor"+3).val()!=0 && $("#base"+3).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+3).val()+"</b>")
                }
                else if($("#basepor"+4).val()!=0 && $("#base"+4).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+4).val()+"</b>")
                }
                else if($("#basepor"+5).val()!=0 && $("#base"+5).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+5).val()+"</b>")
                }
                else if($("#basepor"+6).val()!=0 && $("#base"+6).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+6).val()+"</b>")
                }
                else if($("#basepor"+7).val()!=0 && $("#base"+7).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+7).val()+"</b>")
                }
                else if($("#basepor"+8).val()!=0 && $("#base"+8).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+8).val()+"</b>")
                }
                else if($("#basepor"+9).val()!=0 && $("#base"+9).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+9).val()+"</b>")
                }
                else if($("#basepor"+10).val()!=0 && $("#base"+10).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+10).val()+"</b>")
                }
                else if($("#basepor"+11).val()!=0 && $("#base"+11).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+11).val()+"</b>")
                }
                else if($("#basepor"+12).val()!=0 && $("#base"+12).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+12).val()+"</b>")
                }
                else if($("#basepor"+13).val()!=0 && $("#base"+13).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+13).val()+"</b>")
                }
                else if($("#basepor"+14).val()!=0 && $("#base"+14).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+14).val()+"</b>")
                }
                else if($("#basepor"+15).val()!=0 && $("#base"+15).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+15).val()+"</b>")
                }
                else if($("#basepor"+16).val()!=0 && $("#base"+16).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+16).val()+"</b>")
                }
                else if($("#basepor"+17).val()!=0 && $("#base"+17).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+17).val()+"</b>")
                }
                else if($("#basepor"+18).val()!=0 && $("#base"+18).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+18).val()+"</b>")
                }
                else if($("#basepor"+19).val()!=0 && $("#base"+19).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+19).val()+"</b>")
                }
                else if($("#basepor"+20).val()!=0 && $("#base"+20).val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe ingresar la base en el codigo correspondiente <b>"+$(".tag"+20).val()+"</b>")
                }

               
                
                else if($(".documentoTer").val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Ingrese un tercero")
                }
                else if($(".tag1").val()=="" || $(".tag2").val()==""){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("Debe agregar al menos dos cuentas contables")
                }
                else if($(".totaldebito").val()==0){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("El total de debito es 0")
                }
                else if($(".totalcredito").val()==0){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("El total de credito es 0")
                }
                else if($(".diferencia").val()!=0){
                    $(".erroresNot").removeClass("hidden")
                    $(".errores").html("La diferencia es diferente a 0")
                }                
                else if($(".totalcredito").val()!=0 || $(".totaldebito").val()==0 || $(".tag1").val()=="" || $(".tag2").val()=="" || $(".documentoTer").val()==""){
                    $(".erroresNot").addClass("hidden")
                    $(".errores").html("")
                    $("#formulario").submit()
                }else{
                    alert("algo anda mal")
                }
        })

        
    });
</script>





