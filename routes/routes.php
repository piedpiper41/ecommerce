<?php
Use Kobisi\Config\Route;
// Product //
Route::post('/products/insert', function($request){
  Product::insert($request);
});
Route::post('/products/list', function($request){
  Product::index();
});
// Product //
// sales //
Route::post('/sales/insert', function($request){
  Sales::insert($request);
});
  // random sales //
  Route::get('/sales/random', function($request){
    Sales::randomsales($request);
  });
  // random sales //
// sales //
// Home //
Route::post('/home/list', function(){
    Home::index();
});
Route::post('/home/list/:id', function($request){
    Home::toplist($request);
});
  // producs data random insert//
  Route::get('/products/random', function($request){
      Home::products($request);
  });
  // producs data random insert//
// Home //
// group ve middleware yapılmadı.//
Route::get('/', function(){
    Welcome::index();
});
Route::get('/:any', function(){
    Welcome::index();
});

?>
