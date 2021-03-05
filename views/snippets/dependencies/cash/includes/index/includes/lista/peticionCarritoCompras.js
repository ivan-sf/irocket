$(obtener_registros3());

function obtener_registros3(alumnos)
{
	$.ajax({
		url : 'cajas/consultaCarritoCompras',
		type : 'POST',
		dataType : 'html',
		data : { alumnos: alumnos },
		})

	.done(function(resultado){
		$("#tabla_carrito").html(resultado);
	})
}

$(document).on('keyup', '#busquedaFactura', function()
{
	var valorBusqueda=$(this).val();
	if (valorBusqueda!="")
	{
		obtener_registros3(valorBusqueda);
	}
	else
		{
			obtener_registros3();
		}
});
