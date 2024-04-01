<? 
	include("clases/Ciclo.class.php"); $objciclo=new Ciclo();
	include("clases/Semestre.class.php"); $objsem=new Semestre();
	include("clases/Carrera.class.php"); $objcar=new Carrera();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" href="media/css/bootstrap.css">
	<link rel="stylesheet" href="media/css/bootstrap.min.css">
	<link rel="stylesheet" href="media/css/bootstrap-theme.css">
	<link rel="stylesheet" href="media/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="media/css/fixedHeader.bootstrap.min.css">
	<link rel="stylesheet" href="media/css/responsive.bootstrap.min.css">
	 <script src="media/js/jquery-1.10.2.js"></script>
	<script src="media/js/jquery.dataTables.min.js"></script>
	<script src="media/js/dataTables.bootstrap.min.js"></script>
	<script src="media/js/dataTables.fixedHeader.min.js"></script>
	<script src="media/js/dataTables.responsive.min.js"></script>
	<script src="media/js/responsive.bootstrap.min.js"></script>
	
	<script src="media/js/jquery.min.js"></script>
    <script src="media/js/bootstrap.min.js"></script>


<LINK title=win2k-cold-1 media=all href="calendario/calendar-green.css" type=text/css rel=stylesheet><!-- librería principal del calendario -->

<SCRIPT src="calendario/calendar.js" type=text/javascript></SCRIPT>
<!-- librería para cargar el lenguaje deseado -->

<SCRIPT src="calendario/calendar-es.js" type=text/javascript></SCRIPT>
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->

<SCRIPT src="calendario/calendar-setup.js" type=text/javascript></SCRIPT>
<script language="javascript">
function validar(f){
		if(f.titulo.value ==""){
			alert("Debe seleccionar titulo");
			return false;
		}
		if(f.descripcion.value ==""){
			alert("Debe seleccionar descripcion");
			return false;
		}

		if(f.ruta.value ==""){
			alert("Debe seleccionar ruta");
			return false;
		}
		if(f.codcarrera.value ==""){
			alert("Debe seleccionar carrera");
			return false;
		}
		if(f.codciclo.value ==""){
			alert("Debe seleccionar ciclo");
			return false;
		}
		if(f.codsemestre.value ==""){
			alert("Debe seleccionar semestre");
			return false;
		}
		if(f.fecha.value==""){
			alert("debe ingresar fecha");
			return false;
		}
		if(f.hora.value==""){
			alert("debe ingresar la hora de hora");
			return false;
		}
		f.action='controladores/ClaseController.php';
		f.submit();		
		return true;
}
</script>
<style type="text/css">
<!--
.inputbox {BORDER-RIGHT: #444444 1px solid;
	PADDING-RIGHT: 3px;
	BORDER-TOP: #444444 1px solid;
	PADDING-LEFT: 3px;
	FONT-SIZE: 11px;
	PADDING-BOTTOM: 3px;
	MARGIN: 5px 0px;
	BORDER-LEFT: #444444 1px solid;
	COLOR: #444444;
	PADDING-TOP: 3px;
	BORDER-BOTTOM: #444444 1px solid
}
.Estilo18 {font-size: 18px}
-->
</style>
</head>
<body>
<div class="container">
 <div class="modal-content">
   <div class="modal-body">
<form id="form1" name="form1" method="post" action="controladores/ClaseController.php" onSubmit="return validar(this)" enctype="multipart/form-data" >
  <table  align="center"  class="table-hover table-condensed">
    <tr>
      <td width="30%" height="58" style="font-family:Verdana, Arial, Helvetica, sans-serif"><span class="Estilo2 Estilo18">REGISTRO DE CLASE </span><a href="contenido.php" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
    </tr>
  </table>
  <table align="center" class="table-hover table-condensed">
    <tr>
      <td>Titulo</td>
      <td><input name="titulo" type="text" class="form-control"/></td>
      <td>Enlace Video </td>
      <td><input name="descripcion" type="text" class="form-control"/></td>
    </tr>
    <tr>
      <td>Subir Archivo</td>
      <td> 
	  	<input name="ruta" type="file" class="form-control" />
	  </td>
		<td>Carrera</td>
		<td>
			<input type="hidden" name="codcarrera" value="1" class="form-control"/>
			<input type="text" name="inputname" value="Marketing Empresarial" class="form-control" readonly>
		</td>
	</tr>
    <tr>
      <td>Ciclo</td>
      <td><select name="codciclo" class="form-control">
          <option value="<?=$codciclo;?>">
            <?=$ciclo;?>
            </option>
          <? 		  
		   $listart = $objciclo->ListarPorCiclo("");
		  	for($i=0;$i<count($listart);$i++)
			{
		  	?>
          <option value="<?=$listart[$i]["codciclo"];?>">
            <?=$listart[$i]["descripcion"];?>
            </option>
          <?		  		
		  	}
		  	?>
        </select>
      </td>
      <td>Semestre</td>
      <td><select name="codsemestre" class="form-control">
          <option value="<?=$codsemestre;?>">
            <?=$ciclo;?>
            </option>
          <? 		  
		   $listart = $objsem->ListarPorSemestre("");
		  	for($i=0;$i<count($listart);$i++)
			{
		  	?>
          <option value="<?=$listart[$i]["codsemestre"];?>">
            <?=$listart[$i]["descripcion"];?>
            </option>
          <?		  		
		  	}
		  	?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Fecha</td>
      <td><input name="fecha" type="date" class="form-control" id="fecha" size="10"  value="<?php //echo date("d-m-Y");?>" />
      </td>
      <td>Hora </td>
      <td><input name="hora" type="time" class="form-control"/></td>
    </tr>
  </table>
  <table align="center" width="554" class="table-hover table-condensed">			
    <tr>
      <td width="546" height="83" colspan="4" align="right" ><input type="submit" name="Submit" value="Registrar Clase" class="btn-success btn" <?php echo $dis;?>
	  />	
        <input type="hidden" name="accion" value="R" /></td>
    </tr>
  </table>
</form>
</div>
</div>
</div>
</body>
</html>
