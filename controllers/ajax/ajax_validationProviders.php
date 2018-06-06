<?php namespace models\ajax;


$lastnameUser = $_POST['lastnameUser'];
$documentUser = $_POST['documentUser'];
$nameUser = $_POST['nameUser'];

$count = count($lastnameUser);
//echo $count;

for ($i=0; $i < $count ; $i++) { 
	$length = strlen($lastnameUser[$i]);
	if ($documentUser[$i] == '' OR $lastnameUser[$i] == 'lastnameUser' OR $nameUser[$i] == 'nameUser') {
		echo "1";
	}else{
		echo "2";
	}
}

