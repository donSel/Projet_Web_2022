<?php

    include ('database.php');

    // Enable all warnings and errors.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $db = dbConnect();
    /*$match_id = 1;
    
    $last_name = 'Neroda';
    $first_name = 'Mickaël';
    $town = 'Nantes';
    $photo_url = 'suuu.png';
    $mail = 'mickael.neroda@gmail.com';
    $password = '123';*/
    
    //$res = registerNewUser($db, $last_name, $first_name, $town, $photo_url, $mail, $password);
    //echo "player inserted : " . $res;
    //
    //$res = registerNewUser($db, 'Neroda', 'Olga', 'Moscou', 'neroda.olga@gmail.com', '123');
    //echo "player inserted : " . $res;
    //
    //$res = registerNewUser($db, 'Neroda', 'Olga', 'Moscou', 'neroda.olga@gmail.com', '123');
    //echo "player inserted : " . $res;
    
    
    //$res = registerNewUser($db, 'Neroda', 'Alexandre', 'Moscou', 'neroda.alexandre@gmail.com', '123');
    //echo "player inserted : " . $res;
    
    //echo " res1 : " . isGoodLogin($db, 'Bertrand.RIESSE@gmail.com', 'aze');
    
    
    //$sport_id = addNewSport($db, $sport);
    //$town_id = addNewTown($db, $town);
    //$match_id_match_result = insertEmptyMatchResult($db);
    
    //$organizer_id = 'mickael.neroda@gmail.com';
    //$sport = 'Boxe';
    //$title = 'tournoi';
    //$match_description = 'Petite après midi entre amis';
    //$number_min_player = 6;
    //$number_max_player = 20;
    //$town = 'Paris';
    //$town2 = 'paris';
    //$address = 'plaine de jeux des Dervalières';
    //$date = '2022-06-28';
    //$hour = '15:00:00';
    //$duration = '01:30:00';
    //$price = 0;
    //$age_range = '14-30';

    //insertNewMatch($db, $organizer_id, $sport, $title, $match_description, $number_min_player, $number_max_player, $town, $address, $date, $hour, $duration, $price, $age_range);
    //insertNewMatch($db, $organizer_id, $sport, $title, $match_description, $number_min_player, $number_max_player, $town2, $address, $date, $hour, $duration, $price, $age_range);
    
    //$town_id = addNewTown($db, $town);
    //echo $town_id;
    
    //echo " res1 : " . townAlreadyExist($db, $town);
    //echo " res2 : " . townAlreadyExist($db, 'Moscou');
    
    //print_r(getReviews($db));
    
    
    //echo " res1 : " . insertEmptyReview($db);
    
    //echo insertEmptyReview($db);
    
    
    //incrementRegisteredCount($db, 2);
    
    // set player status (registered + team), data format : role 0 => Organizer, 1 => Player, 2 => player + Organizer, team  0 => team_A, 1 => team_B, 2 => no_team
    // setPlayerStatusTeam($db, $match_id, $mail, $accpeted, $team)
    //setPlayerStatusTeam($db, 2, 'Thomas.ROM DANE@gmail.com', true, 0);
    
    /*insertPlayer($db, 3, 'Petit.ROLZOU@gmail.com', 1);
    insertPlayer($db, 3, 'Michel.ROBICOUET@gmail.com', 1);
    insertPlayer($db, 3, 'Simon.ROLT-LEVEQUE@gmail', 1);
    insertPlayer($db, 3, 'Dubois.ROLU@gmail.com', 1);*/
    
    /*setPlayerStatusTeam($db, 3, 'Petit.ROLZOU@gmail.com', true, 0);
    setPlayerStatusTeam($db, 3, 'Michel.ROBICOUET@gmail.com', true, 0);
    setPlayerStatusTeam($db, 3, 'Simon.ROLT-LEVEQUE@gmail', true, 0);
    setPlayerStatusTeam($db, 3, 'Dubois.ROLU@gmail.com', true, 0);*/
    
    //insertScore($db, 3, 'Dubois.ROLU@gmail.com', '00:00:09');
    
    //updateProfil($db, $mail, $age, $town, $health, $password, $review_value, $review_text, $photo_url)
    //updateProfil($db, 'Bertrand.RIESSE@gmail.com', 9, 'MOSCOU', 0, 'aze', 0, 'trop nul ce site wallah', 'suuu.png');
    
    //print_r(getInfoEvent($db, 3));
    print_r(getInfosAllEvent($db));
    
    //searchEvent($db, $town, $sport_name, $period, $complete)
    //searchEvent($db, 'nantes', 'football', '', '');
    
    echo "<br><br>";
    
    //$arr = ['town', 'sport_name'];
    //$arr[]

    // OLD
    //getInfoEvent($db, $match_id);
    //getAllOrganizerEvents($db, $mail);
    ?>