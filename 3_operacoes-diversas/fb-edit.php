<?php
// inicializacao sdk facebook
require_once "config.php";

// token
$accessToken = '';

// id da publicacao
$idPublicacao = '';

try {
    // dados para envio da publicacao no feed
    $feed_data = array(
        "message" => "Alterado !", 
    );  

    $response = $fb->post("/$idPublicacao", $feed_data, $accessToken); 
    $result = $response->getDecodedBody();

    echo "<pre>\n";
    echo "Alterado: " . $result['success'];
    echo "\n";
    echo "</pre>\n";

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
