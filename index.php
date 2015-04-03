<!DOCTYPE html>
<HTML>
    <HEAD>
        <LINK rel="stylesheet" href="CSS/SlideShow.css">
    </HEAD>    
    <BODY>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $mythumbs = mythumbs("index.xml") ;
    $myPictures = simplexml_load_file('index.xml');
    // foreach ( $myPictures->)
    // echo date("c") . "Pierwszy " . $myPictures->feed[1]->entry[1]->title . "Koniec";
    echo "<div class=\"container\">" ;
    echo "<div class=\"thumbs\"><center>" ;
    foreach ($myPictures->entry as $pixinfo):
        $title=$pixinfo->title;
        $link=$pixinfo->link['href'];
        // $enclosure = $pixinfo->xpath('link[@rel="enclosure"]');
        // $enclosure = $pixinfo->xpath('//link[@rel="enclosure"]');
        $enclosure = $pixinfo->xpath('*//content') ; // link->[@rel="enclosure"] ;
        foreach ( $pixinfo->link as $mylink):
            if ( $mylink['rel'] === "enclosure") {
                $enclosure = $mylink;
            } else {
                $enclosure = $mylink;
            }
        endforeach;
        $image=str_replace("_b.jpg","_s.jpg",$enclosure['href']);
        // var_dump("enclosure", $enclosure) ;
        // echo "<a href=\"",$link,"\"><img src=\"",$image,"\" alt=\"",$title,"\" />", $enclosure['href'] ,"</a>\n";
        echo "<a href=\"",$link,"\"><img src=\"",$image,"\" alt=\"",$title,"\" />", "" ,"</a>\n";
    endforeach;
    echo "</center></div>";
    echo "</div>";
    
    
    
?>
    </BODY>
</HTML>
    