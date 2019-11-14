<?php
namespace Kobisi\Config;
use PDO;
class Database{

    public static $host = 'localhost';
    public static $dbName = 'kobisi';
    public static $username = 'root';
    public static $password = '';
    public static $sql = '';
    public static $params = [];
    private static function connect(){
        $pdo = new PDO('mysql:host='.self::$host.';dbname='.self::$dbName.';charset=utf8', self::$username, self::$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function all($table,$select='*',$where = array(),$orderBy=null,$limit=null,$groupby=null,$join=array()){
        Self::$sql = "";
        Self::select($table,$select);
        Self::join_all($join);
        Self::where_all($where);
        Self::GroupBy($groupby);
        Self::OrderBy($orderBy);
        Self::limit($limit);
        $statement = self::connect()->prepare(Self::$sql);
        $statement = Self::bindValues($statement);
        $statement->execute(Self::$params);
        if(explode(' ', Self::$sql)[0] == 'SELECT'){
            $data = $statement->fetchAll(PDO::FETCH_OBJ);
            return $data;
        }
    }
    public static function first($table,$select='*',$where = array(),$orderBy=null,$limit=null){
        Self::$sql = "";
        Self::select($table,$select);
        Self::where_all($where);
        Self::OrderBy($orderBy);
        Self::limit($limit);
        $statement = self::connect()->prepare(Self::$sql);
        $statement = Self::bindValues($statement);
        $statement->execute();
        if(explode(' ', Self::$sql)[0] == 'SELECT'){
            $data = $statement->fetch(PDO::FETCH_OBJ);
            return $data;
        }
    }
    public static function insert($table, $params = array()){
        Self::$sql = "";
        Self::prepares($table,$params);
        $statement = self::connect()->prepare(Self::$sql);
        $statement->execute(Self::$params);
        return $statement;
    }
    public static function prepares($table,$params = array()){
       Self::$params = [];
       Self::$sql = 'INSERT INTO '.$table.' SET';
       foreach ($params as $key => $value) {
         $param[] = ' '.$key.' = ?';
         Self::$params[] = $value;
       }
       Self::$sql .= implode($param,',');
    }
    public static function OrderBy($orderBy){
      if(count($orderBy) == 2){
        Self::$sql .= ' ORDER BY '.$orderBy[0].' '.$orderBy[1];
      }
    }
    public static function limit($limit){
      if(count($limit) == 2){
        Self::$sql .= ' LIMIT '.(int)$limit[0].', '.(int)$limit[1];
      }elseif(count($limit) == 1){
        Self::$sql .= ' LIMIT '.$limit[0];
      }
    }
    public static function GroupBy($column){
      if(!empty($column)){
        Self::$sql .= ' GROUP BY ' . $column;
      }

    }
    public static function select($table,$select = "*"){
       Self::$sql .= 'SELECT '.$select.' FROM '.$table;
       return Self::$sql;
    }
    private function join_all($array){
      foreach ($array as $key => $value) {
        Self::join($value[0],$value[1],$value[2],$value[3]);
      }
    }
    public static function join($from, $value = '', $mark = '=', $value2 = ''){
      Self::$sql .= ' inner join';
      Self::$sql .= ' '.$from.' on '.$value.' '.$mark.' '.$value2;
      return Self::$sql;
    }
    private function where_all($array){
      foreach ($array as $key => $value) {
        Self::where($value[0],$value[1],$value[2]);
      }
    }
    public static function where($column, $value = '', $mark = '=', $logical = '&&'){
      if(strstr(Self::$sql,'WHERE')){
        Self::$sql .= ' '.$logical.' '.$column.' '.$mark.' :'.strtolower($column);
      }else{
        Self::$sql .= ' WHERE';
        Self::$sql .= ' '.$column.' '.$mark.' :'.strtolower($column);
      }
      Self::$params[strtolower($column)] = $value;
      return Self::$sql;
    }
    private function bindValues($statement){
      foreach (Self::$params as $key => $value) {
        $statement->bindParam(':'.$key, $value, PDO::PARAM_STR);
      }
      return $statement;
    }
}

?>
