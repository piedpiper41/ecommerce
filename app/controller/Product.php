<?php
Use Kobisi\Config\Contoller;
use Kobisi\Config\Database as Sql;
class Product
{
  function index(){
    $data = Sql::all('products','*',[],['ID','desc'],[rand(0,1000),10]);
    return Controller::json($data);
  }
  function insert($request){
    $post = $request->post;
    if(!empty($post->title) && !empty($post->content) && !empty($post->images) && !empty($post->price) && !empty($post->regular_price)){
      $insert = Sql::insert('products',[
        'Title'=>$post->title,
        'Content'=>$post->content,
        'Images'=>$post->images,
        'Price'=>$post->price,
        'Regular_Price'=>$post->regular_price,
      ]);

      return Controller::json(array('msg'=>'Başarıyla eklendi'));
    }else{
      return Controller::json(array('error'=>'içerikleri tam doldurunuz.'));
    }
  }
}


 ?>
