<?php
require_once("DBManager.class.php");
class Ciclo{
	private $codciclo;///
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
	public function ListarPorCiclo($v)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from ciclo where(descripcion LIKE CONCAT('%','".$v."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("codciclo"	=> $rs->fields["codciclo"],   			    					
									"descripcion"=> $rs->fields["descripcion"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); $db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}		
	public function BuscarPorCodigo($vcod)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select * from comisaria where(codcomi = ".$vcod.")");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->codcomi=$rs->fields["codcomi"];
				$this->descripcion=$rs->fields["descripcion"];					
				
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}	
	public function Actualizar($vcod,$vNombrelinea)			
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("update comisaria set descripcion = '".$vNombrelinea."' where (codcomi='".$vcod."') "))//si es exitosa la consulta			   
		{
		  $resp=true; 
		}	
		return $resp;
	}
	public function ListaPaginada($vpro,$limitInf,$tampag)
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');			
		$rs=$db->execute("SELECT * FROM comisaria WHERE ( descripcion LIKE CONCAT('%','".$vpro."','%') ) ORDER BY codcomi ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("codcomi"=> $rs->fields["codcomi"],   			    				
									"descripcion"=> $rs->fields["descripcion"],
									);
									
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	public function getCodcomi(){ return $this->codcomi;}
	public function getDescripcion(){ return $this->descripcion;}
}

?>