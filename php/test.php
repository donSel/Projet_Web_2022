<?php

    include ('database.php');

    // Enable all warnings and errors.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $db = dbConnect();
    $match_id = 1;
    
    $last_name = 'Neroda';
    $first_name = 'Mickaël';
    $town = 'Nantes';
    $photo_url = 'suuu.png';
    $mail = 'mickael.neroda@gmail.com';
    $password = '123';
    
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
    
    $organizer_id = 1;
    $sport = 'foot-ball';
    $title = 'après-midi foot-ball';
    $match_description = 'Petite après midi entre amis, match amicaux';
    $number_min_player = 6;
    $number_max_player = 20;
    $town = 'Nantes';
    $address = 'plaine de jeux des Dervalières';
    $date = '25:06:2022';
    $hour = '15:00:00';
    $duration = '00:90:00';
    $price = 0;
    $age_range = '14-30';
    
    insertNewMatch($db, $organizer_id, $sport, $title, $match_description, $number_min_player, $number_max_player, $town, $address, $date, $hour, $duration, $price, $age_range);
    
    //$town_id = addNewTown($db, $town);
    //echo $town_id;
    
    //echo " res1 : " . townAlreadyExist($db, $town);
    //echo " res2 : " . townAlreadyExist($db, 'Moscou');
    
    //print_r(getReviews($db));
    
    
    //echo " res1 : " . insertEmptyReview($db);
    
    //echo insertEmptyReview($db);
    
    
    
    
    
    
    // OLD
    //getInfoEvent($db, $match_id);
    //getAllOrganizerEvents($db, $mail);
    ?>