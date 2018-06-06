<?php namespace controllers;
$metodo = $request->getMetodo();
/**
* 
*/
use models\Company as company;
use models\User as user;
use models\DepositAccount as depositaccount;
use models\Cash as cash;
use models\Conexion as conexion;

class depositosController 
{
	public function detalles()
	{
		if (isset($_POST['idUpdate'])) {
			$this->conexion = new Conexion();
			$this->depositaccount = new DepositAccount();
			$this->depositaccount->set("idupdate", $_POST['idUpdate']);
			$this->depositaccount->set("bankInput", $_POST['bank']);
			$this->depositaccount->set("numberInput", $_POST['number']);
			$this->depositaccount->update();
		}elseif (isset($_POST['idFondos'])) {
			$this->conexion = new Conexion();
			$this->depositaccount = new DepositAccount();
			$this->depositaccount->set("idupdate", $_POST['idFondos']);
			$this->depositaccount->set("currentInput", $_POST['fondos']);
			$this->depositaccount->set("newcurrentInput", $_POST['newfondos']);
			$this->depositaccount->set("typeDeposit", $_POST['typeDeposit']);
			$this->depositaccount->set("tipoDeposito", $_POST['tipoDeposito']);
			$this->depositaccount->newMoney();
		}elseif (isset($_POST['idDeposit'])) {
			$this->conexion = new Conexion();
			$this->depositaccount = new DepositAccount();
			$this->depositaccount->set("idupdate", $_POST['idDeposit']);
			$this->depositaccount->deleteDeposit();
		}else{
			
		}
	}

	public function reportes()
	{
	}

	public function update()
	{
	}

	
}