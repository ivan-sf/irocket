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
            include "views/snippets/dependencies/panel/includes/empleados/crear.php";
    ?>
	
</body>
</html>
