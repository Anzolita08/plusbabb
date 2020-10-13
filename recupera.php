<?php
$Host='localhost';
$Users='root';
$password='';
$Basededatos='plusbagg';

$mysqli = new mysqli($Host,$Users,$password,$Basededatos);

if ($mysqli->connect_errno) {
echo "Fallo de conexion";
}

 //fin de la conexion

$formcontrol= $_POST['email'];
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
// Salida: XXX
$generate = substr(str_shuffle($permitted_chars), 0, 10);
$pass = md5($generate);

$sql = "UPDATE users SET password='$pass' WHERE email = '$formcontrol'";

if (mysqli_query($mysqli, $sql)) {
     echo "New record created successfully";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
}


$cuerpo=123;
$Destinatario=$_POST['email'];
$cabecera="To: usuario <".$Destinatario.">";
if(mail($Destinatario,"Contraseña temporal cuenta de correo" , 'Su nueva contraseña es :'.$generate,$cabecera)){

echo "Correo Enviado con exito";
}else{
echo "Algo salio mal";
}
 ?>
<html>
	<head>
		<title>Recuperar Password</title>
		
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
	</head>
	
	<body>
		
		<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Recuperar Password</div>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>     
					
					<div style="padding-top:30px" class="panel-body" >
						
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="on">
							
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="email" type="email" class="formcontrol" name="email" placeholder="email" required>                                        
							</div>
							
							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-success">Enviar</a>
								</div>
							</div>
							
							
								</div>
							</div>    
						</form>
				
					</div>                     
				</div>  
			</div>
		</div>
	</body>
</html>