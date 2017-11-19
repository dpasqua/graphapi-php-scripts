<?php
// inicializar sdk facebook
require_once "config.php";

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // Erro retornado pela graph api
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // falha na validacao ou outro tipo de erro
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (!isset($accessToken)) {
    // usuario nao esta logado, voltar para Login
    header("Location: $siteUrl/login.php");
    exit;
}

// guarda o token na sessao
$_SESSION['fb_access_token'] = (string) $accessToken;

// redireciona usuario
header("Location: $siteUrl/fb-interno.php");
