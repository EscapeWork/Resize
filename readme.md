# EscapeWork\Resize [![Build Status](https://secure.travis-ci.org/EscapeWork/Resize.png)](http://travis-ci.org/EscapeWork/Resize) [![Latest Stable Version](https://poser.pugx.org/escapework/resize/v/stable.png)](https://packagist.org/packages/escapework/resize) [![Total Downloads](https://poser.pugx.org/escapework/resize/downloads.png)](https://packagist.org/packages/escapework/resize)

Componente que faz uma abstração da library [Imagine](https://github.com/avalanche123/Imagine) para fazer manipulações com imagens.

### Exemplos 

```php
use EscapeWork\Resize\Resize;

$resize = new Resize('/path/to/image.jpg');
$resize->setWidth(200)->setHeight(100)->resize(); # ajusta o tamanho automáticamente, mantendo no máximo 200px de largura e/ou 100px de altura

$resize = new Resize('/path/to/image.jpg');
$resize->setWidth(90)->setHeight(90)->crop(); # redimensiona, e depois cropa exatamente 90x90, podendo cortar algumas partes da imagem
```

### Crop a partir de um X e Y definidos

```php
$resize = new Resize('/path/to/image.jpg');
$resize->setX(20)->setY(30)->setWidth(300)->setHeight(400)->crop();
```

### Minimum Width and Minimum Height

```php
$resize = new Resize('/path/to/image.jpg');
$resize->setMinWidth(300)->setMinHeight(500)->resize();

$resize = new Resize('/path/to/other/image.jpg');
$resize->setMinHeight(549)->resize();

$resize = new Resize('/path/to/another/image.jpg');
$resize->setMinWidth(300)->resize();
```

### Upload de arquivos

```php
use EscapeWork\Resize\Upload;

$upload = new Upload($original, $newFile);
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
        "escapework/resize": "0.5.*"
    }
}