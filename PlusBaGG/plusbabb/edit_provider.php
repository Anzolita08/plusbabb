<?php
  $page_title = 'Editar proveedor';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$provide = find_by_id('provider',(int)$_GET['id']);
$all_provider = find_all('provide');
 redirect('provider.php');
}
?>
<?php
 if(isset($_POST['provider'])){
    $req_fields = array('name','address');
    validate_fields($req_fields);

   if(empty($errors)){
       $p_name  = remove_junk($db->escape($_POST['provide-title']));
       $p_cat   = (int)$_POST['provide-categorie'];
       $query   = "UPDATE provider SET";
       $query  .=" name ='{$pr_name}', address ='{$pr_address}',";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"proveeodr ha sido actualizado. ");
                 redirect('provider.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('edit_provider.php?id='.$provider['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_provider.php?id='.$provider['id'], false);
   }

 }