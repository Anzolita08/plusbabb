<?php
  $page_title = 'Editar Provedor';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $provider = find_by_id('provider',(int)$_GET['id']);
  
  if(!$provider){
    $session->msg("d","Missing user id.");
    redirect('provider.php');
  }
?>

<?php
//Update User basic info
  if(isset($_POST['update'])) {
    $req_fields = array('name','address','phone');
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$provider['id'];
           $name = remove_junk($db->escape($_POST['name']));
       $address = remove_junk($db->escape($_POST['address']));
       $phone = remove_junk($db->escape($_POST['phone']));
            $sql = "UPDATE provider SET name ='{$name}', address ='{$address}',phone='{$phone}' WHERE id='{$db->escape($id)}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Provedor Actualizado ");
            redirect('provider.php?id='.(int)$provider['id'], false);
          } else {
            $session->msg('d',' Lo siento no se actualizó los datos.');
            redirect('edit_provider.php?id='.(int)$provider['id'], false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_provider.php?id='.(int)$provider['id'],false);
    }
  }
?>
<?php include_once('layouts/header.php'); ?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          Actualiza Tu Provedor <?php echo remove_junk(ucwords($provider['name'])); ?>
        </strong>
       </div>
       <div class="panel-body">
          <form method="post" action="edit_provider.php?id=<?php echo (int)$provider['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="name" class="control-label">Email</label>
                  <input type="name" class="form-control" name="name" value="<?php echo remove_junk(ucwords($provider['name'])); ?>">
            </div>
            <div class="form-group">
                  <label for="address" class="control-label">Sucursal</label>
                  <input type="text" class="form-control" name="address" value="<?php echo remove_junk(ucwords($provider['address'])); ?>">
            </div>
            <div class="form-group">
                  <label for="phone" class="control-label">Telefono</label>
                  <input type="text" class="form-control" name="phone" value="<?php echo remove_junk(ucwords($provider['phone'])); ?>">
            </div>
            </div>
            <div class="form-group clearfix">
                  <button type="submit" name="update" class="btn btn-primary">Actualizar provedor</button>
               </div>
        </form>
      </div>
    </div>
  </div>

 </div>
<?php include_once('layouts/footer.php'); ?>
