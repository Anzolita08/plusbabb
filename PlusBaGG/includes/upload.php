<?php

class  Media {

  public $InfoImagen;
  public $NombreArchivo;
  public $TipoArchivo;
  public $RutaDelArchivo;
  //Set destination for upload
  public $RutaUsuarios = SITE_ROOT.DS.'..'.DS.'uploads/usuarios';
  public $RutaProductos = SITE_ROOT.DS.'..'.DS.'uploads/productos';


  public $errors = array();
  public $upload_errors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'Ningun archivo fue subido',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.'
  );
  public$upload_extensions = array(
   'gif',
   'jpg',
   'jpeg',
   'png',
  );
  public function file_ext($NombreArchivo){
     $ext = strtolower(substr( $NombreArchivo, strrpos( $NombreArchivo, '.' ) + 1 ) );
     if(in_array($ext, $this->upload_extensions)){
       return true;
     }
   }

  public function upload($file)
  {
    if(!$file || empty($file) || !is_array($file)):
      $this->errors[] = "Ningún archivo subido.";
      return false;
    elseif($file['error'] != 0):
      $this->errors[] = $this->upload_errors[$file['error']];
      return false;
    elseif(!$this->file_ext($file['nombre'])):
      $this->errors[] = 'Formato de archivo incorrecto ';
      return false;
    else:
      $this->InfoImagen = getimagesize($file['tmp_Nombre']);
      $this->NombreArchivo  = basename($file['Nombre']);
      $this->TipoArchivo  = $this->imageInfo['Mimica'];
      $this->RutaDelArchivo = $file['tmp_Nombre'];
     return true;
    endif;

  }

 public function process(){

    if(!empty($this->errors)):
      return false;
    elseif(empty($this->fileName) || empty($this->RutaDelArchivo)):
      $this->errors[] = "La ubicación del archivo no esta disponible.";
      return false;
    elseif(!is_writable($this->RutaProductos)):
      $this->errors[] = $this->RutaProductos." Debe tener permisos de escritura!!!.";
      return false;
    elseif(file_exists($this->RutaProductos."/".$this->NombreArchivo)):
      $this->errors[] = "El archivo {$this->fileName} realmente existe.";
      return false;
    else:
     return true;
    endif;
 }
 /*--------------------------------------------------------------*/
 /* Function for Process media file
 /*--------------------------------------------------------------*/
  public function process_media(){
    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->NombreArchivo) || empty($this->RutaDelArchivo)){
        $this->errors[] = "La ubicación del archivo no se encuenta disponible.";
        return false;
      }

    if(!is_writable($this->RutaProductos)){
        $this->errors[] = $this->RutaProductos." Debe tener permisos de escritura!!!.";
        return false;
      }

    if(file_exists($this->RutaProductos."/".$this->NombreArchivo)){
      $this->errors[] = "El archivo {$this->NombreArchivo} Realmente existe.";
      return false;
    }

    if(move_uploaded_file($this->RutaDelArchivo,$this->RutaProductos.'/'.$this->NombreArchivo))
    {

      if($this->insert_media()){
        unset($this->RutaDelArchivo);
        return true;
      }

    } else {

      $this->errors[] = "Error en la carga del archivo, posiblemente debido a permisos incorrectos en la carpeta de carga.";
      return false;
    }

  }
  /*--------------------------------------------------------------*/
  /* Function for Process user image
  /*--------------------------------------------------------------*/
 public function process_user($id){

    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->NombreArchivo) || empty($this->RutaDelArchivo)){
        $this->errors[] = "La ubicación del archivo no estaba disponible.";
        return false;
      }
    if(!is_writable($this->RutaUsuarios)){
        $this->errors[] = $this->RutaUsuarios." Debe tener permisos de escritura";
        return false;
      }
    if(!$id){
      $this->errors[] = " ID de usuario ausente.";
      return false;
    }
    $ext = explode(".",$this->NombreArchivo);
    $new_name = randString(8).$id.'.' . end($ext);
    $this->NombreArchivo = $new_name;
    if($this->user_image_destroy($id))
    {
    if(move_uploaded_file($this->RutaDelArchivo,$this->RutaUsuarios.'/'.$this->NombreArchivo))
       {

         if($this->update_userImg($id)){
           unset($this->RutaDelArchivo);
           return true;
         }

       } else {
         $this->errors[] = "Error en la carga del archivo, posiblemente debido a permisos incorrectos en la carpeta de carga.";
         return false;
       }
    }
 }
 /*--------------------------------------------------------------*/
 /* Function for Update user image
 /*--------------------------------------------------------------*/
  private function update_userImg($id){
     global $db;
      $sql = "UPDATE users SET";
      $sql .=" Imagen='{$db->escape($this->NombreArchivo)}'";
      $sql .=" WHERE id='{$db->escape($id)}'";
      $result = $db->query($sql);
      return ($result && $db->affected_rows() === 1 ? true : false);

   }
 /*--------------------------------------------------------------*/
 /* Function for Delete old image
 /*--------------------------------------------------------------*/
  public function user_image_destroy($id){
     $image = find_by_id('users',$id);
     if($Imagen['Imagen'] === 'no_Imagen.jpg')
     {
       return true;
     } else {
       unlink($this->userPath.'/'.$Imagen['Imagen']);
       return true;
     }

   }
/*--------------------------------------------------------------*/
/* Function for insert media image
/*--------------------------------------------------------------*/
  private function insert_media(){

         global $db;
         $sql  = "INSERT INTO media ( NombreArchivo,TipoArchivo )";
         $sql .=" VALUES ";
         $sql .="(
                  '{$db->escape($this->NombreArchivo)}',
                  '{$db->escape($this->TipoArchivo)}'
                  )";
       return ($db->query($sql) ? true : false);

  }
/*--------------------------------------------------------------*/
/* Function for Delete media by id
/*--------------------------------------------------------------*/
   public function media_destroy($id,$file_name){
     $this->NombreArchivo = $NombreArchivo;
     if(empty($this->NombreArchivo)){
         $this->errors[] = "Falta el archivo de foto.";
         return false;
       }
     if(!$id){
       $this->errors[] = "ID de foto ausente.";
       return false;
     }
     if(delete_by_id('media',$id)){
         unlink($this->RutaProductos.'/'.$this->NombreArchi);
         return true;
     } else {
       $this->error[] = "Se ha producido un error en la eliminación de fotografías.";
       return false;
     }

   }



}


?>
