<?php

    include ('constants.php');
        
        
    //dbConnect(...)
    function dbConnect(){

        $dsn = 'pgsql:dbname='.DB_NAME.';host='.DB_SERVER.';port='.DB_PORT.';';
        $user = DB_USER;
        $password = DB_PASSWORD;

        try{
            $db = new PDO($dsn, $user, $password);
            return $db;
        }
        catch (PDOException $e){
            echo 'Connexion échouée : ' . $e->getMessage();
            return false;
        }
    }

    
    //----------------------------------------------------------------------------
    //---------------------------------------------------------- Verification funciton  ----------------------------------------------------------
    //----------------------------------------------------------------------------


?>