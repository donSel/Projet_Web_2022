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

    
    //[id_match,titre,sport,ville,date,heure,inscrits,max]
    function getInfoEvent($db){
        $statement = $db->query('SELECT m.match_id, m.title, s.sport_name, t.town, m.date, m.hour, m.number_max_player FROM match m, sport s, town t WHERE m.sport_id = s.sport_id AND m.town_id = t.town_id');
        return $statement->fetchAll(PDO::FETCH_ASSOC); 
    } 

    
?>