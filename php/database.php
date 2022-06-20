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

    
    //cartes infos des event TOUS [id_match,titre,sport,ville,date,heure,inscrits,max]
    function getInfosAllEvent($db){
        $statement = $db->query('SELECT m.match_id, m.title, s.sport_name, t.town, m.date, m.hour, m.number_max_player 
                                FROM match m, sport s, town t 
                                WHERE m.sport_id = s.sport_id AND m.town_id = t.town_id');
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($data);
        print_r($json); 
    } 
    
    
    // mes évènements que j'organise TOUS : [id_match,titre] 
    function getOrganizerMatchIdTitle($db, $mail){
        $request = 'SELECT match_id, title FROM match WHERE organizer_id=:mail';
        $statement = $db->prepare($request);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
        $json = json_encode($data);
        print_r($json);
    }
    
    
    // évènements où je suis TOUS en fonction de moi: [id_match,titre]
    function getOrganizerPlayerMatchIdTitle($db, $mail){
        $request = 'SELECT m.match_id, m.title 
                    FROM m match, p play 
                    WHERE m.organizer_id=:mail_organizer OR (p.mail=:mail_player AND p.match_id=:m.match_id)';//   (SELECT mail FROM player WHERE mail=:mail_player)';
        $statement = $db->prepare($request);
        $statement->bindParam(':organizer_id', $mail);
        $statement->bindParam(':mail_player', $mail);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
        $json = json_encode($data);
        print_r($json);
    }
    
    
    //TOUS LES JOUEURS inscrits en fonction d'un match donné: [id_user,nom,url] 
    function getPLayersOfAMatch($db, $match_id){
        $request = "SELECT t.mail, p.last_name, p.photo_url 
                    FROM p player, t play 
                    WHERE t.match_id=:match_id AND t.mail=p.mail AND t.is_registered='true'";
        $statement = $db->prepare($request);
        $statement->bindParam(':match_id', $match_id);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
        $json = json_encode($data);
        print_r($json);
    }
    
    
    //carte event : [id_match,titre,description,organisateur_nom,org_url,adresse,heure,durée,prix,nb_max,nb_inscrits] 
    function getInfoEvent($db, $match_id){
        $request = "SELECT m.id_match, m.title, m.match_decription, o.lastname, o.photo_url, m.adress, m.hour, m.duration, m.price, m.number_max_player, m.registered_count 
                    FROM m match, o player 
                    WHERE m.match_id = :match_id AND o.mail = m.organizer_id";
        $statement = $db->prepare($request);
        $statement->bindParam(':match_id', $match_id);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
        $json = json_encode($data);
        print_r($json);
    }
    
    
    //évènements où je suis TOUS en fonction de moi: [id_match,titre,terminé,best_id,best_url,best_nom,rôle,heure,durée,ville,adresse,scoreA,scoreB,vainqueur]
    function getAllProfilEvents($db, $mail){
        $request = "SELECT m.id_match, m.title, r.best_player, p.photo_url, p.last_name, t.role, m.hour, m.duration, v.town, m.adress, r.score_match, r.winner 
                    FROM m match, o player 
                    WHERE m.match_id = :match_id AND o.mail = m.organizer_id";
        $statement = $db->prepare($request);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
        $json = json_encode($data);
        print_r($json);
    }
    
    
    // TOUS [id_match,titre] 
    //function getMatchIdTitle($db){
    //    $statement = $db->query('SELECT match_id, title FROM match');
    //    $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
    //    $json = json_encode($data);
    //    print_r($json);
    //}
    ?>