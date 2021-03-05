<?php
date_default_timezone_set('America/Bogota');
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php 

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", realpath(dirname(__FILE__)) . DS);
define('DIRAPP', 'irocket');
define("URL", 'http://192.168.100.4/' . DIRAPP . "/");
define("INIT_CONTROLLER", "login");
define("INIT_METODO", "index");
define("TITLE_APP", "COMERCIAL PERALTA");
define("URL_SITIO", "#");
require_once("config/autoload.php");
config\autoload::Run();
config\routes::run(new config\request());
//echo "Hola mundo desde index.php";
?>
