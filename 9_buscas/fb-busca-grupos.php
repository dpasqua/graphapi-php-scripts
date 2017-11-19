<?php
// inicializacao sdk facebook
require_once "config.php";

$accessToken = '';

try {
    // buscar key 'php' em grupos
    $response = $fb->get("/search?type=group&q=php&fields=id,name,privacy&limit=100", $accessToken); 
    $groups = $response->getGraphEdge();

    $processaResposta = function($graphEdge) use ($fb)
    {
        echo "<pre>\n";
        echo "--------------\n";
        foreach($graphEdge as $group) {
            echo "ID => " . $group['id'] . "\n";
            echo "Name => " . $group['name'] . "\n";
            echo "Privacy => " . @$group['privacy'] . "\n";
            echo "--------------\n";
        }
        echo "</pre>\n";
    };

    // 1 pagina
    $processaResposta($groups);
    
    // 2 pagina
    $next = $fb->next($groups);
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
