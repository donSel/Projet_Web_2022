<?php

function toTab($dict){
    $result = [];
    foreach($dict as $key){
        $result[] = $key;
    }
    return $result;
}

function toTabTab($tab){
    $result = [];
    foreach($tab as $dict){
        $result[] = toTab($dict);
    }
    return $result;
}