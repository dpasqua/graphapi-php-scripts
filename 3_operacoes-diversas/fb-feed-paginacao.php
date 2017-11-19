<?php
// inicializacao sdk facebook
require_once "config.php";

// parametrizar token de acesso do usuario
$accessToken = '';

try {
    $response = $fb->get("/me/feed?fields=id,name,message,link&limit=10", $accessToken); 
    // processa primeira pagina
    $feedEdge = $response->getGraphEdge();
    processaEdge($feedEdge);
    
    // processar segundo pagina
    $nextFeed = $fb->next($feedEdge);
    if($nextFeed) {
        processaEdge($nextFeed);

        // processa todas paginas restantes
        while($nextFeed = $fb->next($nextFeed)) {
            processaEdge($nextFeed);
        }
    }

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

/* processa retorno de consulta de feed */
function processaEdge($feeds)
{
    echo "<pre>\n";
    echo "--------------\n";
    foreach($feeds as $feed) {
        echo "ID => " . $feed['id'] . "\n";
        echo "NAME => " . @$feed['name'] . "\n";
        echo "MESSAGE => " . @$feed['message'] . "\n";
        echo "LINK => " . @$feed['link'] . "\n";
        echo "--------------\n";
    }
    echo "</pre>\n";
}
