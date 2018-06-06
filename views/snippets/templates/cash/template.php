<?php namespace views;
/**
* 
*/
$template = new Template();
class Template{
	
	function __construct()
	{

		include_once ("views/snippets/dependencies/cash/template/head.php");
		include_once ("views/snippets/dependencies/cash/template/navbar.php");
		include_once ("views/snippets/dependencies/cash/template/slide_right.php");
		//include_once ("snippets/dependencies/header.html");

	}


	function __destruct()
	{
		
		include_once ("views/snippets/dependencies/cash/template/footer.php");
		//include_once ("snippets/dependencies/templates/panel/footer.html");


	}
}
?>