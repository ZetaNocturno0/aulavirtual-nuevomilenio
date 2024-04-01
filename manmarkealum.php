<?
 include ("clases/Clase.class.php"); $objcur = new Clase();
 include("clases/Ciclo.class.php"); $objciclo=new Ciclo();
 include("clases/Semestre.class.php"); $objsem=new Semestre();
 include ("clases/Tarea.class.php"); $objtar = new Tarea();
 $idcliente = $_GET['variable'];
 $cliente = $_GET['variable2'];
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
{
	if(f.idclase.value==""){
		 f.idclase.focus();
		 return false;
	}
	if(f.codcarrera.value==""){
		 f.codcarrera.focus();
		 return false;
	}
	if(f.idcliente.value==""){
		 f.idcliente.focus();
		 return false;
	}
	if(f.ruta.value==""){
		 f.ruta.focus();
		 return false;
	}
		   f.action='controladores/TareaController.php';
		   f.submit();
		   return true;
		 
}
function editar(f)
{   if(f.titulo.value==""){
		 f.titulo.focus();
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
    $('#idclase').val(data_id);
  })
});
</script>
 <script>
		  function rellenar(i,a){	
			 document.form2.idclase.value=i;	   
			 document.form2.codcarrera.value=a;
			 //document.form2.ruta.value=r;
			 }
			 
		function elimina(e,r){
		  document.form3.idclase.value=e;
		  document.form3.ruta.value=r;
		}
</script>
<div class="container">
	<div class="row">	
        <div class="col-md-12">
        <h4>Lista de Clase Marketing</h4>
        <div class="table-responsive">
              <table width="100%" class="table table-striped table-bordered nowrap" id="example">
                   <thead>
                   <tr>
						<th width="22%">Titulo</th>
                   		<th width="1%">Enlace </th>
                     	<th width="1%">Ciclo</th>
                     	<th width="3%">Semestre</th>
                     	<th width="4%">Fecha</th>
                     	<th width="3%">Hora</th>
                     	<th width="2%">Clase</th>
						<th width="2%">Tarea</th>
                   </thead>
    <tbody>
    
    <tr><? $a = $_POST["txtbuscar"]; 
		   $lista = $objcur->ListarPorMarketing($a);
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
    <td><a href=<?=$lista[$i]["descripcion"];?> target="_blank">
<p data-placement="top" data-toggle="tooltip" title="Link"><button class="btn btn-success btn-xs" data-title="Link" data-toggle="modal" ><span class="glyphicon glyphicon-film"></span></button></p></a>	
	</td>
    <td><?=$lista[$i]["codciclo"];?></td>
    <td><?=$lista[$i]["codsemestre"];?></td>
    <td><?=$lista[$i]["fecha"];?></td>
    <td><?=$lista[$i]["hora"];?></td>
	<td><a href=<?=$lista[$i]["ruta"];?> target="_blank">
<p data-placement="top" data-toggle="tooltip" title="Mostrar"><button class="btn btn-warning btn-xs" data-title="Save" data-toggle="modal" ><span class="glyphicon glyphicon-save-file"></span></button></p></a>	
	</td>
    <td>
	<p data-placement="top" data-toggle="tooltip" title="AGREGAR">
	<button class="btn btn-info btn-xs" data-id="<?=$lista[$i]["idclase"];?>" data-title="AGREGAR" data-toggle="modal" data-target="<?php if($objtar->ListarPorEstado($lista[$i]["idclase"],$idcliente)){echo "#mensaje";} else{echo "#nuevo";}?>" 
	onClick="rellenar('<?=$lista[$i]["idclase"];?>','<?=$lista[$i]["codcarrera"];?>');">
	<span class="glyphicon glyphicon-paperclip"></span>
	</button>
        </td>
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

<form name="form2" id="form2" action="" method="post" enctype="multipart/form-data">
 
	<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="nuevo" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						<h4 class="modal-title custom_align" id="Heading">Registro de Tarea</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input class="form-control" type="hidden" name="idclase" id="idclase">
						<input class="form-control" type="hidden" name="codcarrera" id="codcarrera">
						<input class="form-control"	type="hidden" name="idcliente" id="idcliente" value="<? echo $idcliente ?>">
						<input class="form-control"	type="hidden" name="cliente" id="cliente" value="<? echo $cliente ?>">
						<input class="form-control" type="file" name="ruta"/>
						<input name="accion" type="hidden" value="R" id="accion">
					</div>       
				</div>
				<div class="modal-footer ">
					<button type="button" class="btn btn-warning btn-lg" style="width: 100%;" onClick="guardar(this.form);"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
				</div>
			</div>
			<!-- /.modal-content --> 
		</div>
		<!-- /.modal-dialog --> 
	</div>
	</form>
	
	<div class="modal fade" id="mensaje" tabindex="-1" role="dialog" aria-labelledby="nuevo" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						<h4 class="modal-title custom_align" id="Heading">Registro de Tarea</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
							Esta tarea ya se encuentra registrada.
					  </div>       
				</div>
				<div class="modal-footer ">
				
				</div>
			</div>
			<!-- /.modal-content --> 
		</div>
		<!-- /.modal-dialog --> 
	</div>
	
	



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