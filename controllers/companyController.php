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

class companyController 
{
	public function index()
	{
		if (isset($_POST['idUpdate'])) {
			$this->conexion = new Conexion();
			$this->company = new Company();
			$this->company->set("idcompany", $_POST['idUpdate']);
			$this->company->set("companyName", $_POST['name']);
			$this->company->set("companyNit",$_POST['nit']);
			$this->company->set("companyDirection",$_POST['direction']);
			$this->company->set("companyCity",$_POST['city']);
			$this->company->set("regimen",$_POST['regimen']);
			$this->company->set("lastnameUser",$_POST['lastnameUser']);
			$this->company->set("nameUser",$_POST['nameUser']);
			
			$this->company->set("resolucion",$_POST['resolucion']);
			$this->company->set("prefijoInicial",$_POST['prefijoInicial']);
			$this->company->set("prefijoFinal",$_POST['nameUser']);
			$this->company->set("pieFactura",$_POST['pieFactura']);

			$this->company->set("companyPhone",$_POST['phone']);
			$this->company->set("companyEmail",$_POST['email']);
			$this->company->set("companyLogoNameTemp",$_FILES['photo']['tmp_name']);
			$this->company->set("companyLogoName",$_FILES['photo']['name']);
			$this->company->set("companyLogoSize",$_FILES['photo']['size']);
			$this->company->set("companyLogoType",$_FILES['photo']['type']);
			$this->company->update();
		}else{
			
		}
	}

	public function newdeposit()
	{
	}

	public function update()
	{
	}

	
}