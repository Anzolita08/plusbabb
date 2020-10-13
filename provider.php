<?php
  $page_title = 'Lista de Proveedores';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);

  $all_provider = find_all('provider')
?>
<?php
 if(isset($_POST['add_pro'])){
   $req_field = array('provider-name');
   validate_fields($req_field);
   $provider_name = remove_junk($db->escape($_POST['provider-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO provider (name)";
      $sql .= " VALUES ('{$pro_name}')";
      if($db->query($sql)){
        $session->msg("s", "Provedor  agregada exitosamente.");
        redirect('provider.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
        redirect('provider.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('provider.php',false);
   }
 }
 
 if(isset($_POST['add_pro'])){
   $req_field = array('provider-address');
   validate_fields($req_field);
   $provider_name = remove_junk($db->escape($_POST['provider-address']));
   if(empty($errors)){
      $sql  = "INSERT INTO provider (address)";
      $sql .= " VALUES ('{$pro_address}')";
      if($db->query($sql)){
        $session->msg("s", "Provedor  agregada exitosamente.");
        redirect('provider.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
        redirect('provider.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('provider.php',false);
   }
 }

 
 if(isset($_POST['add_pro'])){
   $req_field = array('provider-phone');
   validate_fields($req_field);
   $provider_name = remove_junk($db->escape($_POST['provider-phone']));
   if(empty($errors)){
      $sql  = "INSERT INTO provider (phone)";
      $sql .= " VALUES ('{$pro_phone}')";
      if($db->query($sql)){
        $session->msg("s", "Provedor  agregada exitosamente.");
        redirect('provider.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
        redirect('provider.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('provider.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>

      </div>
    </div>
    <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de Provedores</span>
       </strong>
      </div>
       <a href="add_provider.php" class="btn btn-primary">Agregar provedor </a>
             <td width="200"><a target="_blank" href="report_providers.php" class="btn btn-danger">Exportar a PDF</a></td>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Provedores</th>
                    <th class="text-center" style="width: 200px;">Email</th>
                     <th class="text-center" style="width: 100px;">Sucursal</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_provider as $pro):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($pro['name'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($pro['address'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($pro['phone'])); ?></td>
                     <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_provider.php?id=<?php echo (int)$pro['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_provider.php?id=<?php echo (int)$pro['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
