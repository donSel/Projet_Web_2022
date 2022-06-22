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
    function insertNewMatch($db, $organizer_id, $sport, $title, $match_description, $number_min_player, $number_max_player, $town, $address, $date, $hour, $duration, $price, $age_range){ //  /!\ passing town names in lowercase 
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
        echo "match inserted successfully !<br>";
    }
    
    
    function isMatchFull($db, $match_id){//test : 
        $request = "SELECT number_max_player, registered_count FROM match WHERE match_id=:match_id";
        $statement = $db->prepare($request);
        $statement->bindParam(':match_id', $match_id);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        //print_r($data);
        if ($data['0']['number_max_player'] == $data['0']['registered_count']){
            return true;
        }
        return false;
    }
    
    
    // insert player in a match, data format : role 0 => Organizer, 1 => Player, 2 => player + Organizer
    function insertPLayer($db, $match_id, $mail, $role){ //test : 
        // checking if the match isn't full
        if (isMatchFull($db, $match_id)){
            return false;
        }
        // inserting the new user in the database play
        $stmt = $db->prepare("INSERT INTO play (match_id, mail, is_registered, wait_response, role, team) 
                            VALUES (:match_id, :mail, false, true, :role, 2)");
        $stmt->bindParam(':match_id', $match_id);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        return true;
    }
    
    
    function incrementRegisteredCount($db, $match_id){ // test OK
        // getting the current registered_count value
        $request = "SELECT registered_count FROM match WHERE match_id=:match_id";
        $statement = $db->prepare($request);
        $statement->bindParam(':match_id', $match_id);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $currentVal = $data['0']['registered_count'];
        $newVal = $currentVal + 1;
        // update the registered count in the db
        $request2 = "UPDATE match SET registered_count=:newVal WHERE match_id=:match_id";
        $statement2 = $db->prepare($request2);
        $statement2->bindParam(':match_id', $match_id);
        $statement2->bindParam(':newVal', $newVal);
        $statement2->execute();
        $statement2->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    // set player status (registered + team), data format : role 0 => Organizer, 1 => Player, 2 => player + Organizer, team  0 => team_A, 1 => team_B, 2 => no_team
    function setPlayerStatusTeam($db, $match_id, $mail, $accepted, $role, $team){ //test :
        // cheking if the number of players registered reached the max if accepted == true
        /*if ($accepted == true && isMatchFull($db, $match_id)){ TOO COMPLICATED
            return false; // the number max of player registered has reached the max
        }*/
        
        if ($accepted == true){
            $is_registered = true;
            $wait_response = false;
        } else {
            $is_registered = false;
            $wait_response = false;
        }
    
        
        // updating the player status/team // USE UPDATE
        $stmt = $db->prepare("UPDATE match SET is_registered=:is_registered, wait_response=:wait_response, team=:team
                            WHERE match_id=:match_id"); 
        $stmt->bindParam(':match_id', $match_id);
        $stmt->bindParam(':is_registered', $is_registered);
        $stmt->bindParam(':wait_response', $wait_response);
        $stmt->bindParam(':team', $team);
        $stmt->execute();
        
        /*$request2 = "UPDATE match SET registered_count=:newVal WHERE match_id=:match_id";
        $statement2 = $db->prepare($request2);
        $statement2->bindParam(':match_id', $match_id);
        $statement2->bindParam(':newVal', $newVal);
        $statement2->execute();
        $statement2->fetchAll(PDO::FETCH_ASSOC);*/
        
        // update registered_count
        if ($accepted == true){
            incrementRegisteredCount($db, $match_id);
        }
    }
    
    
    // insert goal
    function insertScore($db, $match_id, $mail, $scoring_time){ //test : 
        // inserting the new user in the database mail
        $stmt = $db->prepare("INSERT INTO score (scoring_time, mail, match_id) 
                            VALUES (:scoring_time, :mail, :match_id)");
        $stmt->bindParam(':scoring_time', $scoring_time);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':match_id', $match_id);
        $stmt->execute();
        return true;
    }
    
    
    // update (becouse it's empty at the begining) match result => check if mail best player exist + set match value to finished
    function updateMatchResultTable($db, $match_id, $score_match, $duration, $best_player, $winner){
        $stmt = $db->prepare("UPDATE match_result 
        SET score_match=:score_match, duration=:duration, best_player=:best_player, winner=:winner
        WHERE match_id=:match_id"); 
        $stmt->bindParam(':match_id', $match_id);
        $stmt->bindParam(':score_match', $score_match);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':best_player', $best_player);
        $stmt->bindParam(':winner', $winner);
        $stmt->execute();
    }
    
    
//----------------------------------------------------------------------------
//---------------------------------------------------------- Profil Page  ----------------------------------------------------------
//----------------------------------------------------------------------------
    
    
    // update profile
    function updateProfil($db, $mail, $age, $town, $health, $password, $review_value, $review_text, $photo_url){ // test : /!\ encrypt the password
        // updating town player
        $res = townAlreadyExist($db, $town);
        if ($res == 0){
            $town_id = addNewTown($db, $town);
        }
        else {
            $town_id = $res;
        }
        
        // getting player review id
        $request = 'SELECT review_id FROM player WHERE mail=:mail';
        $statement = $db->prepare($request);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $review_id = $data['0']['review_id'];
        
        
        // updating review player
        $stmt1 = $db->prepare("UPDATE review SET review_value=:review_value, review_text=:review_text
        WHERE review_id=:review_id"); 
        $stmt1->bindParam(':review_value', $review_value);
        $stmt1->bindParam(':areview_textge', $review_text);
        $stmt1->bindParam(':review_id', $review_id);
        $stmt1->execute();
        
        
        // updating the player table
        $stmt = $db->prepare("UPDATE player SET age=:age, health=:health, town_id=:town_id, photo_url=:photo_url, password=:password
        WHERE mail=:mail"); 
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':health', $health);
        $stmt->bindParam(':town_id', $town_id);
        $stmt->bindParam(':photo_url', $photo_url);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    }
    
    
    // get PlayeInfo
    function getPlayerInfo($db, $mail){
        $request = "SELECT mail, password, first_name, last_name, photo_url, age, health
                    FROM player
                    WHERE mail = :mail";
        $statement = $db->prepare($request);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
        $json = json_encode($data);
        print_r($json);
    }
    
    
    // get PlayerTown
    function getPlayerTown($db, $mail){
        // getting player town id
        $request = 'SELECT town_id FROM player WHERE mail=:mail';
        $statement = $db->prepare($request);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $town_id = $data['0']['town_id'];
        // getting Player town name
        $request2 = 'SELECT town FROM town WHERE town_id=:town_id';
        $statement2 = $db->prepare($request2);
        $statemen2->bindParam(':town_id', $town_id);
        $statement2->execute();
        $data2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($data2);
        print_r($json);
    }
    
    
    // get PLayerReview
    function getPLayerReview($db, $mail){
        // getting player review id
        $request = 'SELECT review_id FROM player WHERE mail=:mail';
        $statement = $db->prepare($request);
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $review_id = $data['0']['review_id'];
        // gettin player review value/text
        $request2 = 'SELECT review_value, review_text FROM review WHERE review_id=:review_id';
        $statement2 = $db->prepare($request2);
        $statemen2->bindParam(':review_id', $review_id);
        $statement2->execute();
        $data2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($data2);
        print_r($json);
    }
    
    
    // get number match of a player
    function getNumberMatchPlayer($db, $mail){
        $request2 = 'SELECT match_id FROM play WHERE mail=:mail AND is_registered=true';
        $statement2 = $db->prepare($request2);
        $statemen2->bindParam(':mail', $mail);
        $statement2->execute();
        $data2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
        return count($data2);
    }
    
    
    function getNumberGoalPLayer($db, $mail){
        $request2 = 'SELECT scoring_time FROM score WHERE mail=:mail';
        $statement2 = $db->prepare($request2);
        $statemen2->bindParam(':mail', $mail);
        $statement2->execute();
        return count($data2);
    }
    
    
    function getNumberBestPlayer($db, $mail){
        $request2 = 'SELECT match_id FROM match_result WHERE best_player=:best_player';
        $statement2 = $db->prepare($request2);
        $statemen2->bindParam(':best_player', $mail);
        $statement2->execute();
        return count($data2);
    }
    
    
//----------------------------------------------------------------------------
//---------------------------------------------------------- Notifications  ----------------------------------------------------------
//----------------------------------------------------------------------------
    
    
    // get Refusal/Acceptation notifications
    function getProfilNotifications($db, $mail){
        $request2 = 'SELECT m.match_id, m.title, t.is_registered, t.wait_response
                    FROM match m, play t 
                    WHERE t.mail=:mail AND t.match_id=m.match_id 
                    AND ( (is_registered=false AND wait_response=false) OR (is_registered=true AND wait_response=false) OR (is_registered=false AND wait_response=true) )';
        $statement2 = $db->prepare($request2);
        $statement2->bindParam(':mail', $mail);
        $statement2->execute();
        $data2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($data2);
        print_r($json);
    }
    
    
//----------------------------------------------------------------------------
//---------------------------------------------------------- Search Bar  ----------------------------------------------------------
//----------------------------------------------------------------------------
    
    
        
?>