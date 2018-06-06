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

     <?php
            include "views/snippets/dependencies/panel/includes/inventarios/detalles.php";
    ?>

</body>
</html>
