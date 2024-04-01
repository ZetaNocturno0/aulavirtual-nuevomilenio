<?
	include("clases/Tarea.class.php"); $objtarea=new Tarea();
 include "clases/Clase.class.php"; $objcur = new Clase();
 include("clases/Ciclo.class.php"); $objciclo=new Ciclo();
 include("clases/Semestre.class.php"); $objsem=new Semestre();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Clase Marketing</title>
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
	<script>
		$(document).ready(function() {
		var table = $('#example').DataTable( {
			responsive: true
		} ); 
			new $.fn.dataTable.FixedHeader( table );
		 });
   </script> 
    <style type="text/css">
        
    </style>
   
</head>
<body>
<script>
function guardar(f)
{   if(f.nombre.value==""){
		 f.nombre.focus();
		 return false;
	}
	if(f.descripcion.value==""){
		 f.descripcion.focus();
		 return false;
	}
	if(f.ruta.value==""){
		 f.ruta.focus();
		 return false;
	}
		   f.action='controladores/ClaseController.php';
		   f.submit();
		   return true;
		 
}
function editar(f)
{   if(f.nombre.value==""){
		 f.nombre.focus();
		 return false;
	}
	if(f.descripcion.value==""){
		 f.descripcion.focus();
		 return false;
	}
	if(f.ruta.value==""){
		 f.ruta.focus();
		 return false;
	}
		   f.action='controladores/ClaseController.php';
		   f.submit();
		   return true;
		
}

function eliminar(f)
{   
		   f.action='controladores/ClaseController.php';
		   f.submit();
		   return true;
}
$(document).ready(function() {
  $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
    var data_id = '';
	var data_des= '';
    if (typeof $(this).data('id') !== 'undefined') {
      data_id = $(this).data('id');	   
    }
    $('#idtarea').val(data_id);
  })
});
</script>
 <script>
		  function rellenar(i,n,d,r,a,c,s,f,h){	
			 document.form2.idclase.value=i;	   
			 document.form2.nombre.value=n;
			 document.form2.descripcion.value=d;
			 document.form2.ruta.value=r;
			 document.form2.codcarrera.value=a;
			 document.form2.codciclo.value=c;
			 document.form2.codsemestre.value=s;
			 document.form2.fecha.value=f;
			 document.form2.hora.value=h;
			 }
			 
		function elimina(e,r){
		  document.form3.idclase.value=e;
		  document.form3.ruta.value=r;
		}
</script>
		  
<div class="container">
	<div class="row">	
        <div class="col-md-12">
        <h4>Lista de Tareas Marketing</h4>
        <div class="table-responsive">
              <table width="100%" class="table table-striped table-bordered nowrap" id="example">
                   <thead>
                   <tr>
						<th width="30%">Titulo Clase </th>
						<th width="5%">Clase </th>
						<th width="5%">Trabajo </th>
						<th width="35%">Nombre & Apellido</th>
						<th width="25%">Correo</th>
                     	
                   </thead>
    <tbody>
    
    <tr><? $a = $_POST["txtbuscar"]; 
		   $lista = $objtarea->ListarPorMarketing($a);
		   //////////////////////////////////////////////////		 
			$TAMANO_PAGINA = 10;//Limito la busqueda			
			$pagina = $_GET["pagina"];//examino la p�gina a mostrar y el inicio del registro a mostrar
		if (!$pagina) {
   			$inicio = 0;
   			$pagina = 1;
		}
		else {
   				$inicio = ($pagina - 1) * $TAMANO_PAGINA;
			}			
			$total_paginas = ceil(count($lista) / $TAMANO_PAGINA);//calculo el total de p�ginas
			//////////////////////////////////////////////////////////77
		   for($i=0;$i<count($lista); $i++){	    
			
		?>
	<td><?=$lista[$i]["titulo"];?></td>
	<td><a href=<?=$lista[$i]["ruta"];?> target="_blank">
<p data-placement="top" data-toggle="tooltip" title="Mostrar"><button class="btn btn-warning btn-xs" data-title="Save" data-toggle="modal" ><span class="glyphicon glyphicon-save-file"></span></button></p></a>
	</td>
	<td>
	<a href=<?=$lista[$i]["rutawork"];?> target="_blank">
<p data-placement="top" data-toggle="tooltip" title="Mostrar"><button class="btn btn-info btn-xs" data-title="Save" data-toggle="modal" ><span class="glyphicon glyphicon-paperclip"></span></button></p></a>	
	</td>
	<td><?=$lista[$i]["nombre"]." ".$lista[$i]["apellido"];?>
      <input type="hidden" name="cat[<?=$i?>]" value="<?=$lista[$i]["nombre"];?>"></td>
	<td><?=$lista[$i]["correo"];?></td>
    
    </tr>
    <?
		  }
		?>
     <tfoot>     
          </table>

<div class="clearfix">

</div>

                
          </div>
            
        </div>
	</div>
</div>
  
 <form name="form2" id="form2" action="" method="post">
 
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Actualizacion de Clase</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
		 
		  <input name="idclase" id="idclase" type="hidden">		   
		 
		<input class="form-control " type="text" name="nombre" id="nombre" placeholder="Nombre">
        <input class="form-control " type="text" name="descripcion" id="descripcion" placeholder="Enlace">
		<input class="form-control " type="hidden" name="ruta" id="ruta" placeholder="Archivo">
		<input class="form-control " type="hidden" name="codcarrera" id="codcarrera" placeholder="Carrera">
		<select name="codciclo" class="form-control">
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
		<select name="codsemestre" class="form-control">
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
		<input class="form-control " type="date" name="fecha" id="fecha" placeholder="Fecha" size="10" value="<?php //echo date("d-m-Y");?>">		
		<input class="form-control " type="time" name="hora" id="hora" placeholder="Hora">
		<input name="accion" type="hidden" value="M" id="accion">
		
        </div>       
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;" onClick="editar(this.form);"><span class="glyphicon glyphicon-ok-sign"></span> Actualizar</button>
		
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>	
	
 </form>      
  
  <form name="form3" >
   
	<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Eliminar Registro</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Esta seguro de eliminar este registro?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" onClick="eliminar(this.form)" ><span class="glyphicon glyphicon-ok-sign"></span> Si</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
		<input name="accion" type="hidden" value="E">
		<input name="idclase" type="hidden" value="">
		<input name="ruta" type="hidden" value="">
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
  </form>  
<script type="text/javascript">
$(document).ready(function(){
$("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    $("[data-toggle=tooltip]").tooltip();
});

</script>
</body>
</htm