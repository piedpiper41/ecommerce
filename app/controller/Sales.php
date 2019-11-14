<?php
Use Kobisi\Config\Contoller;
use Kobisi\Config\Database as Sql;
class Sales
{

  function insert($request){
    $post = $request->post;
    // uye girişi yapılmadığı için post olarak alıp yaptım
    if(!empty($post->user_id) && !empty($post->products_id)){
      $query = Sql::first('products','ID',[
        ['ID',$post->products_id,'=']
      ]);
      if(!empty($query->ID)){
        $insert = Sql::insert('sales',[
          'User_ID' => $post->user_id,
          'Products_ID' => $post->products_id
        ]);
        if($insert){
          return Controller::json(array('msg'=>'Başarıyla eklendi'));
        }
      }else{
        return Controller::json(array('error'=>'Böyle bir içerik bulunamadı.'),401);
      }
    }else{
      return Controller::json(array('error'=>'içerikleri tam doldurunuz.'),401);
    }
  }
  function randomsales(){
    for ($i=0; $i < 100; $i++) {
      $date = date('Y-m-d H:i:s', strtotime("-".rand(1,30)." day"));
      $data = [
        'User_ID' => rand(1,100),
        'Products_ID' => rand(1,1000),
        'Crate_Date' => $date
      ];
      $insert = Sql::insert('sales',$data);
    }

    return Controller::json($data);
  }
}


 ?>
