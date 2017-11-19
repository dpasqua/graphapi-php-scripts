# Scripts PHP para Facebook

Este repositório contém scripts de interações com a API do Facebook (Graph API) usando o SDK para PHP oficial. Você pode usá-los como referência ou integra-los dentro de seu aplicativo.

### Instalação:

```sh
composer install
```

### Configuração:

Antes de testar os scripts é necessário configurar alguns parâmetros dentro do arquivo `config.php`. 

Configure os parâmetros do aplicativo -> `APP_ID`, `APP_SECRET` e `APP_VERSION`:

```php
define('APP_ID', '');
define('APP_SECRET', '');
define('APP_VERSION', '');

// siteurl
$siteUrl = "http://";
```

Os parâmetros do aplicativo devem ser obtidos do Dashboard do aplicativo do Facebook.

O `$siteUrl` é a URL onde esta seu scripts estão hospedados. É o mesmo parâmetros configurado no campo URL do site na plataforma Site do aplicativo do Facebook. Este parâmetro é usado apenas nos scripts que geram token de acesso de usuário e Login.


### Testando os scripts:

Para testar os scripts é necessário copiá-los para o diretório raiz da aplicação, onde esta o arquivo config.php

Alguns scripts precisarão de parametrização extra. As parametrizações estão sempre no ínicio do arquivo. Exemplos de parametrização são: token de acesso de usuário ou página (`$accessToken`), identificadores de grupos, eventos ou places. (`$idGrupo`, `$idEvento` ou `$idPagina`).

Nas parametrizações pode aparecer o campo `$idPublicacao` que normalmente é obtido no retorno de uma publicação (link, foto, video, etc.) realizada.
