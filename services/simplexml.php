<?php
if (file_exists("../_tenant/Config_simpletest.xml")) {
    $xml = simplexml_load_file("../_tenant/Config_simpletest.xml");
    $themename = $xml->customer->name;
    $themedomain = $xml->domain;
    $themetitle = $xml->hometitle;
    $themecolor = $xml->banner_color;

echo "Theme Name = " . $themename;
echo "Theme Domain = " . $themedomain;
echo "Theme Title = " . $themetitle;
echo "Theme Color = " . $themecolor;
// echo '<pre>';
// print_r($xml);
}
else {
    echo "Can't find ../_tenant/Config_simpletest.xml";
}

?>
