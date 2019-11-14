<?php
Use Kobisi\Config\Contoller;
Use Kobisi\Config\View;
use Kobisi\Config\Database as Sql;
class Welcome
{

  function index(){
    View::temp('welcome.php');
  }
}


 ?>
