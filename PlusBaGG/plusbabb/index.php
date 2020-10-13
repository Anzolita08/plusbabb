<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>


<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
       <h1>Bienvenido a PlusBag</h1>
       <p>Iniciar sesión </p>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="auth.php" class="clearfix">
           <a href="recupera.php" class=""underlineHover>Olvidaste tu contraseña?</a>
        <div class="form-group">
  <br>
        <div class="form-group">
              <label for="username" class="control-label">Usuario</label>
              <input type="name" class="form-control" name="username" placeholder="Usuario">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Contraseña</label>
            <input type="password" name= "password" class="form-control" placeholder="Contraseña">
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-info  pull-right">Entrar</button>
<div class="container">
    <form action="userAccount.php" method="post">
        <input type="email" name="email" placeholder="EMAIL" required="">
        <input type="password" name="password" placeholder="PASSWORD" required="">
        <div class="send-button">
            <input type="submit" name="loginSubmit" value="LOGIN">
        </div>
        <a href="forgotPassword.php">Forgot password?</a>
    </form>
</div>
  