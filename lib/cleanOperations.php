<?php


function clean($data){
    // return the clean data for processing purpose
    $safePostOrGet = filter_input_array(INPUT_POST);
    if (!$safePostOrGet) $safePostOrGet = filter_input_array(INPUT_GET);
    return $safePostOrGet;
}



?>