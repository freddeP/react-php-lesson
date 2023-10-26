<?php
require_once("Db.php");
class Auth{

 
    
    public static function register(){

        if(isset($_POST['email']) && $_POST['email']!=null
        & isset($_POST['password']) && $_POST['password']!=null
        & isset($_POST['name']) && $_POST['name']!=null
        ){
          
            $email = $_POST['email'];
            $name = $_POST['name'];
            // glöm inte att validera senare
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $message = Db::register($name, $email, $password);

            return $message;
        }
        return ["error"=>"bad credentials"];
    }

    public static function login(){

         if(isset($_POST['email']) && $_POST['email']!=null
        & isset($_POST['password']) && $_POST['password']!=null
        ){
          
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = (Object) Db::findUser($email);
            if($user->error){
                return ["error"=>"No USER"];
            }
      
            $check = password_verify($password, $user->password);

            if($check) {
                $_SESSION['loggedIn']= true;
                $_SESSION['user']= $user->email;
                $_SESSION['user-id']= $user->id;
                $_SESSION['admin']= $user->admin;
                $_SESSION['name']= $user->name;

              
                return ["message"=>"logged in", "user"=>$user->name];
            }

            return ["error"=>"Wrong Password"];



        }

        
    }




}