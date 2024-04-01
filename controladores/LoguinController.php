<?php       
	include("../clases/Usuario.class.php");
	$objusu =new Usuario();
	$usuario=trim($_REQUEST['user']);
	$clave=trim($_REQUEST['pass']);	
			        
	if($objusu->Login($usuario,$clave))
	{		 	            
		session_start();
		$_SESSION["usuario"]=$objusu->getUsuario();
		$_SESSION["tipo"] = $usuario;
		if($objusu->getTipo()=="ADMINISTRADOR" )
		{
			echo "<script languaje='JavaScript'>"; 		   	     						
			echo "location.href='../index.php';";					  
			echo "</script>";
		}
		if($objusu->getTipo()=="MAESTRO" )
		{
			echo "<script languaje='JavaScript'>"; 		   	     						
			echo "location.href='../indexmaestro.php';";					  
			echo "</script>";
		}
		if($objusu->getTipo()=="ALUMNO" )
		{
			echo "<script languaje='JavaScript'>"; 		   	     						
			echo "location.href='../indexalumno.php';";					  
			echo "</script>";
		}
		if($objusu->getTipo()=="X" )
		{
			echo "<script languaje='JavaScript'>"; 		   	     						
			echo "alert('ESTA CUENTA ESTA DESACTIVADA, CONTACTE AL ADMINISTRADOR');location.href='../login.php';";
			echo "</script>";
		}
	}else{
			echo "<script languaje=javascript> alert('Ingrese un Usuario y/o Contraseña Valido'); location.href=('../login.php');</script>"; 	    }
?>