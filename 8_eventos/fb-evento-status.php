<?php
// inicializacao sdk facebook
require_once "config.php";

// token de acesso 
$accessToken = '';
// identificador do evento
$idEvento = '';

try {
    // maybe, attending, declined
    $response = $fb->post("/$idEvento/attending", [], $accessToken);
    $result = $response->getDecodedBody();

    echo "<pre>\n";
    echo "Status: " . $result['success'];
    echo "\n";
    echo "</pre>\n";

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
