<?php

    include ('database.php');

    // Enable all warnings and errors.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $db = dbConnect();
    
    getInfosAllEvent($db);
    //getMatchIdTitle($db);
    //getOrganizerMatchIdTitle($db, 'toto1@gmail.com');
?>