<?php
// inicializacao sdk facebook
require_once "config.php";

// parametrizar token de acesso 
$accessToken = '';

try {
    $response = $fb->get("/me/videos/uploaded?fields=id,description,picture,source", $accessToken); 
    $videos = $response->getGraphEdge();
    
    echo "<pre>\n";
    echo "--------------\n";
    foreach($videos as $video) {
        echo "ID => " . $video['id'] . "\n";
        echo "DESCRIPTION => " . @$video['description'] . "\n";
        echo "PICTURE => " . @$video['picture'] . "\n";
        echo "SOURCE => " . @$video['source'] . "\n";
        echo "--------------\n";
    }
    echo "</pre>\n";

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
