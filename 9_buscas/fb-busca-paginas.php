<?php
// inicializacao sdk facebook
require_once "config.php";

$accessToken = '';

try {
    // buscar key 'ecommerce' em páginas
    $response = $fb->get("/search?type=page&q=ecommerce&fields=id,name,description,link&limit=100", $accessToken); 
    $pages = $response->getGraphEdge();

    $processaResposta = function($graphEdge) use ($fb)
    {
        echo "<pre>\n";
        echo "--------------\n";
        foreach($graphEdge as $page) {
            echo "ID => " . $page['id'] . "\n";
            echo "Name => " . $page['name'] . "\n";
            echo "Link => " . @$page['link'] . "\n";
            echo "--------------\n";
        }
        echo "</pre>\n";
    };

    // 1 pagina
    $processaResposta($pages);
    
    // 2 pagina
    $next = $fb->next($pages);
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
