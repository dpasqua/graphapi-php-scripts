<?php
// inicializacao sdk facebook
require_once "config.php";

// parametriacoes
$accessTokenUsuario = '';
$accessTokenPagina = '';
$idGrupo = '';
$idEvento = '';

// access token default (configuracao obrigatoria)
$fb->setDefaultAccessToken($accessTokenUsuario);

// parametros de publicacao
$data = array(
    "message" => "Exemplo de publicação em batch !", 
);  

$batch = [
    $fb->request('POST', '/me/feed', $data), // feed do usuario
    $fb->request('POST', '/me/feed', $data, $accessTokenPagina), // feed da pagina
    $fb->request('POST', "/$idGrupo/feed", $data), // feed do grupo
    $fb->request('POST', "/$idEvento/feed", $data), // feed do evento
];

try {
    $responses = $fb->sendBatchRequest($batch);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

// tratar responses
foreach ($responses as $key => $response) {
  if ($response->isError()) {
    $e = $response->getThrownException();
    echo '<p>Error! Facebook SDK Said: ' . $e->getMessage() . "\n\n";
  } else {
    echo "<p>(" . $key . ") HTTP status code: " . $response->getHttpStatusCode() . "<br />\n";
    echo "Response: " . $response->getBody() . "</p>\n\n";
    echo "<hr />\n\n";
  }
}
