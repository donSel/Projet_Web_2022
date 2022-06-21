<?php

    include ('database.php');

    // Enable all warnings and errors.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $db = dbConnect();
    
    $match_id = 1;
    $mail = 'toto1@gmail.com';
    
    //getInfoEvent($db, $match_id);
    getAllOrganizerEvents($db, $mail)
?>