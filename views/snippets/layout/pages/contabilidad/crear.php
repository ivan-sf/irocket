
<?php 
session_start();
if (isset($_GET['bienvenido']) && isset($_SESSION['adminUserNew'])){
    header("location:" . URL . "inventarios/crear?bienvenido");
}elseif (isset($_SESSION['adminUser'])) {
    header("location:" . URL . "layouts/");
}else{
   // header("location:" . URL);
}
require "views/snippets/templates/panel/template.php";
?>

<body>
    <?php if($_GET['tipo']=='codigo'){
            include "views/snippets/dependencies/panel/includes/contabilidad/puc/crearCodigo.php";        
    } ?>

    <?php if($_GET['tipo']=='procesos'){
            include "views/snippets/dependencies/panel/includes/contabilidad/puc/crearProcesos.php";        
    } ?>

    <?php if($_GET['tipo']=='documento'){
            include "views/snippets/dependencies/panel/includes/contabilidad/puc/crearDocumento.php";        
    } ?>

<?php if($_GET['tipo']=='comprobante'){
            include "views/snippets/dependencies/panel/includes/contabilidad/puc/crearTipoComprobante.php";        
    } ?>

<?php if($_GET['tipo']=='puc'){
            include "views/snippets/dependencies/panel/includes/contabilidad/puc/crearCodigoPuc.php";        
    } ?>
     
</body>
</html>

