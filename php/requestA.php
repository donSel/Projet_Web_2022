<?php

function show($what){
    // Send data to the client
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');

    echo json_encode($what); //send as JSON data
}
//check the request :
$requestMethod = $_SERVER['REQUEST_METHOD'];
$request = substr($_SERVER['PATH_INFO'], 1);
$request = explode('/', $request);
$requestRessource = array_shift($request);

$result = 0; //default value

if ($requestRessource == 'search-event'){

    if ($requestMethod == 'GET'){
        if ($_GET['wanted'] == 'cities'){
            $result = [[0,'Bretteville'],[1,'Caen'],[2,'Nantes']];
        }
        else if ($_GET['wanted'] == 'sports'){
            $result = [[0,'Foot-ball'],[1,'Basket-Ball']];
        }
        else if($_GET['wanted'] == 'myOrganizeEvent'){
            $result = [[0,'foot2rue']];
        }
        else if($_GET['wanted'] == 'myEvent'){
            $result = [[0,'foot2rue']];
        }
        else if($_GET['wanted'] == 'allEvents'){
            $idMatch = $_GET['idMatch'];
            $result = [];
            for ($i=0;$i<100;$i++){
                $result[] = [$i,'test','foot-ball','Nantes','10-10-2022','12:00',1,12];
            }
        }
        else if($_GET['wanted'] == 'infos'){
            $idMatch = $_GET['idMatch'];
            $result = [$idMatch, 'titre', 'description', 'Arnaud', 'images/default_avatar.jpg', '--', '--:--', '--:--', '--', 10, 2];
        }
        else if($_GET['wanted'] == 'infosNormal'){
            $idMatch = $_GET['idMatch'];
            $result = [$idMatch, 'titre', true, 0, 'images/default_avatar.jpg', 'Jean-Eude', 'Organisateur', '--:--', '--', 'Bretteville', 'rue du moulin', '10-2', 'ÉquipeA'];
        }
        else if($_GET['wanted'] == 'allPlayers'){
            $idMatch = $_GET['idMatch'];
            $result = [];
            $result[] = [0,'Jean','images/default_avatar.jpg'];
            $result[] = [1,'Paul','images/default_avatar.jpg'];
            $result[] = [2,'Adrien','images/default_avatar.jpg'];
            $result[] = [4,'Clark','images/default_avatar.jpg'];
            $result[] = [5,'Batman','images/default_avatar.jpg'];
            $result[] = [33,'uwu','images/default_avatar.jpg'];

        }
        else{
            $result = null;
        }
    }
    if ($requestMethod == 'POST'){
        $result = 'POST';
        if ($_POST["what"] == 'participate'){
            $matchID = $_POST["matchID"];
            //Add to database
        }
        else if ($_POST["what"] == 'createEvent'){
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
            //Add to database  Pas oublier de préciser le "moi"
        }

    }
    if ($requestMethod == 'PUT'){
        //parse_str(file_get_contents('php://input'), $_PUT);
        //      $login = $_PUT["login"];
        $result = 3;
    }

    if ($requestMethod == 'DELETE'){
        //$_GET['value1']
        $result = 4;
    }

    show($result);

}
else if ($requestRessource == 'organize-event'){
        if ($requestMethod == 'GET'){
            if ($_GET["wanted"] == 'showEventOrganize') {
                $result = [];
                $result[] = [0, 'titre0', 'foot', 'date', 'heure', 2, 20, 8];
                $result[] = [1, 'titre1', 'hand', 'date', 'heure', 4, 20, 5];

            }
            else if ($_GET["wanted"] == 'showMiniProfilesIn') {
                $result = [];
                $idMatch = $_GET['idMatch'];
                $result[] = $idMatch;
                if($idMatch == 0){
                    for($i=0;$i<3;$i++){
                        $result[] = [$i,'Leroy','gérard','gégé@gmail.com','débutant','A'];
                    }
                }



            }
            else if ($_GET["wanted"] == 'showMiniProfilesWait') {
                $result = [];
                $idMatch = $_GET['idMatch'];
                $result[] = $idMatch;
                if($idMatch == 0){
                    for($i=0;$i<3;$i++){
                        $result[] = [$i,'Leroy','gérard','gégé@gmail.com','débutant'];
                    }
                }



            }



        }


    show($result);
}
else{
    header('HTTP/1.1 400 Bad Request');
}



/*
AJAX REQUEST :
ajaxRequest('POST', 'php/request.php/operation/',showResult, 'value1=' + $('#value1').val() + '&value2=' + $('#value2').val());
ajaxRequest('DELETE', 'php/request.php/operation/?value1=' + $('#value1').val() + '&value2=' + $('#value2').val(), showResult);






*/

?>