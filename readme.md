# EscapeWork\Resize

Componente que faz uma abstração da classe `?` para fazer manipulações com imagens.

### Exemplos 

```php
$resize = new EscapeWork\Resize\Resize( $picture );
$resize->setWidth(200)->setHeight(100)->ajust()->resize();
$resize->setWidth(90)->setHeight(90)->crop();
```