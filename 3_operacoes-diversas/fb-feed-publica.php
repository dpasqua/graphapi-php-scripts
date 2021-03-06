<?php
// inicializacao sdk facebook
require_once "config.php";

$accessToken = '';

try {

    // dados para envio da publicacao no feed
    $feed_data = array(
        "message" => "Facebook Developers!", 
        "link" => "http://developers.facebook.com",
    );  

    $response = $fb->post('/me/feed', $feed_data, $accessToken); 
    $graphNode = $response->getGraphNode();
    echo 'ID da Postagem: ' . $graphNode['id'];

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
