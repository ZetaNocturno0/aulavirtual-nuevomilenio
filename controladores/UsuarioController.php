<?php
	require("../clases/Usuario.class.php");
	$Objusu = new Usuario();	
	$accion=$_REQUEST['accion'];		
      if($accion=="R")
	   {    			
				$vcliente=$_REQUEST['idcliente'];
				$vusuario=$_REQUEST['usuario'];
				$vclave=$_REQUEST['clave'];
				$vtipo=$_REQUEST['tipo'];
				
			if($Objusu->Crear($vcliente,$vusuario,$vclave,$vtipo))
				  {                
					echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../manusuario.php';";					
	 				echo "</script>"; 					
		          } else{ echo "No se pudo guardar";}
       }  
	 
	 ///////////////////////////// 	
	 if($accion=="M")
	   {        $vcod = $_REQUEST['idusuario'];
				$vcliente=$_REQUEST['idcliente'];
				$vusuario=$_REQUEST['usuario'];
				$vclave=$_REQUEST['clave'];
				$vtipo=$_REQUEST['tipo'];
				 				
				if($Objusu->Actualizar($vcod,$vcliente,$vusuario,$vclave,$vtipo))
				  {                
					echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../manusuario.php';";					
	 				echo "</script>";
					 					
		          }else{ echo "No se pudo modificar";}
				  
       } 
	   
	if($accion=="E")
	{    			
		$vcod=$_REQUEST['idusuario'];
		if($Objusu->Eliminar($vcod))
		{
			echo "<script languaje=javascript>\n"; 
			echo "location.href ='../manusuario.php';";			
			echo "</script>"; 
			}else{ //echo "No se pudo eliminar";			   			
					echo "<script languaje=javascript>\n"; 
					echo "alert('NO SE PUEDE ELIMINAR!!! existen campos relacionados! ');location.href ='../manusuario.php';";					
					echo "</script>"; 							
		}
	}    
?>