<?php

require_once("DBManager.class.php");

class Cliente{
	private $idcliente;///
	private $dni;
	private $nombre;
	private $apellido;
	private $correo;
	private $telefono;
	private $direccion;
	private $estado;
	///////////////////////////////////////////
public function Crear($vdni,$vnom,$vape,$vcor,$vtel,$vdir,$ve)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("INSERT INTO tb_cliente(idcliente,dni,nombre,apellido,correo,telefono,direccion,estado) VALUES(null,'".$vdni."','".$vnom."','".$vape."','".$vcor."','".$vtel."','".$vdir."','".$ve."')"))
		{
			$resp=true;
		}
		return $resp;		
	}
	
	
	public function ListarPorCriterio($vcliente)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from tb_cliente where(nombre LIKE CONCAT('%','".$vcliente."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("idcliente"	=> $rs->fields["idcliente"],
									"dni" 		=> $rs->fields["dni"],
									"nombre" 	=> $rs->fields["nombre"],
									"apellido" 	=> $rs->fields["apellido"],
									"correo" 	=> $rs->fields["correo"],
									"telefono" 	=> $rs->fields["telefono"],
									"direccion" => $rs->fields["direccion"],
									"estado"	=> $rs->fields["estado"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
		
	public function BuscarPorCodigo($vcod)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select * from tb_cliente where(idcliente = '".$vcod."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idcliente=$rs->fields["idcliente"];
                $this->dni=$rs->fields["dni"];
				$this->nombre=$rs->fields["nombre"];				
				$this->apellido=$rs->fields["apellido"];
				$this->correo=$rs->fields["correo"];
				$this->telefono=$rs->fields["telefono"];					 
				$this->direccion=$rs->fields["direccion"];
				$this->estado=$rs->fields["estado"];
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	
	public function Actualizar($vidprov,$vdni,$vnom,$vape,$vcor,$vtel,$vdir,$ve)			
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("update tb_cliente set  dni = '".$vdni."', nombre = '".$vnom."', apellido = '".$vape."', correo ='".$vcor."', telefono = '".$vtel."', direccion = '".$vdir."', estado = '".$ve."' where (idcliente=".$vidprov.")"))//si es exitosa la consulta		   
		{
		  $resp=true; 
		}	
		return $resp;
	}
	
	////////////////////////////////*/
		
	public function ListaTotal()
	{
		$vector=null;
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from tb_cliente");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                $vector[$row]=array("idcliente"	=> $rs->fields["idcliente"],
									"dni"		=> $rs->fields["dni"],
									"nombre" 	=> $rs->fields["nombre"],
									"apellido"	=> $rs->fields["apellido"],
									"correo"	=> $rs->fields["correo"],
									"telefono" 	=> $rs->fields["telefono"],						
									"direccion"	=> $rs->fields["direccion"],
									"estado"	=> $rs->fields["estado"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
        	return $vector;			
		}else return null;
		
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	////////////////////////////
	public function ListaPaginada($vcli,$limitInf,$tampag)
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');			
		$rs=$db->execute("SELECT * FROM tb_cliente WHERE ( nombres LIKE CONCAT('%','".$vcli."','%') ) ORDER BY nombres ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("idcliente"	=> $rs->fields["idcliente"],
									"dni"		=> $rs->fields["dni"],
									"nombre" 	=> $rs->fields["nombre"],
									"apellido"	=> $rs->fields["apellido"],
									"correo"	=> $rs->fields["correo"],
									"telefono" 	=> $rs->fields["telefono"],						
									"direccion"	=> $rs->fields["direccion"],
									"estado"	=> $rs->fields["estado"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	//////////////////////////////
	public function Eliminar($vcod)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("DELETE FROM tb_cliente WHERE (idcliente=".$vcod.");"))   
		{
			$resp=true;
		}
		return $resp;		
	}	
	
	///////////////////////////////////////*/	
	public function getIdcliente(){ return $this->idcliente;}
	public function getDni(){ return $this->dni;}
	public function getNombre(){ return $this->nombre;}
	public function getApellido(){ return $this->apellido;}
	public function getCorreo(){ return $this->correo;}
	public function getTelefono(){ return $this->telefono;}
	public function getDireccion(){ return $this->direccion;}	
	public function getEstado(){ return $this->estado;}
}
?>