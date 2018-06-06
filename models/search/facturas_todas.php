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
        WHERE userdetails.range = 3
        AND users.stateBD = 1
        ORDER BY users.idusers desc";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['alumnos']))
{
    $q=$conexion->real_escape_string($_POST['alumnos']);
    $query="SELECT * FROM users 
        INNER JOIN userdetails 
        ON users.idusers=userdetails.users_idusers
        WHERE userdetails.range = 3 AND users.stateBD = 1 AND users.userName  LIKE '%$q%' OR
        userdetails.range = 3 AND users.stateBD = 1 AND userdetails.nameUser  LIKE '%$q%' OR
        userdetails.range = 3 AND users.stateBD = 1 AND userdetails.lastnameUser  LIKE '%$q%' OR
        userdetails.range = 3 AND users.stateBD = 1 AND userdetails.documentUser  LIKE '%$q%' 
        
        ORDER BY users.idusers desc";

  
}

$buscarAlumnos=$conexion->query($query);
if ($buscarAlumnos->num_rows > 0)
{

 while($r=$buscarAlumnos->fetch_object()):

    $tabla?> 

<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="white-box">
        <div class="el-card-item">
            <div class="el-card-avatar el-overlay-1">
                <img src="<?php echo URL; ?>views/plugins/images/invoice.png">
                <div class="el-overlay scrl-up">
                    <ul class="el-info">
                        <li>
                            <a class="btn default btn-outline image-popup-vertical-fit" href="<?php echo URL; ?>facturas/detalles?id=<?php echo $r->idbills; ?>&detalles">
                                <i class="icon-magnifier"></i>
                            </a>
                        </li>
                       
                    </ul>
                </div>
            </div>
            <div class="el-card-content">
                <h4 class="">
                    <b>
                        <?php if($r->typeBill == 1){
                            echo "Factura de venta";
                        }elseif($r->typeBill == 2){
                            echo "Factura de compra";
                        }elseif($r->typeBill == 3){
                            echo "Factura de cambio";
                        }elseif($r->typeBill == 4){
                            echo "Factura de devolucion";
                        } ?>
                    </b>
                 </h4>


                <small><h5>Factura #<?php echo $r->idbills; ?></h5></small>

                <br>
            </div>
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
