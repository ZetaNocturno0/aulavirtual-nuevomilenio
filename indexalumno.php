<?
session_start();
if(!isset($_SESSION['usuario']))
{
 	echo "<script languaje='JavaScript'>";       
	echo "parent.location.href='login.php'; ";
	echo "</script>";
}

include "clases/Usuario.class.php"; $obju = new Usuario();
include "clases/Cliente.class.php"; $objc = new Cliente();

if($obju->BuscarPorUsuario($_SESSION['usuario'])){
	$idusuario = $obju->getIdusuario();
	$idcliente = $obju->getIdcliente();
	$objc->BuscarPorCodigo($idcliente);
	$cliente = $objc->getNombre();
}
 $dia = date("Y-m-d");

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Clase Virtual Nuevo Milenio</title>
<link rel="icon" href="img/logo.ico">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
function guardar(f)
{   if(f.monto.value==""){
		 f.monto.focus();
		 return false;
	}
	if(f.concepto.value==""){
		 f.concepto.focus();
		 return false;
	}
	
		   f.action='controladores/CajaController.php';
		   f.submit();
		   return true;		 
}
function actualizar(f){
   if(f.montofin.value==""){
		 f.montofin.focus();
		 return false;
	}
	f.action='controladores/CajaController.php';
		   f.submit();
		   return true;
}
</script>
</head>

<body>

<nav class="navbar navbar-default">
	<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
			</button>
				<a class="navbar-brand" style="font-family:Verdana, Arial, Helvetica, sans-serif">Clase Virtual Nuevo Milenio</a>
		</div>
    <!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="indexalumno.php"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"  style="font-family:Verdana, Arial, Helvetica, sans-serif">Marketing Empresarial<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="manmarkealum.php?variable=<?php echo $idcliente; ?>&variable2=<?php echo $cliente; ?>" target="main" style="font-family:Verdana, Arial, Helvetica, sans-serif"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Lista de Clases</a></li>
					</ul>
		  		</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"  style="font-family:Verdana, Arial, Helvetica, sans-serif">Secretariado Ejecutivo<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="mansecrealum.php?variable=<?php echo $idcliente; ?>&variable2=<?php echo $cliente; ?>" target="main" style="font-family:Verdana, Arial, Helvetica, sans-serif"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Lista de Clases</a></li>			              
					</ul>
				</li>
			</ul>  
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="login.php">
						<p data-placement="top" data-toggle="tooltip" title="Cerrar Sesion">
							<button class="btn btn-danger btn-xs" data-title="Link" data-toggle="modal">
								<span class="glyphicon glyphicon-off"></span>
							</button>
						</p>
					</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a style="font-family:Verdana, Arial, Helvetica, sans-serif">Hola <?=$cliente;?>  <span class="glyphicon glyphicon-user"></span></a></li>
			</ul>

		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<div class="row">
				<div class="col-md-12">
					<iframe name="main" width="100%" height="550px" frameborder="0" src="contenido.php"></iframe>
				</div>
			</div>
</body>
</html>
