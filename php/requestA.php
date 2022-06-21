<?php

//check the request :
$requestMethod = $_SERVER['REQUEST_METHOD'];
$request = substr($_SERVER['PATH_INFO'], 1);
$request = explode('/', $request);
$requestRessource = array_shift($request);


if ($requestRessource == 'search-event'){
    $result = 0; //default value

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

        //$login = $_POST["login"];
        $result = $_POST["value1"];
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

    // Send data to the client
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');

    echo json_encode($result); //send as JSON data

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