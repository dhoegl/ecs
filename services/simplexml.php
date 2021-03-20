<?php
if (file_exists("Config_simpletest.xml2")) {
    $xml = simplexml_load_file("Config_simpletest.xml");
    $themename = $xml->settings->customer->name;
    // $themename = "Weird that xml doesn't work";
    $themedomain = $xml->settings->customer->domain;
    $themetitle = $xml->settings->customer->hometitle;
    $themecolor = $xml->settings->customer->banner_color;

echo $themename;
echo $themedomain;
echo $themetitle;
echo $themecolor;
}
else {
    echo "Nothing to show here";
}

?>
