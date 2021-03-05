<?php 
session_start();

if (isset($_SESSION['UserNew'])) {
    header("location:" . URL . "index");
}elseif (isset($_SESSION['adminUserNew'])) {
    header("location:" . URL . "cajas?caja=ventas");
}
$modelCompany = new models\Company();
$modelUser = new models\User();
$modelDepositAccount = new models\DepositAccount();
$modelCash = new models\Cash();

$dataCompany = $modelCompany->list();
$dataUser = $modelUser->list();
$dataAccount = $modelDepositAccount->list();
$dataCash = $modelCash->list();
if ($dataCompany == 0 && $dataUser == 0 && $dataAccount == 0 && $dataCash == 0 && !isset($_GET['new_company'])) {
    header("location:" . URL . "login?new_company");
}elseif ($dataCompany == 1 && $dataUser == 0 && $dataAccount == 0 && $dataCash == 0 && !isset($_GET['new_admin'])) {
    header("location:" . URL . "login?new_admin");
}elseif ($dataCompany == 1 && $dataUser == 1 && $dataAccount == 0 && $dataCash == 0 && !isset($_GET['new_deposit'])) {
    header("location:" . URL . "login?new_deposit");
}elseif ($dataCompany == 1 && $dataUser == 1 && $dataAccount == 1 && $dataCash == 0 && !isset($_GET['new_cash'])) {
    header("location:" . URL . "login?new_cash");
}

require "views/snippets/templates/auth/template.php";
?>

<body>
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>

    <?php
        if (isset($_GET['new_company'])) {
            require "views/snippets/dependencies/auth/includes/new_company1.php";
        }elseif (isset($_GET['new_admin'])) {
            require "views/snippets/dependencies/auth/includes/new_admin.php";
        }elseif (isset($_GET['new_deposit'])) {
            require "views/snippets/dependencies/auth/includes/new_deposit.php";
        }elseif (isset($_GET['new_cash'])) {
            require "views/snippets/dependencies/auth/includes/new_cash.php";
        }elseif (isset($_GET['error'])) {
            if ($_GET['error'] == 'datos') {
                require "views/snippets/dependencies/auth/includes/login_cash.php";
            }else{
                echo "Error";
            }
        }else{
            require "views/snippets/dependencies/auth/includes/login_cash.php";
        } 
    ?>
   

</body>

