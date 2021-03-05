<?php namespace controllers;

/**
* 
*/
use models\Contabilidad as contabilidad;
use models\Conexion as conexion;

class contabilidadController
{
	private $errors;

	public function __construct()
	{
		$this->errors = 'Hi world desde error controller';
	}

	public function crear()
	{
		if (isset($_POST['codigoPuc'])) {
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();
			$this->contabilidad->set("codigoPuc",$_POST['codigoPuc']);
			$this->contabilidad->set("nombrePuc",$_POST['nombrePuc']);
			$this->contabilidad->set("detallePuc",$_POST['detalle']);
			$this->contabilidad->set("base",$_POST['base']);
			$this->contabilidad->set("tercero",$_POST['tercero']);
			$this->contabilidad->set("exogena",$_POST['exogena']);
			
			
			$this->contabilidad->create();
			
		}elseif (isset($_POST['formProcessVenta'])) {
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("nombrePuc",$_POST['formProcessVenta']);
			$this->contabilidad->procesarFacturasVenta();
		}
		elseif (isset($_POST['formProcessCompra'])) {
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("nombrePuc",$_POST['formProcessCompra']);
			$this->contabilidad->procesarFacturasCompra();
		}
		elseif (isset($_POST['formProcessNotasContablesC'])) {
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("nombrePuc",$_POST['formProcessNotasContablesC']);
			$this->contabilidad->procesarNotasContablesC();
		}
		elseif (isset($_POST['formProcessNotasContablesV'])) {
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("nombrePuc",$_POST['formProcessNotasContablesV']);
			$this->contabilidad->procesarNotasContablesV();
		}
		elseif (isset($_POST['formProcessCuentas'])) {
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("nombrePuc",$_POST['formProcessCuentas']);
			$this->contabilidad->procesarCuentas();
		}
		elseif (isset($_POST['formProcessRegConV'])) {
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("nombrePuc",$_POST['formProcessRegConV']);
			$this->contabilidad->procesarRegistrosContablesV();
		}
		elseif (isset($_POST['formProcessRegConC'])) {
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("nombrePuc",$_POST['formProcessRegConC']);
			$this->contabilidad->procesarRegistrosContablesC();
			
		}
		elseif (isset($_POST['procesarPUC'])) {
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->procesarPuc();
			
		}
		elseif (isset($_POST['procesarPUCD'])) {
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->procesarPucDet();
			
		}
		elseif (isset($_POST['procesarUsuarios'])) {
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->procesarUsuarios();
			
		}elseif (isset($_POST['procesarDV'])) {
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->procesarDV();
			
		}
		
		elseif (isset($_POST['tag'])) {
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("codigo", $_POST['tag']);
			$this->contabilidad->set("nombre", $_POST['nombre']);
			$this->contabilidad->set("detalle", $_POST['detalle']);
			$this->contabilidad->set("debito", $_POST['debito']);
			$this->contabilidad->set("credito", $_POST['credito']);
			$this->contabilidad->set("comprobante", $_POST['comprobante']);
			$this->contabilidad->set("nombreTercero", $_POST['nombreTercero']);
			$this->contabilidad->set("idTercero", $_POST['idTercero']);
			$this->contabilidad->set("documentoTer", $_POST['documentoTer']);
			$this->contabilidad->set("tipoC", $_POST['tipoC']);
			$this->contabilidad->set("observaciones", $_POST['observaciones']);
			$this->contabilidad->set("fecha", $_POST['fecha']);
			$this->contabilidad->set("idusuario", $_POST['idusuario']);
			$this->contabilidad->set("totaldebito", $_POST['totaldebito']);
			$this->contabilidad->set("totalcredito", $_POST['totalcredito']);
			$this->contabilidad->set("diferencia", $_POST['diferencia']);
			$this->contabilidad->set("numeracion", $_POST['numeracion']);
			$this->contabilidad->set("base", $_POST['base']);
			$this->contabilidad->set("tercerolista", $_POST['tercerolista']);
			$this->contabilidad->set("tercerolistaid", $_POST['tercerolistaid']);
			$this->contabilidad->set("tercerolistadoc", $_POST['tercerolistadoc']);
			$this->contabilidad->set("tercerolistanombre", $_POST['tercerolistanombre']);

			$this->contabilidad->procesarNotaContable();
			
		}elseif(isset($_POST['prefijoTC'])){
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("prefijoTC", $_POST['prefijoTC']);
			$this->contabilidad->set("numeracionTC", $_POST['numeracionTC']);
			$this->contabilidad->set("nombreTC", $_POST['nombreTC']);
			$this->contabilidad->procesarTipoComprobante();

		}
		
		
		
	}



	public function venta()
	{
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->procesarFacturasVenta();
			$this->contabilidad->procesarFacturasVentaFE();
			//$this->contabilidad->procesarRegistrosContablesV();
	}

	public function venta2()
	{
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			//$this->contabilidad->procesarFacturasVenta();
			$this->contabilidad->procesarRegistrosContablesV();
			$this->contabilidad->procesarRegistrosContablesVFE();
	}

	public function venta3()
	{
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			//$this->contabilidad->procesarFacturasVenta();
			$this->contabilidad->procesarNotasContablesV();
			$this->contabilidad->procesarNotasContablesVFE();
	}

	public function compra()
	{
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->procesarFacturasCompra();
			$this->contabilidad->procesarFacturasCompraFE();
			//$this->contabilidad->procesarRegistrosContablesC();
	}

	public function compra2()
	{
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			//$this->contabilidad->procesarFacturasVenta();
			$this->contabilidad->procesarRegistrosContablesC();
			$this->contabilidad->procesarRegistrosContablesCFE();
	}

	public function compra3()
	{
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			//$this->contabilidad->procesarFacturasVenta();
			$this->contabilidad->procesarNotasContablesC();
			$this->contabilidad->procesarNotasContablesCFE();
	}


	public function index()
	{

	}


	public function table()
	{

	}

	
	public function getpuc()
	{

	}

	public function documentos()
	{

	}

	public function puc()
	{

	}

	public function editar()
	{
		
		if(isset($_POST['idcomprobante'])){
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("idcomprobante", $_POST['idcomprobante']);
			$this->contabilidad->set("nombreTC", $_POST['nombreTC']);
			$this->contabilidad->editarTipoComprobante();
		}

		if(isset($_POST['idPuc'])){
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("idPuc", $_POST['idPuc']);
			$this->contabilidad->set("nombrePuc", $_POST['nombrePuc']);
			$this->contabilidad->set("detalle", $_POST['detalle']);
			$this->contabilidad->set("base", $_POST['base']);
			$this->contabilidad->set("tercero", $_POST['tercero']);
			$this->contabilidad->set("exogena", $_POST['exogena']);
			$this->contabilidad->editarCodigo();
		}
		elseif (isset($_POST['tag'])) {
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("codigo", $_POST['tag']);
			$this->contabilidad->set("nombre", $_POST['nombre']);
			$this->contabilidad->set("detalle", $_POST['detalle']);
			$this->contabilidad->set("debito", $_POST['debito']);
			$this->contabilidad->set("credito", $_POST['credito']);
			$this->contabilidad->set("comprobante", $_POST['comprobante']);
			$this->contabilidad->set("nombreTercero", $_POST['nombreTercero']);
			$this->contabilidad->set("idTercero", $_POST['idTercero']);
			$this->contabilidad->set("documentoTer", $_POST['documentoTer']);
			$this->contabilidad->set("tipoC", $_POST['tipoC']);
			$this->contabilidad->set("observaciones", $_POST['observaciones']);
			$this->contabilidad->set("fecha", $_POST['fecha']);
			$this->contabilidad->set("idusuario", $_POST['idusuario']);
			$this->contabilidad->set("totaldebito", $_POST['totaldebito']);
			$this->contabilidad->set("totalcredito", $_POST['totalcredito']);
			$this->contabilidad->set("diferencia", $_POST['diferencia']);
			$this->contabilidad->set("numeracion", $_POST['numeracion']);
			$this->contabilidad->set("base", $_POST['base']);
			$this->contabilidad->set("tercerolista", $_POST['tercerolista']);
			$this->contabilidad->set("tercerolistaid", $_POST['tercerolistaid']);
			$this->contabilidad->set("tercerolistadoc", $_POST['tercerolistadoc']);
			$this->contabilidad->set("tercerolistanombre", $_POST['tercerolistanombre']);
			$this->contabilidad->set("idRegistroC", $_POST['idRegistroC']);
			$this->contabilidad->set("tagoculto", $_POST['tagoculto']);
			$this->contabilidad->editarNotaContable();	
		}
		
	}

	public function ver()
	{
		
		
	}

	public function getpuc2()
	{

	}

	public function viewcomprobantes()
	{
			
	}
	public function viewdocumentos()
	{
			
	}
	public function viewgrupos()
	{
	}

	public function duplicar()
	{
		if(isset($_POST['numeracion'])){
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("numeracion", $_POST['numeracion']);
			$this->contabilidad->set("tipo", $_POST['tipo']);
			$this->contabilidad->duplicarDocumento();
		}

	}
	public function eliminar()
	{
		if(isset($_POST['idPuc'])){
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("idPuc", $_POST['idPuc']);
			$this->contabilidad->set("codigo", $_POST['codigo']);
			$this->contabilidad->set("nombrePuc", $_POST['nombrePuc']);
			$this->contabilidad->set("detalle", $_POST['detalle']);
			$this->contabilidad->set("base", $_POST['base']);
			$this->contabilidad->set("tercero", $_POST['tercero']);
			$this->contabilidad->set("exogena", $_POST['exogena']);
			$this->contabilidad->eliminarCodigo();
		}

		if(isset($_POST['idcomprobante'])){
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("idcomprobante", $_POST['idcomprobante']);
			$this->contabilidad->set("nombreTC", $_POST['nombreTC']);
			$this->contabilidad->set("tipo", $_POST['tipo']);
			$this->contabilidad->eliminarTipoComprobante();
		}

		if(isset($_POST['numeracion'])){
			$this->Conexion = new Conexion();
			$this->contabilidad = new Contabilidad();			
			$this->contabilidad->set("numeracion", $_POST['numeracion']);
			$this->contabilidad->set("tipo", $_POST['tipo']);
			$this->contabilidad->eliminarDocumento();
		}
	}

}
$error = new errorsController();