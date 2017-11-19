<?php
// inicializar sdk facebook
require_once "config.php";

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();

    if (!$accessToken->isLongLived()) {   
        // token de acesso de curta duração, solicitar um de longa duração
        $oAuth2Client = $fb->getOAuth2Client();  
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);  
    } 

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // Erro retornado pela graph api
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // falha na validacao ou outro tipo de erro
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

// exibe o token de acesso extendido do usuario
echo $accessToken;
