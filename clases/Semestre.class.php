<?php
require_once("DBManager.class.php");
class Semestre{
	private $codsemestre;///
	private $descripcion ;	
	public function Crear($vdes)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("INSERT INTO comisaria(codcomi,descripcion) VALUES(null,'".$vdes."')"))   
		{
			$resp=true;
		}return $resp;		
	}	
	public function ListarPorSemestre($v)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from semestre where(descripcion LIKE CONCAT('%','".$v."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("codsemestre"	=> $rs->fields["codsemestre"],   			    					
									"descripcion"=> $rs->fields["descripcion"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); $db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}		
		
	public function getCodcomi(){ return $this->codcomi;}
	public function getDescripcion(){ return $this->descripcion;}
}

?>