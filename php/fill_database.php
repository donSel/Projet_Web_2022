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
    $arrFirstNameLen = count($arrFirstName);
    $arrLastNameLen = count($arrLastName);
    
    $photo_url = '';
    $mdp = 'aze';
    $arrAdresse = ['1 Pl. Alexis-Ricordeau', '12 boulevard de Alsace', '3 place Anatole France']; 
    $arrVille = ['Nantes', 'Vaulx-en-velin', 'Angers', 'Paris', ];
    $arrVilleLen = count($arrVille);
    
    for ($i = 0; $i < $arrFirstNameLen; $i++){
        $mail = $arrFirstName[$i] . "." . $arrLastName[$i] . "@gmail.com";
        $randJ = rand(0, $arrVilleLen - 1);
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
    $number_min_player = 2;
    $arrDate = [];
    $arrHour = [];
    $arrTown = ['Nantes', 'Vaulx-en-velin', 'Angers', 'Paris', ];
    $arrAddress = ['1 Pl. Alexis-Ricordeau', '12 boulevard de Alsace', '3 place Anatole France', 'stade de ']; 
    $price = "5";
    $arrTitle = [];
    $age_range = "14-30";
    $match_description = "Evenements sportif de dingue, n'hésitez pas à venir les places sont limitées";
    $duration = "01:30:00";
    $organizer_id = "mickael.neroda@mail.com";
    $arrSport = [];
    
    
    
    $arrLastName = ['ROM-PUISAIS', 'ROM DANE', 'ROLZOU', 'ROLZHAUSEN', 'ROLZEN'	, 'ROLZ', 'ROLU', 'ROLTMIT'	, 'ROLTHMEIR', 'ROLT-LEVEQUE', 'ROBICOUET', 'ROBICO', 'ROBICKEZ', 'ROBICHOY', 'ROBICHOU', 'RIESSE'];
    $arrFirstName = ['Bernard', 'Thomas' , 'Petit', 'Robert', 'Richard', 'Durand', 'Dubois', 'Moreau', 'Laurent', 'Simon', 'Michel', 'Lefebvre', 'Leroy', 'Roux', 'David', 'Bertrand'];
    $arrFirstNameLen = count($arrFirstName);
    $arrLastNameLen = count($arrLastName);
    
    $photo_url = '';
    $mdp = 'aze';
    $arrVilleLen = count($arrVille);
    
    for ($i = 0; $i < $arrFirstNameLen; $i++){
        $mail = $arrFirstName[$i] . "." . $arrLastName[$i] . "@gmail.com";
        $randJ = rand(0, $arrVilleLen - 1);
        $res = registerNewUser($db, $arrLastName[$i], $arrFirstName[$i], $photo_url, $arrVille[$randJ], $mail, $mdp);
        if ($res == true){
            echo "player inserted succesfully !<br>";
        }
        else {
            echo "player not inserted !<br>";
        }
    }
    
    
//------------------------------------------------------------
//-- Filling Play
//------------------------------------------------------------
    
    
//------------------------------------------------------------
//-- Filling Score
//------------------------------------------------------------
    
    
//------------------------------------------------------------
//-- Filling Match Result
//------------------------------------------------------------
?>
