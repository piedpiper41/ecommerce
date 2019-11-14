<?php
/**
 *
 */
class Helper
{
  public function LoadPhp($file){
    if(file_exists($file)){
      require $file;
    }else{
      return false;
    }
  }

}
function asset($path = ""){
  return $_SERVER ['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER ['SERVER_NAME'] . $path;
}
 ?>
