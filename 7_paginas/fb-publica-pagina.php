<?php
// inicializacao sdk facebook
require_once "config.php";

// token de acesso de pagina
$accessToken = '';

try {

    // dados para envio da publicacao no feed
    $feed_data = array(
        "message" => "Site Oficial do php !", 
        "link" => "http://www.php.net",
    );  

    $response = $fb->post("/me/feed", $feed_data, $accessToken); 
    $graphNode = $response->getGraphNode();
    echo 'ID da Postagem: ' . $graphNode['id'];

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
