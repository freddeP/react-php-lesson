<?php
session_set_cookie_params([
    "httponly"=>true,
    "samesite"=>'strict'
]);
session_start();

require_once("Router.php");



// ROUTES


Router::get("/", function(){

  include("client/dist/static.html");

});


Router::get("/data", function(){

    header("Content-Type:application/json");
    $data = [
        [
            "brand"=>"Tesla",
            "model"=>"S long range",
            "id"=>uniqid(true)
        ],
        [
            "brand"=>"Saab",
            "model"=>"9-7X",
            "id"=>uniqid(true)
        ],
        [
            "brand"=>"MB",
            "model"=>"S500",
            "id"=>uniqid(true)
        ]
    ];


    echo json_encode($data, JSON_PRETTY_PRINT);

});





Router::listen();


