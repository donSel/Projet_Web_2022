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
    //---------------------------------------------------------- Requests functions  ----------------------------------------------------------
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
    
    
    // function to check if the mail already exists
    function mailExists($db, $mail){
        $arrUser = getUser($db, $mail);
        foreach ($arrUser as $val){ // changer foreach
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
        return $data['0']['town_id']; // return the id of the town if it already exist in the DB
    }
    
    
    function addNewTown($db, $town){
        // inserting the new town
        $stmt = $db->prepare("INSERT INTO town (town) VALUES (:town)");
        $stmt->bindParam(':town', $town);
        $stmt->execute();
        // returning the id of the inserted town
        $request = 'SELECT town_id, town FROM town WHERE town=:town';
        $statement = $db->prepare($request);
        $statement->bindParam(':town', $town);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $data['0']['town_id'];
    }
    
    
    function getReviews($db){
        $statement = $db->query('SELECT * FROM review');
        return $statement->fetchAll(PDO::FETCH_ASSOC); 
    }
    
    
    function getSports($db){
        $statement = $db->query('SELECT * FROM sport');
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }    
    
    
    function getTowns($db){
        $statement = $db->query('SELECT * FROM town');
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } 
    
    
    function insertEmptyReview($db){
        // inserting an empty review
        $stmt = "INSERT INTO review (review_value, review_text) VALUES (-1, '')";
        $db->query($stmt);
        // getting the id of the last inserted review (even if it's empty)
        $reviewArray = getReviews($db);
        print_r($reviewArray);
        return end($reviewArray)['review_id'];
    }
    
    
    function registerNewUser($db, $last_name, $first_name, $photo_url, $town, $mail, $password){ //  /!\ Encrypt the password and passing town names in lowercase 
        if (mailExists($db, $mail)){
            return false;
        }
        
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
        
        //checking if the avatar url has to be default 
        if (empty($photo_url)){
            $photo_url = "images/default_avatar.jpg"; 
        }
   
        // inserting the new user in the database mail
        $stmt = $db->prepare("INSERT INTO player (mail, password, first_name, last_name, photo_url, age, health, number_match_played, review_id, town_id) 
                            VALUES (:mail, :password, :first_name, :last_name, :photo_url, -1, -1, 0, :review_id, :town_id)");
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':photo_url', $photo_url);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':review_id', $review_id);
        $stmt->bindParam(':town_id', $town_id);
        $stmt->execute();
        return true;
    }
    
    
    //----------------------------------------------------------------------------
    //---------------------------------------------------------- Connexion  ----------------------------------------------------------
    //----------------------------------------------------------------------------

    
    function isGoodLogin($db, $mail, $password){
        $arrUser = getUser($db, $mail);
        foreach ($arrUser as $val){
            if ($val['mail'] == $mail && $val['password'] == $password){
                return true;
            }
        }
        return false;
    }
    
    
    function getUser($db, $mail){
        $request = 'SELECT * FROM player WHERE mail=:mail';
        $statement = $db->prepare($request);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC); 
    }
        
    
    function redirectSearchPage(){
        $url = 'search.html';
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }
    
    
//----------------------------------------------------------------------------
//---------------------------------------------------------- Organize  ----------------------------------------------------------
//----------------------------------------------------------------------------


    function sportAlreadyExist($db, $sport_name){
        $request = 'SELECT sport_id FROM sport WHERE sport_name=:sport_name';
        $statement = $db->prepare($request);
        $statement->bindParam(':sport_name', $sport_name);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $arrLength = count($data);
        if ($arrLength == 0){ // return 0 if the town doesn't exist in the DB
            return 0;
        }
        return $data['0']['sport_id']; // return the id of the town if it already exist in the DB
    }


    function addNewSport($db, $sport_name){
        // inserting the new sport
        $stmt = $db->prepare("INSERT INTO sport (sport_name) VALUES (:sport_name)");
        $stmt->bindParam(':sport_name', $sport_name);
        $stmt->execute();
        // returning the id of the inserted town
        $sportsArray = getSports($db);
        return end($sportsArray)['sport_id'];
        
        /* $request = 'SELECT sport_id, sport_name FROM sport WHERE sport=:sport'; OLD
        $statement = $db->prepare($request);
        $statement->bindParam(':town', $town);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $data['0']['town_id'];*/
    }
    
    
    function getMatchResults($db){
        $statement = $db->query('SELECT * FROM match_result');
        return $statement->fetchAll(PDO::FETCH_ASSOC); 
    }
    

    function insertEmptyMatchResult($db){
        // inserting an empty review
        $stmt = "INSERT INTO match_result (score_match, duration, best_player, winner) VALUES ('', '00:00:00', '', '')";
        $db->query($stmt);
        // getting the id of the last inserted result (even if it's empty)
        $matchResultsArray = getMatchResults($db);
        print_r($matchResultsArray);
        return end($matchResultsArray)['match_id'];
    }
    
    
    // insert a enw match in the database, value format : $date => YYYY-mm-dd, $hour => hh:mm:ss, $duration => hh:mm:ss, $age-range : "val-val"
    function insertNewMatch($db, $organizer_id, $sport, $title, $match_description, $number_min_player, $number_max_player, $town, $address, $date, $hour, $duration, $price, $age_range){ //  /!\ Encrypt the password and passing town names in lowercase 
                                                                                    // vérifier que la date/heure rentrée est pas antérieure à l'actuelle
                                                                                    // check if the match is created and insert the organizer as a player/organizer in play table
                                                                                    // vérifier que le min est pas > au max, de même pour l'age range
                                                                                    // limiter le nombre de caractère pour le titre et la description (commentaire aussi)
        // Cheking and inserting the sport if it doesn't already exist
        $res = sportAlreadyExist($db, $sport);
        if ($res == 0){
            echo "sport not exists <br>";
            $sport_id = addNewSport($db, $sport);
        }  
        else {
            echo "sport exists <br>";
            $sport_id = $res;
        }
        
        // Cheking and inserting the town if it doesn't already exist
        $res = townAlreadyExist($db, $town);
        if ($res == 0){
            echo "town not exists <br>";
            $town_id = addNewTown($db, $town);
        }
        else {
            echo "town exists <br>";
            $town_id = $res;
        }
        
        //insert an empty review
        $match_id_match_result = insertEmptyMatchResult($db);
        
        // values to insert
        /*echo "<br>organizer_id : $organizer_id<br>";
        echo "sport : $sport<br>";
        echo "title : $title<br>";
        echo "match_description : $match_description<br>";
        echo "number_min_player : $number_min_player<br>";
        echo "number_max_player : $number_max_player<br>";
        echo "town : $town<br>";
        echo "address : $address<br>";
        echo "date : $date<br>";
        echo "hour : $hour<br>";
        echo "duration : $duration<br>";
        echo "price : $price<br>";
        echo "age_range : $age_range<br>";
        echo "IDs<br>";
        echo "mactch_id_match_result : $match_id_match_result<br>";
        echo "town_id : $town_id<br>";
        echo "sport_id : $sport_id<br>";*/
        
        
        // inserting the new match in the database mail
        $stmt = $db->prepare("INSERT INTO match (number_max_player, number_min_player, date, hour, address, price, registered_count, title, age_range, match_description, duration, organizer_id, sport_id, match_id_match_result, town_id, is_finished) VALUES (:number_max_player, :number_min_player, :date, :hour, :address, :price, 0, :title, :age_range, :match_description, :duration, :organizer_id, :sport_id, :match_id_match_result, :town_id, false)");
        $stmt->bindParam(':number_max_player', $number_max_player);
        $stmt->bindParam(':number_min_player', $number_min_player);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':hour', $hour);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':age_range', $age_range);
        $stmt->bindParam(':match_description', $match_description);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':organizer_id', $organizer_id);
        $stmt->bindParam(':sport_id', $sport_id);
        $stmt->bindParam(':match_id_match_result', $match_id_match_result);
        $stmt->bindParam(':town_id', $town_id);
        $stmt->execute();
        echo "match inserted succesfully !<br>";
    }
    
    
    // insert player in a match
    function insertPLayer($db, $match_id, $mail, $role, $team){ //  /!\ Encrypt the password and passing town names in lowercase 
        if (!mailExists($db, $mail)){
            return false;
        }
        
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
        
        //checking if the avatar url has to be default 
        if (empty($photo_url)){
            $photo_url = "images/default_avatar.jpg"; 
        }
   
        // inserting the new user in the database mail
        $stmt = $db->prepare("INSERT INTO player (mail, password, first_name, last_name, photo_url, age, health, number_match_played, review_id, town_id) 
                            VALUES (:mail, :password, :first_name, :last_name, :photo_url, -1, -1, 0, :review_id, :town_id)");
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':photo_url', $photo_url);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':review_id', $review_id);
        $stmt->bindParam(':town_id', $town_id);
        $stmt->execute();
        return true;
    }
    
    
    // set player status registered + team
    
    // update profile
    
    // update (becouse it's empty at the begining) match result => check if mail best player exist
    // set match to finished
    
    // insert goal
    
    // barre de recherche
    
    // set player excluded
    

    
        
?>