<?php
// inicializacao sdk facebook
require_once "config.php";

// token de acesso do usuario de longa duracao
$accessToken = '';

try {
    $response = $fb->get("/me/accounts", $accessToken); 
    $accounts = $response->getGraphEdge();
   
    echo "<pre>\n";
    echo "--------------\n";
    foreach($accounts as $account) {
        echo "ID => " . $account['id'] . "\n";
        echo "Name => " . $account['name'] . "\n";
        echo "Access Token => " . $account['access_token'] . "\n";
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
