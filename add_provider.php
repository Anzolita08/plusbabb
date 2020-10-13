<?php
  $page_title = 'Agregar provedores';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(4);
  $groups = find_all('user_groups');
?>
<?php
  if(isset($_POST['add_provider'])){

   $req_fields = array('name','address','phone');
   validate_fields($req_fields);

   if(empty($errors)){
      $p_name    = remove_junk($db->escape($_POST['name']));
      $p_address = remove_junk($db->escape($_POST['address']));
      $p_phone   = remove_junk($db->escape($_POST['phone']));



        $query = "INSERT INTO provider (";
        $query .="name,address,phone";
        $query .=") VALUES (";
        $query .="'{$p_name}','{$p_address}','{$p_phone}'";
        $query .=")";
        $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";

        if($db->query($query)){
          //sucess
          $session->msg('s'," El Proveedor a sido agregado correctamente");
          redirect('add_provider.php', false);
        } else {
          //failed
          $session->msg('d',' No se pudo agregar el provedor');
          redirect('provider.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_provider.php',false);
   }
 }

?>
<?php include_once('layouts/header.php'); ?>
  <?php echo display_msg($msg); ?>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar proveedor</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <form method="post" action="add_provider.php">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" placeholder="Digite El nombre del proveedor" required>
            </div>
            <div class="form-group">
                <label for="address">Correo</label>
                <input type="text" class="form-control" name="address" placeholder="Direccion de correo electronico del proveedor">
            </div>

            <div class="form-group">
                <label for="phone">Sucursal</label>
                <input type="phone" class="form-control" name ="phone"  placeholder="Direccion del  Proveedor">
            </div>
            <div class="form-group clearfix">
             <button type="submit" name="add_provider" class="btn btn-danger">Agregar provedor</button>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
