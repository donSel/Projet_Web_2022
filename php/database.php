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
    //---------------------------------------------------------- Requests funciton  ----------------------------------------------------------
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
    
    
    // function to check if the two password are the same
    function isStringSame($string1, $string2){
        return ($string1 == $string2);
    }
    
    
    function getUser($db, $mail){
        $request = 'SELECT * FROM player WHERE mail=:mail';
        $statement = $db->prepare($request);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC); 
    }
    
    
    // function to check if the mail already exists
    function mailExists($db, $mail){
        $arrUser = getUser($db, $mail);
        foreach ($arrUsers as $val){ // changer foreach
            if ($val['mail'] == $mail){
                return true;
            }
        }
        return false;
    } 

    
    function townAlreadyExist($db, $town){
        $request = 'SELECT town_id FROM town WHERE town=:town';
        $statement = $db->prepare($request);
        $statement->bindParam(':town', $town);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $arrLength = count($data);
        if ($arrLength == 0){ // return 0 if the town doesn't exist in the DB
            return 0;
        }
        print_r($data);
        return $data[0]['town_id']; // return the id of the town if it already exist in the DB
    }
    
    
    function addNewTown($db, $town){
        // inserting the new town
        $stmt = $conn->prepare("INSERT INTO town (value) VALUES (:town)");
        $stmt->bindParam(':town', $town);
        $stmt->execute();
        // returning the id of the inserted town
        $request = 'SELECT town_id, town FROM town WHERE town=:town';
        $statement = $db->prepare($request);
        $statement->bindParam(':town', $town);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        print_r($data);
        return $data[0]['town_id'];
    }
    
    
    function getReviews($db){
        $statement = $db->query('SELECT * FROM review');
        return $statement->fetchAll(PDO::FETCH_ASSOC); 
    }
    
    
    function insertEmptyReview($db){
        // inserting an empty review
        $db = "INSERT INTO review (review_value, review_text) VALUES (-1, '')";
        if ($conn->query($sql) === TRUE) {
           		echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        // getting the id of the last inserted review (even if it's empty)
        $reviewArray = getReviews($db);
        $arrLength = count($data);
        print_r($arrLength);
        return $reviewArray[$arrLength - 1]['review_id'];
    }
    
    
    function registerNewUser($db, $last_name, $first_name, $town, $photo_url, $mail, $password){ //  /!\ Encrypt the password and passing town names in lowercase 
        // Cheking and inserting the town if it doesn't already exist
        $res = townAlreadyExist($db, $town);
        if ($res == 0){
            $town_id = addNewTown($db, $town);
        }
        else {
            $town_id = $res;
        }
        
        //insert an empty review
        $review_id = insertEmptyReview($db);
        
        // inserting the new user in the database
        $stmt = $db->prepare("INSERT INTO player (mail, password, first_name, last_name, photo_url, age, health, number_match_player, review_id, town_id) 
                            VALUES (:mail, :last_name, :first_name, :password, '', NULL, NULL, 0, :review_id, :town_id)");
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':review_id', $review_id);
        $stmt->bindParam(':town_id', $town_id);
        $stmt->execute();
    }
    
    
    //----------------------------------------------------------------------------
    //---------------------------------------------------------- Connexion  ----------------------------------------------------------
    //----------------------------------------------------------------------------
    
    
    function isGoodLogin($db, $mail, $password){
        $arrUser = getUser($db, $mail);
        foreach ($arrUser as $val){ // changer foreach
            if ($val['mail'] == $mail && $val['password'] == $password){
                return true;
            }
        }
        return false;
    }
        
        
?>