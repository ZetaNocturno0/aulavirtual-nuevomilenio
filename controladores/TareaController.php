<?php
	require("../clases/Tarea.class.php");
	$Objtar = new Tarea();	
	$accion=$_REQUEST['accion'];
	$archivo = trim ($_FILES['ruta']['name']);
	$archivo = $_REQUEST['idclase'] . $_REQUEST['cliente'] . $archivo;
	$archivo = preg_replace ("/ /","", $archivo);
	$tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
	$upload = '../trabajos/';
	$grd = 'trabajos/';	
	////////////////////////////////// 		
	if($accion=="R")
	{
		$vidclase=$_REQUEST['idclase'];
		$vcodcarrera=$_REQUEST['codcarrera'];
		$vidcliente=$_REQUEST['idcliente'];
		//$vrutawork2=$_REQUEST['rutawork'];
		$vruta	=	$upload . $archivo;
		$vruta2	=	$grd . 	$archivo;

		if($tipoArchivo == "pdf" || $tipoArchivo == "docx"){
			if(move_uploaded_file($_FILES['ruta']['tmp_name'], $vruta)) {
				if($Objtar->Crear($vidclase,$vcodcarrera,$vidcliente,$vruta2))
				{
					if($codcarrera == "1")
					{
						echo "<script languaje=javascript>\n"; 
						echo "location.href ='../contenido.php';";
						echo "</script>";
					}
					else
					{
						echo "<script languaje=javascript>\n"; 
						echo "location.href ='../contenido.php';";
						echo "</script>";
					}					
				}else{ echo "No se pudo guardar";}
			}	
		}else{ echo "Formato de archivo no valido";}
	}
	 if($accion=="E")
	{        
			$vcod=$_REQUEST['idtarea'];
			$rutawork= $_REQUEST['rutawork'];
			if($Objtar->Eliminar($vcod))
			{
				unlink("../".$rutawork);
				echo "<script languaje=javascript>\n"; 
	 			echo "location.href ='../mantareas.php';";					
	 			echo "</script>";
		     }else{ echo "No se pudo eliminar";}
	}  
	 //////////////////////////////////////////////

?>