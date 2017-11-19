<?php
// inicializacao sdk facebook
require_once "config.php";

$accessToken = '';
$id_grupo = '';

try {
    $response = $fb->get("/$id_grupo/members", $accessToken); 
    $members = $response->getGraphEdge();

    echo "<pre>\n";
    echo "--------------\n";
    foreach($members as $member) {
        echo "ID => " . $member['id'] . "\n";
        echo "Name => " . $member['name'] . "\n";
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
