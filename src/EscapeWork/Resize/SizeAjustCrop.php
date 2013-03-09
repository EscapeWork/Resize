<?php namespace EscapeWork\Resize;

class SizeAjustCrop implements Ajustable
{

    public
        $width, 
        $height, 
        $originalWidth, 
        $originalHeight;


    public function __construct( $width = null, $height = null, $originalWidth = null, $originalHeight = null )
    {
        if( !is_null( $width ) )
        {
            $this->setWidth( $width );
        }

        if( !is_null( $height ) )
        {
            $this->setHeight( $height );
        }

        if( !is_null( $originalWidth ) )
        {
            $this->setOriginalWidth( $originalWidth );
        }

        if( !is_null( $originalHeight ) )
        {
            $this->setOriginalHeight( $originalHeight );
        }
    }

    public function setWidth( $width )
    {
        $this->width = $width;

        return $this;
    }

    public function setHeight( $height )
    {
        $this->height = $height;

        return $this;
    }

    public function setOriginalWidth( $originalWidth )
    {
        $this->originalWidth = $originalWidth;

        return $this;
    }

    public function setOriginalHeight( $originalHeight )
    {
        $this->originalHeight = $originalHeight;

        return $this;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getOriginalWidth()
    {
        return $this->originalWidth;
    }

    public function getOriginalHeight()
    {
        return $this->originalHeight;
    }

    public function ajust()
    {
        $width  = $this->getWidth();
        $height = $this->getHeight();
        
        if( $width > $height )
        {
            $sizes = $this->ajustWidthHigherHeight();

            if( $sizes['width'] < $this->getWidth() || $sizes['height'] < $this->getHeight() )
            {
                $sizes = $this->ajustHeightHigherWidth();
            }
        }
        elseif( $height > $width )
        {
            $sizes = $this->ajustHeightHigherWidth();

            if( $sizes['width'] < $this->getWidth() || $sizes['height'] < $this->getHeight() )
            {
                $sizes = $this->ajustWidthHigherHeight();
            }
        }
        else
        {
            $sizes = $this->ajustWidthHigherHeight();

            if( $sizes['width'] < $this->getWidth() || $sizes['height'] < $this->getHeight() )
            {
                $sizes = $this->ajustHeightHigherWidth();
            }
        }

        return $sizes;
    }

    private function ajustWidthHigherHeight()
    {
        $originalWidth  = $this->getOriginalWidth();
        $originalHeight = $this->getOriginalHeight();
        $width          = $this->getWidth();
        $height         = $this->getHeight();

        $newWidth  = $this->getWidth();
        $newHeight = ceil( ( $originalHeight * $width )  / $originalWidth );

        return array(
            'width'  => $newWidth, 
            'height' => $newHeight
        );
    }

    private function ajustHeightHigherWidth()
    {
        $originalWidth  = $this->getOriginalWidth();
        $originalHeight = $this->getOriginalHeight();
        $width          = $this->getWidth();
        $height         = $this->getHeight();

        $newWidth  = ceil( ( $originalWidth  * $height ) / $originalHeight );
        $newHeight = $this->getHeight();

        return array(
            'width'  => $newWidth, 
            'height' => $newHeight
        );
    }
}