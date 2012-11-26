# EscapeWork\Resize [![Build Status](https://secure.travis-ci.org/EscapeWork/Resize.png)](http://travis-ci.org/EscapeWork/Resize)

Componente que faz uma abstração da classe `?` para fazer manipulações com imagens.

### Exemplos 

```php
$resize = new EscapeWork\Resize\Resize( $picture );
$resize->setWidth(200)->setHeight(100)->resize();
$resize->setWidth(90)->setHeight(90)->crop();
```