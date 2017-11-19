<?php
// inicializacao sdk facebook
require_once "config.php";

$accessToken = $_SESSION['fb_access_token'];

try {
    // trata permissoes
    $response = $fb->get('/me/permissions?status=granted', $accessToken);

    $permissions_list = [];
    $permissions = $response->getGraphEdge();
    foreach($permissions as $perm) {
    		$permissions_list[] = $perm['permission'];
    }

    // garante que usuario aceitou publish_actions
    if(!in_array('publish_actions', $permissions_list)) {
        // nao tem permissao, solicitar
        $helper = $fb->getRedirectLoginHelper();
        $loginUrl = $helper->getLoginUrl("$siteUrl/fb-callback.php", [ 'publish_actions' ]);

        // redireciona para login
        header("Location: $loginUrl");
        exit;
    }

    // usuario valido e com permissoes aceitas
    $response = $fb->get('/me?fields=id,name', $accessToken);
    $user = $response->getGraphNode();

    // exibe foto do usuario logado
    echo "<img src=\"https://graph.facebook.com/{$user['id']}/picture?type=large\"><br />";
    echo $user['id'] . "<br /> ";
    echo $user['name'] . "<br /> ";

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
