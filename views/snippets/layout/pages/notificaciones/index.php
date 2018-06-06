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
            if ($_GET['ver'] == 'todo') {
                include "views/snippets/dependencies/panel/includes/notificaciones/todas.php";
            }
        }
    ?>
	
</body>
</html>
