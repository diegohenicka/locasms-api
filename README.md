# locasms.com.br - API de envio de SMS
## SDK para integração com o LocaSMS

Para verificar a documentação completa e os exemplos de resposta, acesse o <a href="http://locasms.com.br/downloads-loca-sms/" target="_blank">Manuais de Integração e outras opções de Downloads</a>.



## Como usar: ##

Baixe e coloque o arquivo **locasms.php** no mesmo diretorio do arquivo PHP que irá implementar.
Após isso, importe o arquivo em seu projeto e inicialize usando seus dados de acesso.

```php
require 'locasms.php';
use LocaSMS\LocaSMS;

$locasms = new LocaSMS("seu_login", "sua_senha");
```


## Gerar envio de SMS simples: ##

Chame o método **enviarSMS** para gerar o envio:
OBS: Pode se passar vários números de telefones separados por vírgula

```php
$locasms->enviarSMS("mensagem", "numero(s)");
```


Enviar call-back para a geração do SMS:

```php
$locasms->enviarSMS("mensagem", "numero(s)", "url_callback");
```

Agendar data e hora de envio:

```php
$locasms->enviarSMS("mensagem", "numero(s)", "", "24/07/2018", "16:00");
```


## Consultar status de uma campanha: ##

Chame o método **statusCampanha** para consultar uma campanha:

```php
$locasms->statusCampanha("id_da_campanha");
```



## Consultar o saldo de sua conta: ##

Chame o método **consultaSaldo** para consultar o saldo da sua conta:

```php
$locasms->consultaSaldo();
```