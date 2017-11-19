<?php
// inicializacao sdk facebook
require_once "config.php";

$accessToken = '';

try {
    $nomeAlbum = "Paisagens";
    $idAlbum = null;

    // verificar albums
    $response = $fb->get("/me/albums", $accessToken); 
    $albumsEdge = $response->getGraphEdge();

    foreach($albumsEdge as $album) {
        $dados = $album->asArray();
        
        if($dados['name'] == $nomeAlbum) {
            // album encontrado
            $idAlbum = $dados['id']; 
        }
    }

    if($idAlbum == null) {
        // criar novo album
        $dados = [
            'name' => $nomeAlbum,
            'message' => 'Álbum com belas paisagens',
        ];

        $response = $fb->post('/me/albums', $dados, $accessToken);
        $graphNode = $response->getGraphNode();
        $idAlbum = $graphNode['id'];
    }

    // publicar foto no album
    $photo_data = [
        'caption' => 'Bela Paisagem.',
        'image' => $fb->fileToUpload(__DIR__ . '/resources/paisagem-1.jpg'),
    ];

    $response = $fb->post("/$idAlbum/photos", $photo_data, $accessToken);
    $graphNode = $response->getGraphNode();
    echo 'ID da Foto: ' . $graphNode['id'];

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
