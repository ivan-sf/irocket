<?php namespace models\ajax;


$idInventary = $_POST['idInventary'];
$codeProduct = $_POST['codeProduct'];
$codePromProduct = $_POST['codePromProduct'];
$priceProduct = $_POST['priceProduct'];
$pricePromProduct = $_POST['pricePromProduct'];
$nameProduct = $_POST['nameProduct'];
$limitProduct = $_POST['limitProduct'];

$count = count($codeProduct);
//echo $count;

for ($i=0; $i < $count ; $i++) { 
	$length = strlen($codeProduct[$i]);

	if ($codePromProduct[$i] != '') {
		if ($pricePromProduct[$i] == '' OR $codeProduct[$i] == '' OR $priceProduct[$i] == '' OR $nameProduct[$i] == '' OR $limitProduct[$i] == '') {
			echo "1";
		}else{
			echo "2";
		}
	}else{
		if ($codeProduct[$i] == '' OR $priceProduct[$i] == '' OR $nameProduct[$i] == '' OR $limitProduct[$i] == '') {
		echo "1";
		}else{
			echo "2";
		}
	}

}