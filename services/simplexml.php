<?php
if (file_exists("../_tenant/Config_simpletest.xml")) {
    $xml = simplexml_load_file("../_tenant/Config_simpletest.xml");
    $themename = $xml->settings->customer->name;
    $themedomain = $xml->settings->customer->domain;
    $themetitle = $xml->settings->customer->hometitle;
    $themecolor = $xml->settings->customer->banner_color;

echo $themename;
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
