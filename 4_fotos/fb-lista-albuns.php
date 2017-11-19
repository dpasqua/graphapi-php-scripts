<?php
// inicializacao sdk facebook
require_once "config.php";

// parametrizar token de acesso 
$accessToken = '';

try {
    $response = $fb->get("/me/albums", $accessToken); 
    $albums = $response->getGraphEdge();
    
    echo "<pre>\n";
    echo "--------------\n";
    foreach($albums as $album) {
        echo "ID => " . $album['id'] . "\n";
        echo "NAME => " . @$album['name'] . "\n";
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
