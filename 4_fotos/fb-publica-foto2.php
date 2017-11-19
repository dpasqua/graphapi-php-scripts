<?php
// inicializacao sdk facebook
require_once "config.php";

// parametrizar token de acesso
$accessToken = '';

try {
    $photo_data = [
        'caption' => 'Bela Paisagem.',
    	'url' => 'http://douglaspasqua.com/paisagem-1.jpg',
    ];

    $response = $fb->post('/me/photos', $photo_data, $accessToken);
    $graphNode = $response->getGraphNode();
    echo 'ID da Foto: ' . $graphNode['id'];

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
