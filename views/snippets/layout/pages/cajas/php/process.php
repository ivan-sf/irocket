<?php 
include '../../../../../../config.php';

if (isset($_POST['typeBill'])) {
	if ($_POST['typeBill'] == '1') {
		include 'sale.php';
	}elseif ($_POST['typeBill'] == '2') {
		include 'buy.php';
	}elseif ($_POST['typeBill'] == '3') {
		include 'change.php';
	}elseif ($_POST['typeBill'] == '4') {
		include 'return.php';
	}else{
		include 'default.php';
	}
}
