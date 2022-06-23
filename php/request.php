<?php

function show($data){
    // Send data to the client
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');

    echo json_encode($data); //send as JSON data
}

//check the request :
$requestMethod = $_SERVER['REQUEST_METHOD'];
$request = substr($_SERVER['PATH_INFO'], 1);
$request = explode('/', $request);
$requestRessource = array_shift($request);

//$db = dbConnect();

$result = 0; //default value
if ($requestRessource == 'search-event'){
    $result = 50;
    if ($requestMethod == 'GET'){
        if ($_GET['wanted'] == 'cities'){
            //getTowns($db)
            $result = [[0,'Bretteville'],[1,'Caen'],[2,'Nantes']];
        }
        else if ($_GET['wanted'] == 'sports'){
            //getSports($db)
            $result = [[0,'Foot-ball'],[1,'Basket-Ball']];
        }
        else if($_GET['wanted'] == 'myOrganizeEvent'){
            //getOrganizerEventIdTitle($db, $mail)
            $result = [[0,'foot2rue']];
        }
        else if($_GET['wanted'] == 'myEvent'){
            //getOrganizerPlayerEventIdTitle($db,$mail)
            $result = [[0,'foot2rue']];
        }
        else if($_GET['wanted'] == 'allEvents'){
            $idMatch = $_GET['idMatch'];
            $result = [];
            for ($i=0;$i<10;$i++){
                $result[] = [$i,'test','foot-ball','Nantes','10-10-2022','12:00',1,12];
            }
        }
        else if($_GET['wanted'] == 'speEvents'){ //filtre
            $idMatch = $_GET['idMatch'];

            $result = [];
            for ($i=0;$i<10;$i++){
                $result[] = [$i,'test','foot-ball','Nantes','10-10-2022','12:00',1,12];
            }
        }
        else if($_GET['wanted'] == 'infos'){ //infos détaillées (pop up)
            //getInfoEvent($db, $match_id)
            $idMatch = $_GET['idMatch'];
            if ($idMatch == 0){
                $result = [$idMatch, 'titre0', 'description', 'Arnaud', 'images/default_avatar.jpg', '--', '--:--', '--:--', '--', 10, 10];
            }else{
                $result = [$idMatch, 'titreautre', 'J\'ai encore de la place :)', 'Arnaud', 'images/default_avatar.jpg', '--', '--:--', '--:--', '--', 10, 2];
            }

        }
        else if($_GET['wanted'] == 'infosNormal'){
            //getAllProfilEvents($db, $mail)
            $idMatch = $_GET['idMatch'];
            $result = [$idMatch, 'titre', true, 0, 'images/default_avatar.jpg', 'Jean-Eude', 'Organisateur', '--:--', '--', 'Bretteville', 'rue du moulin', '10-2', 'ÉquipeA'];
        }
        else if($_GET['wanted'] == 'allPlayers'){
            //getPLayersOfEvent($db, $match_id)
            $idMatch = $_GET['idMatch'];
            $result = [];
            $result[] = [0,'Jean','images/default_avatar.jpg'];
            $result[] = [1,'Paul','images/default_avatar.jpg'];
            $result[] = [2,'Adrien','images/default_avatar.jpg'];
            $result[] = [4,'Clark','images/default_avatar.jpg'];
            $result[] = [5,'Batman','images/default_avatar.jpg'];
            $result[] = [33,'uwu','images/default_avatar.jpg'];

        }

    }
    else if ($requestMethod == 'POST'){
        $result = 'POST';
        if ($_POST["what"] == 'participate'){
            $matchID = $_POST["matchID"];
            //setPlayerStatusTeam($db, $match_id, $mail, $accepted, $role, $team)
            //Add to database
        }


    }


    show($result);

}else if ($requestRessource == 'organize-event'){
    if ($requestMethod == 'GET'){
        if ($_GET["wanted"] == 'showEventOrganize') {
            //getAllOrganizerEvents
            $result = [];
            $result[] = [0, 'titre0', 'foot', 'date', 'heure', 2, 20, 8];
            $result[] = [1, 'titre1', 'hand', 'date', 'heure', 4, 20, 5];
            $result[] = [2, 'titre2', 'hand', 'date', 'heure', 4, 20, 5];
            $result[] = [3, 'titre3', 'hand', 'date', 'heure', 4, 20, 5];
            $result[] = [4, 'titre4', 'hand', 'date', 'heure', 4, 20, 5];

        }
        else if ($_GET["wanted"] == 'showMiniProfilesIn') {
            //getPLayersOfEvent($db, $match_id)
            $result = [];
            $idMatch = $_GET['idMatch'];
            $result[] = $idMatch;
            if($idMatch == 0){
                for($i=0;$i<3;$i++){
                    $result[] = ['Leroy.gege@gmail.com'.$i,'Leroy','gérard','gégé@gmail.com','débutant','A'];
                }
            }
            else{

                for($i=0;$i<3;$i++){
                    $result[] = ['Arnaud.cir@gmail.com'.$i,'Arnaud','CIR','Arnaud.cir@gmail.com','débutant','A'];
                }

            }



        }
        else if ($_GET["wanted"] == 'showMiniProfilesWait') {
            //getPLayersWaitingOfEvent($db, $match_id)
            $result = [];
            $idMatch = $_GET['idMatch'];
            $result[] = $idMatch;
            if($idMatch == 0){
                for($i=0;$i<3;$i++){
                    $result[] = ['Leroy.gege@gmail.com'.$i,'Leroy','gérard','gégé@gmail.com','débutant'];
                }
            }else{

                for($i=0;$i<3;$i++){
                    $result[] = ['Arnaud.cir@gmail.com'.$i,'Arnaud','CIR','Arnaud.cir@gmail.com','débutant'];
                }
           