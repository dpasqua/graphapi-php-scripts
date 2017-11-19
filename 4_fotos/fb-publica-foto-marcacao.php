<?php
// inicializacao sdk facebook
require_once "config.php";

$accessToken = '';

try {
    // obter 3 usuarios para marcar na foto
    $response = $fb->get("/me/taggable_friends?limit=3", $accessToken); 

    $friendsEdge = $response->getGraphEdge();
    $tags = array();
    $pos = 10;

    foreach($friendsEdge as $friend) {
        $data = $friend->asArray();

        $tags[] = [
            'x' => $pos,
            'y' => $pos,
            'tag_uid' => $data['id']
        ];
        $pos++;
    }

    $photo_data = [
        'caption' => 'Bela Paisagem.',
        'image' => $fb->fileToUpload(__DIR__ . '/resources/paisagem-1.jpg'),
        'tags' => $tags,
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
