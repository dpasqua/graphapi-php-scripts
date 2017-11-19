<?php
// inicializacao sdk facebook
require_once "config.php";

$accessToken = '';

try {
    $response = $fb->get("/me/groups", $accessToken); 
    $groups = $response->getGraphEdge();

    echo "<pre>\n";
    echo "--------------\n";
    foreach($groups as $group) {
        echo "ID => " . $group['id'] . "\n";
        echo "Name => " . $group['name'] . "\n";
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
