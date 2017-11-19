<?php
// inicializacao sdk facebook
require_once "config.php";

// parametrizar token de acesso 
$accessToken = '';

try {
    $response = $fb->get("/me/photos/uploaded?fields=id,name,picture", $accessToken); 
    $photos = $response->getGraphEdge();
    
    echo "<pre>\n";
    echo "--------------\n";
    foreach($photos as $photo) {
        echo "ID => " . $photo['id'] . "\n";
        echo "NAME => " . @$photo['name'] . "\n";
        echo "PICTURE => " . $photo['picture'] . "\n";
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
