<?php
// inicializar sdk facebook
require_once "config.php";

$helper = $fb->getRedirectLoginHelper();
// permissoes
$perms = [
    'email',
    'publish_actions',
    'user_friends'
];

$loginUrl = $helper->getLoginUrl("$siteUrl/fb-callback.php",$perms);
echo '<a href="' . $loginUrl . '">Logar com Facebook!</a>';
