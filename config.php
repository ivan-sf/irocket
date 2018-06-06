<?php 


define("DS", DIRECTORY_SEPARATOR);
define("ROOT", realpath(dirname(__FILE__)) . DS);
define('DIRAPP', 'irocket');
define('DB', 'irocket');
define('HOSTDB', 'localhost');
define('USERDB', 'root');
define('PASSDB', '');
define("URL", 'http://192.168.0.20/' . DIRAPP . "/");
define("URL_SITIO", "https://irocketapi.wordpress.com/");


$con  = new mysqli(HOSTDB,USERDB,PASSDB,DB);

?>

<script>
	const URL_APP = "http://192.168.0.20/";
</script>