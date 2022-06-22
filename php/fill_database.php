<?php

    include ('database.php');
    include ('constants.php');

    // Enable all warnings and errors.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $db = dbConnect();

    
//------------------------------------------------------------
//-- Filling Player table
//------------------------------------------------------------
    

    $arrLastName = ['ROM-PUISAIS', 'ROM DANE', 'ROLZOU', 'ROLZHAUSEN', 'ROLZEN'	, 'ROLZ', 'ROLU', 'ROLTMIT'	, 'ROLTHMEIR', 'ROLT-LEVEQUE', 'ROBICOUET', 'ROBICO', 'ROBICKEZ', 'ROBICHOY', 'ROBICHOU', 'RIESSE'];
    $arrFirstName = ['Bernard', 'Thomas' , 'Petit', 'Robert', 'Richard', 'Durand', 'Dubois', 'Moreau', 'Laurent', 'Simon', 'Michel', 'Lefebvre', 'Leroy', 'Roux', 'David', 'Bertrand'];
    $arrVille = ['Nantes', 'Vaulx-en-velin', 'Angers', 'Paris', ];
    $photo_url = '';
    $mdp = 'aze';
    
    $arrFirstNameLen = count($arrFirstName);
    $arrLastNameLen = count($arrLastName);
    $arrVilleLen = count($arrVille);
    
    $arrMail = [];
    
    for ($i = 0; $i < $arrFirstNameLen; $i++){
        $mail = $arrFirstName[$i] . "." . $arrLastName[$i] . "@gmail.com";
        array_push($arrMail, $mail);
        //echo "Array Mail <br>";
        //print_r($arrMail);
        //echo "<br>";
        $randJ = rand(0, $arrVilleLen - 1);
        //registerNewUser($db, $last_name, $first_name, $photo_url, $town, $mail, $password)
        $res = registerNewUser($db, $arrLastName[$i], $arrFirstName[$i], $photo_url, $arrVille[$randJ], $mail, $mdp);
        if ($res == true){
            echo "player inserted succesfully !<br>";
        }
        else {
            echo "player not inserted !<br>";
        }
    }
    
    
//------------------------------------------------------------
//-- Filling Match table
//------------------------------------------------------------


    $number_max_player = 2;
    $number_max_player = 2;
    
    $number_min_player_array = [20, 10, 2, 15];
    $number_max_player_array = [35, 15, 2, 25];
    $arrDate = ['2022-06-29', '2022-07-15', '2022-07-13', '2022-08-19'];
    $arrHour = ['15:00:00', '14:00:00', '15:45:00', '17:00:00'];
    $arrTown = ['Nantes', 'Nantes', 'Angers', 'Paris'];
    $arrAddress = ['1 Pl. Alexis-Ricordeau', '12 boulevard de Alsace', '3 place Anatole France', 'Rue Henri Delaunay, 93200 Saint-Denis']; 
    $price = "5";
    $arrTitle = ['Rugby au SNUC', 'Match de Basket au stade de Procès', 'Cherche partenaire de tennis pour un petit match', 'Match de foot au stade de France'];
    $age_range = "14-30";
    $match_description = "Evenements sportif de dingue, n'hésitez pas à venir les places sont limitées";
    $duration = "01:30:00";
    $organizer_id = "mickael.neroda@mail.com";
    $arrSport = ['rugby', 'basketball', 'tennis', 'football'];
    
    $arrTownLen = count($arrTown);
    
    for ($i = 0; $i < $arrTownLen; $i++){
        // insert a enw match in the database, value format : $date => YYYY-mm-dd, $hour => hh:mm:ss, $duration => hh:mm:ss, $age-range : "val-val"
        //function insertNewMatch($db, $organizer_id, $sport, $title, $match_description, $number_min_player, $number_max_player, $town, $address, $date, $hour, $duration, $price, $age_range)
        insertNewMatch($db, $organizer_id, $arrSport[$i], $arrTitle[$i], $match_description, $number_min_player_array[$i], $number_max_player_array[$i], $arrTown[$i], $arrAddress[$i], $arrDate[$i], $arrHour[$i], $duration, $price, $age_range);
        echo "match inserted succesfully !<br>";
    }
    
    
//------------------------------------------------------------
//-- Filling Play
//------------------------------------------------------------


// registered/exculdes/waiting
// team a et b equitable ou pas 
    
    //$n = $arrFirstNameLen;
    //$randI = rand(1, $arrFirstNameLen);
    
    // filling tennis match
    for ($i = 1; $i < 3; $i++){
        $res = insertPlayer($db, 2, $arrMail[$i], $i);
        if ($res == true){
            echo "player inserted in the match succesfully !<br>";
        }
        else {
            echo "player not inserted in the match !<br>";
        }
    }

    // filling other matches
    for ($i = 1; $i <= $arrTownLen; $i++){
        $randNumberPlayer = rand(0, 5);
        for ($j = 0; $j < $randNumberPlayer; $j++){
            $randI = rand(0, 2);
            $randJ = rand(1, $arrFirstNameLen - 1);
            $randK = rand(1, 2);
            $randL = rand(0, 1);
            // insert player in a match, data format : role 0 => Organizer, 1 => Player, 2 => player + Organizer // check if the player isn't already signed in
            //insertPlayer($db, $match_id, $mail, $role);
            $res = insertPlayer($db, $i, $arrMail[$randJ], $randI);
            // set player status (registered + team), data format : role 0 => Organizer, 1 => Player, 2 => player + Organizer, team  0 => team_A, 1 => team_B, 2 => no_team
            // setPlayerStatusTeam($db, $match_id, $mail, $accpeted, $team)
            setPlayerStatusTeam($db, $i, $arrMail[$randJ], $randL, $randK);
            if ($res == true){
                echo "player inserted in the match succesfully !<br>";
            }
            else {
                echo "player not inserted in the match !<br>";
            }
            
            
        }
    }
    
    
//------------------------------------------------------------
//-- Filling Score
//------------------------------------------------------------
    

    $scoringTimeText = "00:00:";
    //$scoringTime = "00:00:05";

    for ($i = 1; $i <= $arrTownLen; $i++){
        $randNumberScore = rand(0, 10);
        for ($j = 0; $j < $randNumberScore; $j++){
            $randI = rand(1, $arrFirstNameLen - 1);
            $randMinute = strval(rand(1, 60));
            $scoringTime = $scoringTimeText . $randMinute;
            //insertScore($db, $match_id, $mail, $scoring_time)
            insertScore($db, $i, $arrMail[$randI], $scoringTime); // not working
            if ($res == true){
                echo "score inserted in the match succesfully !<br>";
            }
            else {
                echo "score not inserted in the match !<br>";
            }
        }
    }
    
    
//------------------------------------------------------------
//-- Filling Match Result
//------------------------------------------------------------

    $durationText = "00:00:";
    //$duration = "00:00:10";

    for ($i = 1; $i <= 2; $i++){
        $randI = rand(1, $arrFirstNameLen - 1);
        $randMinuteDuration = strval(rand(1, 60));  
        $duration = $durationText . $randMinuteDuration;
        $randScoreTeamA = strval(rand(0, 10));
        $randScoreTeamB = strval(rand(0, 10));
        $scoreMatch = $randScoreTeamA . "-" . $randScoreTeamB;
        // update (becouse it's empty at the begining) match result => check if mail best player exist + set match value to finished
        //updateMatchResultTable($db, $match_id, $score_match, $duration, $best_player, $winner)
        updateMatchResultTable($db, $i, $scoreMatch, $duration, $arrMail[$randI], 'Team A');
        if ($res == true){
            echo "Match Result inserted in the match succesfully !<br>";
        }
        else {
            echo "Match Result not inserted in the match !<br>";
        }
    }
    

?>
