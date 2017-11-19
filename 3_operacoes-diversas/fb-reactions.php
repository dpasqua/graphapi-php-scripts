<?php
// inicializacao sdk facebook
require_once "config.php";

// parametrizar token de acesso
$accessToken = '';

// id da publicacao
$idPublicacao = '';

try {
    $response = $fb->get("/$idPublicacao/reactions", $accessToken); 
    $reactions = $response->getGraphEdge();

    $reactionsCounter = [
        'NONE'     => 0,
        'LIKE'     => 0,
        'LOVE'     => 0,
        'WOW'      => 0,
        'HAHA'     => 0,
        'SAD'      => 0,
        'ANGRY'    => 0,
        'THANKFUL' => 0,
    ];

    foreach($reactions as $reaction) {
        $type = $reaction['type'];
        $reactionsCounter[$type]++;
    }

    // imprime contador de reacoes
    echo "<pre>\n";
    print_r($reactionsCounter);
    echo "</pre>\n";

    // reacoes informacoes
    echo "<pre>\n";
    echo "--------------\n";
    foreach($reactions as $reaction) {
        echo "ID => " . $reaction['id'] . "\n";
        echo "Name => " . $reaction['name'] . "\n";
        echo "TYPE => ". $reaction['type'] . "\n";
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
