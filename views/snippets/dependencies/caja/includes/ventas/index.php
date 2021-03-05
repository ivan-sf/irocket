

    <div class="container-fluid">
    <div id="respuesta" class="hidden">

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
        <div class="row mt-3">

        
            <div class="col-md-7">
                <form action="" class="form" id="formularioBusqueda">
                    <input type="text" id="inpBusq" name="inpBusq" class="form-control" autofocus>
                </form>    
                <div class="prueba">
                    <ul id="container"></ul>
                </div>
                <table class="table table-responsive table-sm">
                    <thead>
                        <tr>
                            <td>NOMBRE</td>
                            <td>CODIGO</td>
                            <td>CANTIDAD</td>
                            <td>EXISTENCIAS</td>
                            <td>VENTA</td>
                            <td>IVA</td>
                            <td>AGREGAR</td>
                            <td>EDITAR</td>
                        </tr>
                    </thead>
                    <tbody id="listaBusqueda">

                    </tbody>
                </table>
            </div>
            <div class="col-md-5">
                <table class="table table-responsive table-sm">
                    <thead>
                        <tr>
                            <td>NOMBRE</td>
                            <td>VENTA</td>
                            <td>IVA</td>
                            <td>CANTIDAD</td>
                            <td>TOTAL</td>
                            <td>ELIMINAR</td>
                        </tr>
                    </thead>
                    <tbody id="listaFactura">

                    </tbody>
                </table>
            </div>
        </div>
    </div>


   <script src="<?php echo URL; ?>views/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script>
        $(document).on('click','.btnAgregar',function(){
            let elemento = $(this)[0].parentElement.parentElement
            let codigo = $(elemento).attr('codigoAgregar')
            let nombre = $(elemento).attr('nombreAgregar')
            let existencias = $(elemento).attr('existenciasAgregar')
            let idproducto = $(elemento).attr('idproductoAgregar')
            let cantidadTD = $(elemento).children(".cantidadAgTD")
            let cantidadIN = $(cantidadTD).children(".cantidadAgregar")
            let cantidadINV = $(cantidadIN).val()
            
            console.log(cantidadINV)
            var answer = $('#answerJS');
            var respuesta = $('#respuesta');
            var alertJS = $('#alertJS');
            var datos = 10;
            $.ajax({
                url: "../../irocket/controllers/ajax/ajaxGuardar.php",
                type: "POST",
                data: {nombre,codigo,idproducto,cantidadINV,existencias},
                success: function(data){
                    if(data==1){
                        listaFactura()
                        $("#inpBusq").val("")
                        $("#inpBusq").focus()

                    }else{
                        respuesta.removeClass('hidden');
                        answer.html(data);  
                    }
                    
                }
            }) 

        })
        function listaFactura(){  
                var datos = 10;
                $.ajax({
                    url: "../../irocket/controllers/ajax/ajaxListaFactura.php",
                    type: "POST",
                    data: datos,
                    success: function(data){
                        let datos=JSON.parse(data)
                        template=''
                        datos.forEach(dato=>{
                            template+=`
                            <form>
                                <tr>
                                <td>${dato.nombre}
                                <input type="hidden" value="${dato.nombre}">
                                </td>
                                <td>${dato.precioU}
                                <input type="hidden" value="${dato.precioU}">
                                </td> 
                                <td>${dato.iva}%
                                <input type="hidden" value="${dato.iva}">
                                </td> 
                                <td>
                                <input class="form-control" type="text" value="${dato.cantidad}">
                                </td>
                                <td>${dato.precioT}
                                <input type="hidden" value="${dato.precioT}">
                                </td>
                                <td>
                                <input type="button" value="X" class="btn btn-danger">
                                </td>
                                </tr>
                            </form>
                            `
                        })
                        $("#listaFactura").html(template)
                    }
                })           
            }
        $(document).ready(function(){           
            listaFactura()
            $("#inpBusq").keyup(function(e){
                busqueda=$("#inpBusq").val()
                var datos = $("#formularioBusqueda").serialize();
                $.ajax({
                    url: "../../irocket/controllers/ajax/ajaxBuscador.php",
                    type: "POST",
                    data: datos,
                    success: function(data){
                        let datos=JSON.parse(data)
                        template=''
                        datos.forEach(dato=>{
                            template+=`
                            <div id="formularioAgregar ">
                                <tr existenciasAgregar="${dato.totalEx}" codigoAgregar="${dato.codigo}" nombreAgregar="${dato.nombre}" idproductoAgregar="${dato.idproducts}">
                                <td>${dato.nombre}
                                <input type="hidden" value="${dato.nombre}">
                                </td>
                                <td>${dato.codigo}
                                <input type="hidden" value="${dato.codigo}" name="codigo">
                                </td> 
                                <td class="cantidadAgTD">
                                <input type="text" name="cantidad" value="1" class="form form-control cantidadAgregar">
                                </td>
                                <td>${dato.totalEx}
                                <input type="hidden" value="${dato.totalEx}">
                                </td>
                                <td>
                                <select>
                                    <option>${dato.precio1}</option>
                                    <option>${dato.precio2}</option>
                                    <option>${dato.precio3}</option>
                                </select>
                                <input type="hidden" value="${dato.precio1}">
                                </td>
                                <td>${dato.iva}
                                <input type="hidden" value="${dato.iva}">
                                </td>
                                <td>
                                <button value="${dato.idproducts}" id="btnAgregar" class="btn btn-success btnAgregar">AGREGAR</button>
                                </td>
                                <td>
                                <input type="button" value="EDITAR" class="btn btn-warning">
                                </td>
                                </tr>
                            </div>
                            `
                        })
                        $("#listaBusqueda").html(template)
                    }
                })

                console.log(busqueda)
            })
        })

        
    </script>