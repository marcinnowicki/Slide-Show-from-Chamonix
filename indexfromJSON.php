<!DOCTYPE html>
<HTML>
    <HEAD>
        <LINK rel="stylesheet" href="CSS/SlideShow.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    </HEAD>    
    <BODY>
        <SCRIPT lang="javascript">
<?php
$search_html = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
?>
            var jqxhr = $.get("http://datamachiner.pl/SlideShow/Flickr2JSON.php?id=<?php echo $search_html; ?>", function (response) {
                console.log("success 1 ");
            })
                    .done(function () {
                        // do nothing
                        console.log("second success");
                    })
                    .fail(function () {
                        // do nothing
                        console.log("error");
                    })
                    .always(function (response) {
                        // do something
                        console.log("finished");
                        $.each(response.entry, function (index, row) {
                            // console.log(row.title);
                            var newIMG = "<IMG SRC=\"" + row.link[0].href + "\">";
                            var bigIMG = "";
                            var myINFO = "";
                            $.each(this.link, function () {
                                if (this["@attributes"].rel === "enclosure") {
                                    myINFO = "Title: " + row.title + "<br/>"
                                            // + "Author: <A HREF=\'" + row.author.uri + "\'>" + row.author.name + "<br/>"
                                            + "Author: " + row.author.name + "<br/>"
                                            + "id: " + row.id + "<br/>"
                                            + "published: " + row.published + "<br/>"
                                            + "updated: " + row.updated + "<br/>";
                                    // + "content: " + row.content + "<br/>"
                                    // + "published: " + row.published + "<br/>" ;


                                    newIMG = "<IMG SRC=\"" + this["@attributes"].href.replace('_b.jpg', '_s.jpg') + "\">";
                                    bigIMG = "<div class=\"bigimage\" onMouseOver=\"document.getElementById('info').innerHTML='" + myINFO + "';\">"
                                            // + "<i style=\"z-index:100; top: 20px; \" class=\"fa fa-rocket icon-4x\"></i>" 
                                            + "<a href=\"#\"><span class=\"fa fa-rocket icon-3x circle\"></span></a>"
                                            + "<div class=\"bigdesc\">" + row.title + " by " + row.author.name + "</div><A HREF=\"" + row.link[0]['@attributes'].href + "\">"
                                            + "<IMG SRC=\"" + this["@attributes"].href + "\"></A></div>";
                                    console.log(bigIMG) ;
                                    $("#thumbs").append(newIMG);
                                    $("#big").append(bigIMG);
                                    $("#info").innerHTML = myINFO;
                                }
                            });
                        });
                    });

            jqxhr.always(function () {
                console.log("second finished");
            });

        </script>
        <?php
        /*
         * To change this license header, choose License Headers in Project Properties.
         * To change this template file, choose Tools | Templates
         * and open the template in the editor.
         */
        $arr = array(
            'Recent Uploads tagged chamonix, ski and snow (Web)' => 'https://api.flickr.com/services/feeds/photos_public.gne?tags=chamonix,ski,snow',
            'Recent Uploads tagged chamonix, ski and snow (local)' => 'index.xml',
            'Chamonix' => 'https://api.flickr.com/services/feeds/photos_public.gne?tags=chamonix',
            'Hintertux' => 'https://api.flickr.com/services/feeds/photos_public.gne?tags=hintertux',
            'Bali' => 'https://api.flickr.com/services/feeds/photos_public.gne?tags=bali');
        echo "<FORM  NAME=\"Change\" ACTION=\"indexfromJSON.php\" method=\"GET\" enctype=\"application/x-www-form-urlencoded\">";
        echo "<SELECT NAME=\"id\" ONCHANGE=\"submit()\">";
        echo "<OPTION VALUE=\"index.html\">Select something</OPTION>";
        foreach ($arr as $title => $url) {
            echo "<OPTION VALUE=\"" . $url . "\">" . $title . "</OPTION>";
        }
        echo "</SELECT>";
        echo "You selected " . urldecode($search_html);
        ?>

        <div class="container">
            <div class="big" id="big">
            </div>
            <div class="info" id="info">
                Some info
            </div>
            <div class="thumbs" id="thumbs">
            </div>
        </div>


    </BODY>
</HTML>
