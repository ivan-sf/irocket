<?php namespace models\ajax;


$nameInput = $_POST['nameInput'];
$numberInput = $_POST['numberInput'];
$currentInput = $_POST['currentInput'];
$bankInput = $_POST['bankInput'];
$count = count($nameInput);

for ($i=0; $i < $count ; $i++) { 
	$length = strlen($nameInput[$i]);

	if ($currentInput[$i] == '') {
		echo "1";
	}elseif ($numberInput[$i] == '') {
		echo "1";
	}else{
		echo "2";
	}

}