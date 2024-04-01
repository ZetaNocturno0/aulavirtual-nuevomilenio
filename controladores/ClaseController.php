<?php
	require("../clases/Clase.class.php");
	$Objclase = new Clase();	
	$accion=$_REQUEST['accion'];
	$archivo = trim ($_FILES['ruta']['name']);
	$archivo = $_REQUEST['titulo'] . $_REQUEST['cliente'] . $archivo;
	$archivo = preg_replace ("/ /","", $archivo);
	$tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
	$upload = '../upload/';
	$grd = 'upload/';
	 ////////////////////////////////// 		
	if($accion=="R")
	{
		$titulo=$_REQUEST['titulo'];		
		$descripcion=$_REQUEST['descripcion'];		
		$ruta	=	$upload . $archivo;
		$ruta2	=	$grd . 	$archivo;		
		$codcarrera=$_REQUEST['codcarrera'];	
		$codciclo=$_REQUEST['codciclo'];				
		$codsemestre=$_REQUEST['codsemestre'];						
		$fecha=$_REQUEST['fecha'];						
		$hora=$_REQUEST['hora'];
		$idcliente=$_REQUEST['idcliente'];
		
		if($tipoArchivo == "pdf" || $tipoArchivo == "docx"){
			if(move_uploaded_file($_FILES['ruta']['tmp_name'], $ruta)) {
				if($Objclase->Crear($titulo,$descripcion,$ruta2,$codcarrera,$codciclo,$codsemestre,$fecha,$hora,$idcliente))
				{
						echo "<script languaje=javascript>\n"; 
						echo "location.href ='../contenido.php';";
						echo "</script>";
				}else{ echo "No se pudo guardar";}
			}
		}else{ echo "Formato de archivo no valido";}
	}  	 
	 ///////////////////////////// 	
	if($accion=="M")
	{        
	   			$vcod=$_REQUEST['idclase'];
	   			$titulo=$_REQUEST['titulo'];		
				$descripcion=$_REQUEST['descripcion'];		
				$ruta=$_REQUEST['ruta'];								
				$codcarrera=$_REQUEST['codcarrera'];	
				$codciclo=$_REQUEST['codciclo'];				
				$codsemestre=$_REQUEST['codsemestre'];						
				$fecha=$_REQUEST['fecha'];						
				$hora=$_REQUEST['hora'];
				
				if($Objclase->Actualizar($vcod,$titulo,$descripcion,$ruta,$codcarrera,$codciclo,$codsemestre,$fecha,$hora))
		  		{        
					if($codcarrera == "1")
					{
						echo "<script languaje=javascript>\n"; 
						echo "location.href ='../manmarketing.php';";
						echo "</script>";
					}
					else
					{
						echo "<script languaje=javascript>\n"; 
						echo "location.href ='../mansecretariado.php';";
						echo "</script>";
					}					
          		}else{ echo "No se pudo modificar";}
	} 
	   
	if($accion=="E")
	{        
			$vcod=$_REQUEST['idclase'];
			$ruta= $_REQUEST['ruta'];
			if($Objclase->Eliminar($vcod))
			{
				unlink("../".$ruta);
				echo "<script languaje=javascript>\n"; 
	 			echo "location.href ='../contenido.php';";					
	 			echo "</script>";
		     }else{ echo "No se pudo eliminar";}
	}       
?>