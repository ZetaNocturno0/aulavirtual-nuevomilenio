<?
 include "clases/Usuario.class.php"; $objcur = new Usuario();
 include "clases/Cliente.class.php"; $obj = new Cliente();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>USUARIOS</title>
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
{   if(f.idcliente.value==""){
		 f.idemp.focus();
		 return false;
	}
	if(f.usuario.value==""){
		 f.usuario.focus();
		 return false;
	}
	if(f.clave.value==""){
		 f.clave.focus();
		 return false;
	}
	if(f.tipo.value==""){
		 f.tipo.focus();
		 return false;
	}
		   f.action='controladores/UsuarioController.php';
		   f.submit();
		   return true;
		 
}
function editar(f)
{   if(f.idcliente.value==""){
		 f.idemp.focus();
		 return false;
	}
	if(f.usuario.value==""){
		 f.usuario.focus();
		 return false;
	}
	if(f.clave.value==""){
		 f.clave.focus();
		 return false;
	}
	if(f.tipo.value==""){
		 f.tipo.focus();
		 return false;
	}
	
		   f.action='controladores/UsuarioController.php';
		   f.submit();
		   return true;
		
}

function eliminar(f)
{   
		   f.action='controladores/UsuarioController.php';
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
    $('#idusuario').val(data_id);
  })
});
</script>
 <script>
		  function rellenar(i,u,c,t){		   
			 document.form2.idcliente.value=i;
			 document.form2.usuario.value=u;
			 document.form2.clave.value=c;
			 document.form2.tipo.value=t;
			 		 }
			 
		function elimina(e){
		  document.form3.idusuario.value=e; 
		}
 </script>
<div class="container">
	<div class="row">
		
        
        <div class="col-md-12">
        <h4>Lista de Usuarios <button class="btn btn-success btn-xs" data-title="AGREGAR" data-toggle="modal" data-target="#nuevo" ><span class="glyphicon glyphicon-plus"></span> Agregar</button><a href="contenido.php" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></h4>
        <div class="table-responsive">

            
              <table width="100%" class="table table-striped table-bordered nowrap" id="example">
                   		   			 
                   <thead>
                   <tr><th width="3%">ID</th>
                    <th width="19%">Nombres y Apellidos </th>
                     <th width="13%">Usuario</th>
                     <th width="10%">Clave</th>
                     <th width="11%">Tipo</th>
                     <th width="3%">Editar</th>
					 <th width="5%">Borrar</th>
					 <th width="5%">Reporte</th>
                   </thead>
<tbody>    
    <tr><? $a = $_POST["txtbuscar"]; 
		   $lista = $objcur->ListarPorCriterio($a);					 
		   //////////////////////////////////////////////////77		 
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
			if($obj->BuscarPorCodigo($lista[$i]["idcliente"])){
			     $lista[$i]["nombre"]=$obj->getNombre();
				 $lista[$i]["apellido"]=$obj->getApellido();
			}
		?>
    <td><?=$lista[$i]["idusuario"];?></td>
    <td><?=$lista[$i]["nombre"]." ".$lista[$i]["apellido"];?></td>
    <td><?=$lista[$i]["usuario"];?></td>
    <td><?=$lista[$i]["clave"];?></td>
    <td><?=$lista[$i]["tipo"];?></td>
    <td><p data-placement="top" data-toggle="tooltip" title="Edit">
	<button class="btn btn-primary btn-xs" data-id="<?=$lista[$i]["idusuario"];?>" data-title="Edit" data-toggle="modal" data-target="#edit" onClick="rellenar('<?=$lista[$i]["idcliente"];?>','<?=$lista[$i]["usuario"];?>','<?=$lista[$i]["clave"];?>','<?=$lista[$i]["tipo"];?>');"><span class="glyphicon glyphicon-pencil"></span></button>
        </td>
    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" onClick="elimina('<?=$lista[$i]["idusuario"];?>');"><span class="glyphicon glyphicon-trash"></span></button></p></td>
	<td>
	<a href="reporteusuario.php?variable=<?=$lista[$i]["idusuario"];?>" target="_blank">
	<p data-placement="top" data-toggle="tooltip" title="Report"><button class="btn btn-info btn-xs" data-title="Report" data-toggle="modal"><span class="glyphicon glyphicon-folder-open"></span></button></p>
	</a>
	</td>
    </tr>
    <?
		  }
		?>
    </tbody>
</table>

<div class="clearfix">
	</div>      
			</div>
			</div>
	</div>
</div>

<form name="form1" action="" method="post">
<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="nuevo" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Registro de Usuario</h4>
          </div>
        <div class="modal-body">
         <div class="form-group">
			<select name="idcliente" class="form-control">
			<option value="">SELECCIONAR TRABAJADOR</option>
			<? $listacliente = $obj->ListaTotal();
			  for($i=0;$i<count($listacliente);$i++){
			?>
			 <option value="<?=$listacliente[$i]["idcliente"];?>"><?=$listacliente[$i]["nombre"]." ".$listacliente[$i]["apellido"];?></option>
			 <?
			 }
			 ?>
			</select>

			<input class="form-control " type="text" name="usuario" id="usuario" placeholder="Usuario">
			<input class="form-control " type="text" name="clave" id="clave" placeholder="Clave">
			<select name="tipo" class="form-control">
				<option value="ADMINISTRADOR">ADMINISTRADOR</option>
				<option value="MAESTRO">MAESTRO</option>
				<option value="ALUMNO">ALUMNO</option>
			</select>
			
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
    
 <form name="form2" id="form2" action="" method="post"> 
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Actualizacion de Usuario</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
		  <select name="idcliente" class="form-control">
		<? $listacliente = $obj->ListaTotal();
		  for($i=0;$i<count($listacliente);$i++){
		?>
		 <option value="<?=$listacliente[$i]["idcliente"]?>"><?=$listacliente[$i]["nombre"]." ".$listacliente[$i]["apellido"];?></option>
		 <?
		 }
		 ?>
		</select>
		<input class="form-control " type="text" name="usuario" id="usuario" placeholder="Usuario">
		<input class="form-control " type="text" name="clave" id="clave" placeholder="Clave">
		<select name="tipo" class="form-control">
				<option value="ADMINISTRADOR">ADMINISTRADOR</option>
				<option value="MAESTRO">MAESTRO</option>
				<option value="ALUMNO">ALUMNO</option>
		</select>
		<input name="idusuario" type="hidden" value="" id="idusuario">
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
		<input name="idusuario" type="hidden" value="">
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