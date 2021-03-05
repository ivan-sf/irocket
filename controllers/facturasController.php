<?php namespace controllers;
$metodo = $request->getMetodo();
/**
* 
*/
use models\Company as company;
use models\User as user;
use models\Bills as bills;
use models\Cash as cash;
use models\Conexion as conexion;

class facturasController 
{
	

	public function detalles()
	{
		if (isset($_POST['cambio'])) {
			$this->conexion = new Conexion();
			$this->bills = new Bills();
			$this->bills->set("cNewProd",$_POST['cNewProd']);
			$this->bills->set("qNewProd",$_POST['qNewProd']);
			$this->bills->set("idBillD",$_POST['idBillD']);
			$this->bills->set("idBill",$_POST['idBill']);
			$this->bills->set("idUser",$_POST['idUser']);
			$this->bills->set("tipo",$_POST['cambio']);
			$this->bills->set("estado",$_POST['estado']);
			$this->bills->set("typeBill",$_POST['typeBill']);
			$this->bills->changeBill();
		}elseif (isset($_POST['devolucion'])) {
			$this->conexion = new Conexion();
			$this->bills = new Bills();
			$this->bills->set("cNewProd",$_POST['cNewProd']);
			$this->bills->set("qNewProd",$_POST['qNewProd']);
			$this->bills->set("idBillD",$_POST['idBillD']);
			$this->bills->set("idBill",$_POST['idBill']);
			$this->bills->set("idUser",$_POST['idUser']);
			$this->bills->set("tipo",$_POST['devolucion']);
			$this->bills->set("estado",$_POST['estado']);
			$this->bills->set("typeBill",$_POST['typeBill']);
			$this->bills->returnBill();
		}elseif (isset($_POST['saldo'])) {
			$this->conexion = new Conexion();
			$this->bills = new Bills();
			$this->bills->set("idBill",$_POST['idBill']);
			$this->bills->set("idUser",$_POST['idUser']);
			$this->bills->set("balance",$_POST['balance']);
			$this->bills->set("tipo",$_POST['saldo']);
			$this->bills->balanceBill();
		}elseif (isset($_POST['eliminar'])) {
			$this->conexion = new Conexion();
			$this->bills = new Bills();
			$this->bills->set("idBill",$_POST['idBill']);
			$this->bills->set("idUser",$_POST['idUser']);
			$this->bills->set("tipo",$_POST['eliminar']);
			$this->bills->deleteBill();
		}elseif (isset($_POST['imprimir'])) {
			$this->conexion = new Conexion();
			$this->bills = new Bills();
			$this->bills->printDayV();
		}elseif (isset($_POST['idCliente'])) {
			$this->conexion = new Conexion();
			$this->bills = new Bills();
			$this->bills->set("idCliente",$_POST['idCliente']);
			$this->bills->set("cliente",$_POST['cliente']);
			$this->bills->set("documentUser",$_POST['documentUser']);
			$this->bills->set("idbill",$_GET['id']);
			$this->bills->editarFactura();
		}else{
			
		}
	}

	public function index()
	{

	}

	public function update()
	{
		
	}

	public function imprimir()
	{
		
	}

	public function getpuc2()
	{

	}

	
}