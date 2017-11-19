<?php
// inicializacao sdk facebook
require_once "config.php";

$accessTokenDefault = '';

// access token default (configuracao obrigatoria)
$fb->setDefaultAccessToken($accessTokenDefault);

// popular o $dummyData com o conteudo real das publicacoes
// SELECT message, link, access_token FROM requests WHERE published=false
$dummyData = array_fill(0, 125, [ 'data' => ['message' => 'batch request', 'link' => 'http://xpto.example.net'], 'access_token' => 'token xpto' ]);

// divido o array em pedaços de 50
$batchs = array_chunk($dummyData, 50);

foreach($batchs as $batch) {
    $request = [];
    foreach($batch as $row) {
        $request[] = $fb->request('POST', '/me/feed', $row['data'], $row['access_token']);
    }

    // publicar ate 50 request em batch
    try {
        $responses = $fb->sendBatchRequest($request);
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
}
