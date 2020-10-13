<?php
 session_start();

class Session {

 public $msg;
 private $Usuarios_is_logged_in = false;

 function __construct(){
   $this->flash_msg();
   $this->UsuariosLoginSetup();
 }

  public function isUserLoggedIn(){
    return $this->Usuarios_is_logged_in;
  }
  public function login($Usuarios_id){
    $_SESSION['Usuarios_id'] = $Usuarios_id;
  }
  private function userLoginSetup()
  {
    if(isset($_SESSION['Usuarios_id']))
    {
      $this->Usuarios_is_logged_in = true;
    } else {
      $this->Usuarios_is_logged_in = false;
    }

  }
  public function logout(){
    unset($_SESSION['Usuarios_id']);
  }

  public function msg($type ='', $msg =''){
    if(!empty($msg)){
       if(strlen(trim($type)) == 1){
         $type = str_replace( array('d', 'i', 'w','s'), array('danger', 'info', 'warning','success'), $type );
       }
       $_SESSION['msg'][$type] = $msg;
    } else {
      return $this->msg;
    }
  }

  private function flash_msg(){

    if(isset($_SESSION['msg'])) {
      $this->msg = $_SESSION['msg'];
      unset($_SESSION['msg']);
    } else {
      $this->msg;
    }
  }
}

$session = new Session();
$msg = $session->msg();

?>
