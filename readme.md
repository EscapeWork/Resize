# EscapeWork\Resize [![Build Status](https://secure.travis-ci.org/EscapeWork/Resize.png)](http://travis-ci.org/EscapeWork/Resize)

Componente que faz uma abstração da classe `canvas` para fazer manipulações com imagens.

A Classe Canvas foi criado pelo [Davi Ferreira](https://github.com/daviferreira/canvas).

### Exemplos 

```php
use EscapeWork\Resize;

$resize = new Resize('/caminho/para/imagem');
$resize->setWidth(200)->setHeight(100)->resize();
$resize->setWidth(90)->setHeight(90)->crop();
```

### Instalação 

A instalação está disponível via [Composer](https://packagist.org/packages/escapework/resize). Autoload compátivel com a PSR-0.