
	<?php namespace models\ajax;


	$documentUser = $_POST['documentUser'];
	$count = count($name);
	
	for ($i=0; $i < $count ; $i++) { 
		$length = strlen($name[$i]);
	
		if ($name[$i] == '' OR $description[$i] == '' OR $documentUser[$i] == '') {
			echo "1";
		}else{
			echo "2";
		}
	
	}