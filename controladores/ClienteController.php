<?php
	require("../clases/Cliente.class.php");
	require("../clases/Usuario.class.php"); $obju = new Usuario();
	$Objcliente = new Cliente();	
	$accion=$_REQUEST['accion'];		

	if($accion=="R")
	{
		$vdni=$_REQUEST['dni'];
		$vnom=$_REQUEST['nombre']; 
		$vape=$_REQUEST['apellido'];
		$vcor=$_REQUEST['correo'];				
		$vtel=$_REQUEST['telefono'];
		$vdir=$_REQUEST['direccion'];
		$ve=$_REQUEST['estado'];

		if($Objcliente->Crear($vdni,$vnom,$vape,$vcor,$vtel,$vdir,$ve))
		{                
			echo "<script languaje=javascript>\n"; 
			echo "location.href ='../mancliente.php';";					
			echo "</script>"; 					
			}else{echo "No se pudo guardar";}
	}
	
	if($accion=="M")
	{     
		$vcod = $_REQUEST['idcliente'];
		$vdni=$_REQUEST['dni'];
		$vnom=$_REQUEST['nombre']; 
		$vape=$_REQUEST['apellido'];
		$vcor=$_REQUEST['correo'];				
		$vtel=$_REQUEST['telefono'];
		$vdir=$_REQUEST['direccion'];
		echo $ve=$_REQUEST['estado'];
				
		if($ve=="INACTIVO"){if($obju->desactivaPerfil($vcod,"X")){;}}
			if($Objcliente->Actualizar($vcod,$vdni,$vnom,$vape,$vcor,$vtel,$vdir,$ve))
			{ 
				echo "<script languaje=javascript>\n"; 
				echo "location.href ='../mancliente.php';";					
				echo "</script>"; 										
			}else{echo "No se pudo modificar";}
	}

	if($accion=="E")
	{    			
		$vcod=$_REQUEST['idcliente'];
		if($Objcliente->Eliminar($vcod))
		{
			echo "<script languaje=javascript>\n"; 
			echo "location.href ='../mancliente.php';";					
			echo "</script>"; 
			}else{echo "No se pudo eliminar";}
	}
?>