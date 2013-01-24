<?php namespace EscapeWork\Resize;

interface Ajustable
{
    public function setWidth( $width );

    public function setHeight( $height );

    public function setOriginalWidth( $originalWidth );

    public function setOriginalHeight( $originalHeight );

    public function getWidth();

    public function getHeight();

    public function getOriginalWidth();

    public function getOriginalHeight();

    public function ajust();
}