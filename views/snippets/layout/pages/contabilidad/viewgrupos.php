<?php
/////// CONEXIÓN A LA BASE DE DATOS /////////
$host = 'localhost';
$basededatos = 'irocket';
$usuario = 'root';
$contraseña = '';
$conexion = new mysqli($host, $usuario,$contraseña, $basededatos);


//////////////// VALORES INICIALES ///////////////////////
$tabla="";
$query="SELECT * FROM puc WHERE codigo!='' AND estado=1 ORDER BY `puc`.`codigo` ASC LIMIT 250";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['alumnos']))
{
    $q=$conexion->real_escape_string($_POST['alumnos']);
    $query="SELECT * FROM puc
            WHERE 
            codigo LIKE '$q%'  AND estado=1
            OR nombre LIKE '%$q%'  AND estado=1
            ORDER BY `puc`.`codigo` ASC
            LIMIT 250
            ";
}

$buscarAlumnos=$conexion->query($query);
if ($buscarAlumnos->num_rows > 0)
{
?>
<thead>
    <tr>
        <th>
        <b>Codigo</b>
        </th>
        <th>
        <b>Nombre</b>
        </th>
        <th>
        <b>Editar</b>
        </th>
        <th>
        <b>Eliminar</b>
        </th>
        
    </tr>
</thead>
<?php
 while($r=$buscarAlumnos->fetch_object()):

    $tabla?> 
    
        <tr>
            <th>
            <?php echo $r->codigo ?>
            </th>
            <th>
            <?php echo $r->nombre; ?>
            </th>
            <th>
                <form action="" id="form">
                <a href="<?php echo URL."contabilidad/editar?tipo=codigo&id=".$r->idpuc;; ?>" class="btn btn-warning">Editar</a>
                </form>
                
            </th>
            <th>
                <form action="" id="form">
                <a href="<?php echo URL."contabilidad/eliminar?tipo=codigo&id=".$r->idpuc;; ?>" class="btn btn-danger">Eliminar</a>
                </form>
                
            </th>
            <th>
            
            </th>
        </tr>
 <br>

<?php endwhile;
?>

<?php

} else
    {
        $tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
    }


echo $tabla;
?>



<script>
$(".btnEditar").click(function(){
    alert($(".btnEditarPlus").val())
})

$("#form").keypress(function(e){
    if(e.which==13){
        return false
    }
})
</script>
