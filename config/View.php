<?php
namespace Kobisi\Config;
class View{

    public static function temp($tempname,$data = array()){
        require_once(__DIR__.'/../resources/view/'.$tempname);
    }
}

?>
