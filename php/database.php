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

    
    //cartes infos des event TOUS [match_id,titre,sport,ville,date,heure,inscrits,max]
    function getInfosAllEvent($db){
        $statement = $db->query('SELECT m.match_id, m.title, s.sport_name, t.town, m.date, m.hour, m.number_max_player 
                                FROM match m, sport s, town t 
                                WHERE m.sport_id = s.sport_id AND m.town_id = t.town_id');
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($data);
        print_r($json); 
    } 
    
    
    // mes évènements que j'organise TOUS : [match_id,titre] 
    function getOrganizerEventIdTitle($db, $mail){
        $request = 'SELECT match_id, title FROM match WHERE organizer_id=:mail';
        $statement = $db->prepare($request);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
        $json = json_encode($data);
        print_r($json);
    }
    
    
    // évènements où je suis TOUS en fonction de moi: [match_id,titre]
    function getOrganizerPlayerEventIdTitle($db, $mail){
        $request = 'SELECT m.match_id, m.title 
                    FROM match m, play p 
                    WHERE m.organizer_id=:mail_organizer OR (p.mail=:mail_player AND p.match_id=:m.match_id)';//   (SELECT mail FROM player WHERE mail=:mail_player)';
        $statement = $db->prepare($request);
        $statement->bindParam(':organizer_id', $mail);
        $statement->bindParam(':mail_player', $mail);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
        $json = json_encode($data);
        print_r($json);
    }
    
    
    //TOUS LES JOUEURS inscrits en fonction d'un match donné: [id_user,nom,prénom,url,statut,équipe] 
    function getPLayersOfEvent($db, $match_id){
        $request = "SELECT t.mail, p.last_name, p.first_name, p.photo_url, t.role, t.team   
                    FROM player p, play t 
                    WHERE t.match_id=:match_id AND t.mail=p.mail AND t.is_registered='true'";
        $statement = $db->prepare($request);
        $statement->bindParam(':match_id', $match_id);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
        $json = json_encode($data);
        print_r($json);
    }
    
    
    //carte event : [match_id,titre,description,organisateur_nom,org_url,adresse,heure,durée,prix,nb_max,nb_inscrits] 
    function getInfoEvent($db, $match_id){
        $request = "SELECT m.match_id, m.title, m.match_description, o.last_name, o.photo_url, m.adress, m.hour, m.duration, m.price, m.number_max_player, m.registered_count 
                    FROM match m, player o 
                    WHERE m.match_id = :match_id AND o.mail = m.organizer_id";
        $statement = $db->prepare($request);
        $statement->bindParam(':match_id', $match_id);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
        $json = json_encode($data);
        print_r($json);
    }
    
    // match ou je suis joueur
    //évènements où je suis TOUS en fonction de moi: [match_id,titre,terminé,best_id,best_url,best_nom,rôle,heure,durée,ville,adresse,scoreA,scoreB,vainqueur]
    function getAllProfilEvents($db, $mail){
        $request = "SELECT m.match_id, m.title, m.is_finished, r.best_player, p.photo_url, p.last_name, t.role, m.hour, m.duration, v.town, m.adress, r.score_match, r.winner 
                    FROM match m, player p, match_result r, play t, town v
                    WHERE t.mail=:m.mail AND m.match_id=t.match_id AND m.match_id=r.match_id AND r.best_player=p.mail AND m.town_id=v.town_id";
        $statement = $db->prepare($request);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
        $json = json_encode($data);
        print_r($json);
    }
    
    
    //----------------------------------------------------------------------------
    //---------------------------------------------------------- Organize  ----------------------------------------------------------
    //----------------------------------------------------------------------------
    
    
    //joueur en attente TOUS en fonction d'un match donné: [id_user,nom,prénom,statut] 
    function getPLayersWaitingOfEvent($db, $match_id){
        $request = "SELECT t.mail, p.last_name, p.first_name, t.role
        FROM player p, play t
        WHERE t.match_id=:match_id AND t.mail=p.mail AND t.wait_response='true' AND t.is_registered='false'";
        $statement = $db->prepare($request);
        $statement->bindParam(':match_id', $match_id);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
        $json = json_encode($data);
        print_r($json);
    }
    
    
    //match TOUS en fonction d'un utilisateur (ce sont les matchs que lui organise): [match_id,titre,sport,date,heure,nb_minimum,nb_max,nb_actuel]
    function getAllOrganizerEvents($db, $mail){
        $request = "SELECT m.match_id, m.title, s.sport_name, m.date, m.hour, m.number_min_player, m.number_max_player, m.registered_count
                    FROM match m, sport s
                    WHERE m.organizer_id=:mail AND s.sport_id=m.sport_id";
        $statement = $db->prepare($request);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
        $json = json_encode($data);
        print_r($json);
    }    
    
    
    //----------------------------------------------------------------------------
    //---------------------------------------------------------- Registration  ----------------------------------------------------------
    //----------------------------------------------------------------------------
    
    
    

    ?>