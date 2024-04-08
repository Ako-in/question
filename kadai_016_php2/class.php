<?php
class Food{
  // プロパティを定義する
  private $name;
  private $price;
  // メソッドを定義する
  // function set_name($name){
  //   $this->name = $name;
  // }
  // function show_name(){
  //   // echo $this->name;
  // }
  // function set_price($price){
  //   $this->price = $price;
  // }
  // function show_price(){
  // return $this->price;
  // }
  
  // コンストラクタで定義する
  function __construct(string $name, int $price){
    $this->name = $name;
    $this->price =$price;
  }
}

//インスタンス化する
// $potato = new Food();
// $potato->set_name('potato');
// $potato->show_name();
$potato = new Food('potato',250);

// $potato->set_price('250');
$potato->show_price();

print_r($potato);
echo '<br>';

class Animal{
  private $name;
  private $height;
  private $weight;
  // function set_name($name){
  //   $this->name = $name;
  // }
  // function show_name(){
  //   return $this->name;
  // }
  // function set_height($height){
  //   $this->height = $height;
  // }
  // function show_height(){
  //   return $this->height;
  // }
  // function set_weight($weight){
  //   $this->weight = $weight;
  // }
  // function show_weight(){
  //   return $this->wight;
  // }

  function __construct(string $name, int $height, int $weight){
    $this->name = $name;
    $this->height= $height;
    $this->weight=$weight;
  }
}

$dog = new Animal('dog', 60, 5000);
// $dog->set_name('dog');
// $dog->set_height('60');
// $dog->set_weight('5000');

print_r($dog);
echo '<br>';

echo $potato->price;
// privateアクセスになっているからエラーになる。
// publicに変更すると課題の内容から外れてしまう。
echo $dog->height;