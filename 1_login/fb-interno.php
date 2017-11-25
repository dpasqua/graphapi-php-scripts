<?php
// inicializacao sdk facebook
require_once "config.php";

$accessToken = $_SESSION['fb_access_token'];

try {
    // usuario valido e com permissoes aceitas
    $response = $fb->get('/me?fields=id,name,email,gender', $accessToken);
    $user = $response->getGraphNode();

    // exibe dados do usuario
    echo $user['id'] . "<br /> ";
    echo $user['name'] . "<br /> ";
    echo $user['email'] . "<br /> ";
    echo $user['gender'] . "<br /> ";
    echo "<img src=\"https://graph.facebook.com/{$user['id']}/picture?type=large\"><br />";

} catch(Facebook\Exceptions\FacebookResponseException $e) {
    die ('Graph returned an error: ' . $e->getMessage());
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    die ('Facebook SDK returned an error: ' . $e->getMessage());
}
