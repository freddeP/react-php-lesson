<?php
session_set_cookie_params([
    "httponly"=>true,
    "samesite"=>'strict'
]);
session_start();

require_once("Router.php");
require_once("Classes/Db.php");
require_once("Classes/Debug.php");
require_once("Classes/Auth.php");



// ROUTES


Router::get("/db", function(){

    Debug::print(Db::createQuote("Snart Lunch","Vad är det för mat idag?",12,"LENNY"));

    Debug::print(Db::readQuotes());

});

//QUOTES-ROUTES
Router::get("/quotes", function(){

    header("Content-Type:application/json");
    echo json_encode( Db::readQuotes(), JSON_PRETTY_PRINT);

});

Router::post("/quotes", function(){

    $title = $_POST['title'];
    $body = $_POST['body'];
    $user_id = 12;   // Hämtas senare från sessions
    $author = "Lenny"; // Hämtas senare från sessions

   $id = Db::createQuote($title, $body, $user_id, $author);
   header("Content-Type:application/json");
   echo json_encode( $id, JSON_PRETTY_PRINT);
});



// AUTH-routes

Router::post("/register",function(){

    $response = Auth::register();

    header("Content-Type:application/json");
    echo json_encode( $response, JSON_PRETTY_PRINT);

});


Router::get("/", function(){

  include("client/dist/static.html");

});


/* Router::get("/data", function(){

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

}); */





Router::listen();


