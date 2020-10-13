<?php
  require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }
}
/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
/*--------------------------------------------------------------*/
/* Function for Count id  By table name
/*--------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }
 /*--------------------------------------------------------------*/
 /* Login with the data provided in $_POST,
 /* coming from the login form.
/*--------------------------------------------------------------*/
  function authenticate($NombreUsuario='', $Contraseña='') {
    global $db;
    $NombreUsuario = $db->escape($NombreUsuario );
    $Contraseña = $db->escape($Contraseña);
    $sql  = sprintf("SELECT id,NombreUsuario ,Contraseña,NivelUsuario FROM Usuario WHERE NombreUsuario  ='%s' LIMIT 1", $NombreUsuario );
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $Usuario = $db->fetch_assoc($result);
      $password_request = sha1($Contraseña);
      if($password_request === $Usuario['Contraseña'] ){
        return $Usuario['id'];
      }
    }
   return false;
  }
  /*--------------------------------------------------------------*/
  /* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
   function authenticate_v2($NombreUsuario='', $password='') {
     global $db;
     $NombreUsuario = $db->escape($NombreUsuario);
     $Contraseña = $db->escape($Contraseña);
     $sql  = sprintf("SELECT id,NombreUsuario,Contraseña,NivelUsuario FROM Usuarios WHERE NombreUsuario ='%s' LIMIT 1", $NombreUsuario);
     $result = $db->query($sql);
     if($db->num_rows($result)){
       $Usuarios = $db->fetch_assoc($result);
       $password_request = sha1($Contraseña);
       if($password_request === $Usuarios['Contraseña'] ){
         return $Usuarios;
       }
     }
    return false;
   }


  /*--------------------------------------------------------------*/
  /* Find current log in user by session id
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['Usuarios_id'])):
             $Usuarios_id = intval($_SESSION['Usuarios_id']);
             $current_user = find_by_id('Usuarios',$Usuarios_id);
        endif;
      }
    return $current_user;
  }
  /*--------------------------------------------------------------*/
  /* Find all user by
  /* Joining users table and user gropus table
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.Nombre,u.NombreUsuario,u.NivelUsuario,u.Estado,u.UltimoAcceso,";
      $sql .="g.NombreRol ";
      $sql .="FROM Usuarios u ";
      $sql .="LEFT JOIN TipoUsuario g ";
      $sql .="ON g.Cargo=u.NivelUsuario ORDER BY u.Nombre ASC";
      $result = find_by_sql($sql);
      return $result;
  }
  /*--------------------------------------------------------------*/
  /* Function to update the last log in of a user
  /*--------------------------------------------------------------*/

 function updateLastLogIn($user_id)
	{
		global $db;
    $date = make_date();
    $sql = "UPDATE Usuarios SET UltimoAcceso='{$date}' WHERE id ='{$Usuarios_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
	}

  /*--------------------------------------------------------------*/
  /* Find all Group name
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT NombreRol FROM TipoUsuario WHERE NombreRol = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Find group level
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT Cargo FROM TipoUsuario WHERE Cargo = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Function for cheaking which user level has access to page
  /*--------------------------------------------------------------*/
   function page_require_level($require_level){
     global $session;
     $current_user = current_user();
     $login_level = find_by_groupLevel($current_user['TipoUsuario']);
     //if user not login
     if (!$session->isUserLoggedIn(true)):
            $session->msg('d','Por favor Iniciar sesión...');
            redirect('index.php', false);
      //if Group status Deactive
     elseif($login_level['group_status'] === '0'):
           $session->msg('d','Este nivel de usaurio esta inactivo!');
           redirect('home.php',false);
      //cheackin log in User level and Require level is Less than or equal to
     elseif($current_user['user_level'] <= (int)$require_level):
              return true;
      else:
            $session->msg("d", "¡Lo siento!  no tienes permiso para ver la página.");
            redirect('home.php', false);
        endif;

     }
   /*--------------------------------------------------------------*/
   /* Function for Finding all product name
   /* JOIN with categorie  and media database table
   /*--------------------------------------------------------------*/
  function join_product_table(){
     global $db;
     $sql  =" SELECT p.id,p.Nombre,p.Cantidad,p.PrecioCompra,p.PrecioVenta,p.media_id,p.Fecha,c.Nombre
     ";
    $sql  .=" AS categorie,m.NombreArchivo AS Imagen";
    $sql  .=" FROM products p";
    $sql  .=" LEFT JOIN categorias c ON c.id = p.categorias_id";
    $sql  .=" LEFT JOIN media m ON m.id = p.media_id";
    $sql  .=" ORDER BY p.id ASC";
    return find_by_sql($sql);

   }
  /*--------------------------------------------------------------*/
  /* Function for Finding all product name
  /* Request coming from ajax.php for auto suggest
  /*--------------------------------------------------------------*/

   function find_product_by_title($product_name){
     global $db;
     $p_Nombre = remove_junk($db->escape($product_name));
     $sql = "SELECT Nombre FROM Productos WHERE Nombre like '%$p_Nombre%' LIMIT 5";
     $result = find_by_sql($sql);
     return $result;
   }

  /*--------------------------------------------------------------*/
  /* Function for Finding all product info by product title
  /* Request coming from ajax.php
  /*--------------------------------------------------------------*/
  function find_all_product_info_by_title($title){
    global $db;
    $sql  = "SELECT * FROM Productos ";
    $sql .= " WHERE Nombre ='{$title}'";
    $sql .=" LIMIT 1";
    return find_by_sql($sql);
  }

  /*--------------------------------------------------------------*/
  /* Function for Update product quantity
  /*--------------------------------------------------------------*/
  function update_product_qty($qty,$p_id){
    global $db;
    $qty = (int) $qty;
    $id  = (int)$p_id;
    $sql = "UPDATE Productos SET Cantidad=Cantidad -'{$qty}' WHERE id = '{$id}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);

  }
  /*--------------------------------------------------------------*/
  /* Function for Display Recent product Added
  /*--------------------------------------------------------------*/
 function find_recent_product_added($limit){
   global $db;
   $sql   = " SELECT p.id,p.Nombre,p.PrecioVenta,p.media_id,c.Nombre AS categorias,";
   $sql  .= "m.NombreArchivo AS Imagen FROM Productos p";
   $sql  .= " LEFT JOIN categorias c ON c.id = p.categorias_id";
   $sql  .= " LEFT JOIN media m ON m.id = p.media_id";
   $sql  .= " ORDER BY p.id DESC LIMIT ".$db->escape((int)$limit);
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Find Highest saleing Product
 /*--------------------------------------------------------------*/
 function find_higest_saleing_product($limit){
   global $db;
   $sql  = "SELECT p.Nombre, COUNT(s.Productos_id) AS TotalSalida, SUM(s.Cantidad) AS TotalCantidad";
   $sql .= " FROM Salida s";
   $sql .= " LEFT JOIN Productos p ON p.id = s.Productos_id ";
   $sql .= " GROUP BY s.Productos_id";
   $sql .= " ORDER BY SUM(s.Cantidad) DESC LIMIT ".$db->escape((int)$limit);
   return $db->query($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for find all sales
 /*--------------------------------------------------------------*/
 function find_all_sale(){
   global $db;
   $sql  = "SELECT s.id,s.Cantidad,s.Precio,s.Fecha,p.Nombre";
   $sql .= " FROM sales s";
   $sql .= " LEFT JOIN Productos p ON s.Productos_id = p.id";
   $sql .= " ORDER BY s.Fecha DESC";
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Display Recent sale
 /*--------------------------------------------------------------*/
function find_recent_sale_added($limit){
  global $db;
  $sql  = "SELECT s.id,s.Cantidad,s.Precio,s.Fecah,p.Nombre";
  $sql .= " FROM Salida s";
  $sql .= " LEFT JOIN Productos p ON s.Productos_id = p.id";
  $sql .= " ORDER BY s.Fecha DESC LIMIT ".$db->escape((int)$limit);
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate sales report by two dates
/*--------------------------------------------------------------*/
function find_sale_by_dates($start_date,$end_date){
  global $db;
  $start_date  = date("Y-m-d", strtotime($FechaInicio));
  $end_date    = date("Y-m-d", strtotime($FechaFinal));
  $sql  = "SELECT s.date, p.Nombre,p.PrecioVenta,p.PrecioCompra,";
  $sql .= "COUNT(s.Productos_id) AS TotalArchivos,";
  $sql .= "SUM(s.qty) AS total_sales,";
  $sql .= "SUM(p.PrecioVenta * s.Cantidad) AS TotalPrecioVenta,";
  $sql .= "SUM(p.PrecioCompra * s.Cantidad) AS TotalCompraVenta ";
  $sql .= "FROM Salida s ";
  $sql .= "LEFT JOIN Productos p ON s.Productos_id = p.id";
  $sql .= " WHERE s.date BETWEEN '{$FechaInicio}' AND '{$FechaFinal}'";
  $sql .= " GROUP BY DATE(s.Fecha),p.NombreArchivo";
  $sql .= " ORDER BY DATE(s.Fecha) DESC";
  return $db->query($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Daily sales report
/*--------------------------------------------------------------*/
function  dailySales($year,$month){
  global $db;
  $sql  = "SELECT s.qty,";
  $sql .= " DATE_FORMAT(s.Fecha, '%Y-%m-%e') AS Fecha,p.Nombre,";
  $sql .= "SUM(p.PrecioVenta * s.qty) AS TotalPrecioSalida";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN Productos p ON s.Productos_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.Fecha, '%Y-%m' ) = '{$year}-{$month}'";
  $sql .= " GROUP BY DATE_FORMAT( s.Fecha,  '%e' ),s.Productos_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Monthly sales report
/*--------------------------------------------------------------*/
function  monthlySales($year){
  global $db;
  $sql  = "SELECT s.qty,";
  $sql .= " DATE_FORMAT(s.Fecha, '%Y-%m-%e') AS Fecha,p.Nombre,";
  $sql .= "SUM(p.PrecioVenta * s.qty) AS TotalPrecioVenta";
  $sql .= " FROM Salida s";
  $sql .= " LEFT JOIN Productos p ON s.Productos_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.Fecha, '%Y' ) = '{$Año}'";
  $sql .= " GROUP BY DATE_FORMAT( s.Fecha,  '%c' ),s.Productos_id";
  $sql .= " ORDER BY date_format(s.Fecha, '%c' ) ASC";
  return find_by_sql($sql);
}

?>
