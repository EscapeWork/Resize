# EscapeWork\Resize (Beta) [![Build Status](https://secure.travis-ci.org/EscapeWork/Resize.png)](http://travis-ci.org/EscapeWork/Resize)

Componente que faz uma abstração da library [Imagine](https://github.com/avalanche123/Imagine) para fazer manipulações com imagens.

### Exemplos 

```php
use EscapeWork\Resize;

$resize = new Resize('/caminho/para/imagem');
$resize->setWidth(200)->setHeight(100)->resize(); # ajusta o tamanho automáticamente, mantendo no máximo 200px de largura e/ou 100px de altura

$resize = new Resize('/caminho/para/imagem');
$resize->setWidth(90)->setHeight(90)->crop(); # redimensiona, e depois cropa exatamente 90x90, podendo cortar algumas partes da imagem
```

### Instalação 

A instalação está disponível via [Composer](https://packagist.org/packages/escapework/resize). Autoload compátivel com a PSR-0.