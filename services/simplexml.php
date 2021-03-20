<?php
if (file_exists("../_tenant/Config_simpletest.xml")) {
    $xml = simplexml_load_file("../_tenant/Config_simpletest.xml");
    $themename = $xml->name;
    // $themename = "Weird that xml doesn't work";
    $themedomain = $xml->domain;
    $themetitle = $xml->hometitle;
    $themecolor = $xml->banner_color;

echo $themename;
echo $themedomain;
echo $themetitle;
echo $themecolor;
}
else {
    echo "Nothing to show here";
}

?>
