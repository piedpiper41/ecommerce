<?php
  function __autoload($class_name){
          $parts = explode('\\', $class_name);
          $class_name = end($parts);
          $classesPath = __DIR__.'/../config/'.$class_name.'.php';
          $controllersPath = __DIR__.'/../app/controller/'.$class_name.'.php';
          $modelsPath = __DIR__.'/../app/model/'.$class_name.'.php';
          if(file_exists($classesPath)){
              require_once($classesPath);
          }else if(file_exists($controllersPath)){
              require_once($controllersPath);
          }else if(file_exists($modelsPath)){
              require_once($modelsPath);
          }
  }
  require_once(__DIR__.'/../config/helper.php');
  require_once(__DIR__.'/../routes/routes.php');
 ?>
