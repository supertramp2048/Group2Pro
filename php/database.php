<?php
require('database.class.php');

$config = [
  'host'=>"localhost",
  'name'=>"banhangdb",
  'user'=>"root",
  'pass'=>""
];

$db = new database($config);

/*$db->table('hang')->insert([
  'TenHang' => 'Dell gaming',
  'DonVi' => 'cái',
  'DonGia' => '100000',
  'SoLuong' => '10'
]);
$db->table('hang')->deleteId(45);
$hang = $db->table("hang")->limit(15)->get();// trong lệnh này $db sẽ mặc định trỏ luôn tới table hang
print_r($hang);
foreach($hang as $h){
  echo $h['TenHang']."<br>";
}

$users = $db->table("users")->updateRow(1,[
  'UserName' => 'long',
  'email' => 'long@gmail.com'
]);
$user = $db->table('users')->limit(10)->get();
print_r($user);
foreach($user as $u){
  echo $u['password']."<br>";
}
$db->table('hang')->deleteId(45);
$hang = $db->table("hang")->limit(15)->get();// trong lệnh này $db sẽ mặc định trỏ luôn tới table hang
print_r($hang);
foreach($hang as $h){
  echo $h['TenHang']."<br>";
}
*/