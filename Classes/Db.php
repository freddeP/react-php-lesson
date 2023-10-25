<?php

class Db{


    private static $user = "user";
    private static $password = "1234";
    private static $host = "localhost";
    private static $db = "rphp";



    private static function connect(){

        $con = new mysqli(self::$host, self::$user, self::$password, self::$db);
        if ($con->connect_error) return $con->connect_error;     
        return $con;

    }

    public static function createQuote($title, $body, $user_id, $author){
        $con = self::connect();

        $query = "INSERT INTO quotes 
        (title, body, user_id, author)
        VALUES
        (?, ?, ?, ?)";

        $stmt = $con->prepare($query);

        $stmt->bind_param("ssds",$title, $body, $user_id,$author);

        $stmt->execute();
        $stmt->close();

     /*    $query = "INSERT INTO quotes 
        (title, body, user_id, author)
        VALUES
        ('$title', '$body', $user_id, '$author')"; */

        

   /*      $result = $con->query($query); */

        $id = $con->insert_id;

        $con->close();

        return [$id];




    }
    public static function readQuotes(){

        $query = "SELECT * FROM quotes";

        $con =  self::connect();
        $result = $con->query($query);
        $con->close();
        
        $quotes = [];
        while($row = $result->fetch_assoc()){
            // Push...
            $quotes[]= $row;
        }
        return $quotes;


    }
    public static function deleteQuote($id){}
    public static function updateQuote(){}








}