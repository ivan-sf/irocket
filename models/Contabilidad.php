<?php namespace models;

class Contabilidad
{
	private $codigoPuc;
	private $nombrePuc;

	function __construct(){
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
	}
/*
while ($dataA2= mysqli_fetch_array($query2)) {
		$total+=$dataA['precio_total'];
	}
*/



public function arrayPuc(){
	$sql = "SELECT * FROM puc WHERE auxiliar=1 AND estado=1";
	$datos = $this->con->returnConsulta($sql);
	return $datos;
}

public function arrayPuc1(){
	$sql = "SELECT * FROM `puc` INNER JOIN puc_detalles ON idpuc=idpucdetalles
	ORDER BY `puc`.`codigo` ASC";
	$datos = $this->con->returnConsulta($sql);
	return $datos;
}

public function arrayUsers(){
	$sql = "SELECT * FROM `users` INNER JOIN userdetails ON idusers=users_idusers";
	$datos = $this->con->returnConsulta($sql);
	return $datos;
}


public function arrayDocumento(){
	$numero = $this->numero;
	$comprobante = $this->comprobante;
	$sql = "SELECT * FROM notacontable WHERE tipoNotaContable=$comprobante AND comprobante=$numero";
	$datos = $this->con->returnConsulta($sql);
	return $datos;
}

public function arrayRegistros(){
	$numero = $this->numero;
	$comprobante = $this->comprobante;
	$sql = "SELECT * FROM registroscontables WHERE notaContable=$numero AND tipoRegistro=$comprobante AND estado=1";
	$datos = $this->con->returnConsulta($sql);
	return $datos;
}

public function arrayTipoC(){
	$comprobante = $this->comprobante;
	$sql = "SELECT * FROM comprobantes WHERE idcomprobante=$comprobante";
	$datos = $this->con->returnConsulta($sql);
	return $datos;
}


public function arrayVCod(){
	$idcodigo = $this->idcodigo;
	$sql = "SELECT * FROM puc WHERE idpuc=$idcodigo";
	$datos = $this->con->returnConsulta($sql);
	return $datos;
}





public function arrayComprobantes(){
	$sql = "SELECT * FROM comprobantes WHERE estado=1";
	$datos = $this->con->returnConsulta($sql);
	return $datos;
}

public function arrayVentas(){
	$sql = "SELECT * FROM bills WHERE stateBill=1 AND typeBill=1";
	$datos = $this->con->returnConsulta($sql);
	return $datos;
}
public function arrayVentasFE(){
	$sql = "SELECT * FROM bills WHERE stateBill=1 AND typeBill=3";
	$datos = $this->con->returnConsulta($sql);
	return $datos;
}

public function arrayCompras(){
	$sql = "SELECT * FROM bills WHERE stateBill=1 AND typeBill=4";
	$datos = $this->con->returnConsulta($sql);
	return $datos;
}

public function arrayComprasFE(){
	$sql = "SELECT * FROM bills WHERE stateBill=1 AND typeBill=6";
	$datos = $this->con->returnConsulta($sql);
	return $datos;
}

public function procesarUsuarios(){
	$sql="UPDATE `userdetails` SET `tipoCliente` = '1' WHERE `range` = 2";
	$query = $this->con->returnConsulta($sql);
	$sql="UPDATE `userdetails` SET `tipoEmpleado` = '1' WHERE `range` = 1";
	$query = $this->con->returnConsulta($sql);
	$sql="UPDATE `userdetails` SET `tipoCajero` = '1' WHERE `range` = 1";
	$query = $this->con->returnConsulta($sql);
	$sql="UPDATE `userdetails` SET `tipoProveedor` = '1' WHERE `range` = 3";
	$query = $this->con->returnConsulta($sql);

	$sql = "SELECT * FROM `userdetails`";
	$query = $this->con->returnConsulta($sql);

	while($data=mysqli_fetch_array($query)){
		$id=$data['iduserDetails'];
		$documento=$data['documentUser'];
		$razonSocial=$data['company'];
		$nombres=$data['nameUser'];
		$apellidos=$data['lastnameUser'];
		$nombreExplode = explode (" ", $nombres);
		$nombre1=$nombreExplode[0];
		$nombren2=$nombreExplode[1];
		$nombren3=$nombreExplode[2];
		$nombren4=$nombreExplode[3];
		$nombre2=$nombren2." ".$nombren3." ".$nombren4;
		$apellidoExplode = explode (" ", $apellidos);
		$apellido1=$apellidoExplode[0];
		$apellidon2=$apellidoExplode[1];
		$apellidon3=$apellidoExplode[2];
		$apellidon4=$apellidoExplode[3];
		$apellido2=$apellidon2." ".$apellidon3." ".$apellidon4;
		$sql="UPDATE `userdetails` SET `documento` = '$documento', `municipio` = 'SAN MIGUEL LA DORADA', `codmunicipio` = '757', `departamento` = 'PUTUMAYO', `codigodepartamento` = '86', `pais` = 'COLOMBIA', `codigopais` = '169', `razonSocial` = '$razonSocial', `nombreComercial` = '$razonSocial', `primerNombre` = '$nombre1', `otrosNombres` = '$nombre2', `primerApellido` = '$apellido1', `segundoApellido` = '$apellido2' WHERE `iduserDetails` = '$id'";
		$query2=$this->con->returnConsulta($sql);		
	}
}


public function procesarDV(){
	$sql = "SELECT * FROM `userdetails`";
	$query = $this->con->returnConsulta($sql);

	while($data=mysqli_fetch_array($query)){
		$id=$data['iduserDetails'];
		$documento=$data['documento'];
		$docInv=strrev($documento);
		$longitud=strlen($docInv);
		if($longitud==1){
			$documentoFinal="$docInv"."00000000000000";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
			

		}
		if($longitud==2){
			$documentoFinal="$docInv"."0000000000000";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
		}
		if($longitud==3){
			$documentoFinal="$docInv"."000000000000";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
		}
		if($longitud==4){
			$documentoFinal="$docInv"."00000000000";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
		}
		if($longitud==5){
			$documentoFinal="$docInv"."0000000000";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
		}
		if($longitud==6){
			$documentoFinal="$docInv"."000000000";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
		}
		if($longitud==7){
			$documentoFinal="$docInv"."00000000";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
		}
		if($longitud==8){
			$documentoFinal="$docInv"."0000000";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
		}
		if($longitud==9){
			$documentoFinal="$docInv"."000000";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
		}
		if($longitud==10){
			$documentoFinal="$docInv"."00000";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
		}
		if($longitud==11){
			$documentoFinal="$docInv"."0000";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
		}
		if($longitud==12){
			$documentoFinal="$docInv"."000";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
		}
		if($longitud==13){
			$documentoFinal="$docInv"."00";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
		}
		if($longitud==14){
			$documentoFinal="$docInv"."0";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
		}
		if($longitud==15){
			$documentoFinal="$docInv";
			$caracter1=$documentoFinal[0]*3;
			$caracter2=$documentoFinal[1]*7;
			$caracter3=$documentoFinal[2]*13;
			$caracter4=$documentoFinal[3]*17;
			$caracter5=$documentoFinal[4]*19;
			$caracter6=$documentoFinal[5]*23;
			$caracter7=$documentoFinal[6]*29;
			$caracter8=$documentoFinal[7]*37;
			$caracter9=$documentoFinal[8]*41;
			$caracter10=$documentoFinal[9]*43;
			$caracter11=$documentoFinal[10]*47;
			$caracter12=$documentoFinal[11]*53;
			$caracter13=$documentoFinal[12]*59;
			$caracter14=$documentoFinal[13]*67;
			$caracter15=$documentoFinal[14]*71;
			$totalSuma=$caracter1+$caracter2+$caracter3+$caracter4+$caracter5+$caracter6+$caracter7+$caracter8+$caracter9+$caracter10+$caracter11+$caracter12+$caracter13+$caracter14+$caracter15;
			$residuo=$totalSuma%11;
			if($residuo<=1){
				$dv=$residuo;
			}else{
				$dv=11-$residuo;
			}
		}

		
		$sql="UPDATE `userdetails` SET `dv` = '$dv' WHERE `iduserDetails` = '$id'";
		$query2 = $this->con->returnConsulta($sql);
	}
}


public function editarTipoComprobante(){
	$idcomprobante = $this->idcomprobante;
	$nombreTC1 = $this->nombreTC;
	
	$nombreTC=strtoupper($nombreTC1);

	$sql = "UPDATE `comprobantes` SET `nombre` = '$nombreTC' WHERE `comprobantes`.`idcomprobante` = $idcomprobante";
	
	$query = $this->con->returnConsulta($sql);
	

	header("location:" . URL . "contabilidad/crear?tipo=comprobante&$tipo");

}

public function eliminarTipoComprobante(){
	$idcomprobante = $this->idcomprobante;
	$nombreTC1 = $this->nombreTC;
	$tipo = $this->tipo;
	
	$nombreTC=strtoupper($nombreTC1);

	$sql="SELECT * FROM `notacontable` WHERE tipoNotacontable=$tipo";
	$query = $this->con->returnConsulta($sql);
	$row = mysqli_num_rows($query);
	if($row>=1){
		header("location:" . URL . "contabilidad/eliminar?tipo=tipocomprobante&id=$idcomprobante&error");
	}else{
		$sql = "UPDATE `comprobantes` SET `estado` = '0' WHERE `comprobantes`.`idcomprobante` = $idcomprobante";
		$query = $this->con->returnConsulta($sql);
		header("location:" . URL . "contabilidad/crear?tipo=comprobante");
	}
	
}


public function eliminarDocumento(){
	$numeracion = strtoupper($this->numeracion);
	$tipo = strtoupper($this->tipo);
	if($tipo==1 OR $tipo==2){
		header("location:" . URL . "contabilidad/eliminar?tipo=documento&numero=$numeracion&comprobante=$tipo&error");
	}else{
		$sql = "UPDATE `notacontable` SET `estadoNotacontable` = '0' WHERE `notacontable`.`comprobante` = $numeracion AND tipoNotacontable = $tipo";
		$query = $this->con->returnConsulta($sql);
		$sql = "UPDATE `registroscontables` SET `estado` = '0' WHERE `notaContable` = $numeracion AND tipoRegistro = $tipo";
		$query = $this->con->returnConsulta($sql);
		header("location:" . URL . "contabilidad/documentos?tipo=$tipo&success");
	}
}

public function duplicarDocumento(){
	$numeracion = strtoupper($this->numeracion);
	$tipo = strtoupper($this->tipo);
	$sql = "SELECT * FROM `notacontable` WHERE tipoNotacontable=$tipo";
	$query2 = $this->con->returnConsulta($sql);
	$row = mysqli_num_rows($query2);
	$sql = "SELECT * FROM `notacontable` WHERE tipoNotacontable=$tipo AND comprobante=$numeracion";
	$query = $this->con->returnConsulta($sql);
	$comprobante=$row+1;
	$datetimeNot = 	date("G:i:s");
	$dateTime = date("Y-m-d");
	if($tipo==1 OR $tipo==2){
		header("location:" . URL . "contabilidad/duplicar?tipo=documento&numero=$numeracion&comprobante=$tipo&error");
	}else{
		while($datosRegistros=mysqli_fetch_array($query)){
			$terceroDocumento=$datosRegistros['terceroDocumento'];
			$terceroNombre=$datosRegistros['terceroNombre'];
			$detalle=$datosRegistros['detalle'];
			$descripcion=$datosRegistros['descripcion'];
			$cierre=$datosRegistros['cierre'];
			$fechaDMA=$datosRegistros['fechaDMA'];
			$fechaHMs=$datosRegistros['fechaHMs'];
			$usuarioCreador=$datosRegistros['usuarioCreador'];
			$totalDebito=$datosRegistros['totalDebito'];
			$totalCredito=$datosRegistros['totalCredito'];
			$cantidadCuentas=$datosRegistros['cantidadCuentas'];
			$tipoNotacontable=$datosRegistros['tipoNotacontable'];
			$estadoNotacontable=$datosRegistros['estadoNotacontable'];
			$diferencia=$datosRegistros['diferencia'];
			$prefijo=$datosRegistros['prefijo'];
			$tipoComprobante=$datosRegistros['tipoComprobante'];
		}
		$sql2 = "INSERT INTO `notacontable` ( `comprobante`, `terceroDocumento`, `terceroNombre`, `detalle`, `descripcion`, `cierre`, `fechaDMA`, `fechaHMs`, `usuarioCreador`, `totalDebito`, `totalCredito`, `cantidadCuentas`, `tipoNotacontable`, `estadoNotacontable`, `diferencia`, `prefijo`, `tipoComprobante`) VALUES ('$comprobante', '$terceroDocumento', '$terceroNombre', '$detalle', '$descripcion', '0', '$dateTime', '$datetimeNot ', '$usuarioCreador', '$totalDebito', '$totalCredito', '100', '$tipoNotacontable', '1', '$diferencia', '$prefijo', '$tipoComprobante');	";
		$query = $this->con->returnConsulta($sql2);
	
		$sql = "SELECT * FROM `registroscontables` WHERE tipoRegistro=$tipo AND notaContable=$numeracion AND estado=1";
		$query = $this->con->returnConsulta($sql);
		while($datosRegistros=mysqli_fetch_array($query)){
			$tipoRegistro=$datosRegistros['tipoRegistro'];
			$notaContable=$datosRegistros['notaContable'];
			$codigo=$datosRegistros['codigo'];
			$nombre=$datosRegistros['nombre'];
			$terceroNombre=$datosRegistros['terceroNombre'];
			$terceroDocumento=$datosRegistros['terceroDocumento'];
			$terceroDigVer=$datosRegistros['terceroDigVer'];
			$detalle=$datosRegistros['detalle'];
			$descripcion=$datosRegistros['descripcion'];
			$debito=$datosRegistros['debito'];
			$credito=$datosRegistros['credito'];
			$diferencia=$datosRegistros['diferencia'];
			$fecha=$datosRegistros['fecha'];
			$estado=$datosRegistros['estado'];
			$base=$datosRegistros['base'];
	
			$sql = "INSERT INTO `registroscontables` (`tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `fecha`, `estado`, `base`) VALUES ('$tipoRegistro', '$comprobante', '$codigo', '$nombre', '$terceroNombre', '$terceroDocumento', '$terceroDigVer', '$detalle', '$descripcion', '$debito', '$credito', '$diferencia', '$dateTime', '$estado', '$base')
			";
			$query2 = $this->con->returnConsulta($sql);
		}
	
	
		if($query2){
			header("location:" . URL . "contabilidad/ver?tipo=documento&numero=$comprobante&comprobante=$tipo&duplicado");
		}else{
			header("location:" . URL . "contabilidad/duplicar?tipo=documento&numero=$numeracion&comprobante=$tipo&$row&error");
		}
	}
	
}



public function editarCodigo(){
	$idPuc = $this->idPuc;
	$nombrePuc = strtoupper($this->nombrePuc);
	$detalle = strtoupper($this->detalle);
	$base = strtoupper($this->base);
	$tercero = strtoupper($this->tercero);
	$exogena = strtoupper($this->exogena);
	
	$sql = "UPDATE `puc` SET `nombre` = '$nombrePuc', `detalle` = '$detalle', `base` = '$base', `tercero` = '$tercero', `exogena` = '$exogena' WHERE `puc`.`idpuc` = $idPuc";
	
	$query = $this->con->returnConsulta($sql);
	

	header("location:" . URL . "contabilidad/editar?tipo=codigo&id=$idPuc&success");

}

public function eliminarCodigo(){
	$idPuc = $this->idPuc;
	$nombrePuc = strtoupper($this->nombrePuc);
	$detalle = strtoupper($this->detalle);
	$base = strtoupper($this->base);
	$tercero = strtoupper($this->tercero);
	$exogena = strtoupper($this->exogena);
	$codigo = strtoupper($this->codigo);

	$sql = "SELECT * FROM `registroscontables` WHERE codigo LIKE '$codigo%'";
	$query = $this->con->returnConsulta($sql);
	$row = mysqli_num_rows($query);
	if($row>=1){
		header("location:" . URL . "contabilidad/eliminar?tipo=codigo&id=$idPuc&error");
	}else{
		$sql = "UPDATE `puc` SET `estado` = '0' WHERE `puc`.`idpuc` = $idPuc";
		$query = $this->con->returnConsulta($sql);
		header("location:" . URL . "contabilidad/puc?codigo=$codigo&row=$row");
	}
	
	
	


}



public function procesarTipoComprobante(){
	$prefijoTC1 = $this->prefijoTC;
	$numeracionTC = $this->numeracionTC;
	$nombreTC1 = $this->nombreTC;
	$prefijoTC=strtoupper($prefijoTC1);
	$nombreTC=strtoupper($nombreTC1);
	$sql = "SELECT * FROM `comprobantes` ORDER BY `comprobantes`.`tipo` DESC";
	$query = $this->con->returnConsulta($sql);
	$datos= mysqli_fetch_array($query);
	$tipo=$datos['tipo']+1;
	$sql = "INSERT INTO `comprobantes` (`nombre`, `tipo`, `prefijo`, `estado`, `fecha`, `usuario`, `numeracion`, `pred`) VALUES ('$nombreTC', '$tipo', '$prefijoTC', '1', 'hoy', 'user', '$numeracionTC', '0');";
	$query = $this->con->returnConsulta($sql);
	

	header("location:" . URL . "contabilidad/crear?tipo=comprobante&$tipo");

}

public function procesarPucDet(){
	$sql = "SELECT * FROM puc";
	$query = $this->con->returnConsulta($sql);
	$i=0;
	while($datos= mysqli_fetch_array($query)){
		$codigo=$datos['codigo'];
		$idpuc=$datos['codigo'];
		$longitud= strlen($codigo);
		if($longitud==1){
			$sql2 = "INSERT INTO `puc_detalles` (`codigo`, `clase`, `grupo`, `cuenta`, `subcuenta`, `auxiliar`) VALUES ('$idpuc', '$idpuc', '', '', '', '')";
			$query2 = $this->con->returnConsulta($sql2);
			$i++;
		}
		if($longitud==2){
			$clase=$codigo[0];
			$digito2=$codigo[1];
			$totalgrupo=$digito1.$digito2;
			$sql2 = "INSERT INTO `puc_detalles` (`codigo`, `clase`, `grupo`, `cuenta`, `subcuenta`, `auxiliar`) VALUES ('$idpuc', '$clase', '$totalgrupo', '', '', '')";
			$query2 = $this->con->returnConsulta($sql2);
			$i++;
		}
		if($longitud==4){
			$digito1=$codigo[0];
			$digito2=$codigo[1];
			$digito3=$codigo[2];
			$digito4=$codigo[3];
			$totalgrupo=$digito1.$digito2;
			$totalcuenta=$digito1.$digito2.$digito3.$digito4;
			$sql2 = "INSERT INTO `puc_detalles` (`codigo`, `clase`, `grupo`, `cuenta`, `subcuenta`, `auxiliar`) VALUES ('$idpuc', '$digito1', '$totalgrupo', '$totalcuenta', '', '')";
			$query2 = $this->con->returnConsulta($sql2);
			$i++;
		}
		if($longitud==6){
			$digito1=$codigo[0];
			$digito2=$codigo[1];
			$digito3=$codigo[2];
			$digito4=$codigo[3];
			$digito5=$codigo[4];
			$digito6=$codigo[5];
			$totalgrupo=$digito1.$digito2;
			$totalcuenta=$digito1.$digito2.$digito3.$digito4;
			$totalsubcuenta=$digito1.$digito2.$digito3.$digito4.$digito5.$digito6;
			$sql2 = "INSERT INTO `puc_detalles` (`codigo`, `clase`, `grupo`, `cuenta`, `subcuenta`, `auxiliar`) VALUES ('$idpuc', '$digito1', '$totalgrupo', '$totalcuenta', '$totalsubcuenta', '')";
			$query2 = $this->con->returnConsulta($sql2);
			$i++;
		}
		if($longitud==8){
			$digito1=$codigo[0];
			$digito2=$codigo[1];
			$digito3=$codigo[2];
			$digito4=$codigo[3];
			$digito5=$codigo[4];
			$digito6=$codigo[5];
			$digito7=$codigo[6];
			$digito8=$codigo[7];
			$totalgrupo=$digito1.$digito2;
			$totalcuenta=$digito1.$digito2.$digito3.$digito4;
			$totalsubcuenta=$digito1.$digito2.$digito3.$digito4.$digito5.$digito6;
			$auxiliar=$digito1.$digito2.$digito3.$digito4.$digito5.$digito6.$digito7.$digito8;
			$sql2 = "INSERT INTO `puc_detalles` (`codigo`, `clase`, `grupo`, `cuenta`, `subcuenta`, `auxiliar`) VALUES ('$idpuc', '$digito1', '$totalgrupo', '$totalcuenta', '$totalsubcuenta', '$auxiliar')";
			
			$query2 = $this->con->returnConsulta($sql2);
			$i++;
		}
		
		
	}
	header("location:" . URL . "contabilidad/crear?tipo=procesos&$i");

}


public function procesarPuc(){
	$sql = "SELECT * FROM puc";
	$query = $this->con->returnConsulta($sql);
	$row = mysqli_num_rows($query);
	$i=0;
	$i1=0;
	while($datos= mysqli_fetch_array($query)){
		$i++;
		$codigo=$datos['codigo'];
		$nombre=$datos['nombre'];
		$codigoNew=$codigo."01";
		$longitud= strlen($codigo);
		if($longitud==6){
			$i1++;
			$sql2 = "INSERT INTO `puc` (`codigo`, `nombre`, `fav`, `auxiliar`) VALUES ('$codigoNew', '$nombre', '0', '1')";
			$query2 = $this->con->returnConsulta($sql2);
		}
	}

	header("location:" . URL . "contabilidad/crear?tipo=procesos&$i&$i1");
}

public function procesarNotaContable(){

	$connect = $this->con->connect();
	$codigo = $this->codigo;
	$nombre = $this->nombre;
	$detalle = $this->detalle;
	$debito = $this->debito;
	$credito = $this->credito;
	$numeracion = $this->numeracion;
	$numeracionC = $this->numeracion;
	$nombreTercero = $this->nombreTercero;
	$idTercero = $this->idTercero;
	$documentoTer = $this->documentoTer;
	$observaciones = $this->observaciones;
	$fecha = $this->fecha;
	$tipoC = $this->comprobante;
	$idusuario = $this->idusuario;
	$totaldebito = $this->totaldebito;
	$totalcredito = $this->totalcredito;
	$diferencia = $this->diferencia;
	$tercerolista = $this->tercerolista;
	$tercerolistaid = $this->tercerolistaid;
	$tercerolistadoc = $this->tercerolistadoc;
	$tercerolistanombre = $this->tercerolistanombre;
	$base = $this->base;
	$today = date("H:i:s"); 

	$count = count($codigo);
	$sql44 = "SELECT * FROM comprobantes WHERE tipo=$tipoC";
	$query44 = $this->con->returnConsulta($sql44);
	$datos44= mysqli_fetch_array($query44);
	$tipoComprobante=strtoupper($datos44['nombre']);
	$prefijo=$datos44['prefijo'];

	$sql2 = "INSERT INTO `notacontable` (`comprobante`, `terceroDocumento`, `terceroNombre`, `detalle`, `descripcion`, `cierre`, `fechaDMA`, `fechaHMs`, `usuarioCreador`, `totalDebito`, `totalCredito`, `cantidadCuentas`, `tipoNotacontable`, `estadoNotacontable`, `diferencia`, `prefijo`, `tipoComprobante`) VALUES ('$numeracion', '$documentoTer', '$nombreTercero', '', '$observaciones', '0', '$fecha', '$today', '$idusuario', '$totaldebito', '$totalcredito', '100', '$tipoC', '1', '$diferencia', '$prefijo', '$tipoComprobante')";
	$query2 = $this->con->returnConsulta($sql2);

	$sql66 = "SELECT * FROM `comprobantes` WHERE tipo=$tipoC";
	$query66 = $this->con->returnConsulta($sql66);
	$datos66= mysqli_fetch_array($query66);
	$numeracion=$datos66['numeracion'];
	$numeracionN=$numeracion+1;
	$sql66 = "UPDATE `comprobantes` SET `numeracion` = '$numeracionN' WHERE tipo = $tipoC";
	$query66 = $this->con->returnConsulta($sql66);
	

	for ($i=0; $i < $count; $i++) {
		$codigo1 = $codigo[$i];
		if($codigo1!=""){
			$nombre1 = $nombre[$i];
			$detalle1 = $detalle[$i];
			$debito1 = $debito[$i];
			if($credito[$i]!=0){
				$credito1 = $credito[$i];
			}else{
				$credito1 = 0;
			}
			$base1 = $base[$i];
			$tercerolista1 = $tercerolista[$i];
			$tercerolistaid1 = $tercerolistaid[$i];
			$tercerolistadoc1 = $tercerolistadoc[$i];
			$tercerolistanombre1 = $tercerolistanombre[$i];
			if($tercerolistadoc1=="")
			{
				$tercerolistadoc1 = $documentoTer;
				$tercerolistanombre1 = $nombreTercero;
			}
			
			$sql = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo1";
			$query2 = $this->con->returnConsulta($sql);	

			$sql = "SELECT * FROM `puc` WHERE codigo=$codigo1";
			$query2 = $this->con->returnConsulta($sql);
			$datos3= mysqli_fetch_array($query2);
			$nombrecodigo=$datos3['nombre'];
			$valorpucdebito=$datos3['totaldebito'];
			$valorpuccredito=$datos3['totalcredito'];
			$totaldebitopuc=$debito1+$valorpucdebito;
			$totalcreditopuc=$credito1+$valorpuccredito;

			
			

			$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`, `base`) VALUES ('$fecha','$tipoC', '$numeracion', '$codigo1', '$nombre1', '$tercerolistanombre1', '$tercerolistadoc1', '$tercerolistaid1', '$detalle1', '', '$debito1', '$credito1', '', '1', '$base1')";
			$query2 = $this->con->returnConsulta($sql);

			$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo1";
			$query3 = $this->con->returnConsulta($sql);	
			$datos4= mysqli_fetch_array($query3);

			$codigoclase=$datos4['clase'];
			$codigogrupo=$datos4['grupo'];
			$codigocuenta=$datos4['cuenta'];
			$codigosubcuenta=$datos4['subcuenta'];
			$codigoauxiliar=$datos4['auxiliar'];

			$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
			$query5 = $this->con->returnConsulta($sql5);	
			$datos5= mysqli_fetch_array($query5);
			$totalclasedebito=$datos5['totaldebito']+$debito1;
			$totalclasecredito=$datos5['totalcredito']+$credito1;

			
			
			
		}
		
	}
	$sql = "UPDATE `registroscontables` SET `estado` = '0' WHERE nombre='eliminar' AND estado=1";
	$query2 = $this->con->returnConsulta($sql);
 
	header("location:" . URL . "contabilidad/crear?tipo=documento&nuevo=documento&documento=$numeracionC&tipodocumento=$tipoC");
}


public function editarNotaContable(){

	$connect = $this->con->connect();
	$codigo = $this->codigo;
	$nombre = $this->nombre;
	$detalle = $this->detalle;
	$debito = $this->debito;
	$credito = $this->credito;
	$numeracion = $this->numeracion;
	$numeracionC = $this->numeracion;
	$nombreTercero = $this->nombreTercero;
	$idTercero = $this->idTercero;
	$documentoTer = $this->documentoTer;
	$observaciones = $this->observaciones;
	$fecha = $this->fecha;
	$tipoC = $this->comprobante;
	$idusuario = $this->idusuario;
	$totaldebito = $this->totaldebito;
	$totalcredito = $this->totalcredito;
	$diferencia = $this->diferencia;
	$tercerolista = $this->tercerolista;
	$tercerolistaid = $this->tercerolistaid;
	$tercerolistadoc = $this->tercerolistadoc;
	$tercerolistanombre = $this->tercerolistanombre;
	$idRegistroC = $this->idRegistroC;
	$tagoculto = $this->tagoculto;
	$base = $this->base;
	$today = date("H:i:s"); 
	
	
	$count = count($codigo);
	$sql44 = "SELECT * FROM comprobantes WHERE tipo=$tipoC";
	$query44 = $this->con->returnConsulta($sql44);
	$datos44= mysqli_fetch_array($query44);
	$tipoComprobante=strtoupper($datos44['nombre']);
	$prefijo=$datos44['prefijo'];




	for ($i=0; $i < $count; $i++) {
		$codigo1 = $codigo[$i];
		if($codigo1!=""){
			$nombre1 = $nombre[$i];
			$detalle1 = strtoupper($detalle[$i]);
			$debito1 = $debito[$i];
			$tercerolista1 = $tercerolista[$i];
			$tercerolistaid1 = $tercerolistaid[$i];
			$tercerolistadoc1 = $tercerolistadoc[$i];
			$tercerolistanombre1 = $tercerolistanombre[$i];
			$idRegistroC1 = $idRegistroC[$i];
			$tagoculto1 = $tagoculto[$i];
			if($tercerolistadoc1=="")
			{
				$tercerolistadoc1 = $documentoTer;
				$tercerolistanombre1 = $nombreTercero;
			}
			$credito1 = $credito[$i];
			$base1 = $base[$i];
			
			
			$sql = "SELECT * FROM `puc` WHERE codigo=$codigo1";
			$query2 = $this->con->returnConsulta($sql);	
			$datos3= mysqli_fetch_array($query2);
			$nombrecodigo=$datos3['nombre'];
			$valorpucdebito=$datos3['totaldebito'];
			$valorpuccredito=$datos3['totalcredito'];
			$totaldebitopuc=$debito1+$valorpucdebito;
			$totalcreditopuc=$credito1+$valorpuccredito;

			
		
			$sql = "SELECT * FROM `registroscontables` WHERE idregistrocontable=$idRegistroC1";
			$query2 = $this->con->returnConsulta($sql);
			$row=mysqli_num_rows($query2);
			if($row>=1){
					$estado=1;
					if($nombre1=="eliminar"){
						$estado=0;
					}
					
					$sql = "UPDATE `registroscontables` SET `nombre` = '$nombre1',`terceroNombre` = '$tercerolistanombre1',`terceroDocumento` = '$tercerolistadoc1',`codigo` = '$codigo1',`credito` = '$credito1',`debito` = '$debito1',`base` = '$base1',`detalle` = '$detalle1',`estado` = '$estado' WHERE `registroscontables`.`idregistrocontable` = $idRegistroC1";
					$query2 = $this->con->returnConsulta($sql);
			}
			else if($row==0){
				$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`, `base`) VALUES ('$fecha','$tipoC', '$numeracion', '$codigo1', '$nombre1', '$tercerolistanombre1', '$tercerolistadoc1', '$tercerolistaid1', '$detalle1', '', '$debito1', '$credito1', '', '1', '$base1')";
				$query2 = $this->con->returnConsulta($sql);
			}

			
			
		}
		
	} 
	if($totaldebito==0 OR $totalcredito==0){
		$sql2 = "SELECT * FROM `registroscontables` WHERE tipoRegistro=$tipoC AND notaContable=$numeracion";
		$query2 = $this->con->returnConsulta($sql2);
		$rowcont= mysqli_num_rows($query2);
		$totaldebito=0;
		$totalcredito=0;
		while($datos2= mysqli_fetch_array($query2)){
			$totaldebito+=$datos2['debito'];
			$totalcredito+=$datos2['credito'];
		}
		$diferencia=$totaldebito-$totalcredito;
	}

	$sql2 = "UPDATE `notacontable` SET `descripcion` = '$observaciones',`terceroDocumento` = '$documentoTer',`fechaDMA` = '$fecha', `terceroNombre` = '$nombreTercero', `totalDebito` = '$totaldebito', `totalCredito` = '$totalcredito' WHERE `comprobante` = $numeracion AND `tipoNotacontable` = $tipoC";
	$query2 = $this->con->returnConsulta($sql2);

	$sql = "UPDATE `registroscontables` SET `estado` = '0' WHERE nombre='eliminar' AND estado=1";
	$query2 = $this->con->returnConsulta($sql);



	if($query2){
		header("location:" . URL . "contabilidad/editar?tipo=documento&numero=$numeracionC&comprobante=$tipoC&success&$nombre1");
	}else{
		header("location:" . URL . "contabilidad/editar?tipo=documento&numero=$numeracionC&comprobante=$tipoC&error");
	}
}

public function procesarFacturasVenta()
{
	$connect = $this->con->connect();
	$sql = "SELECT * FROM `bills` WHERE typebill=1 AND revision=0 AND stateBill=1";
	$query = $this->con->returnConsulta($sql);
	$idbill = $array['numeroFactura'];
	$row = mysqli_num_rows($query);
	$inc=0;
		while($datos= mysqli_fetch_array($query)){
			$idfinal=$datos['idbills'];

			$clienteBills=$datos['cliente'];
			$documentoBills=$datos['documentUser'];
			
			if($clienteBills==""){
				$clienteBills="CUANTIAS MENORES";
				$documentoBills="222222222";
			}
		
			$sqlID = "SELECT * FROM `bills` WHERE idbills=$idfinal";
			$queryID = $this->con->returnConsulta($sqlID);
			$arrayID = mysqli_fetch_array($queryID);
			$idbill = $arrayID['idbills'];
			$numeroFactura = $arrayID['numeroFactura']." F-V";
			
			$sqlDet = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1";
			$queryDet = $this->con->returnConsulta($sqlDet);
			$rowDet = mysqli_num_rows($queryDet);
			$total=0;
			$totalImpuesto=0;	
			$totalCosto=0;	
			while ($dataDet= mysqli_fetch_array($queryDet)) {
				$totalCosto+=$dataDet['pUnidadCompra']*$dataDet['cantidad'];
				$total+=$dataDet['precioTotal'];
				$totalImpuesto+=$dataDet['impuesto']*$dataDet['cantidad'];
			}
			$totalSinIva=$total-$totalImpuesto;
			
			$sql19 = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1 AND ivaPorcentaje=19";
			$query19 = $this->con->returnConsulta($sql19);
			$total19=0;
			$totalImpuesto19=0;	
			$totalCos19=0;	
			while ($datos19= mysqli_fetch_array($query19)) {
				$totalCos19+=$datos19['pUnidadCompra']*$datos19['cantidad'];
				$total19+=$datos19['precioTotal'];
				$totalImpuesto19+=$datos19['impuesto']*$datos19['cantidad'];
			}
			$totalSinIva19=$total19-$totalImpuesto19;
			$totalIvaCos19=$totalCos19/1.19;

			$sql5 = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1 AND ivaPorcentaje=5";
			$query5 = $this->con->returnConsulta($sql5);
			$total5=0;
			$totalImpuesto5=0;	
			$totalCos5=0;	
			while ($datos5= mysqli_fetch_array($query5)) {
				$totalCos5+=$datos5['pUnidadCompra']*$datos5['cantidad'];
				$total5+=$datos5['precioTotal'];
				$totalImpuesto5+=$datos5['impuesto']*$datos5['cantidad'];
			}
			$totalSinIva5=$total5-$totalImpuesto5;
			$totalIvaCos5=$totalCos5/1.05;

			$sql0 = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1 AND ivaPorcentaje=0";
			$query0 = $this->con->returnConsulta($sql0);
			$total0=0;
			$totalImpuesto0=0;	
			$totalCos0=0;	
			while ($datos0= mysqli_fetch_array($query0)) {
				$totalCos0+=$datos0['pUnidadCompra']*$datos0['cantidad'];
				$total0+=$datos0['precioTotal'];
				$totalImpuesto0+=$datos0['impuesto']*$datos0['cantidad'];
			}
			$totalSinIva0=$total0-$totalImpuesto0;
			$totalIvaCos0=$totalCos0;

			$sqlNoR = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail=1 AND typeBillDetail=2";
			$queryNoR = $this->con->returnConsulta($sqlNoR);
			$totalNoR=0;
			$totalImpuestoNoR=0;	
			while ($dataNoR= mysqli_fetch_array($queryNoR)) {
				$totalNoR+=$dataNoR['precioTotal'];
				$totalImpuestoNoR+=$dataNoR['impuesto']*$dataNoR['cantidad'];
			}
			$totalSinIvaNoR=$totalNoR-$totalImpuestoNoR;
			$totalCostoSinIva=$totalIvaCos5+$totalIvaCos19+$totalIvaCos0;

			
			 
			$sqlUpd = "UPDATE `bills` SET `cliente` = '$clienteBills',`documentUser` = '$documentoBills',`precioCostoSiniVA` = '$totalCostoSinIva',`precioCostoConiVA` = '$totalCosto',`baseIvaNoR` = '$totalSinIvaNoR',`ivaNoR` = '$totalImpuestoNoR',`total` = '$total',`baseIva5` = '$totalSinIva5', `iva5V` = '$totalImpuesto5',`baseIva19` = '$totalSinIva19', `iva19V` = '$totalImpuesto19', `totalSinIva` = '$totalSinIva', `baseIva0` = '$totalSinIva0',`comprobanteID` = '$numeroFactura' WHERE `bills`.`idbills` = $idbill";
			$queryUpd = $this->con->returnConsulta($sqlUpd);


			$sql = "UPDATE `bills` SET `revision` = '1' WHERE `bills`.`idbills` = $idbill";
			$query2 = $this->con->returnConsulta($sql);
			
		}
		
		

		// header("location:" . URL . "cajas?caja=ventas");
		header("location:" . URL . "contabilidad/venta2");
		//header("location:" . URL . "contabilidad/crear?tipo=codigo&error=codigo&". $idfinal."/". "/" . "");
	
	}



	public function procesarFacturasVentaFE()
	{
	$connect = $this->con->connect();
	$sql = "SELECT * FROM `bills` WHERE typebill=3  AND revision=0 AND stateBill=1";
	$query = $this->con->returnConsulta($sql);
	$idbill = $array['numeroFactura'];
	$row = mysqli_num_rows($query);
	$inc=0;
		while($datos= mysqli_fetch_array($query)){
			$idfinal=$datos['idbills'];

			$clienteBills=$datos['cliente'];
			$documentoBills=$datos['documentUser'];
			
			if($clienteBills==""){
				$clienteBills="CUANTIAS MENORES";
				$documentoBills="222222222";
			}
		
			$sqlID = "SELECT * FROM `bills` WHERE idbills=$idfinal";
			$queryID = $this->con->returnConsulta($sqlID);
			$arrayID = mysqli_fetch_array($queryID);
			$idbill = $arrayID['idbills'];
			$numeroFactura = $arrayID['numeroFactura']." F-V";
			
			$sqlDet = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1";
			$queryDet = $this->con->returnConsulta($sqlDet);
			$rowDet = mysqli_num_rows($queryDet);
			$total=0;
			$totalImpuesto=0;	
			$totalCosto=0;	
			while ($dataDet= mysqli_fetch_array($queryDet)) {
				$totalCosto+=$dataDet['pUnidadCompra']*$dataDet['cantidad'];
				$total+=$dataDet['precioTotal'];
				$totalImpuesto+=$dataDet['impuesto']*$dataDet['cantidad'];
			}
			$totalSinIva=$total-$totalImpuesto;
			
			$sql19 = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1 AND ivaPorcentaje=19";
			$query19 = $this->con->returnConsulta($sql19);
			$total19=0;
			$totalImpuesto19=0;	
			$totalCos19=0;	
			while ($datos19= mysqli_fetch_array($query19)) {
				$totalCos19+=$datos19['pUnidadCompra']*$datos19['cantidad'];
				$total19+=$datos19['precioTotal'];
				$totalImpuesto19+=$datos19['impuesto']*$datos19['cantidad'];
			}
			$totalSinIva19=$total19-$totalImpuesto19;
			$totalIvaCos19=$totalCos19/1.19;

			$sql5 = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1 AND ivaPorcentaje=5";
			$query5 = $this->con->returnConsulta($sql5);
			$total5=0;
			$totalImpuesto5=0;	
			$totalCos5=0;	
			while ($datos5= mysqli_fetch_array($query5)) {
				$totalCos5+=$datos5['pUnidadCompra']*$datos5['cantidad'];
				$total5+=$datos5['precioTotal'];
				$totalImpuesto5+=$datos5['impuesto']*$datos5['cantidad'];
			}
			$totalSinIva5=$total5-$totalImpuesto5;
			$totalIvaCos5=$totalCos5/1.05;

			$sql0 = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1 AND ivaPorcentaje=0";
			$query0 = $this->con->returnConsulta($sql0);
			$total0=0;
			$totalImpuesto0=0;	
			$totalCos0=0;	
			while ($datos0= mysqli_fetch_array($query0)) {
				$totalCos0+=$datos0['pUnidadCompra']*$datos0['cantidad'];
				$total0+=$datos0['precioTotal'];
				$totalImpuesto0+=$datos0['impuesto']*$datos0['cantidad'];
			}
			$totalSinIva0=$total0-$totalImpuesto0;
			$totalIvaCos0=$totalCos0;

			$sqlNoR = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail=1 AND typeBillDetail=2";
			$queryNoR = $this->con->returnConsulta($sqlNoR);
			$totalNoR=0;
			$totalImpuestoNoR=0;	
			while ($dataNoR= mysqli_fetch_array($queryNoR)) {
				$totalNoR+=$dataNoR['precioTotal'];
				$totalImpuestoNoR+=$dataNoR['impuesto']*$dataNoR['cantidad'];
			}
			$totalSinIvaNoR=$totalNoR-$totalImpuestoNoR;
			$totalCostoSinIva=$totalIvaCos5+$totalIvaCos19+$totalIvaCos0;

			
			 
			$sqlUpd = "UPDATE `bills` SET `cliente` = '$clienteBills',`documentUser` = '$documentoBills',`precioCostoSiniVA` = '$totalCostoSinIva',`precioCostoConiVA` = '$totalCosto',`baseIvaNoR` = '$totalSinIvaNoR',`ivaNoR` = '$totalImpuestoNoR',`total` = '$total',`baseIva5` = '$totalSinIva5', `iva5V` = '$totalImpuesto5',`baseIva19` = '$totalSinIva19', `iva19V` = '$totalImpuesto19', `totalSinIva` = '$totalSinIva', `baseIva0` = '$totalSinIva0',`comprobanteID` = '$numeroFactura' WHERE `bills`.`idbills` = $idbill";
			$queryUpd = $this->con->returnConsulta($sqlUpd);


			$sql = "UPDATE `bills` SET `revision` = '1' WHERE `bills`.`idbills` = $idbill";
			$query2 = $this->con->returnConsulta($sql);
			
		}
		
		

		// header("location:" . URL . "cajas?caja=ventas");
		header("location:" . URL . "contabilidad/venta2");
		//header("location:" . URL . "contabilidad/crear?tipo=codigo&error=codigo&". $idfinal."/". "/" . "");
	
	}



	public function procesarFacturasCompra()
	{
		$connect = $this->con->connect();
		$sql = "SELECT * FROM `bills` WHERE typebill=4 AND revision=0 AND stateBill=1";
		$query = $this->con->returnConsulta($sql);
		$array = mysqli_fetch_array($query);
		$idbill = $array['numeroFactura'];
		$row = mysqli_num_rows($query);
		$inc=0;
			while($datos= mysqli_fetch_array($query)){
				$idfinal=$datos['idbills'];
				$clienteBills=$datos['cliente'];
				$documentoBills=$datos['documentUser'];
				
				if($clienteBills==""){
					$clienteBills="CUANTIAS MENORES";
					$documentoBills="222222222";
				}
				$sqlID = "SELECT * FROM `bills` WHERE idbills=$idfinal";
				$queryID = $this->con->returnConsulta($sqlID);
				$arrayID = mysqli_fetch_array($queryID);
				$idbill = $arrayID['idbills'];
				$numeroFactura = $arrayID['numeroFactura'] . " F-C";
				
				$sqlDet = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1";
				$queryDet = $this->con->returnConsulta($sqlDet);
				$total=0;
				$totalImpuesto=0;	
				while ($dataDet= mysqli_fetch_array($queryDet)) {
					$total+=$dataDet['precioTotal'];
					$totalImpuesto+=$dataDet['impuesto']*$dataDet['cantidad'];
				}
				$totalSinIva=$total-$totalImpuesto;
				
				$sql19 = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1 AND ivaPorcentaje=19";
				$query19 = $this->con->returnConsulta($sql19);
				$total19=0;
				$totalImpuesto19=0;	
				while ($datos19= mysqli_fetch_array($query19)) {
					$total19+=$datos19['precioTotal'];
					$totalImpuesto19+=$datos19['impuesto']*$datos19['cantidad'];
				}
				$totalSinIva19=$total19-$totalImpuesto19;

				$sql5 = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1 AND ivaPorcentaje=5";
				$query5 = $this->con->returnConsulta($sql5);
				$total5=0;
				$totalImpuesto5=0;	
				while ($datos5= mysqli_fetch_array($query5)) {
					$total5+=$datos5['precioTotal'];
					$totalImpuesto5+=$datos5['impuesto']*$datos5['cantidad'];
				}
				$totalSinIva5=$total5-$totalImpuesto5;

				$sql0 = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1 AND ivaPorcentaje=0";
				$query0 = $this->con->returnConsulta($sql0);
				$total0=0;
				$totalImpuesto0=0;	
				while ($datos0= mysqli_fetch_array($query0)) {
					$total0+=$datos0['precioTotal'];
					$totalImpuesto0+=$datos0['impuesto']*$datos0['cantidad'];
				}
				$totalSinIva0=$total0-$totalImpuesto0;

				$sqlNoR = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail=1 AND typeBillDetail=2";
				$queryNoR = $this->con->returnConsulta($sqlNoR);
				$totalNoR=0;
				$totalImpuestoNoR=0;	
				while ($dataNoR= mysqli_fetch_array($queryNoR)) {
					$totalNoR+=$dataNoR['precioTotal'];
					$totalImpuestoNoR+=$dataNoR['impuesto']*$dataNoR['cantidad'];
				}
				$totalSinIvaNoR=$totalNoR-$totalImpuestoNoR;
				 
				$sqlUpd = "UPDATE `bills` SET `cliente` = '$clienteBills',`documentUser` = '$documentoBills',`baseIvaNoR` = '$totalSinIvaNoR',`ivaNoR` = '$totalImpuestoNoR',`total` = '$total',`baseIva5` = '$totalSinIva5', `iva5V` = '$totalImpuesto5',`baseIva19` = '$totalSinIva19', `iva19V` = '$totalImpuesto19', `totalSinIva` = '$totalSinIva', `baseIva0` = '$totalSinIva0',`comprobanteID` = '$numeroFactura' WHERE `bills`.`idbills` = $idbill";
				$queryUpd = $this->con->returnConsulta($sqlUpd);

				$idbills=$datos['idbills'];

				$sql = "UPDATE `bills` SET `revision` = '1' WHERE `bills`.`idbills` = $idbills";
				$query2 = $this->con->returnConsulta($sql);
			}
			

		header("location:" . URL . "contabilidad/compra2");
		//header("location:" . URL . "contabilidad/crear?tipo=codigo&error=codigo&". $inc."/". "/" . "");
		
		}


		public function procesarFacturasCompraFE()
	{
		$connect = $this->con->connect();
		$sql = "SELECT * FROM `bills` WHERE typebill=6 AND revision=0 AND stateBill=1";
		$query = $this->con->returnConsulta($sql);
		$array = mysqli_fetch_array($query);
		$idbill = $array['numeroFactura'];
		$row = mysqli_num_rows($query);
		$inc=0;
			while($datos= mysqli_fetch_array($query)){
				$idfinal=$datos['idbills'];
				$clienteBills=$datos['cliente'];
				$documentoBills=$datos['documentUser'];
				
				if($clienteBills==""){
					$clienteBills="CUANTIAS MENORES";
					$documentoBills="222222222";
				}
				$sqlID = "SELECT * FROM `bills` WHERE idbills=$idfinal";
				$queryID = $this->con->returnConsulta($sqlID);
				$arrayID = mysqli_fetch_array($queryID);
				$idbill = $arrayID['idbills'];
				$numeroFactura = $arrayID['numeroFactura'] . " F-C";
				
				$sqlDet = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1";
				$queryDet = $this->con->returnConsulta($sqlDet);
				$total=0;
				$totalImpuesto=0;	
				while ($dataDet= mysqli_fetch_array($queryDet)) {
					$total+=$dataDet['precioTotal'];
					$totalImpuesto+=$dataDet['impuesto']*$dataDet['cantidad'];
				}
				$totalSinIva=$total-$totalImpuesto;
				
				$sql19 = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1 AND ivaPorcentaje=19";
				$query19 = $this->con->returnConsulta($sql19);
				$total19=0;
				$totalImpuesto19=0;	
				while ($datos19= mysqli_fetch_array($query19)) {
					$total19+=$datos19['precioTotal'];
					$totalImpuesto19+=$datos19['impuesto']*$datos19['cantidad'];
				}
				$totalSinIva19=$total19-$totalImpuesto19;

				$sql5 = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1 AND ivaPorcentaje=5";
				$query5 = $this->con->returnConsulta($sql5);
				$total5=0;
				$totalImpuesto5=0;	
				while ($datos5= mysqli_fetch_array($query5)) {
					$total5+=$datos5['precioTotal'];
					$totalImpuesto5+=$datos5['impuesto']*$datos5['cantidad'];
				}
				$totalSinIva5=$total5-$totalImpuesto5;

				$sql0 = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail!=3 AND typeBillDetail=1 AND ivaPorcentaje=0";
				$query0 = $this->con->returnConsulta($sql0);
				$total0=0;
				$totalImpuesto0=0;	
				while ($datos0= mysqli_fetch_array($query0)) {
					$total0+=$datos0['precioTotal'];
					$totalImpuesto0+=$datos0['impuesto']*$datos0['cantidad'];
				}
				$totalSinIva0=$total0-$totalImpuesto0;

				$sqlNoR = "SELECT * FROM `billdetails` WHERE bills_idbills=$idbill AND stateBillDetail=1 AND typeBillDetail=2";
				$queryNoR = $this->con->returnConsulta($sqlNoR);
				$totalNoR=0;
				$totalImpuestoNoR=0;	
				while ($dataNoR= mysqli_fetch_array($queryNoR)) {
					$totalNoR+=$dataNoR['precioTotal'];
					$totalImpuestoNoR+=$dataNoR['impuesto']*$dataNoR['cantidad'];
				}
				$totalSinIvaNoR=$totalNoR-$totalImpuestoNoR;
				 
				$sqlUpd = "UPDATE `bills` SET `cliente` = '$clienteBills',`documentUser` = '$documentoBills',`baseIvaNoR` = '$totalSinIvaNoR',`ivaNoR` = '$totalImpuestoNoR',`total` = '$total',`baseIva5` = '$totalSinIva5', `iva5V` = '$totalImpuesto5',`baseIva19` = '$totalSinIva19', `iva19V` = '$totalImpuesto19', `totalSinIva` = '$totalSinIva', `baseIva0` = '$totalSinIva0',`comprobanteID` = '$numeroFactura' WHERE `bills`.`idbills` = $idbill";
				$queryUpd = $this->con->returnConsulta($sqlUpd);

				$idbills=$datos['idbills'];

				$sql = "UPDATE `bills` SET `revision` = '1' WHERE `bills`.`idbills` = $idbills";
				$query2 = $this->con->returnConsulta($sql);
			}
			

		header("location:" . URL . "contabilidad/compra2");
		//header("location:" . URL . "contabilidad/crear?tipo=codigo&error=codigo&". $inc."/". "/" . "");
		
		}

	public function create()
	{
		$connect = $this->con->connect();
		$codigoPuc1 = $this->codigoPuc;
		$nombrePuc1 = $this->nombrePuc;
		$detallePuc1 = $this->detallePuc;
		$base1 = $this->base;
		if($base1==""){
			$base1=0;
		}
		$tercero1 = $this->tercero;
		$exogena1 = $this->exogena;
		
		
		
		$codigoPuc = strtoupper($codigoPuc1);
		$nombrePuc = strtoupper($nombrePuc1);
		$detallePuc = strtoupper($detalle1);
		$sql = "SELECT * FROM puc WHERE codigo='$codigoPuc1' AND estado=1";
		$query = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($query);
		$array = mysqli_fetch_array($query);
		$longitud = strlen($codigoPuc);
		
		if($row>=1 OR $longitud==3 OR $longitud==5 OR $longitud>8){
			header('Location:?tipo=codigo&error');
		}else{
			$longitudCodigo=strlen($codigoPuc);
			if($longitudCodigo==8){
				$sql = "INSERT INTO `puc` (`codigo`, `nombre`, `fav`, `detalle`, `auxiliar`,`base`, `tercero`, `exogena`, `estado`) VALUES ('$codigoPuc', '$nombrePuc', '0', '$detallePuc', '1', '$base1', '$tercero1', '$exogena1',1)";
				$query = $this->con->returnConsulta($sql);
				if($query){
					$digito1=$codigoPuc[0];
					$digito2=$codigoPuc[1];
					$digito3=$codigoPuc[2];
					$digito4=$codigoPuc[3];
					$digito5=$codigoPuc[4];
					$digito6=$codigoPuc[5];
					$digito7=$codigoPuc[6];
					$digito8=$codigoPuc[7];
					$totalgrupo=$digito1.$digito2;
					$totalcuenta=$digito1.$digito2.$digito3.$digito4;
					$totalsubcuenta=$digito1.$digito2.$digito3.$digito4.$digito5.$digito6;
					$auxiliar=$digito1.$digito2.$digito3.$digito4.$digito5.$digito6.$digito7.$digito8;
					$sql2 = "INSERT INTO `puc_detalles` (`codigo`, `clase`, `grupo`, `cuenta`, `subcuenta`, `auxiliar`) VALUES ('$auxiliar', '$digito1', '$totalgrupo', '$totalcuenta', '$totalsubcuenta', '$auxiliar')";
					
					$query2 = $this->con->returnConsulta($sql2);

					


					header('Location:?tipo=codigo&success');
				}else{
					header('Location:?tipo=codigo&error=no_add');
				}
			}else{
				$sql = "INSERT INTO `puc` (`codigo`, `nombre`, `fav`, `detalle`, `auxiliar`) VALUES ('$codigoPuc', '$nombrePuc', '0', '$detallePuc', '0')";
				$query = $this->con->returnConsulta($sql);
				if($query){


					$idpuc=$codigoPuc;
					if($longitudCodigo==1){
					$digito1=$codigoPuc[0];
					$sql2 = "INSERT INTO `puc_detalles` (`codigo`, `clase`, `grupo`, `cuenta`, `subcuenta`, `auxiliar`) VALUES ('$idpuc', '$idpuc', '', '', '', '')";
						$query2 = $this->con->returnConsulta($sql2);
					}

					if($longitudCodigo==2){
						$clase=$codigoPuc[0];
						$digito2=$codigoPuc[1];
						$totalgrupo=$digito1.$digito2;
						$sql2 = "INSERT INTO `puc_detalles` (`codigo`, `clase`, `grupo`, `cuenta`, `subcuenta`, `auxiliar`) VALUES ('$idpuc', '$clase', '$totalgrupo', '', '', '')";
						$query2 = $this->con->returnConsulta($sql2);
					}
					if($longitudCodigo==4){
						$digito1=$codigoPuc[0];
						$digito2=$codigoPuc[1];
						$digito3=$codigoPuc[2];
						$digito4=$codigoPuc[3];
						$totalgrupo=$digito1.$digito2;
						$totalcuenta=$digito1.$digito2.$digito3.$digito4;
						$sql2 = "INSERT INTO `puc_detalles` (`codigo`, `clase`, `grupo`, `cuenta`, `subcuenta`, `auxiliar`) VALUES ('$idpuc', '$digito1', '$totalgrupo', '$totalcuenta', '', '')";
						$query2 = $this->con->returnConsulta($sql2);
					}
					if($longitudCodigo==6){
						$digito1=$codigoPuc[0];
						$digito2=$codigoPuc[1];
						$digito3=$codigoPuc[2];
						$digito4=$codigoPuc[3];
						$digito5=$codigoPuc[4];
						$digito6=$codigoPuc[5];
						$totalgrupo=$digito1.$digito2;
						$totalcuenta=$digito1.$digito2.$digito3.$digito4;
						$totalsubcuenta=$digito1.$digito2.$digito3.$digito4.$digito5.$digito6;
						$sql2 = "INSERT INTO `puc_detalles` (`codigo`, `clase`, `grupo`, `cuenta`, `subcuenta`, `auxiliar`) VALUES ('$idpuc', '$digito1', '$totalgrupo', '$totalcuenta', '$totalsubcuenta', '')";
						$query2 = $this->con->returnConsulta($sql2);
					}
					



					header('Location:?tipo=codigo&success');
				}else{
					header('Location:?tipo=codigo&error=no_add');
				}
			}
			
		}
	}

	public function procesarNotasContablesC()
	{
		$connect = $this->con->connect();
		$sql = "SELECT * FROM `bills` WHERE typebill=4    AND stateBill=1 AND notacontable=0";
		$query = $this->con->returnConsulta($sql);
		$inc=0;
			while($datos= mysqli_fetch_array($query)){
				$idbill=$datos['idbills'];
				$numeroFactura=$datos['numeroFactura'];
				$documentUser=$datos['documentUser'];
				$cliente=$datos['cliente'];
				$total=$datos['total'];
				$users_idusers=$datos['users_idusers'];
				$detalle="Factura de compra #$numeroFactura";
				$descripcion="Factura de compra #$numeroFactura por un valor total de $" . number_format($total) . " del proveedor $cliente";
				$inc ++;
				$fechaDMA = $datos['dateRegister']	;
				$fechaHora = date("G:i:s");

				$sql2 = "SELECT * FROM `registroscontables` WHERE tipoRegistro=2 AND notaContable=$numeroFactura";
				$query2 = $this->con->returnConsulta($sql2);
				$rowcont= mysqli_num_rows($query2);
				$totaldebito=0;
				$totalcredito=0;
				while($datos2= mysqli_fetch_array($query2)){
					$totaldebito+=$datos2['debito'];
					$totalcredito+=$datos2['credito'];
				}
				$diferencia=$totaldebito-$totalcredito;
				
				$sql3 = "INSERT INTO `notacontable` (`comprobante`, `terceroDocumento`, `terceroNombre`, `detalle`, `descripcion`, `cierre`, `fechaDMA`, `fechaHMs`, `usuarioCreador`, `totalDebito`, `totalCredito`, `cantidadCuentas`, `tipoNotacontable`, `estadoNotacontable`,`prefijo`, `tipoComprobante`) VALUES ('$numeroFactura', '$documentUser', '$cliente', '$detalle', '$descripcion', '0', '$fechaDMA', '', '$users_idusers', '$totaldebito', '$totalcredito', '100', '2', '1', 'FC', 'FACTURA DE COMPRA')";
				$query3 = $this->con->returnConsulta($sql3);


				$sql = "UPDATE `bills` SET `notacontable` = '1' WHERE `bills`.`idbills` = $idbill";
				$query2 = $this->con->returnConsulta($sql);
			}
		
		header("location:" . URL . "cajas?caja=compras");
		//header("location:" . URL . "contabilidad/crear?tipo=procesos&error=codigo&". $inc."/$numeroFactura". "/" . "");
		
	}

	public function procesarNotasContablesCFE()
	{
		$connect = $this->con->connect();
		$sql = "SELECT * FROM `bills` WHERE typebill=6  AND stateBill=1 AND notacontable=0";
		$query = $this->con->returnConsulta($sql);
		$inc=0;
			while($datos= mysqli_fetch_array($query)){
				$idbill=$datos['idbills'];
				$numeroFactura=$datos['numeroFactura'];
				$documentUser=$datos['documentUser'];
				$cliente=$datos['cliente'];
				$total=$datos['total'];
				$users_idusers=$datos['users_idusers'];
				$detalle="Factura de compra #$numeroFactura";
				$descripcion="Factura de compra electronica #$numeroFactura por un valor total de $" . number_format($total) . " del proveedor $cliente";
				$inc ++;
				$fechaDMA = $datos['dateRegister']	;
				$fechaHora = date("G:i:s");

				$sql2 = "SELECT * FROM `registroscontables` WHERE tipoRegistro=5001 AND notaContable=$numeroFactura";
				$query2 = $this->con->returnConsulta($sql2);
				$rowcont= mysqli_num_rows($query2);
				$totaldebito=0;
				$totalcredito=0;
				while($datos2= mysqli_fetch_array($query2)){
					$totaldebito+=$datos2['debito'];
					$totalcredito+=$datos2['credito'];
				}
				$diferencia=$totaldebito-$totalcredito;
				
				$sql3 = "INSERT INTO `notacontable` (`comprobante`, `terceroDocumento`, `terceroNombre`, `detalle`, `descripcion`, `cierre`, `fechaDMA`, `fechaHMs`, `usuarioCreador`, `totalDebito`, `totalCredito`, `cantidadCuentas`, `tipoNotacontable`, `estadoNotacontable`,`prefijo`, `tipoComprobante`) VALUES ('$numeroFactura', '$documentUser', '$cliente', '$detalle', '$descripcion', '0', '$fechaDMA', '', '$users_idusers', '$totaldebito', '$totalcredito', '100', '5001', '1', 'FCE', 'FACTURA DE COMPRA ELECTRONICA')";
				$query3 = $this->con->returnConsulta($sql3);


				$sql = "UPDATE `bills` SET `notacontable` = '1' WHERE `bills`.`idbills` = $idbill";
				$query2 = $this->con->returnConsulta($sql);
			}
		
		header("location:" . URL . "cajas?caja=compras");
		//header("location:" . URL . "contabilidad/crear?tipo=procesos&error=codigo&". $inc."/$numeroFactura". "/" . "");
		
	}

	public function procesarNotasContablesV()
	{
		$connect = $this->con->connect();
		$sql = "SELECT * FROM `bills` WHERE typebill=1 AND stateBill=1 AND notacontable=0";
		$query = $this->con->returnConsulta($sql);
		$inc=0;
				
			while($datos= mysqli_fetch_array($query)){
				$idbill=$datos['idbills'];
				$numeroFactura=$datos['numeroFactura'];
				$documentUser=$datos['documentUser'];
				$cliente=$datos['cliente'];
				$total=$datos['total'];
				$users_idusers=$datos['users_idusers'];
				$detalle="Factura de venta #$numeroFactura";
				$descripcion="Factura de venta #$numeroFactura por un valor total de $" . number_format($total) . " del cliente $cliente";
				$inc ++;

				$fechaDMA = $datos['dateRegister']	;
				$fechaHora = date("G:i:s");

				$sql2 = "SELECT * FROM `registroscontables` WHERE tipoRegistro=1 AND notaContable=$numeroFactura";
				$query2 = $this->con->returnConsulta($sql2);
				$rowcont= mysqli_num_rows($query2);
				$totaldebito=0;
				$totalcredito=0;
				while($datos2= mysqli_fetch_array($query2)){
					$totaldebito+=$datos2['debito'];
					$totalcredito+=$datos2['credito'];
				}
				$totaldebitoF=$totaldebito;
				$totalcreditoF=$totalcredito;
				$diferencia=$totaldebito-$totalcredito;
				
				$sql2 = "INSERT INTO `notacontable` (`comprobante`, `terceroDocumento`, `terceroNombre`, `detalle`, `descripcion`, `cierre`, `fechaDMA`, `fechaHMs`, `usuarioCreador`, `totalDebito`, `totalCredito`, `cantidadCuentas`, `tipoNotacontable`, `estadoNotacontable`, `diferencia`,`prefijo`, `tipoComprobante`) VALUES ('$numeroFactura', '$documentUser', '$cliente', '$detalle', '$descripcion', '0', '$fechaDMA', '', '$users_idusers', '$totaldebitoF', '$totalcreditoF', '100', '1', '1', '$diferencia', 'FV', 'FACTURA DE VENTA')";
				$query2 = $this->con->returnConsulta($sql2);

				
				$sql = "UPDATE `bills` SET `notacontable` = '1' WHERE `bills`.`idbills` = $idbill";
				$query2 = $this->con->returnConsulta($sql);
			}
		
			header("location:" . URL . "cajas?caja=ventas");
		
	}

	public function procesarNotasContablesVFE()
	{
		$connect = $this->con->connect();
		$sql = "SELECT * FROM `bills` WHERE typebill=3  AND stateBill=1 AND notacontable=0";
		$query = $this->con->returnConsulta($sql);
		$inc=0;
				
			while($datos= mysqli_fetch_array($query)){
				$idbill=$datos['idbills'];
				$numeroFactura=$datos['numeroFactura'];
				$documentUser=$datos['documentUser'];
				$cliente=$datos['cliente'];
				$total=$datos['total'];
				$users_idusers=$datos['users_idusers'];
				$detalle="Factura de venta #$numeroFactura";
				$descripcion="Factura de venta electronica #$numeroFactura por un valor total de $" . number_format($total) . " del cliente $cliente";
				$inc ++;

				$fechaDMA = $datos['dateRegister']	;
				$fechaHora = date("G:i:s");

				$sql2 = "SELECT * FROM `registroscontables` WHERE tipoRegistro=5000 AND notaContable=$numeroFactura";
				$query2 = $this->con->returnConsulta($sql2);
				$rowcont= mysqli_num_rows($query2);
				$totaldebito=0;
				$totalcredito=0;
				while($datos2= mysqli_fetch_array($query2)){
					$totaldebito+=$datos2['debito'];
					$totalcredito+=$datos2['credito'];
				}
				$totaldebitoF=$totaldebito;
				$totalcreditoF=$totalcredito;
				$diferencia=$totaldebito-$totalcredito;
				
				$sql2 = "INSERT INTO `notacontable` (`comprobante`, `terceroDocumento`, `terceroNombre`, `detalle`, `descripcion`, `cierre`, `fechaDMA`, `fechaHMs`, `usuarioCreador`, `totalDebito`, `totalCredito`, `cantidadCuentas`, `tipoNotacontable`, `estadoNotacontable`, `diferencia`,`prefijo`, `tipoComprobante`) VALUES ('$numeroFactura', '$documentUser', '$cliente', '$detalle', '$descripcion', '0', '$fechaDMA', '', '$users_idusers', '$totaldebitoF', '$totalcreditoF', '100', '5000', '1', '$diferencia', 'FVE', 'FACTURA DE VENTA ELECTRONICA')";
				$query2 = $this->con->returnConsulta($sql2);

				
				$sql = "UPDATE `bills` SET `notacontable` = '1' WHERE `bills`.`idbills` = $idbill";
				$query2 = $this->con->returnConsulta($sql);
			}
		
			header("location:" . URL . "cajas?caja=ventas");
		
	}

	

	public function procesarCuentas()
	{
		$connect = $this->con->connect();
		$sql = "SELECT * FROM `puc`";
		$query = $this->con->returnConsulta($sql);
		$inc=0;
			while($datos= mysqli_fetch_array($query)){
				$codigo=$datos['codigo'];
				$nombre=$datos['nombre'];
				$longitud= strlen($codigo);
				if($longitud==1){
					$clase=$codigo;			
				}else{
					$clase=NULL;
				}
				if($longitud==2){
					$clase=$codigo;			
				}else{
					$clase=NULL;
				}
				$sql = "INSERT INTO `cuentas` (`codigo`,`clase`, `grupo`, `cuenta`, `subcuenta`, `auxiliar`, `nombre`, `estado`, `tipo`) VALUES ('$codigo', '$clase', NULL, NULL, NULL,NULL, '$nombre', '1', '1')";
				$query2 = $this->con->returnConsulta($sql);	
			}
		
		//header("location:" . URL . "cajas?caja=ventas");
		//header("location:" . URL . "contabilidad/crear?tipo=codigo&error=codigo&". $longitud."/". "/" . "");
		
	}

	public function procesarRegistrosContablesV()
	{
		$connect = $this->con->connect();
		$sql = "SELECT * FROM `bills` WHERE typebill=1 AND contabilidad=0 AND stateBill=1";
		$query = $this->con->returnConsulta($sql);
		$inc=0;
		while($datos= mysqli_fetch_array($query)){
			$inc++;
			$numeroFactura=$datos['numeroFactura'];
			$terceroNombre=$datos['cliente'];
			$terceroDoc=$datos['documentUser'];
			$fecha=$datos['dateRegister'];

			//PRIMER REGRISTRO
			$credito=$datos['totalSinIva'];
			
			if($credito>0){
				
				$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=1";
				$query2 = $this->con->returnConsulta($sql);	
				while($datos2= mysqli_fetch_array($query2)){
					$codigo=$datos2['codigo'];
					$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
						
					$query2 = $this->con->returnConsulta($sql);	
					$datos3= mysqli_fetch_array($query2);
					$nombrecodigo=$datos3['nombre'];
					$valorpucdebito=$datos3['totaldebito'];
					$valorpuccredito=$datos3['totalcredito'];
				}
				$totalcreditopuc=$credito+$valorpuccredito;
				
				$creditoR1=$datos['baseIva0'];

				if($creditoR1>0){
					$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','1', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '', '', '0', '$creditoR1', '', '1')";
					$query2 = $this->con->returnConsulta($sql);
				}

				

				$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=7";
				$query2 = $this->con->returnConsulta($sql);	
				while($datos2= mysqli_fetch_array($query2)){
					$codigo=$datos2['codigo'];
					$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
					$query2 = $this->con->returnConsulta($sql);	
					$datos3= mysqli_fetch_array($query2);
					$nombrecodigo=$datos3['nombre'];
					$valorpucdebito=$datos3['totaldebito'];
					$valorpuccredito=$datos3['totalcredito'];
				}
				$totalcreditopuc=$credito+$valorpuccredito;
				
				$creditoR1=$datos['baseIva5'];

				if($creditoR1>0){
					$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','1', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '', '', '0', '$creditoR1', '', '1')";
					$query2 = $this->con->returnConsulta($sql);
				}


				$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=8";
				$query2 = $this->con->returnConsulta($sql);	
				while($datos2= mysqli_fetch_array($query2)){
					$codigo=$datos2['codigo'];
					$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
					$query2 = $this->con->returnConsulta($sql);	
					$datos3= mysqli_fetch_array($query2);
					$nombrecodigo=$datos3['nombre'];
					$valorpucdebito=$datos3['totaldebito'];
					$valorpuccredito=$datos3['totalcredito'];
				}
				$totalcreditopuc=$credito+$valorpuccredito;
				
				$creditoR1=$datos['baseIva19'];

				if($creditoR1>0){
					$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','1', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '', '', '0', '$creditoR1', '', '1')";
					$query2 = $this->con->returnConsulta($sql);
				}


				
				
	
				

				

				$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
				$query3 = $this->con->returnConsulta($sql);	
				$datos4= mysqli_fetch_array($query3);
				$codigoclase=$datos4['clase'];
				$codigogrupo=$datos4['grupo'];
				$codigocuenta=$datos4['cuenta'];
				$codigosubcuenta=$datos4['subcuenta'];
				$codigoauxiliar=$datos4['auxiliar'];

				
				
				$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
				$query5 = $this->con->returnConsulta($sql5);	
				$datos5= mysqli_fetch_array($query5);
				$totalclasedebito=$datos5['totaldebito']+$debito;
				$totalclasecredito=$datos5['totalcredito']+$credito;
				
				
				
	
				//SEGUNDO REGISTRO EL IVA AL 19
				$credito=$datos['iva19V'];
				$base19=$datos['baseIva19'];
				if($base19>0){
					$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=2";
					$query2 = $this->con->returnConsulta($sql);	
					while($datos2= mysqli_fetch_array($query2)){
						$codigo=$datos2['codigo'];
						$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
						$query2 = $this->con->returnConsulta($sql);	
						$datos3= mysqli_fetch_array($query2);
						$nombrecodigo=$datos3['nombre'];
						$detalle=$datos3['detalle'];
						$valorpucdebito=$datos3['totaldebito'];
						$valorpuccredito=$datos3['totalcredito'];
					}
					$totalcreditopuc=$credito+$valorpuccredito;
					$detalle=$detalle." ".number_format($base19);
		
					$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','1', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '$detalle', '', '0', '$credito', '', '1')";
					$query2 = $this->con->returnConsulta($sql);
					
					

					
					$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
					$query3 = $this->con->returnConsulta($sql);	
					$datos4= mysqli_fetch_array($query3);
					$codigoclase=$datos4['clase'];
					$codigogrupo=$datos4['grupo'];
					$codigocuenta=$datos4['cuenta'];
					$codigosubcuenta=$datos4['subcuenta'];
					$codigoauxiliar=$datos4['auxiliar'];

					
					
					$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
					$query5 = $this->con->returnConsulta($sql5);	
					$datos5= mysqli_fetch_array($query5);
					$totalclasedebito=$datos5['totaldebito']+$debito;
					$totalclasecredito=$datos5['totalcredito']+$credito;
					
					


				}
				
	
				//TERCER REGISTRO EL IVA AL 5
				$credito=$datos['iva5V'];
				$base19=$datos['baseIva5'];
				if($base19>0){
					$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=3";
					$query2 = $this->con->returnConsulta($sql);	
					while($datos2= mysqli_fetch_array($query2)){
						$codigo=$datos2['codigo'];
						$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
						$query2 = $this->con->returnConsulta($sql);	
						$datos3= mysqli_fetch_array($query2);
						$nombrecodigo=$datos3['nombre'];
						$detalle=$datos3['detalle'];
						$valorpucdebito=$datos3['totaldebito'];
						$valorpuccredito=$datos3['totalcredito'];
					}
					$totalcreditopuc=$credito+$valorpuccredito;
					$detalle=$detalle." ".number_format($base19);
		
					$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','1', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '$detalle', '', '0', '$credito', '', '1')";
					$query2 = $this->con->returnConsulta($sql);

					$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
					$query3 = $this->con->returnConsulta($sql);	
					$datos4= mysqli_fetch_array($query3);
					$codigoclase=$datos4['clase'];
					$codigogrupo=$datos4['grupo'];
					$codigocuenta=$datos4['cuenta'];
					$codigosubcuenta=$datos4['subcuenta'];
					$codigoauxiliar=$datos4['auxiliar'];

					
					
					$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
					$query5 = $this->con->returnConsulta($sql5);	
					$datos5= mysqli_fetch_array($query5);
					$totalclasedebito=$datos5['totaldebito']+$debito;
					$totalclasecredito=$datos5['totalcredito']+$credito;
					
					
				}
	
				//CUARTO REGISTRO LA CAJA GENERAL
				$debito=$datos['total'];
				$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=4";
				$query2 = $this->con->returnConsulta($sql);	
				while($datos2= mysqli_fetch_array($query2)){
					$codigo=$datos2['codigo'];
					$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
					$query2 = $this->con->returnConsulta($sql);	
					$datos3= mysqli_fetch_array($query2);
					$nombrecodigo=$datos3['nombre'];
					$detalle=$datos3['detalle'];
					$valorpucdebito=$datos3['totaldebito'];
					$valorpuccredito=$datos3['totalcredito'];
				}
				$totaldebitopuc=$debito+$valorpucdebito;
				$detalle=$detalle." ".number_format($debito) . ")";
	
				$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','1', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '', '', '$debito', '0', '', '1')";
				$query2 = $this->con->returnConsulta($sql);


				$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
				$query3 = $this->con->returnConsulta($sql);	
				$datos4= mysqli_fetch_array($query3);
				$codigoclase=$datos4['clase'];
				$codigogrupo=$datos4['grupo'];
				$codigocuenta=$datos4['cuenta'];
				$codigosubcuenta=$datos4['subcuenta'];
				$codigoauxiliar=$datos4['auxiliar'];

				
				
				$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
				$query5 = $this->con->returnConsulta($sql5);	
				$datos5= mysqli_fetch_array($query5);
				$totalclasedebito=$datos5['totaldebito']+$debito;
				$totalclasecredito=$datos5['totalcredito']+$credito;

				
				
	
				
				//QUINTO REGISTRO DEBITO COSTO
				$credito=$datos['precioCostoSiniVA'];
				$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=5";
				$query2 = $this->con->returnConsulta($sql);	
				while($datos2= mysqli_fetch_array($query2)){
					$codigo=$datos2['codigo'];
					$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
					$query2 = $this->con->returnConsulta($sql);	
					$datos3= mysqli_fetch_array($query2);
					$nombrecodigo=$datos3['nombre'];
					$detalle=$datos3['detalle'];
					$valorpucdebito=$datos3['totaldebito'];
					$valorpuccredito=$datos3['totalcredito'];
				}
				$totalcreditopuc=$credito+$valorpuccredito;
	
				$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','1', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '', '', '0', '$credito', '', '1')";
				$query2 = $this->con->returnConsulta($sql);

				$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
					$query3 = $this->con->returnConsulta($sql);	
					$datos4= mysqli_fetch_array($query3);
					$codigoclase=$datos4['clase'];
					$codigogrupo=$datos4['grupo'];
					$codigocuenta=$datos4['cuenta'];
					$codigosubcuenta=$datos4['subcuenta'];
					$codigoauxiliar=$datos4['auxiliar'];

					
					
					$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
					$query5 = $this->con->returnConsulta($sql5);	
					$datos5= mysqli_fetch_array($query5);
					$totalclasedebito=$datos5['totaldebito']+$debito;
					$totalclasecredito=$datos5['totalcredito']+$credito;
					
					
	
				//SEXTO REGISTRO CREDITO COSTO
				$debito=$datos['precioCostoSiniVA'];
				$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=6";
				$query2 = $this->con->returnConsulta($sql);	
				while($datos2= mysqli_fetch_array($query2)){
					$codigo=$datos2['codigo'];
					$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
					$query2 = $this->con->returnConsulta($sql);	
					$datos3= mysqli_fetch_array($query2);
					$nombrecodigo=$datos3['nombre'];
					$detalle=$datos3['detalle'];
					$valorpucdebito=$datos3['totaldebito'];
					$valorpuccredito=$datos3['totalcredito'];
				}
				$totaldebitopuc=$credito+$valorpucdebito;
	
	
				$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','1', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '', '', '$debito', '0', '', '1')";
				$query2 = $this->con->returnConsulta($sql);

				$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
				$query3 = $this->con->returnConsulta($sql);	
				$datos4= mysqli_fetch_array($query3);
				$codigoclase=$datos4['clase'];
				$codigogrupo=$datos4['grupo'];
				$codigocuenta=$datos4['cuenta'];
				$codigosubcuenta=$datos4['subcuenta'];
				$codigoauxiliar=$datos4['auxiliar'];

				
				
				$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
				$query5 = $this->con->returnConsulta($sql5);	
				$datos5= mysqli_fetch_array($query5);
				$totalclasedebito=$datos5['totaldebito']+$debito;
				$totalclasecredito=$datos5['totalcredito']+$credito;

				
				
			}

			$idbills=$datos['idbills'];

			$sql = "UPDATE `bills` SET `contabilidad` = '1' WHERE `bills`.`idbills` = $idbills";
			$query2 = $this->con->returnConsulta($sql);
			
			
			
			
		}
		
		header("location:" . URL . "contabilidad/venta3");
		
	}

	public function procesarRegistrosContablesVFE()
	{
		$connect = $this->con->connect();
		$sql = "SELECT * FROM `bills` WHERE typebill=3  AND contabilidad=0 AND stateBill=1";
		$query = $this->con->returnConsulta($sql);
		$inc=0;
		while($datos= mysqli_fetch_array($query)){
			$inc++;
			$numeroFactura=$datos['numeroFactura'];
			$terceroNombre=$datos['cliente'];
			$terceroDoc=$datos['documentUser'];
			$fecha=$datos['dateRegister'];

			//PRIMER REGRISTRO
			$credito=$datos['totalSinIva'];
			
			if($credito>0){
				
				$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=1";
				$query2 = $this->con->returnConsulta($sql);	
				while($datos2= mysqli_fetch_array($query2)){
					$codigo=$datos2['codigo'];
					$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
						
					$query2 = $this->con->returnConsulta($sql);	
					$datos3= mysqli_fetch_array($query2);
					$nombrecodigo=$datos3['nombre'];
					$valorpucdebito=$datos3['totaldebito'];
					$valorpuccredito=$datos3['totalcredito'];
				}
				$totalcreditopuc=$credito+$valorpuccredito;
				
				$creditoR1=$datos['baseIva0'];

				if($creditoR1>0){
					$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','5000', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '', '', '0', '$creditoR1', '', '1')";
					$query2 = $this->con->returnConsulta($sql);
				}

				

				$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=7";
				$query2 = $this->con->returnConsulta($sql);	
				while($datos2= mysqli_fetch_array($query2)){
					$codigo=$datos2['codigo'];
					$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
					$query2 = $this->con->returnConsulta($sql);	
					$datos3= mysqli_fetch_array($query2);
					$nombrecodigo=$datos3['nombre'];
					$valorpucdebito=$datos3['totaldebito'];
					$valorpuccredito=$datos3['totalcredito'];
				}
				$totalcreditopuc=$credito+$valorpuccredito;
				
				$creditoR1=$datos['baseIva5'];

				if($creditoR1>0){
					$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','5000', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '', '', '0', '$creditoR1', '', '1')";
					$query2 = $this->con->returnConsulta($sql);
				}


				$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=8";
				$query2 = $this->con->returnConsulta($sql);	
				while($datos2= mysqli_fetch_array($query2)){
					$codigo=$datos2['codigo'];
					$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
					$query2 = $this->con->returnConsulta($sql);	
					$datos3= mysqli_fetch_array($query2);
					$nombrecodigo=$datos3['nombre'];
					$valorpucdebito=$datos3['totaldebito'];
					$valorpuccredito=$datos3['totalcredito'];
				}
				$totalcreditopuc=$credito+$valorpuccredito;
				
				$creditoR1=$datos['baseIva19'];

				if($creditoR1>0){
					$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','5000', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '', '', '0', '$creditoR1', '', '1')";
					$query2 = $this->con->returnConsulta($sql);
				}


				
				
	
				

				

				$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
				$query3 = $this->con->returnConsulta($sql);	
				$datos4= mysqli_fetch_array($query3);
				$codigoclase=$datos4['clase'];
				$codigogrupo=$datos4['grupo'];
				$codigocuenta=$datos4['cuenta'];
				$codigosubcuenta=$datos4['subcuenta'];
				$codigoauxiliar=$datos4['auxiliar'];

				
				
				$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
				$query5 = $this->con->returnConsulta($sql5);	
				$datos5= mysqli_fetch_array($query5);
				$totalclasedebito=$datos5['totaldebito']+$debito;
				$totalclasecredito=$datos5['totalcredito']+$credito;
				
				
				
	
				//SEGUNDO REGISTRO EL IVA AL 19
				$credito=$datos['iva19V'];
				$base19=$datos['baseIva19'];
				if($base19>0){
					$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=2";
					$query2 = $this->con->returnConsulta($sql);	
					while($datos2= mysqli_fetch_array($query2)){
						$codigo=$datos2['codigo'];
						$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
						$query2 = $this->con->returnConsulta($sql);	
						$datos3= mysqli_fetch_array($query2);
						$nombrecodigo=$datos3['nombre'];
						$detalle=$datos3['detalle'];
						$valorpucdebito=$datos3['totaldebito'];
						$valorpuccredito=$datos3['totalcredito'];
					}
					$totalcreditopuc=$credito+$valorpuccredito;
					$detalle=$detalle." ".number_format($base19);
		
					$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','5000', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '$detalle', '', '0', '$credito', '', '1')";
					$query2 = $this->con->returnConsulta($sql);
					
					

					
					$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
					$query3 = $this->con->returnConsulta($sql);	
					$datos4= mysqli_fetch_array($query3);
					$codigoclase=$datos4['clase'];
					$codigogrupo=$datos4['grupo'];
					$codigocuenta=$datos4['cuenta'];
					$codigosubcuenta=$datos4['subcuenta'];
					$codigoauxiliar=$datos4['auxiliar'];

					
					
					$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
					$query5 = $this->con->returnConsulta($sql5);	
					$datos5= mysqli_fetch_array($query5);
					$totalclasedebito=$datos5['totaldebito']+$debito;
					$totalclasecredito=$datos5['totalcredito']+$credito;
					
					


				}
				
	
				//TERCER REGISTRO EL IVA AL 5
				$credito=$datos['iva5V'];
				$base19=$datos['baseIva5'];
				if($base19>0){
					$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=3";
					$query2 = $this->con->returnConsulta($sql);	
					while($datos2= mysqli_fetch_array($query2)){
						$codigo=$datos2['codigo'];
						$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
						$query2 = $this->con->returnConsulta($sql);	
						$datos3= mysqli_fetch_array($query2);
						$nombrecodigo=$datos3['nombre'];
						$detalle=$datos3['detalle'];
						$valorpucdebito=$datos3['totaldebito'];
						$valorpuccredito=$datos3['totalcredito'];
					}
					$totalcreditopuc=$credito+$valorpuccredito;
					$detalle=$detalle." ".number_format($base19);
		
					$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','5000', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '$detalle', '', '0', '$credito', '', '1')";
					$query2 = $this->con->returnConsulta($sql);

					$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
					$query3 = $this->con->returnConsulta($sql);	
					$datos4= mysqli_fetch_array($query3);
					$codigoclase=$datos4['clase'];
					$codigogrupo=$datos4['grupo'];
					$codigocuenta=$datos4['cuenta'];
					$codigosubcuenta=$datos4['subcuenta'];
					$codigoauxiliar=$datos4['auxiliar'];

					
					
					$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
					$query5 = $this->con->returnConsulta($sql5);	
					$datos5= mysqli_fetch_array($query5);
					$totalclasedebito=$datos5['totaldebito']+$debito;
					$totalclasecredito=$datos5['totalcredito']+$credito;
					
					
				}
	
				//CUARTO REGISTRO LA CAJA GENERAL
				$debito=$datos['total'];
				$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=4";
				$query2 = $this->con->returnConsulta($sql);	
				while($datos2= mysqli_fetch_array($query2)){
					$codigo=$datos2['codigo'];
					$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
					$query2 = $this->con->returnConsulta($sql);	
					$datos3= mysqli_fetch_array($query2);
					$nombrecodigo=$datos3['nombre'];
					$detalle=$datos3['detalle'];
					$valorpucdebito=$datos3['totaldebito'];
					$valorpuccredito=$datos3['totalcredito'];
				}
				$totaldebitopuc=$debito+$valorpucdebito;
				$detalle=$detalle." ".number_format($debito) . ")";
	
				$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','5000', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '', '', '$debito', '0', '', '1')";
				$query2 = $this->con->returnConsulta($sql);


				$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
				$query3 = $this->con->returnConsulta($sql);	
				$datos4= mysqli_fetch_array($query3);
				$codigoclase=$datos4['clase'];
				$codigogrupo=$datos4['grupo'];
				$codigocuenta=$datos4['cuenta'];
				$codigosubcuenta=$datos4['subcuenta'];
				$codigoauxiliar=$datos4['auxiliar'];

				
				
				$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
				$query5 = $this->con->returnConsulta($sql5);	
				$datos5= mysqli_fetch_array($query5);
				$totalclasedebito=$datos5['totaldebito']+$debito;
				$totalclasecredito=$datos5['totalcredito']+$credito;

				
				
	
				
				//QUINTO REGISTRO DEBITO COSTO
				$credito=$datos['precioCostoSiniVA'];
				$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=5";
				$query2 = $this->con->returnConsulta($sql);	
				while($datos2= mysqli_fetch_array($query2)){
					$codigo=$datos2['codigo'];
					$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
					$query2 = $this->con->returnConsulta($sql);	
					$datos3= mysqli_fetch_array($query2);
					$nombrecodigo=$datos3['nombre'];
					$detalle=$datos3['detalle'];
					$valorpucdebito=$datos3['totaldebito'];
					$valorpuccredito=$datos3['totalcredito'];
				}
				$totalcreditopuc=$credito+$valorpuccredito;
	
				$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','5000', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '', '', '0', '$credito', '', '1')";
				$query2 = $this->con->returnConsulta($sql);

				$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
					$query3 = $this->con->returnConsulta($sql);	
					$datos4= mysqli_fetch_array($query3);
					$codigoclase=$datos4['clase'];
					$codigogrupo=$datos4['grupo'];
					$codigocuenta=$datos4['cuenta'];
					$codigosubcuenta=$datos4['subcuenta'];
					$codigoauxiliar=$datos4['auxiliar'];

					
					
					$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
					$query5 = $this->con->returnConsulta($sql5);	
					$datos5= mysqli_fetch_array($query5);
					$totalclasedebito=$datos5['totaldebito']+$debito;
					$totalclasecredito=$datos5['totalcredito']+$credito;
					
					
	
				//SEXTO REGISTRO CREDITO COSTO
				$debito=$datos['precioCostoSiniVA'];
				$sql = "SELECT * FROM `codigospred` WHERE tipo=1 AND pos=6";
				$query2 = $this->con->returnConsulta($sql);	
				while($datos2= mysqli_fetch_array($query2)){
					$codigo=$datos2['codigo'];
					$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
					$query2 = $this->con->returnConsulta($sql);	
					$datos3= mysqli_fetch_array($query2);
					$nombrecodigo=$datos3['nombre'];
					$detalle=$datos3['detalle'];
					$valorpucdebito=$datos3['totaldebito'];
					$valorpuccredito=$datos3['totalcredito'];
				}
				$totaldebitopuc=$credito+$valorpucdebito;
	
	
				$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','5000', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '', '', '$debito', '0', '', '1')";
				$query2 = $this->con->returnConsulta($sql);

				$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
				$query3 = $this->con->returnConsulta($sql);	
				$datos4= mysqli_fetch_array($query3);
				$codigoclase=$datos4['clase'];
				$codigogrupo=$datos4['grupo'];
				$codigocuenta=$datos4['cuenta'];
				$codigosubcuenta=$datos4['subcuenta'];
				$codigoauxiliar=$datos4['auxiliar'];

				
				
				$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
				$query5 = $this->con->returnConsulta($sql5);	
				$datos5= mysqli_fetch_array($query5);
				$totalclasedebito=$datos5['totaldebito']+$debito;
				$totalclasecredito=$datos5['totalcredito']+$credito;

				
				
			}

			$idbills=$datos['idbills'];

			$sql = "UPDATE `bills` SET `contabilidad` = '1' WHERE `bills`.`idbills` = $idbills";
			$query2 = $this->con->returnConsulta($sql);
			
			
			
			
		}
		
		header("location:" . URL . "contabilidad/venta3");
		
	}


	public function procesarRegistrosContablesC()
	{

		$connect = $this->con->connect();
		$sql = "SELECT * FROM `bills` WHERE typebill=4 AND contabilidad=0 AND stateBill=1 ";
		$query = $this->con->returnConsulta($sql);
		$inc=0;
		while($datos= mysqli_fetch_array($query)){
			$inc++;
			$numeroFactura=$datos['numeroFactura'];
			$terceroNombre=$datos['cliente'];
			$terceroDoc=$datos['documentUser'];
			$fecha=$datos['dateRegister'];

			//PRIMER REGRISTRO LA 
			$debito=$datos['totalSinIva'];
			$credito=0;
			
			if($debito>0){
				
			$sql = "SELECT * FROM `codigospred` WHERE tipo=2 AND pos=1";
			$query2 = $this->con->returnConsulta($sql);	
			while($datos2= mysqli_fetch_array($query2)){
				$codigo=$datos2['codigo'];
				$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
				$query2 = $this->con->returnConsulta($sql);	
				$datos3= mysqli_fetch_array($query2);
				$nombrecodigo=$datos3['nombre'];
				$valorpucdebito=$datos3['totaldebito'];
				$valorpuccredito=$datos3['totalcredito'];
			}
			$totaldebitopuc=$debito+$valorpucdebito;
			$totalcreditopuc=$credito+$valorpuccredito;
			
			$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','2', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '', '', '$debito', '$credito', '', '1')";
			$query2 = $this->con->returnConsulta($sql);

			$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
			$query3 = $this->con->returnConsulta($sql);	
			$datos4= mysqli_fetch_array($query3);
			$codigoclase=$datos4['clase'];
			$codigogrupo=$datos4['grupo'];
			$codigocuenta=$datos4['cuenta'];
			$codigosubcuenta=$datos4['subcuenta'];
			$codigoauxiliar=$datos4['auxiliar'];

			
			
			$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
			$query5 = $this->con->returnConsulta($sql5);	
			$datos5= mysqli_fetch_array($query5);
			$totalclasedebito=$datos5['totaldebito']+$debito;
			$totalclasecredito=$datos5['totalcredito']+$credito;

			
			

			
			}

			//SEGUNDO REGRISTRO IVA19 
			$debito=$datos['iva19V'];
			$credito=0;
			$base19=$datos['baseIva19'];
			
			if($debito>0){
				
			$sql = "SELECT * FROM `codigospred` WHERE tipo=2 AND pos=2";
			$query2 = $this->con->returnConsulta($sql);	
			while($datos2= mysqli_fetch_array($query2)){
				$codigo=$datos2['codigo'];
				$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
				$query2 = $this->con->returnConsulta($sql);	
				$datos3= mysqli_fetch_array($query2);
				$nombrecodigo=$datos3['nombre'];
				$detalle=$datos3['detalle'];
				$valorpucdebito=$datos3['totaldebito'];
				$valorpuccredito=$datos3['totalcredito'];
			}
			$totaldebitopuc=$debito+$valorpucdebito;
			$totalcreditopuc=$credito+$valorpuccredito;
			$detalle=$detalle." ".number_format($base19);


			$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','2', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '$detalle', '', '$debito', '$credito', '', '1')";
			$query2 = $this->con->returnConsulta($sql);
			
			$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
			$query3 = $this->con->returnConsulta($sql);	
			$datos4= mysqli_fetch_array($query3);
			$codigoclase=$datos4['clase'];
			$codigogrupo=$datos4['grupo'];
			$codigocuenta=$datos4['cuenta'];
			$codigosubcuenta=$datos4['subcuenta'];
			$codigoauxiliar=$datos4['auxiliar'];

			
			
			$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
			$query5 = $this->con->returnConsulta($sql5);	
			$datos5= mysqli_fetch_array($query5);
			$totalclasedebito=$datos5['totaldebito']+$debito;
			$totalclasecredito=$datos5['totalcredito']+$credito;

			}

			//TERCERO REGRISTRO IVA5 
			$debito=$datos['iva5V'];
			$credito=0;
			$base19=$datos['baseIva5'];
			
			if($debito>0){
				
			$sql = "SELECT * FROM `codigospred` WHERE tipo=2 AND pos=3";
			$query2 = $this->con->returnConsulta($sql);	
			while($datos2= mysqli_fetch_array($query2)){
				$codigo=$datos2['codigo'];
				$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
				$query2 = $this->con->returnConsulta($sql);	
				$datos3= mysqli_fetch_array($query2);
				$nombrecodigo=$datos3['nombre'];
				$detalle=$datos3['detalle'];
				$valorpucdebito=$datos3['totaldebito'];
				$valorpuccredito=$datos3['totalcredito'];
			}
			$totaldebitopuc=$debito+$valorpucdebito;
			$totalcreditopuc=$credito+$valorpuccredito;
			$detalle=$detalle." ".number_format($base19);


			$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','2', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '$detalle', '', '$debito', '$credito', '', '1')";
			$query2 = $this->con->returnConsulta($sql);
			$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
			$query3 = $this->con->returnConsulta($sql);	
			$datos4= mysqli_fetch_array($query3);
			$codigoclase=$datos4['clase'];
			$codigogrupo=$datos4['grupo'];
			$codigocuenta=$datos4['cuenta'];
			$codigosubcuenta=$datos4['subcuenta'];
			$codigoauxiliar=$datos4['auxiliar'];

			
			
			$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
			$query5 = $this->con->returnConsulta($sql5);	
			$datos5= mysqli_fetch_array($query5);
			$totalclasedebito=$datos5['totaldebito']+$debito;
			$totalclasecredito=$datos5['totalcredito']+$credito;

			
			
			}

			//CUARTO CREDITO CAJA 
			$debito=0;
			$credito=$datos['total'];
			$base19=$datos['baseIva5'];
			
			if($credito>0){
				
			$sql = "SELECT * FROM `codigospred` WHERE tipo=2 AND pos=4";
			$query2 = $this->con->returnConsulta($sql);	
			while($datos2= mysqli_fetch_array($query2)){
				$codigo=$datos2['codigo'];
				$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
				$query2 = $this->con->returnConsulta($sql);	
				$datos3= mysqli_fetch_array($query2);
				$nombrecodigo=$datos3['nombre'];
				$detalle=$datos3['detalle'];
				$valorpucdebito=$datos3['totaldebito'];
				$valorpuccredito=$datos3['totalcredito'];
			}
			$totaldebitopuc=$debito+$valorpucdebito;
			$totalcreditopuc=$credito+$valorpuccredito;
			$detalle=$detalle." ".number_format($base19);


			$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','2', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '$detalle', '', '$debito', '$credito', '', '1')";
			$query2 = $this->con->returnConsulta($sql);
			$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
			$query3 = $this->con->returnConsulta($sql);	
			$datos4= mysqli_fetch_array($query3);
			$codigoclase=$datos4['clase'];
			$codigogrupo=$datos4['grupo'];
			$codigocuenta=$datos4['cuenta'];
			$codigosubcuenta=$datos4['subcuenta'];
			$codigoauxiliar=$datos4['auxiliar'];

			
			
			$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
			$query5 = $this->con->returnConsulta($sql5);	
			$datos5= mysqli_fetch_array($query5);
			$totalclasedebito=$datos5['totaldebito']+$debito;
			$totalclasecredito=$datos5['totalcredito']+$credito;

			

			$idbills=$datos['idbills'];

			$sql = "UPDATE `bills` SET `contabilidad` = '1' WHERE `bills`.`idbills` = $idbills";
			$query2 = $this->con->returnConsulta($sql);	

			

			}


		}
		header("location:" . URL . "contabilidad/compra3");
		//header("location:" . URL . "contabilidad/crear?tipo=codigo&error=codigo&". $inc."/". "/" . "");

	}

	public function procesarRegistrosContablesCFE()
	{

		$connect = $this->con->connect();
		$sql = "SELECT * FROM `bills` WHERE typebill=6 AND contabilidad=0 AND stateBill=1";
		$query = $this->con->returnConsulta($sql);
		$inc=0;
		while($datos= mysqli_fetch_array($query)){
			$inc++;
			$numeroFactura=$datos['numeroFactura'];
			$terceroNombre=$datos['cliente'];
			$terceroDoc=$datos['documentUser'];
			$fecha=$datos['dateRegister'];

			//PRIMER REGRISTRO LA 
			$debito=$datos['totalSinIva'];
			$credito=0;
			
			if($debito>0){
				
			$sql = "SELECT * FROM `codigospred` WHERE tipo=2 AND pos=1";
			$query2 = $this->con->returnConsulta($sql);	
			while($datos2= mysqli_fetch_array($query2)){
				$codigo=$datos2['codigo'];
				$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
				$query2 = $this->con->returnConsulta($sql);	
				$datos3= mysqli_fetch_array($query2);
				$nombrecodigo=$datos3['nombre'];
				$valorpucdebito=$datos3['totaldebito'];
				$valorpuccredito=$datos3['totalcredito'];
			}
			$totaldebitopuc=$debito+$valorpucdebito;
			$totalcreditopuc=$credito+$valorpuccredito;
			
			$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','5001', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '', '', '$debito', '$credito', '', '1')";
			$query2 = $this->con->returnConsulta($sql);

			$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
			$query3 = $this->con->returnConsulta($sql);	
			$datos4= mysqli_fetch_array($query3);
			$codigoclase=$datos4['clase'];
			$codigogrupo=$datos4['grupo'];
			$codigocuenta=$datos4['cuenta'];
			$codigosubcuenta=$datos4['subcuenta'];
			$codigoauxiliar=$datos4['auxiliar'];

			
			
			$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
			$query5 = $this->con->returnConsulta($sql5);	
			$datos5= mysqli_fetch_array($query5);
			$totalclasedebito=$datos5['totaldebito']+$debito;
			$totalclasecredito=$datos5['totalcredito']+$credito;

			
			

			
			}

			//SEGUNDO REGRISTRO IVA19 
			$debito=$datos['iva19V'];
			$credito=0;
			$base19=$datos['baseIva19'];
			
			if($debito>0){
				
			$sql = "SELECT * FROM `codigospred` WHERE tipo=2 AND pos=2";
			$query2 = $this->con->returnConsulta($sql);	
			while($datos2= mysqli_fetch_array($query2)){
				$codigo=$datos2['codigo'];
				$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
				$query2 = $this->con->returnConsulta($sql);	
				$datos3= mysqli_fetch_array($query2);
				$nombrecodigo=$datos3['nombre'];
				$detalle=$datos3['detalle'];
				$valorpucdebito=$datos3['totaldebito'];
				$valorpuccredito=$datos3['totalcredito'];
			}
			$totaldebitopuc=$debito+$valorpucdebito;
			$totalcreditopuc=$credito+$valorpuccredito;
			$detalle=$detalle." ".number_format($base19);


			$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','5001', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '$detalle', '', '$debito', '$credito', '', '1')";
			$query2 = $this->con->returnConsulta($sql);
			
			$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
			$query3 = $this->con->returnConsulta($sql);	
			$datos4= mysqli_fetch_array($query3);
			$codigoclase=$datos4['clase'];
			$codigogrupo=$datos4['grupo'];
			$codigocuenta=$datos4['cuenta'];
			$codigosubcuenta=$datos4['subcuenta'];
			$codigoauxiliar=$datos4['auxiliar'];

			
			
			$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
			$query5 = $this->con->returnConsulta($sql5);	
			$datos5= mysqli_fetch_array($query5);
			$totalclasedebito=$datos5['totaldebito']+$debito;
			$totalclasecredito=$datos5['totalcredito']+$credito;

			}

			//TERCERO REGRISTRO IVA5 
			$debito=$datos['iva5V'];
			$credito=0;
			$base19=$datos['baseIva5'];
			
			if($debito>0){
				
			$sql = "SELECT * FROM `codigospred` WHERE tipo=2 AND pos=3";
			$query2 = $this->con->returnConsulta($sql);	
			while($datos2= mysqli_fetch_array($query2)){
				$codigo=$datos2['codigo'];
				$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
				$query2 = $this->con->returnConsulta($sql);	
				$datos3= mysqli_fetch_array($query2);
				$nombrecodigo=$datos3['nombre'];
				$detalle=$datos3['detalle'];
				$valorpucdebito=$datos3['totaldebito'];
				$valorpuccredito=$datos3['totalcredito'];
			}
			$totaldebitopuc=$debito+$valorpucdebito;
			$totalcreditopuc=$credito+$valorpuccredito;
			$detalle=$detalle." ".number_format($base19);


			$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','5001', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '$detalle', '', '$debito', '$credito', '', '1')";
			$query2 = $this->con->returnConsulta($sql);
			$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
			$query3 = $this->con->returnConsulta($sql);	
			$datos4= mysqli_fetch_array($query3);
			$codigoclase=$datos4['clase'];
			$codigogrupo=$datos4['grupo'];
			$codigocuenta=$datos4['cuenta'];
			$codigosubcuenta=$datos4['subcuenta'];
			$codigoauxiliar=$datos4['auxiliar'];

			
			
			$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
			$query5 = $this->con->returnConsulta($sql5);	
			$datos5= mysqli_fetch_array($query5);
			$totalclasedebito=$datos5['totaldebito']+$debito;
			$totalclasecredito=$datos5['totalcredito']+$credito;

			
			
			}

			//CUARTO CREDITO CAJA 
			$debito=0;
			$credito=$datos['total'];
			$base19=$datos['baseIva5'];
			
			if($credito>0){
				
			$sql = "SELECT * FROM `codigospred` WHERE tipo=2 AND pos=4";
			$query2 = $this->con->returnConsulta($sql);	
			while($datos2= mysqli_fetch_array($query2)){
				$codigo=$datos2['codigo'];
				$sql = "SELECT * FROM `puc` WHERE codigo=$codigo";
					$sql3 = "UPDATE `puc` SET `fav` = '1' WHERE `puc`.`codigo` = $codigo";
					$query3 = $this->con->returnConsulta($sql3);
				$query2 = $this->con->returnConsulta($sql);	
				$datos3= mysqli_fetch_array($query2);
				$nombrecodigo=$datos3['nombre'];
				$detalle=$datos3['detalle'];
				$valorpucdebito=$datos3['totaldebito'];
				$valorpuccredito=$datos3['totalcredito'];
			}
			$totaldebitopuc=$debito+$valorpucdebito;
			$totalcreditopuc=$credito+$valorpuccredito;
			$detalle=$detalle." ".number_format($base19);


			$sql = "INSERT INTO `registroscontables` (`fecha`, `tipoRegistro`, `notaContable`, `codigo`, `nombre`, `terceroNombre`, `terceroDocumento`, `terceroDigVer`, `detalle`, `descripcion`, `debito`, `credito`, `diferencia`, `estado`) VALUES ('$fecha','5001', '$numeroFactura', '$codigo', '$nombrecodigo', '$terceroNombre', '$terceroDoc', '', '$detalle', '', '$debito', '$credito', '', '1')";
			$query2 = $this->con->returnConsulta($sql);
			$sql = "SELECT * FROM `puc_detalles` WHERE codigo=$codigo";
			$query3 = $this->con->returnConsulta($sql);	
			$datos4= mysqli_fetch_array($query3);
			$codigoclase=$datos4['clase'];
			$codigogrupo=$datos4['grupo'];
			$codigocuenta=$datos4['cuenta'];
			$codigosubcuenta=$datos4['subcuenta'];
			$codigoauxiliar=$datos4['auxiliar'];

			
			
			$sql5 = "SELECT * FROM `puc` WHERE codigo=$codigoclase";
			$query5 = $this->con->returnConsulta($sql5);	
			$datos5= mysqli_fetch_array($query5);
			$totalclasedebito=$datos5['totaldebito']+$debito;
			$totalclasecredito=$datos5['totalcredito']+$credito;

			

			$idbills=$datos['idbills'];

			$sql = "UPDATE `bills` SET `contabilidad` = '1' WHERE `bills`.`idbills` = $idbills";
			$query2 = $this->con->returnConsulta($sql);	

			

			}


		}
		header("location:" . URL . "contabilidad/compra3");
		//header("location:" . URL . "contabilidad/crear?tipo=codigo&error=codigo&". $inc."/". "/" . "");

	}
	
	
	
}

