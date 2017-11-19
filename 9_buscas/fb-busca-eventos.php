<?php
// inicializacao sdk facebook
require_once "config.php";

$accessToken = '';

try {
    // buscar key 'linux' em eventos
    $response = $fb->get("/search?type=event&q=linux&fields=id,name,description,start_time,place{location{country,city,latitude,longitude}}&limit=100", $accessToken); 
    $events = $response->getGraphEdge();

    $processaResposta = function($graphEdge) use ($fb)
    {
        echo "<pre>\n";
        echo "--------------\n";
        foreach($graphEdge as $event) {
            echo "ID => " . $event['id'] . "\n";
            echo "Name => " . $event['name'] . "\n";
            echo "Description => " . @$event['description'] . "\n";
            echo "Start Time => " . $event['start_time']->format('d/m/Y H:i:s') . "\n";
            echo "Country => " . @$event['place']['location']['country'] . "\n";
            echo "Cidade => " . @$event['place']['location']['city'] . "\n";
            echo "Latitude => " . @$event['place']['location']['latitude'] . "\n";
            echo "Longitude => " . @$event['place']['location']['longitude'] . "\n";
            echo "--------------\n";
        }
        echo "</pre>\n";
    };

    // 1 pagina
    $processaResposta($events);

    // 2 pagina
    $next = $fb->next($events);
    if($next) {
        $processaResposta($next);
    }

    // etc...

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
