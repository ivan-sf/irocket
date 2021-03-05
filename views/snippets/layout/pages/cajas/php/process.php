<?php 
include '../../../../../../config.php';

if (isset($_POST['typeBill'])) {
	if ($_POST['typeBill'] == '1') {
		if ($_POST['imprimir'] == 'si') {
			include 'sale.php';
		}else{
			include 'sale.php';
		}
	}elseif ($_POST['typeBill'] == '2') {
		if ($_POST['imprimir'] == 'si') {
			include 'buy.php';
		}else{
			include 'buy_1.php';
		}
	}elseif ($_POST['typeBill'] == '3') {
		include 'change.php';
	}elseif ($_POST['typeBill'] == '4') {
		include 'return.php';
	}else{
		include 'default.php';
	}
}
