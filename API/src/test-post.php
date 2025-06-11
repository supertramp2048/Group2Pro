<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
//header('Access-Control-Allow-Origin: http://localhost:5174');//test
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: token, Content-Type');
$data = [
    [ "id" => 1, "title" => "Iphone 8 plus", "views" => 200, "src" => "/images/iphone8plus.png", "price" => 10000000, "categoryId" => 1 ],
    [ "id" => 2, "title" => "Iphone 13", "views" => 200, "src" => "/images/iphone13.png", "price" => 10000000, "categoryId" => 1 ],
    [ "id" => 3, "title" => "Iphone 15 pro", "views" => 200, "src" => "/images/iphone15pro.png", "price" => 10000000, "categoryId" => 1 ],
    [ "id" => 7, "title" => "Iphone 16 pro", "views" => 200, "src" => "/images/iphone16pro.png", "price" => 10000000, "categoryId" => 1 ],
    [ "id" => 4, "title" => "Dell gaming", "views" => 200, "src" => "/images/dellGaming.png", "price" => 10000000, "categoryId" => 2 ],
    [ "id" => 5, "title" => "Asus ROG", "views" => 200, "src" => "/images/asusROG.png", "price" => 10000000, "categoryId" => 2 ],
    [ "id" => 6, "title" => "Acer Nitro 5", "views" => 200, "src" => "/images/AceNitro.png", "price" => 10000000, "categoryId" => 2 ]
];

header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>