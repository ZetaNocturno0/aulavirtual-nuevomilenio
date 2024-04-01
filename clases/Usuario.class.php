<?php
require_once("DBManager.class.php");

class Usuario{
	private $idusuario ;
	private $usuario;
	private $clave;
	private $tipo;
	
		/////////////////constructor/////////////////
	function __construct($idusuario="",$idcliente="",$usuario="", $clave="", $tipo=""){
	
         $this->setIdusuario($idusuario);//		 $this->setIdemp($idemp);//
		 $this->setUsuario($usuario);//
		 $this->setClave($clave);//
		 $this->setTipo($tipo);//
		         }	
	///////////////////////////////////////////
	public function Crear($vidcliente,$vusu,$vcla,$vt)
	{
		$resp=false;		
		$db= new DBManager('root','');	
		if($db->_execute("INSERT INTO tb_usuario (idusuario,idcliente,usuario,clave,tipo) VALUES(null,".$vidcliente.",'".$vusu."','".$vcla."','".$vt."')")) 

		{
			$resp=true;
		}
		return $resp;		
	}
	
	
	public function ListarPorTipoUsuario($vu)
	{
		$vector=null;		
		$db= new DBManager('root','');	
		$rs=$db->execute("select * from tb_usuario where(tipo ='".$vu."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				 $vector[$row]=array("idusuario"=> $rs->fields["idusuario"],
				 					"idcliente"=> $rs->fields["idcliente"],
									"usuario"=> $rs->fields["usuario"],
									"clave"=> $rs->fields["clave"],
									"tipo"=> $rs->fields["tipo"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function ListarPorCriterio($vu)
	{
		$vector=null;		
		$db= new DBManager('root','');	
		$rs=$db->execute("select * from tb_usuario where(usuario like concat('%','".$vu."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				 $vector[$row]=array("idusuario"=> $rs->fields["idusuario"],
				 					"idcliente"=> $rs->fields["idcliente"],
									"usuario"=> $rs->fields["usuario"],
									"clave"=> $rs->fields["clave"],
									"tipo"=> $rs->fields["tipo"]);
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
		$rs=$db->execute("select * from tb_usuario where(idusuario= ".$vcod.")");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idusuario=$rs->fields["idusuario"];
				$this->idcliente=$rs->fields["idcliente"];	
				$this->usuario=$rs->fields["usuario"];
				$this->clave=$rs->fields["clave"];
				$this->tipo=$rs->fields["tipo"];				
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	public function BuscarPorUsuario($v)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');	
		$rs=$db->execute("select * from tb_usuario where(usuario= '".$v."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idusuario=$rs->fields["idusuario"];
				$this->idcliente=$rs->fields["idcliente"];	
				$this->usuario=$rs->fields["usuario"];
				$this->clave=$rs->fields["clave"];
				$this->tipo=$rs->fields["tipo"];				
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	public function LlamarUsuario($v)
	{
		$vector=null;
		$db= new DBManager('root','');	
		$rs=$db->execute("select * from tb_usuario INNER JOIN tb_cliente ON tb_usuario.idcliente = tb_cliente.idcliente where(idusuario= '".$v."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                 $vector[$row]=array("idusuario"	=> $rs->fields["idusuario"],
									"idcliente"		=> $rs->fields["idcliente"],
									"usuario"		=> $rs->fields["usuario"],
									"clave"			=> $rs->fields["clave"],
									"tipo"			=> $rs->fields["tipo"],
									"dni"			=> $rs->fields["dni"],
									"nombre"		=> $rs->fields["nombre"],
									"apellido"		=> $rs->fields["apellido"],
									"correo"		=> $rs->fields["correo"],
									"telefono"		=> $rs->fields["telefono"],
									"direccion"		=> $rs->fields["direccion"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
        	return $vector;			
		}else return null;
		
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos   						
	}
	
	public function Actualizar($vcod,$vem,$vu,$vc,$t)			
	{
		$resp=false;		
		$db= new DBManager('root','');	
		if($db->_execute("update tb_usuario set idcliente=".$vem.", 
												usuario='".$vu."', 
												clave='".$vc."', 
												tipo = '".$t."' where (idusuario=".$vcod.") "))//si es exitosa la consulta			   
		{
		  $resp=true; 
		}	
		return $resp;
	}
	//////////////////////////////////
	public function desactivaPerfil($vem,$vu)			
	{
		$resp=false;		
		$db= new DBManager('root','');	
		if($db->_execute("update tb_usuario set tipo='".$vu."' where (idcliente=".$vem.") "))//si es exitosa la consulta			   
		{
		  $resp=true; 
		}	
		return $resp;
	}
	/////////////////////////////////*/
		
	public function ListaTotal()
	{
		$vector=null;
		$db= new DBManager('root','');	
		$rs=$db->execute("select * from tb_usuario");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                 $vector[$row]=array("idusuario"=> $rs->fields["idusuario"],
									"idcliente"=> $rs->fields["idcliente"],
									"usuario"=> $rs->fields["usuario"],
									"clave"=> $rs->fields["clave"],
									"tipo"=> $rs->fields["tipo"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
        	return $vector;			
		}else return null;
		
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	/*///////////////////////////
	public function ListaPaginada($vpro,$limitInf,$tampag)
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');	
		$rs=$db->execute("SELECT * FROM usuario WHERE ( Nombreusu LIKE CONCAT('%','".$vpro."','%') ) ORDER BY Idusuario ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("idusuario"=> $rs->fields["idusuario"],
				 					"idtienda"=> $rs->fields["idtienda"],
									"idemp"=> $rs->fields["idemp"],
									"usuario"=> $rs->fields["usuario"],
									"clave"=> $rs->fields["clave"],
									"tipo"=> $rs->fields["tipo"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}*/
	public function Login($vNombreusu,$vContraseña)
        {
                $resp=false;
                $num_rows=0;//numero de filas afectada por la consulta
                $db= new DBManager('root','');	
        		$rs=$db->execute("SELECT * FROM tb_usuario WHERE (usuario='".$vNombreusu."' AND clave='".$vContraseña."');");
                $num_rows=$rs->getNumOfRows();
                if($num_rows>0)
                {        $resp=true;
                         $rs->firstRow(); // opcional, pero recomendado
                        while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también                               
                                $this->idusuario=$rs->fields["idusuario"];
								$this->idcliente=$rs->fields["idcliente"];	
								$this->usuario=$rs->fields["usuario"];
								$this->clave=$rs->fields["clave"];
								$this->tipo=$rs->fields["tipo"];
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
		if($db->_execute("DELETE FROM tb_usuario WHERE (idusuario=".$vcod.");"))   
		{
			$resp=true;
		}
		return $resp;		
	}					
	
	public function getIdusuario(){ return $this->idusuario;}
	public function getIdcliente(){ return $this->idcliente;}
	public function getUsuario(){ return $this->usuario;}
	public function getClave(){ return $this->clave;}
	public function getTipo(){ return $this->tipo;}
	
	public function setIdusuario($idusuario){ $this->idusuario = $idusuario;}
	public function setIdcliente($idcliente){  $this->idcliente = $idcliente;}	
	public function setUsuario($usuario){  $this->usuario = $usuario;}	
	public function setClave($clave){  $this->clave = $clave;}	
	public function setTipo($tipo){  $this->tipo = $tipo;}	

}




?>