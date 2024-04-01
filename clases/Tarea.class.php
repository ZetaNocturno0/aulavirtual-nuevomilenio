<?php
require_once("DBManager.class.php");

class Tarea{
	private $idtarea;
	private $idclase;
	private $codcarrera;
	private $idcliente;
	private $rutawork;
	private $alojado;
	
		/////////////////constructor/////////////////
	function __construct($idtarea="",$idclase="",$codcarrera="",$idcliente="", $rutawork=""){
	
         $this->setIdtarea($idtarea);//
         $this->setIdclase($idclase);//
		 $this->setCodcarrera($codcarrera);//
         $this->setIdcliente($idcliente);//
		 $this->setRutawork($rutawork);//
		         }	
	///////////////////////////////////////////
	public function Crear($vidclase,$vcodcarrera,$vidcliente,$vrutawork)
	{
		$resp=false;		
		$db= new DBManager('root','');	
		if($db->_execute("INSERT INTO tarea (idtarea,idclase,codcarrera,idcliente,rutawork,alojado) VALUES(null,'".$vidclase."','".$vcodcarrera."','".$vidcliente."','".$vrutawork."',1)")) 
		{
			$resp=true;
		}
		return $resp;		
	}
	public function ListarPorMarketing($vtarea)
	{
		$vector=null;		
		$db= new DBManager('root','');
		$rs=$db->execute("select * from tarea INNER JOIN tb_cliente ON tarea.idcliente = tb_cliente.idcliente INNER JOIN clase ON tarea.idclase = clase.idclase where(nombre LIKE CONCAT('%','".$vtarea."','%')) and tarea.codcarrera = '1'");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("idtarea"		=> $rs->fields["idtarea"],
									"idclase" 		=> $rs->fields["idclase"],
									"codcarrera" 	=> $rs->fields["codcarrera"],
									"idcliente" 	=> $rs->fields["idcliente"],
									"rutawork" 		=> $rs->fields["rutawork"],
									"alojado" 		=> $rs->fields["alojado"],
									"idcliente"		=> $rs->fields["idcliente"],
									"nombre" 		=> $rs->fields["nombre"],
									"apellido" 		=> $rs->fields["apellido"],
									"correo" 		=> $rs->fields["correo"],
									"idclase"		=> $rs->fields["idclase"],
									"titulo" 		=> $rs->fields["titulo"],
									"ruta" 			=> $rs->fields["ruta"],
									"fecha" 		=> $rs->fields["fecha"],
									"hora" 			=> $rs->fields["hora"],
									);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	public function ListarPorSecretariado($vtarea)
	{
		$vector=null;		
		$db= new DBManager('root','');
		$rs=$db->execute("select * from tarea INNER JOIN tb_cliente ON tarea.idcliente = tb_cliente.idcliente INNER JOIN clase ON tarea.idclase = clase.idclase where(nombre LIKE CONCAT('%','".$vtarea."','%')) and tarea.codcarrera = '2'");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("idtarea"		=> $rs->fields["idtarea"],
									"idclase" 		=> $rs->fields["idclase"],
									"codcarrera" 	=> $rs->fields["codcarrera"],
									"idcliente" 	=> $rs->fields["idcliente"],
									"rutawork" 		=> $rs->fields["rutawork"],
									"alojado" 		=> $rs->fields["alojado"],
									"idcliente"		=> $rs->fields["idcliente"],
									"nombre" 		=> $rs->fields["nombre"],
									"apellido" 		=> $rs->fields["apellido"],
									"correo" 		=> $rs->fields["correo"],
									"idclase"		=> $rs->fields["idclase"],
									"titulo" 		=> $rs->fields["titulo"],
									"ruta" 			=> $rs->fields["ruta"],
									"fecha" 		=> $rs->fields["fecha"],
									"hora" 			=> $rs->fields["hora"],
									);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function ListarPorCriterio($vtarea)
	{
		$vector=null;		
		$db= new DBManager('root','');
		$rs=$db->execute("select * from tarea INNER JOIN tb_cliente ON tarea.idcliente = tb_cliente.idcliente INNER JOIN clase ON tarea.idclase = clase.idclase where(nombre LIKE CONCAT('%','".$vtarea."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("idtarea"		=> $rs->fields["idtarea"],
									"idclase" 		=> $rs->fields["idclase"],
									"codcarrera" 	=> $rs->fields["codcarrera"],
									"idcliente" 	=> $rs->fields["idcliente"],
									"rutawork" 		=> $rs->fields["rutawork"],
									"alojado" 		=> $rs->fields["alojado"],
									"idcliente"		=> $rs->fields["idcliente"],
									"nombre" 		=> $rs->fields["nombre"],
									"apellido" 		=> $rs->fields["apellido"],
									"correo" 		=> $rs->fields["correo"],
									"idclase"		=> $rs->fields["idclase"],
									"titulo" 		=> $rs->fields["titulo"],
									"ruta" 			=> $rs->fields["ruta"],
									"fecha" 		=> $rs->fields["fecha"],
									"hora" 			=> $rs->fields["hora"],
									);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function ListarPorEstado($vidclase,$vidcliente)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');	
		$rs=$db->execute("select alojado from tarea where idclase = ".$vidclase." and idcliente = ".$vidcliente."");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $alojado=$rs->fields["alojado"];
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	////////////////////////////////////////*/
	public function Eliminar($vcod)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("DELETE FROM tarea WHERE (idtarea=".$vcod.");"))   
		{
			$resp=true;
		}
		return $resp;		
	}					
	
	public function getIdtarea(){ return $this->idtarea;}
	public function getIdclase(){ return $this->idclase;}
	public function getCodcarrera(){ return $this->codcarrera;}
	public function getIdcliente(){ return $this->idcliente;}
	public function getRutawork(){ return $this->rutawork;}
	public function getalojado(){ return $this->alojado;}
	
	public function setIdtarea($idtarea){ $this->idtarea = $idtarea;}
	public function setIdclase($idclase){  $this->idclase = $idclase;}
	public function setCodcarrera($codcarrera){  $this->codcarrera = $codcarrera;}
	public function setIdcliente($idcliente){  $this->idcliente = $idcliente;}	
	public function setRutawork($rutawork){  $this->rutawork = $rutawork;}	
}
?>