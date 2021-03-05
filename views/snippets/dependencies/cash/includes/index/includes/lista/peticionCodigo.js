$(obtener_registros2());

function obtener_registros2(alumnos)
{
	$.ajax({
		url : 'cajas/consultaCodigo',
		type : 'POST',
		dataType : 'html',
		data : { alumnos: alumnos },
		})

	.done(function(resultado){
		$("#tabla_resultado").html(resultado);
	})
}

$(document).on('keyup', '#busquedaCodigo', function()
{
	var valorBusqueda=$(this).val();
	if (valorBusqueda!="")
	{
		obtener_registros2(valorBusqueda);
	}
	else
		{
			obtener_registros2();
		}
});
