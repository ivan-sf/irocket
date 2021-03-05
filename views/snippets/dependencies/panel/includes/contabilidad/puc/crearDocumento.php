<?php
if(isset($_SESSION['adminUser']) OR isset($_SESSION['adminUserNew'])){
//echo $_SESSION['adminUser'];
    $modelContabilidad = new models\Contabilidad();
    $con = new models\Conexion();
    $arrayPuc = $modelContabilidad->arrayPuc();
    $arrayUsers = $modelContabilidad->arrayUsers();
    $arrayComprobantes = $modelContabilidad->arrayComprobantes();
    
											
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
    
    <button class="btn m-btn--pill btn-badge" type="submit"><a href="<?php echo URL; ?>contabilidad/crear?tipo=comprobante" class="">Ver documentos</a></button>
    
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
                            <h2>Nuevo comprobante contable</h2>
                            <div class="alert alert-primary erroresNot hidden" role="alert">
                                <strong>Error - </strong> <b class="errores"> </b>
                            </div>
							<div id="slimtest1">

								<div class="m-grid__item m-grid__item--fluid m-wrapper">
                                <form id="formulario" action="" method="POST">
                                <input type="hidden" autocomplete="off" name="idusuario" value="<?php echo $_SESSION['adminUserNew']; ?>">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        Tipo de comprobante
                                        
                                        <select name="comprobante" id="comprobante" class="form-control m-input m-input--air m-input--pill">
                                            <?php while ($datos1 = mysqli_fetch_array($arrayComprobantes)) { ?>
                                            <option value="<?php echo $datos1['tipo']; ?>">
                                                <?php echo strtoupper($datos1['nombre']); ?>    
                                            </option>
                                            <?php } ?>
                                        </select>

                                    
                                    </div>
                                    <div class="col-md-6">

                                    </div>


                                    <div class="col-md-2">
                                            Numero comprobante automatico <br>
                                            <h3 class="numeracion"></h3>
                                            <input class="form-control" name="numeracion" id="numeracion" type="hidden" autocomplete="off" autofocus>
                                    </div>
                                </div>
                                <br>
                                

                               <div class="row">
                               <div class="col-md-4">
                                    Tercero 
                                        <input class="form-control col-md-3 tercero1" autofocus name="tercero" id="tag" type="text" autocomplete="off">
                                </div>
                                <div class="col md-6">
                                    <br> <b>Documento</b>: <p class="documentoTercero"></p>
                                    <input type="hidden" autocomplete="off" name="nombreTercero" class="nombreTercero">
                                    <input type="hidden" autocomplete="off" name="idTercero" class="idTercero">
                                    <input type="hidden" autocomplete="off" name="documentoTer" class="documentoTer">
                                </div>
                                <div class="col-md-2">
                                    Fecha
                                    <input class="form-control" name="fecha" type="date" value="<?php echo date("Y-m-d");?>">
                                </div>
                               </div>
                               <br>


                                          
                            <table>
                                        <th>
                                            <div class="col-md-12 codigo">
                                                <label for="tag">Codigo</label>
                                                <input class="form-control tag1" name="tag[]" id="tag" type="text" autocomplete="off">
                                                <?php $i=1; while($i<=52){ $i++ ?>
                                                    <input class="form-control tag<?php echo $i; ?>" name="tag[]" id="tag" type="hidden" autocomplete="off">
                                                <?php } ?>
                                                
                                            </div>
                                        </th>
                                        <th>
                                            <div class="col-md-12">
                                                <label for="nombre">Nombre</label>
                                                <input class="form-control" name="nombre[]" id="nombre1" type="text" autocomplete="off">
                                                <?php $i=1; while($i<=52){ $i++ ?>
                                                    <input class="form-control" name="nombre[]" id="nombre<?php echo $i; ?>" type="hidden" autocomplete="off">
                                                <?php } ?>
                                            </div>
                                        </th>
                                        <th>
                                        <div class="col-md-12">
                                            <label for="detalle">Detalle</label>
                                            <input class="form-control" name="detalle[]" id="detalle1" type="text" autocomplete="off">
                                                <?php $i=1; while($i<=52){ $i++ ?>
                                                    <input class="form-control" name="detalle[]" id="detalle<?php echo $i; ?>" type="hidden" autocomplete="off">
                                                <?php } ?>
                                        </div>
                                        </th>
                                            <div class="col-md-12">
                                                <input class="form-control" name="tercerolistaid[]" id="tercerolistaid1" type="hidden" autocomplete="off">
                                                <?php $i=1; while($i<=52){ $i++ ?>
                                                    <input class="form-control" name="tercerolistaid[]" id="tercerolistaid<?php echo $i; ?>" type="hidden" autocomplete="off">
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-12">
                                                <input class="form-control" name="tercerolistanombre[]" id="tercerolistanombre1" type="hidden" autocomplete="off">
                                                <?php $i=1; while($i<=52){ $i++ ?>
                                                    <input class="form-control" name="tercerolistanombre[]" id="tercerolistanombre<?php echo $i; ?>" type="hidden" autocomplete="off">
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-12">
                                                <input class="form-control" name="tercerolistadoc[]" id="tercerolistadoc1" type="hidden" autocomplete="off">
                                                <?php $i=1; while($i<=52){ $i++ ?>
                                                    <input class="form-control" name="tercerolistadoc[]" id="tercerolistadoc<?php echo $i; ?>" type="hidden" autocomplete="off">
                                                <?php } ?>
                                            </div>
                                        <th>

                                                <input class="form-control terceropuc" name="terceropuc[]" id="terceropuc1" type="hidden" autocomplete="off">
                                                <input class="form-control basepor" name="basepor[]" id="basepor1" type="hidden" autocomplete="off">
                                                <?php $i=1; while($i<=52){ $i++ ?>
                                                    <input class="form-control" name="terceropuc[]" id="terceropuc<?php echo $i; ?>" type="hidden" autocomplete="off">
                                                    <input class="form-control" name="basepor[]" id="basepor<?php echo $i; ?>" type="hidden" autocomplete="off">
                                                <?php } ?>
                                                



                                            <div class="col-md-12">
                                                <label for="#tercerolista">Tercero</label>
                                                <input class="form-control" name="tercerolista[]" id="tercerolista1" type="text" autocomplete="off">
                                                <?php $i=1; while($i<=52){ $i++ ?>
                                                    <input class="form-control" name="tercerolista[]" id="tercerolista<?php echo $i; ?>" type="hidden" autocomplete="off">
                                                <?php } ?>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="col-md-12">
                                                <label for="base">Base </label>
                                                <input class="form-control" name="base[]" id="base1" type="text" autocomplete="off">
                                                <?php $i=1; while($i<=52){ $i++ ?>
                                                    <input class="form-control" name="base[]" id="base<?php echo $i; ?>" type="hidden" autocomplete="off">
                                                <?php } ?>
                                                
                                            </div>
                                        </th>
                                        <th>
                                            <div class="col-md-12">
                                                <label for="debito">Debito</label>
                                                <input disabled class="form-control" name="debito[]" disabled  value="0" id="debito1" type="text" autocomplete="off">
                                                <?php $i=1; while($i<=52){ $i++ ?>
                                                    <input disabled class="form-control" name="debito[]" disabled  value="0" id="debito<?php echo $i; ?>" type="hidden" autocomplete="off">
                                                <?php } ?>
                                                
                                            </div>
                                        </th>
                                        <th>
                                            <div class="col-md-12">
                                                <label for="credito">Credito</label>
                                                <input class="form-control credito" name="credito[]" disabled  value="0" id="credito1" type="text" autocomplete="off">
                                                <?php $i=1; while($i<=52){ $i++ ?>
                                                    <input disabled class="form-control credito" name="credito[]" disabled  value="0" id="credito<?php echo $i; ?>" type="hidden" autocomplete="off">
                                                <?php } ?>            
                                            </div>
                                        </th>

                                        <div class="col-md-12">
                                                <input class="form-control" name="tagoculto[]"   value="0" id="tagoculto1" type="hidden" autocomplete="off">
                                                <?php $i=1; while($i<=52){ $i++ ?>
                                                    <input class="form-control" name="tagoculto[]"   value="0" id="tagoculto<?php echo $i; ?>" type="hidden" autocomplete="off">
                                                <?php } ?> 
                                                           
                                            </div>
                                        

                                        <th>
                                            <div class="col-md-12">
                                                <label for="btneliminar">Eliminar</label>
                                                <button style="margin-top:5%" class="btn btn-danger"  type="button" disabled  value="1" id="btneliminar1" type="button" autocomplete="off">x</button> <div class="br"></div> 
                                                <button style="margin-top:5%" class="btn btn-danger hidden"  type="button" disabled  value="2" id="btneliminar2" autocomplete="off">x</button> <div class="b2r"></div>

                                                <?php $i=2; while($i<=52){ $i++ ?>
                                                    <button style="margin-top:5%" class="btn btn-danger hidden"  type="button"  value="<?php echo $i ?>" id="btneliminar<?php echo $i ?>" autocomplete="off">x</button> <div class="b<?php echo $i ?>r"></div>
                                                <?php } ?> 
                
                                            </div>
                                        </th>
                                        
                            </table>       
                               

                               
                                

                                  
                                       
                                            
                                                        
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
                                                <textarea class="form-control" rows="6" placeholder="Observaciones" name="observaciones"></textarea>
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
                        $("#numeracion").val(numeracion)
                        $(".numeracion").html(numeracion)
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
                        $("#numeracion").val(numeracion)
                        $(".numeracion").html(numeracion)
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

        
                


      
        function nuevaFilaEnter() {

            
            

            
        var lengthInputs = $(".codigo input").length;
        if($(".tag1").val()!="" && $("#tagoculto2").val()==0){
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
        i=1;
        contenidodetalle=$("#detalle1").val()
        
        while(i<=50){   
            i++
            i2=i+1
            if($("#detalle"+i).val()==""){
                $("#detalle"+i).val(contenidodetalle)
            }
            if($(".tag"+i).val()!="" && $("#tagoculto"+i2).val()==0){
            $(".tag"+i2).get(0).type = 'text';
            $("#nombre"+i2).get(0).type = 'text';
            $("#detalle"+i2).get(0).type = 'text';
            $("#base"+i2).get(0).type = 'text';
            $("#debito"+i2).get(0).type = 'text';
            $("#credito"+i2).get(0).type = 'text';
            $("#tercerolista"+i2).get(0).type = 'text';
            $(".br"+i).html("<br>")
            $("#btneliminar"+i2).removeClass("hidden");
            $(".tag"+i2).focus();
            }
        }
       
        }


        


           

        


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

        $(".credito").keyup(function(){
            $("#credito"+numTag).keyup(function(e) {
                //console.log(e.which)
                if (e.which==13) {
                    if($("#credito"+numTag).val()==""){
                        $("#credito"+numTag).val("0")
                    }
                    nuevaFilaEnter()
                }
            })
        });

        $(document.body).keyup(function(){

            $("#detalle"+numTag).keypress(function(e) {
                //console.log(e.which)
                if (e.which == 13) {
                    $("#tercerolista"+numTag).focus()
                }
            })

            $("#tercerolista"+numTag).keypress(function(e) {
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
            //console.log(e.which)
            
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
                while(i<=52){
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

            
            var lengthInputs = $(".codigo input").length;
                i=1
                debito=0
                credito=0
                while(i<=52){
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





