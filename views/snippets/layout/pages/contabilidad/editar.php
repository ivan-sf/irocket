
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

<?php if($_GET['tipo']=='documento'){
            include "views/snippets/dependencies/panel/includes/contabilidad/puc/editarDocumento.php";        
    } ?>
    <?php if($_GET['tipo']=='tipocomprobante'){
            include "views/snippets/dependencies/panel/includes/contabilidad/puc/editarTipoComprobante.php";        
    } ?>
    <?php if($_GET['tipo']=='codigo'){
            include "views/snippets/dependencies/panel/includes/contabilidad/puc/editarCodigo.php";        
    } ?>
     
</body>
</html>

