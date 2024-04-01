<?php
/** 
 * @version 	
 * @author		Diego Zagaceta 
 * @copyright	Copyright (c) 2013 
 */

require_once("DBManager.class.php");

class Clase{
	private $idclase;
	private $titulo;
	private $descripcion;
	private $ruta;
	private $codcarrera;
	private $codciclo;
	private $codsemestre;
	private $fecha;
	private $hora;
	private $idcliente;
	
	public function Crear($titulo,$descripcion,$ruta,$codcarrera,$codciclo,$codsemestre,$fecha,$hora,$idcliente)
	{
		$resp=false;		
		$db= new DBManager('root','');
		//$fecha = implode("-", array_reverse(explode("-", $fecha)));		
		if($db->_execute("INSERT INTO clase(idclase,titulo,descripcion,ruta,codcarrera,codciclo,codsemestre,fecha,hora,idcliente) VALUES(null,'".$titulo."','".$descripcion."','".$ruta."','".$codcarrera."','".$codciclo."','".$codsemestre."','".$fecha."','".$hora."','".$idcliente."')"))   
		{
			$resp=true;
		}
		return $resp;		
	}
	
	public function ListarPorCriterio($vclase)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from clase where(titulo LIKE CONCAT('%','".$vclase."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("idclase"		=> $rs->fields["idclase"],
									"titulo" 		=> $rs->fields["titulo"],
									"descripcion" 	=> $rs->fields["descripcion"],
									"ruta" 			=> $rs->fields["ruta"],
									"codcarrera" 	=> $rs->fields["codcarrera"],
									"codciclo" 		=> $rs->fields["codciclo"],
									"codsemestre" 	=> $rs->fields["codsemestre"],
									"fecha"			=> $rs->fields["fecha"],
									"hora"			=> $rs->fields["hora"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	////////////////////
	
	public function ListarPorCliente($vclase,$vcliente)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from clase where(titulo LIKE CONCAT('%','".$vclase."','%')) and idcliente = '".$vcliente."'");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("idclase"		=> $rs->fields["idclase"],
									"titulo" 		=> $rs->fields["titulo"],
									"descripcion" 	=> $rs->fields["descripcion"],
									"ruta" 			=> $rs->fields["ruta"],
									"codcarrera" 	=> $rs->fields["codcarrera"],
									"codciclo" 		=> $rs->fields["codciclo"],
									"codsemestre" 	=> $rs->fields["codsemestre"],
									"fecha"			=> $rs->fields["fecha"],
									"hora"			=> $rs->fields["hora"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	////////////////////
	
	public function ListarPorMarketing($vclase)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from clase where(titulo LIKE CONCAT('%','".$vclase."','%')) and codcarrera = '1'");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("idclase"		=> $rs->fields["idclase"],
									"titulo" 		=> $rs->fields["titulo"],
									"descripcion" 	=> $rs->fields["descripcion"],
									"ruta" 			=> $rs->fields["ruta"],
									"codcarrera" 	=> $rs->fields["codcarrera"],
									"codciclo" 		=> $rs->fields["codciclo"],
									"codsemestre" 	=> $rs->fields["codsemestre"],
									"fecha"			=> $rs->fields["fecha"],
									"hora"			=> $rs->fields["hora"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function ListarPorSecretariado($vclase)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from clase where(titulo LIKE CONCAT('%','".$vclase."','%')) and codcarrera = '2'");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("idclase"		=> $rs->fields["idclase"],
									"titulo" 		=> $rs->fields["titulo"],
									"descripcion" 	=> $rs->fields["descripcion"],
									"ruta" 			=> $rs->fields["ruta"],
									"codcarrera" 	=> $rs->fields["codcarrera"],
									"codciclo" 		=> $rs->fields["codciclo"],
									"codsemestre" 	=> $rs->fields["codsemestre"],
									"fecha"			=> $rs->fields["fecha"],
									"hora"			=> $rs->fields["hora"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function BuscarPorCodigo($vcodmarc)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select idclase,codcarrera,codciclo,codsemestre,DATE_FORMAT(fecha,'%d-%m-%Y') AS titulo,descripcion,ruta,hora from clase where (idclase = '".$vcodmarc."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idclase=$rs->fields["idclase"];
   			    $this->titulo=$rs->fields["titulo"];
				$this->descripcion=$rs->fields["descripcion"];   			    
				$this->ruta=$rs->fields["ruta"];
				$this->codcarrera=$rs->fields["codcarrera"];
				$this->codciclo=$rs->fields["codciclo"];
				$this->codsemestre=$rs->fields["codsemestre"];
				$this->fecha=$rs->fields["fecha"];
				$this->hora=$rs->fields["hora"];
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	public function ListarPorClase($vidclase)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select idclase,codcarrera,codciclo,codsemestre,DATE_FORMAT(fecha,'%d-%m-%Y') AS titulo,descripcion,ruta,hora from clase where(idclase ='".$vidclase."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("idclase"		=> $rs->fields["idclase"],
									"titulo"		=> $rs->fields["titulo"],
									"descripcion"	=> $rs->fields["descripcion"],
   			    					"ruta" 			=> $rs->fields["ruta"],
									"codcarrera"	=> $rs->fields["codcarrera"],
									"codciclo"		=> $rs->fields["codciclo"],
									"codsemestre"	=> $rs->fields["codsemestre"],
									"hora"			=> $rs->fields["hora"],);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function Verificar($vcodmarc)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select num,codcomi,codinfra,DATE_FORMAT(fecha,'%d-%m-%Y') AS fecha,placa,clase,color,papeleta,pnp,chofer,marca,motor,horaing,obs,estado,espago from internamiento where (papeleta = '".$vcodmarc."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->num=$rs->fields["num"];
   			    $this->codcomi=$rs->fields["codcomi"];
				$this->codinfra=$rs->fields["codinfra"];   			    
				$this->fecha=$rs->fields["fecha"];
				$this->placa=$rs->fields["placa"];
				$this->clase=$rs->fields["clase"];
				$this->color=$rs->fields["color"];
				$this->papeleta=$rs->fields["papeleta"];
				$this->pnp=$rs->fields["pnp"];
				$this->chofer=$rs->fields["chofer"];
				$this->marca=$rs->fields["marca"];
				$this->motor=$rs->fields["motor"];
				$this->horaing=$rs->fields["horaing"];
				$this->obs=$rs->fields["obs"];
				$this->estado=$rs->fields["estado"];
				$this->espago=$rs->fields["espago"];
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	public function ListarPorFecha($fecha)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$fecha = implode("-", array_reverse(explode("-", $fecha)));	
		$rs=$db->execute("select idclase,codcarrera,codciclo,codsemestre,DATE_FORMAT(fecha,'%d-%m-%Y') AS titulo,descripcion,ruta,hora from clase where(fecha ='".$fecha."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("idclase"		=> $rs->fields["idclase"],
									"titulo"		=> $rs->fields["titulo"],
									"descripcion"	=> $rs->fields["descripcion"],
   			    					"ruta" 			=> $rs->fields["ruta"],
									"codcarrera"	=> $rs->fields["codcarrera"],
									"codciclo"		=> $rs->fields["codciclo"],
									"codsemestre"	=> $rs->fields["codsemestre"],
									"hora"			=> $rs->fields["hora"],);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function ListaPaginada($vpro,$limitInf,$tampag)
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');	
		$rs=$db->execute("SELECT idclase,codcarrera,codciclo,codsemestre,DATE_FORMAT(fecha,'%d-%m-%Y') AS titulo,descripcion,ruta,hora FROM clase WHERE ( idclase LIKE CONCAT('%','".$vpro."','%') ) ORDER BY idclase ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("idclase"		=> $rs->fields["idclase"],
									"titulo"		=> $rs->fields["titulo"],
									"descripcion"	=> $rs->fields["descripcion"],
   			    					"ruta" 			=> $rs->fields["ruta"],
									"codcarrera"	=> $rs->fields["codcarrera"],
									"codciclo"		=> $rs->fields["codciclo"],
									"codsemestre"	=> $rs->fields["codsemestre"],
									"hora"			=> $rs->fields["hora"],);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function Actualizar($vidprov,$titulo,$descripcion,$ruta,$codcarrera,$codciclo,$codsemestre,$fecha,$hora)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("update clase set  titulo='".$titulo."', 
											 descripcion='".$descripcion."', 
											 ruta='".$ruta."', 
											 codcarrera='".$codcarrera."', 
											 codciclo='".$codciclo."', 
											 codsemestre='".$codsemestre."', 
											 fecha='".$fecha."', 
											 hora='".$hora."' where (idclase=".$vidprov.")"))   
		{
			$resp=true;
		}
		return $resp;		
	}
	
	public function Eliminar($vcod)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("DELETE FROM clase WHERE (idclase=".$vcod.");"))   
		{
			$resp=true;
		}
		return $resp;		
	}	
	
	public function Correlativo()
	{
		$vCorre2 = 1;		
		$vCont = 1;
		$vCeros = "";
		$delta_ceros = 0;
		$AnoSiguiente = 0;
		$AnoActual = 0;
		$fecha = getdate();
		
		$db= new DBManager('root','');	
		$rs=$db->execute("SELECT num FROM clase ORDER BY num;");
		
		//Entra a este bloque si existe algun valor en el campo INroOrd		
		if($rs->lastRow())
		{			
			
		
			$vCorre1 = substr($rs->fields['num'],0,5);//variable que almacena los 4 primeros caracteres de INroOrd
			$vCorre2 = substr($rs->fields['num'],6); //extraigo los ultimos 5 caracteres de INroOrd 			
			
			$vCorre1 = intval($vCorre1); //obtengo el valor entero
			$vCorre2 = intval($vCorre2); //obtengo el valor entero
							
			$vCorre2++;//se incrementa en 1, es decir el correlativo
			
			//verifico si el correlativo llega a ocupar los 5 digitos
		 	$delta_ceros = 6 - strlen($vCorre2);
			
			if( $delta_ceros == 0 )// Si en el codigo  correlativo ya no existen ceros que poner es decir vCorre2 = 10000
			{
				//Si es que he pasado al siguiente año
				$AnoActual = intval($fecha['year']);
				if($AnoActual>$vCorre1)
				{   
					$AnoSiguiente = $vCorre1+=1;
					return $AnoSiguiente."0000001";
				}
				else{

						return ($vCorre1.$vCorre2);
					}			
			}
			
			if( $delta_ceros < 0 /*-1*/)// Si en el codigo correlativo ya no existen ceros que poner y ya llego al limite, en este caso delta_ceros = -1
			{
				$AnoSiguiente = $vCorre1+=1;
				return $AnoSiguiente."0000001";
			}
			
			if( $delta_ceros > 0) // Si en el codigo correlativo existen ceros que poner
			{
			
				//Si es que he pasado al siguiente año
				$AnoActual = intval($fecha['year']);
				if($AnoActual>$vCorre1)
				{   
					$AnoSiguiente = $vCorre1+=1;
					return $AnoSiguiente."0000001";
				}
				else{
						for($i=1; $i<$delta_ceros; $i++)
						{
							$vCont++;//contador de ceros
						}			
						$vCeros=str_pad($vCeros,$vCont,'0',STR_PAD_RIGHT);//rellenar de ceros al lado derecho		
						return($vCorre1.$vCeros.$vCorre2);
					}			
			}			

		}else{ 
				//Caso contrario esta vacio el campo al inicio de las acciones				
				return ($fecha['year']."000000".$vCorre2);				
			 }

		$rs->close();
		$db->closeConnection();//opcional			
	}

	public function getIdclase(){ return $this->idclase;}
	public function getTitulo(){ return $this->titulo;}
	public function getDescripcion(){ return $this->descripcion;}
	public function getRuta(){ return $this->ruta;}
	public function getCodcarrera(){ return $this->codcarrera;}
	public function getCodciclo(){ return $this->codciclo;}
	public function getCodsemestre(){ return $this->codsemestre;}
	public function getFecha(){ return $this->fecha;}
	public function getHora(){ return $this->hora;}
	public function getIdcliente(){ return $this->idcliente;}
	
}
?>