<?php
    header('Content-Type: application/json');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $search_html = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $myfile = ( ($search_html ) ? ($search_html)  : ("index.xml")) ;
    $myPictures = simplexml_load_file($myfile);
    // $myPictures = simplexml_load_file('https://api.flickr.com/services/feeds/photos_public.gne?tags=chamonix');
    
    $content = json_encode($myPictures );
    
    echo $content ;
    