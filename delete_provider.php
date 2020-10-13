<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  $provider = find_by_id('provider',(int)$_GET['id']);
  if(!$provider){
    $session->msg("d","ID vac�o.");
    redirect('provider.php');
  }
?>
<?php
  $delete_id = delete_by_id('provider',(int)$provider['id']);
  if($delete_id){
      $session->msg("s","Proveedor eliminado.");
      redirect('provider.php');
  } else {
      $session->msg("d","Eliminaci�n fall�");
      redirect('sales.php');
  }
?>
