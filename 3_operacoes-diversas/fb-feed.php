<?php
// inicializacao sdk facebook
require_once "config.php";

// parametrizar token de acesso do usuario
$accessToken = '';

try {
    $response = $fb->get("/me/feed?fields=id,name,message,link,caption,description,picture", $accessToken); 
    $feeds = $response->getGraphEdge();
    
    echo "<pre>\n";
    echo "--------------\n";
    foreach($feeds as $feed) {
        echo "ID => " . $feed['id'] . "\n";
        echo "NAME => " . @$feed['name'] . "\n";
        echo "MESSAGE => " . @$feed['message'] . "\n";
        echo "LINK => " . @$feed['link'] . "\n";
        echo "CAPTION => " . @$feed['caption'] . "\n";
        echo "DESCRIPTION => " . @$feed['description'] . "\n";
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
