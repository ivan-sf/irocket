<?php 
session_start();
if (isset($_SESSION['adminUser'])) {
	header("location:" . URL . "layouts/");
}elseif (isset($_SESSION['adminUserNew'])) {
    //header("location:" . URL . "inventarios?bienvenido");
}else{
	header("location:" . URL);
}
require "views/snippets/templates/panel/template.php";
?>

<body>
	<?php
        if(isset($_GET['ver'])){
            if ($_GET['ver'] == 'todas') {
                include "views/snippets/dependencies/panel/includes/facturas/todas.php";
            }
        }elseif(isset($_GET['reportes'])){
            if ($_GET['reportes'] == 'ventas') {
                if ($_GET['tipo'] == 'todo') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/ventas/todo.php";
                }elseif ($_GET['tipo'] == 'diario') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/ventas/diario.php";
                }elseif ($_GET['tipo'] == 'contable') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/ventas/contable.php";
                }elseif ($_GET['tipo'] == 'mensual') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/ventas/mensual.php";
                }elseif ($_GET['tipo'] == 'semestral') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/ventas/semestral.php";
                }elseif ($_GET['tipo'] == 'anual') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/ventas/anual.php";
                }
            }elseif ($_GET['reportes'] == 'compras') {
                if ($_GET['tipo'] == 'todo') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/compras/todo.php";
                }elseif ($_GET['tipo'] == 'diario') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/compras/diario.php";
                }elseif ($_GET['tipo'] == 'semanal') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/compras/semanal.php";
                }elseif ($_GET['tipo'] == 'mensual') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/compras/mensual.php";
                }elseif ($_GET['tipo'] == 'semestral') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/compras/semestral.php";
                }elseif ($_GET['tipo'] == 'anual') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/compras/anual.php";
                }
            }elseif ($_GET['reportes'] == 'depositos') {
                if ($_GET['tipo'] == 'activo') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/depositos/activo.php";
                }elseif ($_GET['tipo'] == 'pasivo') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/depositos/pasivo.php";
                }
            }elseif ($_GET['reportes'] == 'pendientes') {
                if ($_GET['tipo'] == 'cobrar') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/pendientes/cobrar.php";
                }elseif ($_GET['tipo'] == 'pagar') {
                    include "views/snippets/dependencies/panel/includes/facturas/reportes/pendientes/pagar.php";
                }
            }
        }
    ?>
	
</body>
</html>
