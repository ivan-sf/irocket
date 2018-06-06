<?php
	
if (isset($_SESSION['administrador'])) {
    header("location:" . URL . "index");
}elseif (isset($_SESSION['adminUserNew'])) {
    header("location:" . URL . "index");
}
require "views/snippets/templates/auth/template.php";
if(isset($_SESSION['UserNew']) OR isset($_SESSION['adminUserNew']) AND isset($_SESSION['cash'])){
    header("location:" . URL . "cajas?caja=ventas");
}elseif(isset($_SESSION['UserNew']) OR isset($_SESSION['adminUserNew']) AND !isset($_SESSION['cash'])){
    
}
?>

<body>
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>

    <?php
     
            require "views/snippets/dependencies/auth/includes/login_cash.php";
            
    ?>
   

</body>

