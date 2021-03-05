<?php namespace views;
/**
* 
*/
$template = new Template();
class Template{
	
	function __construct()
	{
		include_once ("views/snippets/dependencies/panel/template/head.html");
		include_once ("views/snippets/dependencies/panel/template/navbar.html");
		include_once ("views/snippets/dependencies/panel/template/sidebar_left.html");

	}


	function __destruct()
	{
		include_once ("views/snippets/dependencies/panel/template/footer.html");
		


	}
}
?>