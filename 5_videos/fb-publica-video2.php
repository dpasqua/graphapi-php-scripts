<?php
// inicializacao sdk facebook
require_once "config.php";

$accessToken = '';

try {
    $video_data = [
        'title' => 'Video Demonstração',
        'description' => 'Este video é apenas uma demonstração',
        'file_url' => 'http://douglaspasqua.com/natureza-1.mp4',
    ];

    $response = $fb->post('/me/videos', $video_data, $accessToken);
    $graphNode = $response->getGraphNode();
    echo 'ID do Video: ' . $graphNode['id'];

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
