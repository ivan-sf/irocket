<?php 
session_start();
if (isset($_SESSION['adminUser'])) {
	header("location:" . URL . "layouts/");
}elseif (isset($_SESSION['administrador'])) {
    //header("location:" . URL . "inventarios?bienvenido");
}else{
	header("location:" . URL);
}
require "views/snippets/templates/panel/template.php";
?>

<body>
	 <?php
        if (isset($_GET['bienvenido'])) {
            include "views/snippets/dependencies/panel/includes/index/index_welcome.php";
        }else{
            include "views/snippets/dependencies/panel/includes/index/index.php";
        }
    ?>
	
</body>
</html>
