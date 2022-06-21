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
    
    
?>
