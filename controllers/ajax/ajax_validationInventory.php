<?php namespace models\ajax;


$name = $_POST['nameInventary'];
$description = $_POST['descriptionInventary'];
$count = count($name);

for ($i=0; $i < $count ; $i++) { 
	$length = strlen($name[$i]);

	if ($name[$i] == '' OR $description[$i] == '') {
		echo "1";
	}else{
		echo "2";
	}

}