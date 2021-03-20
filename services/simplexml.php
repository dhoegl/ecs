<?php
if (file_exists("Config_simpletest.xml")) {
    $xml = simplexml_load_file("Config_simpletest.xml");
    // $themename = $xml->settings->customer->name;
    // $themedomain = $xml->settings->customer->domain;
    // $themetitle = $xml->settings->customer->hometitle;
    // $themecolor = $xml->settings->customer->banner_color;

// echo $themename;
// echo $themedomain;
// echo $themetitle;
// echo $themecolor;
echo '<pre>';
print_r($xml);
}
else {
    echo "Nothing to show here";
}

?>
