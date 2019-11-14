<?php
Use Kobisi\Config\Contoller;
Use Kobisi\Models\User;
use Kobisi\Config\Database as Sql;
class Home{
  public function index(){
    $date = date('Y-m-d 00:00:00');
    $data['Product_Total'] = Sql::first('products','count(ID) as total');
    $data['Today_Sales'] = Sql::first('sales','count(ID) as total',[
      ['Crate_Date',strval($date),'>']
    ]);
    $data['data'] = Sql::all('sales','Content,Title,products.ID,count(sales.ID) as total',[],['total','DESC'],[0,10],'sales.Products_ID',[
      ['products','products.id','=','sales.Products_ID']
    ]);
    return Controller::json($data);
  }
  public function TopList($request){
    $day = date('Y-m-d');
    $week = date('Y-m-d', strtotime("-1 week"));
    $mont = date('Y-m-d', strtotime("-1 month"));
    $arr = [$day,$week,$mont];
    if(!empty($arr[(int)$request->params->id])){
      $date = $arr[(int)$request->params->id];
      $data['data'] = Sql::all('sales','users.id,users.name,sum(products.price) as totalPrice',[
        ['Crate_Date',strval($date),'>']
      ],['totalPrice','DESC'],[0,10],'sales.user_id',[
        ['products','products.id','=','sales.Products_ID'],
        ['users','users.id','=','sales.user_id']
      ]);
      return Controller::json($data);
    }
  }
  public function user(){
    $data = file_get_contents('https://raw.githubusercontent.com/pixelastic/fakeusers/master/data/randomuser.json');
    foreach (json_decode($data) as $key => $value) {
       $timestamp = date("Y-m-d H:i:s");
      $param['name'] = $value->first_name;
      $param['email'] = $value->email;
      $param['password'] = md5($value->password);
      $param['created_at'] = $timestamp;
      $param['updated_at'] = $timestamp;
        User::UserInsert($param);
    }
    $data = User::userlist();
      //return Controller::json($data);
  }
  public function products(){
    set_time_limit(0);
    $data = file_get_contents('https://kobisi.autok2cdn.store/urunler.json');
    for ($i=0; $i < 2; $i++) {
      foreach (json_decode($data)[2]->data as $key => $value) {
        $param['Title'] = $value->Title;
        $param['Content'] = $value->Content;
        $param['Images'] = $value->Media_images;
        $param['Price'] = $value->Price;
        $param['Regular_Price'] = $value->Regular_Price;
        $param['Slug'] = $value->Slug.'-'.rand(1,100);
        if($key < 500){
          Sql::insert('products',$param);
        }
      }
    }

  }
}

?>
