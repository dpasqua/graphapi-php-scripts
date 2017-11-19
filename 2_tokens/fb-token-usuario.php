<?php
// inicializar sdk facebook
require_once "config.php";

$helper = $fb->getRedirectLoginHelper();

// permissoes
$perms = [
    'publish_actions',
    'email',
    'user_friends',
    'user_posts',
    'user_photos',
    'user_videos',
    'user_managed_groups',
    'manage_pages',
    'publish_pages',
    'user_events',
    'rsvp_event'
];

$loginUrl = $helper->getLoginUrl("$siteUrl/fb-callback.php", $perms);
echo '<a href="' . $loginUrl . '">Logar com Facebook!</a>';
