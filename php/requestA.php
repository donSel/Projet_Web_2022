<?php

include('database.php');
include('functions.php');
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

$db = dbConnect();

$me = 'mickael.neroda@mail.com';

$result = 0; //default value

if ($requestRessource == 'search-event'){

    if ($requestMethod == 'GET'){
        if ($_GET['wanted'] == 'cities'){
            $result = toTabTab(getTowns($db));
            //$result = [[0,'Bretteville'],[1,'Caen'],[2,'Nantes']];
        }
        else if ($_GET['wanted'] == 'sports'){
            $result = toTabTab(getSports($db));
            //$result = [[0,'Foot-ball'],[1,'Basket-Ball']];
        }
        else if($_GET['wanted'] == 'myOrganizeEvent'){
            $result = toTAbTAb(getOrganizerEventIdTitle($db, $me));
            //$result = [[0,'foot2rue']];
        }
        else if($_GET['wanted'] == 'myEvent'){
            $result = toTabTab(getOrganizerPlayerEventIdTitle($db,$me));
            //$result = [[0,'foot2rue']];
        }
        else if($_GET['wanted'] == 'allEvents'){
            $result = toTabTab(getInfosAllEvent($db));
            /*
            //getInfosAllEvent($db)
            $idMatch = $_GET['idMatch'];
            $result = [];
            for ($i=0;$i<10;$i++){
                $result[] = [$i,'test','foot-ball','Nantes','10-10-2022','12:00',1,12];
            }*/
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
            $result = toTab(getInfoEvent($db, $idMatch));
            /*if ($idMatch == 0){
                $result = [$idMatch, 'titre0', 'description', 'Arnaud', 'images/default_avatar.jpg', '--', '--:--', '--:--', '--', 10, 10];
            }else{
                $result = [$idMatch, 'titreautre', 'J\'ai encore de la place :)', 'Arnaud', 'images/default_avatar.jpg', '--', '--:--', '--:--', '--', 10, 2];
            }*/

        }
        else if($_GET['wanted'] == 'infosNormal'){
            //getAllProfilEvents($db, $mail)
            $idMatch = $_GET['idMatch'];
            $result = toTabTab(getAllProfilEvents($db, $me));
            //$result = [$idMatch, 'titre', true, 0, 'images/default_avatar.jpg', 'Jean-Eude', 'Organisateur', '--:--', '--', 'Bretteville', 'rue du moulin', '10-2', 'ÉquipeA'];
        }
        else if($_GET['wanted'] == 'allPlayers'){
            $idMatch = $_GET['idMatch'];
            $result = toTabTab(getPLayersOfEvent($db, $idMatch));
            /*$result = [];
            $result[] = [0,'Jean','images/default_avatar.jpg'];
            $result[] = [1,'Paul','images/default_avatar.jpg'];
            $result[] = [2,'Adrien','images/default_avatar.jpg'];
            $result[] = [4,'Clark','images/default_avatar.jpg'];
            $result[] = [5,'Batman','images/default_avatar.jpg'];
            $result[] = [33,'uwu','images/default_avatar.jpg'];*/

        }
        
    }
    if ($requestMethod == 'POST'){
        $result = 'POST';
        if ($_POST["what"] == 'participate'){
            $matchID = $_POST["matchID"];
            setPlayerStatusTeam($db, $matchID, $me, false, 1, 0);
            //Add to database
        }


    }


    show($result);

}
else if ($requestRessource == 'organize-event'){
        if ($requestMethod == 'GET'){
            if ($_GET["wanted"] == 'showEventOrganize') {
                //getAllOrganizerEvents
                $result = toTabTab(getAllOrganizerEvents($db, $me));
                /*$result = [];
                $result[] = [0, 'titre0', 'foot', 'date', 'heure', 2, 20, 8];
                $result[] = [1, 'titre1', 'hand', 'date', 'heure', 4, 20, 5];
                $result[] = [2, 'titre2', 'hand', 'date', 'heure', 4, 20, 5];
                $result[] = [3, 'titre3', 'hand', 'date', 'heure', 4, 20, 5];
                $result[] = [4, 'titre4', 'hand', 'date', 'heure', 4, 20, 5];*/

            }
            else if ($_GET["wanted"] == 'showMiniProfilesIn') {
                //getPLayersOfEvent($db, $match_id)
                $idMatch = $_GET['idMatch'];
                $result = toTabTab(getPLayersOfEvent($db, $idMatch));
                array_unshift($result,$idMatch);
                /*
                $result = [];
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

                }*/



            }
            else if ($_GET["wanted"] == 'showMiniProfilesWait') {
                //getPLayersWaitingOfEvent($db, $match_id)
                $result = [];
                $idMatch = $_GET['idMatch'];
                $result = toTabTab(getPLayersWaitingOfEvent($db, $idMatch));
                array_unshift($result,$idMatch);
                /*$result[] = $idMatch;
                if($idMatch == 0){
                    for($i=0;$i<3;$i++){
                        $result[] = ['Leroy.gege@gmail.com'.$i,'Leroy','gérard','gégé@gmail.com','débutant'];
                    }
                }else{

                    for($i=0;$i<3;$i++){
                        $result[] = ['Arnaud.cir@gmail.com'.$i,'Arnaud','CIR','Arnaud.cir@gmail.com','débutant'];
                    }
                }*/
            }
        }else if ($_POST["what"] == 'createEvent'){
            //insertNewMatch($db, $organizer_id, $sport, $title, $match_description, $number_min_player, $number_max_player, $town, $address, $date, $hour, $duration, $price, $age_range
            $matchID = $_POST["matchID"];
            $sport = $_POST["sport"];
            $title = $_POST["title"];
            $comment = $_POST["comment"];
            $min = $_POST["min"];
            $max = $_POST["max"];
            $town = $_POST["town"];
            $adress = $_POST["adress"];
            $date = $_POST["date"];
            $hour = $_POST["hour"];
            $duration = $_POST["duration"];
            $price = $_POST["price"];
            $minA = $_POST["minA"];
            $maxA = $_POST["maxA"];
            $in = $_POST["in"];

            insertNewMatch($db, $me, $sport, $title, $comment, $min, $max, $town, $adress, $date, $hour, $duration, $price, $minA.'-'.$maxA);
            if ($in){

            }
            //Add to database  Pas oublier de préciser le "moi"
        }
        else if ($requestMethod == 'PUT'){
            parse_str(file_get_contents('php://input'), $_PUT);
            if ($_PUT["what"] == 'setTeam') {
                //setPlayerStatusTeam($db, $match_id, $mail, $accepted, $role, $team)
                $team = $_PUT["team"];
                $idMatch = $_PUT["idMatch"];
                $mail = $_PUT["mail"];
                setPlayerStatusTeam($db, $idMatch, $mail, true, 1, $team);
            }
            else if ($_PUT["what"] == 'setEnd') {
                //$result = $_PUT["idMatch"];
                //updateMatchResultTable($db, $match_id, $score_match, $duration, $best_player, $winner)
                $idMatch = $_PUT['idMatch'];
                $score = strval($_PUT['scoreA']).'-'.$_PUT['scoreB'];
                $duration = '00:00:00';
                $best = $_PUT['best'];
                $winner = $_PUT['winner'];
                updateMatchResultTable($db, $idMatch, $score, $duration, $best, $winner);
            }
        }

    show($result);
}
else if ($requestRessource == 'profile'){
    if ($requestMethod == 'GET'){
        if ($_GET["wanted"] == 'profileInfos') {
            $result = ['nantes@gmail.com','Leroy','nathan','19','Caen','débutant','12345','images/default_avatar.jpg','je suis un commentaire']; //[id_user,nom,prenom,age;ville,forme,mdp,url,commentaire]
            //HERE
        }else if ($_GET["wanted"] == 'profileStats') {
            $result = [10,2,"Roger","Rabbit"]; //[nbMatch,nbButs,bestPlayer_nom,bestPlayer_prenom]
            //HERE
        }
        else if ($_GET["wanted"] == 'notifs') {
            $result = [[0,'User veut se joindre à l\'évènement'],[1,'Vous avez été séléctionnés pour l’évènement :“Petit tennis au SNUC”'],[2,'Vous avez n’avez pas été séléctionnés pour l’évènement :“match de basket au stade de Procès”']];
            $result = toTabTab(getProfilNotifications($db, $me));
        }




    }
    if ($requestMethod == 'PUT'){
        parse_str(file_get_contents('php://input'), $_PUT);
        $firstName = $_PUT['firstName'];
        $lastName = $_PUT['lastName'];
        $age = $_PUT['age'];
        $town = $_PUT['town'];
        $health = $_PUT['health'];
        $password = $_PUT['password'];
        $photoUrl = $_PUT['photoUrl'];
        $commentary = $_PUT['commentary'];
        $result = [$firstName,$lastName,$age,$town,$health,$password,$photoUrl,$commentary];
        //updateProfil($db, $me, $age, $town, $health, $password, $review_value, $review_text, $photo_url)
    }
    show($result);
}
else{
    header('HTTP/1.1 400 Bad Request');
}


?>
