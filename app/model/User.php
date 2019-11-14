<?php
namespace Kobisi\Models;
use Kobisi\Config\Database as Sql;

class User
{
  public static function userlist(){
    return Sql::query('SELECT * FROM users');
  }
  public static function UserInsert($params){
    return Sql::insert('users',$params);
  }
}


 ?>
