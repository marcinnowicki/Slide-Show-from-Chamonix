<?php
header('Content-Type: application/json');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $myPictures = simplexml_load_file('index.xml');
    $content = json_encode($myPictures );
    
    echo $content ;
    
?>
    