<?php $Usuarios = UsuarioActual(); ?>
<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title><?php if (!empty($pagina_title))
           echo remove_junk($pagina_title);
            elseif(!empty($Usuarios))
           echo ucfirst($Usuarios['Nombre']);
            else echo "Sistema simple de inventario";?>
    </title>
	
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
  </head>
  <body>
  <?php  if ($session->isUserLoggedIn(true)): ?>
    <header id="header">
      <div class="logo pull-left"> PlusBag - Inventario </div>
      <div class="header-content">
      <div class="header-date pull-left">
        <strong><?php echo date("d/m/Y  g:i a");?></strong>
      </div>
      <div class="pull-right clearfix">
        <ul class="info-menu list-inline list-unstyled">
          <li class="profile">
            <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
              <img src="uploads/Usuarios/<?php echo $Usuarios['Imagen'];?>" alt="Usuarios-Imagen" class="img-circle img-inline">
              <span><?php echo remove_junk(ucfirst($Usuarios['Nombre'])); ?> <i class="caret"></i></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                  <a href="profile.php?id=<?php echo (int)$Usuarios['id'];?>">
                      <i class="glyphicon glyphicon-Usuarios"></i>
                      Perfil
                  </a>
              </li>
             <li>
                 <a href="edit_account.php" title="edit account">
                     <i class="glyphicon glyphicon-cog"></i>
                     Configuración
                 </a>
             </li>
             <li class="last">
                 <a href="logout.php">
                     <i class="glyphicon glyphicon-off"></i>
                     Salir
                 </a>
             </li>
           </ul>
          </li>
        </ul>
      </div>
     </div>
    </header>
    <div class="sidebar">
      <?php if($user['Cargo'] === '1'): ?>
        <!-- admin menu -->
      <?php include_once('MenuAdmi.php');?>

      <?php elseif($user['Cargo'] === '2'): ?>
        <!-- Special user -->
      <?php include_once('MenuEspecial.php');?>

      <?php elseif($user['Cargo'] === '3'): ?>
        <!-- User menu -->
      <?php include_once('MenuUsuario.php');?>

      <?php endif;?>

   </div>
<?php endif;?>

<div class="pagina">
  <div class="container-fluid">
