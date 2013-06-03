# EscapeWork\Resize (Beta) [![Build Status](https://secure.travis-ci.org/EscapeWork/Resize.png)](http://travis-ci.org/EscapeWork/Resize)

Componente que faz uma abstração da library [Imagine](https://github.com/avalanche123/Imagine) para fazer manipulações com imagens.

### Exemplos 

```php
use EscapeWork\Resize\Resize;

$resize = new Resize('/caminho/para/imagem');
$resize->setWidth(200)->setHeight(100)->resize(); # ajusta o tamanho automáticamente, mantendo no máximo 200px de largura e/ou 100px de altura

$resize = new Resize('/caminho/para/imagem');
$resize->setWidth(90)->setHeight(90)->crop(); # redimensiona, e depois cropa exatamente 90x90, podendo cortar algumas partes da imagem
```

```php
use EscapeWork\Resize\Upload;

$upload = new Upload( $original, $newFile );
```

#### Upload e redimensionamento a partir de um array 

```php
use EscapeWork\Resize\Resize;

$dir      = 'img';
$img      = 'original.jpg';
$sizes    = array(
    'mini-' => array(
        'width'  => 80, 
        'height' => 80, 
        'crop'   => true
    ), 
    'thumb-' => array(
        'width'  => 150, 
        'height' => 100, 
        'crop'   => false
    ), 
    'vga-' => array(
        'width'  => 640, 
        'height' => 480, 
        'crop'   => false
    ), 
);

# cria 3 novas imagens [mini-original.jpg], [thumb-original.jpg], [vga-original.jpg], 
# redimensionadas e cropadas conforme as informações do array 
Resize::make( $dir, $img, $sizes );
```

### Instalação 

A instalação está disponível via [Composer](https://packagist.org/packages/escapework/resize).

```
{
    "require": {
        "escapework/resize": "0.4.*"
    }
}