<?php
// inicializacao sdk facebook
require_once "config.php";

// parametrizar token de acesso
$accessToken = '';

// id da publicacao
$idPublicacao = '';

try {
    $response = $fb->get("/$idPublicacao/likes?summary=true", $accessToken); 
    $likes = $response->getGraphEdge();

    $metaData = $likes->getMetaData();
    echo "Total Likes: " . $metaData["summary"]["total_count"] . "\n";

    echo "<pre>\n";
    echo "--------------\n";
    foreach($likes as $like) {
        echo "ID => " . $like['id'] . "\n";
        echo "Name => " . $like['name'] . "\n";
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
