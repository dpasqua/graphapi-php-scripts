<?php
// inicializacao sdk facebook
require_once "config.php";

// usar um access token de página para listar eventos da pagina
// access token de usuario para listar eventos do usuário
$accessToken = '';

try {
    // trocar me por ID do grupo para listar eventos do grupo
    $response = $fb->get("/me/events", $accessToken); 
    $events = $response->getGraphEdge();

    echo "<pre>\n";
    echo "--------------\n";
    foreach($events as $event) {
        echo "ID => " . $event['id'] . "\n";
        echo "Name => " . $event['name'] . "\n";
        echo "Description => " . @$event['description'] . "\n";
        echo "Place => " . @$event['place']['name'] . "\n";
        echo "Start Time => " . @$event['start_time']->format('d/m/Y H:i:s') . "\n";
        echo "Status => " . @$event['rsvp_status'] . "\n";
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
