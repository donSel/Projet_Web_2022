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
    
    echo " res1 : " . isGoodLogin($db, 'Bertrand.RIESSE@gmail.com', 'aze');
    
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