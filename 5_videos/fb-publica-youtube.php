<?php
// inicializacao sdk facebook
require_once "config.php";

$accessToken = '';

try {

    // dados para envio da publicacao 
    $feed_data = array(
        'link' => "http://www.youtube.com/watch?v=YHuDByY1pnk"
    );

    $response = $fb->post('/me/feed', $feed_data, $accessToken);
    $graphNode = $response->getGraphNode();
    echo 'ID da Publicação: ' . $graphNode['id'];

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
