<?php 
if (isset($_GET['ver'])) {
    if ($_GET['ver'] == 'todas') {
        include 'todas.php';
    }elseif ($_GET['ver'] == 'venta') {
        include 'venta.php';
    }elseif ($_GET['ver'] == 'compra') {
        include 'compra.php';
    } else{
        include 'todas.php';
    }
}elseif (isset($_GET['buscar'])) {
    if ($_GET['buscar'] == 'todas') {
        include 'todas.php';
    }elseif ($_GET['buscar'] == 'venta') {
        include 'venta.php';
    }elseif ($_GET['buscar'] == 'compra') {
        include 'compra.php';
    } else{
        include 'buscar.php';
    }
}
 ?>