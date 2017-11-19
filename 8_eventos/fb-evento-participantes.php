<?php
// inicializacao sdk facebook
require_once "config.php";

// parametrizar token de acesso
$accessToken = '';

// id do evento
$idEvento = '';

try {
    $calcEvent = function($edge) use ($fb, $idEvento, $accessToken) {
        // lista dos que comparecerao
        $response = $fb->get("/$idEvento/$edge", $accessToken); 
        $data = $response->getGraphEdge();

        $total = count($data);

        echo "Total $edge: " . $total . "\n";
        echo "--------------\n";
        foreach($data as $user) {
            echo "ID => " . $user['id'] . "\n";
            echo "Name => " . $user['name'] . "\n";
            echo "--------------\n";
        }    
    };

    echo "<pre>\n";
    $calcEvent('attending');
    $calcEvent('declined');
    $calcEvent('interested');
    $calcEvent('maybe');
    $calcEvent('noreply');
    echo "</pre>\n";

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
