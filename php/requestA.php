<?php

// A COMPLETER

//check the resuest :
$requestMethod = $_SERVER['REQUEST_METHOD'];
$request = substr($_SERVER['PATH_INFO'], 1);
$request = explode('/', $request);
$requestRessource = array_shift($request);


if ($requestRessource == 'my-organize-event'){
    $result = 0; //default value

    if ($requestMethod == 'POST'){
        $result = add($_POST['value1'],$_POST['value2']);
    }

    if ($requestMethod == 'DELETE'){
        $result = sub($_GET['value1'],$_GET['value2']);
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

?>