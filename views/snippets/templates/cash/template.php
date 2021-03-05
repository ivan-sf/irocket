<?php namespace views;
/**
* 
*/
$template = new Template();
class Template{
	
	function __construct()
	{
			include_once ("views/snippets/dependencies/cash/template/head.php");

		if (isset($_SESSION['administrador'])) {
			include_once ("views/snippets/dependencies/cash/template/navbar.php");
		}else if (isset($_SESSION['contable'])){
			include_once ("views/snippets/dependencies/cash/template/navbar2.php");
		}else{
			include_once ("views/snippets/dependencies/cash/template/navbar3.php");
		}
	}


	function __destruct()
	{
		include_once ("views/snippets/dependencies/cash/template/footer.php");
	}
}
?>