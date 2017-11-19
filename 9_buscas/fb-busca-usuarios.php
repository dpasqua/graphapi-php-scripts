<?php
// inicializacao sdk facebook
require_once "config.php";

$accessToken = '';

try {
    // buscar key 'pasqua' em usuários
    $response = $fb->get("/search?type=user&q=pasqua&fields=id,name,link&limit=100", $accessToken); 
    $users = $response->getGraphEdge();

    $processaResposta = function($graphEdge) use ($fb)
    {
        echo "<pre>\n";
        echo "--------------\n";
        foreach($graphEdge as $user) {
            echo "ID => " . $user['id'] . "\n";
            echo "Name => " . $user['name'] . "\n";
            echo "Link => " . @$user['link'] . "\n";
            echo "--------------\n";
        }
        echo "</pre>\n";
    };

    // 1 pagina
    $processaResposta($users);
    
    // 2 pagina
    $next = $fb->next($users);
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
