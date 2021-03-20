<?php
if (file_exists("../_tenant/Config_simpletest.xml")) {
    $xml = simplexml_load_file("../_tenant/Config_simpletest.xml");
    $themename = $xml->customer->name;
    $themedomain = $xml->domain;
    $themetitle = $xml->hometitle;
    $themecolor = $xml->banner_color;

echo "Theme Name = " . $themename;
echo $themedomain;
echo $themetitle;
echo $themecolor;
// echo '<pre>';
// print_r($xml);
}
else {
    echo "Can't find ../_tenant/Config_simpletest.xml";
}

?>
