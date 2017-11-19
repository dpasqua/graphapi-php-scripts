<?php
// inicializacao sdk facebook
require_once "config.php";

$accessToken = '';

try {
    // buscar key 'café' em locais em um raio de 1k do ct da novatec
    $response = $fb->get("/search?type=place&q=café&fields=id,name,link&center=-23.509220,-46.625734&distance=1000&limit=100", $accessToken); 
    $places = $response->getGraphEdge();

    $processaResposta = function($graphEdge) use ($fb)
    {
        echo "<pre>\n";
        echo "--------------\n";
        foreach($graphEdge as $place) {
            echo "ID => " . $place['id'] . "\n";
            echo "Name => " . $place['name'] . "\n";
            echo "Link => " . @$place['link'] . "\n";
            echo "--------------\n";
        }
        echo "</pre>\n";
    };

    // 1 pagina
    $processaResposta($places);
    
    // 2 pagina
    $next = $fb->next($places);
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
