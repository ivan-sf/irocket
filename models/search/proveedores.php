<?php
/////// CONEXIÓN A LA BASE DE DATOS /////////
$host = 'localhost';
$basededatos = 'irocket';
$usuario = 'root';
$contraseña = '';
include"../../config.php";
$conexion = new mysqli($host, $usuario,$contraseña, $basededatos);


//////////////// VALORES INICIALES ///////////////////////
$tabla="";
$query="SELECT * FROM users 
        INNER JOIN userdetails 
        ON users.idusers=userdetails.users_idusers
        WHERE userdetails.tipoProveedor = 1
        AND users.stateBD = 1
        ORDER BY users.idusers desc";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['alumnos']))
{
    $q=$conexion->real_escape_string($_POST['alumnos']);
    $query="SELECT * FROM users 
        INNER JOIN userdetails 
        ON users.idusers=userdetails.users_idusers
        WHERE userdetails.tipoProveedor = 1 AND users.stateBD = 1 AND users.userName  LIKE '%$q%' OR
        userdetails.tipoProveedor = 1 AND users.stateBD = 1 AND userdetails.nameUser  LIKE '%$q%' OR
        userdetails.tipoProveedor = 1 AND users.stateBD = 1 AND userdetails.lastnameUser  LIKE '%$q%' OR
        userdetails.tipoProveedor = 1 AND users.stateBD = 1 AND userdetails.documentUser  LIKE '%$q%' 
        
        ORDER BY users.idusers desc";

  
}

$buscarAlumnos=$conexion->query($query);
if ($buscarAlumnos->num_rows > 0)
{

 while($r=$buscarAlumnos->fetch_object()):

    $tabla?> 

 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="white-box">
            <div class="product-img">
                <img  height="150" width="180" src="<?php echo $r->ruta; ?>">
                <div class="pro-img-overlay">
                    <a href="<?php echo URL; ?>tercero/editar?id=<?php echo $r->idusers; ?>&configurar" class="bg-warning"><i class="ti-marker-alt"></i></a> 
                    <a href="<?php echo URL; ?>tercero/editar?id=<?php echo $r->idusers; ?>&eliminar" class="bg-danger"><i class="ti-trash"></i></a>
                </div>
            </div>
            <div class="product-text">
                <span class="pro-price bg-danger"><?php echo $r->documentUser; ?></span>
                <h3 class="box-title m-b-0"><?php echo $r->nameUser . " " . $r->lastnameUser; ?></h3>
                <small class="text-muted db">

                <label for="exampleInputEmail1">
                    <b><?php echo $r->company;
                    ?></b>
                </label>
                </small>
                    
                 
                    <br>
            </div>
        </div>
    </div>             
<?php endwhile;


} else
    {
        $tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
    }


echo $tabla;
?>
