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

        $id = $con->insert_id;

        $con->close();

        return [
            "id"=>$id,
            "title"=>$title,
            "body"=>$body,
            "user_id"=>$user_id,
            "author"=>$author
        ];




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


    /// register, login

    public static function register($name, $email, $password){

        $con = self::connect();
        $query = "INSERT INTO users (name, email, password)
        VALUES (?, ? ,?)
        ";
        $stmt = $con->prepare($query);

        $stmt->bind_param("sss", $name, $email, $password);
       
       try{
        $stmt->execute();

       }
       catch(Exception $e){
        $stmt->close();
        $con->close();
        return ["error"=>$e->getMessage()];



       }
       $stmt->close();
       $con->close();
        return ["message"=>"USER CREATED"];

    }

    public static function findUser($email){

        $con = self::connect();

        $query = "SELECT * FROM users WHERE email= ?";
        $stmt= $con->prepare($query);
        $stmt->bind_param("s", $email);
        
        try{
            $stmt->execute();
            $result = $stmt->get_result(); // get the mysqli result
            $user = $result->fetch_assoc(); // fetch data   
            $stmt->close();
            $con->close();
            return $user;


        }
        catch(Exception $e){

            $stmt->close();
            $con->close();
            return ["error"=>$e->getMessage()];

        }

    

    }








}