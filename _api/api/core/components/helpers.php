<?php

function dump($data = 0){
    echo '<pre style="background: #123; color: #4c4; font-size: 16px; padding:0px 15px ">';
    var_dump($data);
    echo '</pre>';
}

function dd($data = 0){
    echo '<pre style="background: #123; color: #4f4; font-size: 16px; padding:2px 15px" >';
    var_dump($data);
    die;
    exit;
}