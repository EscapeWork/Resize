<?php 
namespace EscapeWork\Resize;

class SizeAjust
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
        if( $this->getOriginalWidth() === $this->getOriginalHeight() )
        {
            return $this->ajustWidthEqualsHeight();
        }
        elseif( $this->getOriginalWidth() > $this->getOriginalHeight() )
        {
            return $this->ajustWidthHigherHeight();
        }
        elseif( $this->getOriginalHeight() > $this->getOriginalWidth() )
        {
            return $this->ajustHeightHigherWidth();
        }
        else
        {
            throw new \Exception('Unknow error, check data types');
        }
    }

    private function ajustWidthEqualsHeight()
    {
        $largura = $this->getWidth();
        $altura  = $this->getHeight();
        $w       = $this->getOriginalWidth();
        $h       = $this->getOriginalHeight();

        if( $w > $largura ) 
        { 
            $nw = $largura;  $nh = ($h * $largura) / $w; 

            if( $nh > $altura ) 
            { 
                $nh = $altura; $nw = ($w * $altura)/$h; 
            } 
        } 
        elseif( $h > $altura ) 
        { 
            $nh = $altura; $nw = ($w * $altura)/$h; 
        } 
        else 
        { 
                $nw = $w; $nh = $h; 
        }

        return array(
            'width'  => $nw, 
            'height' => $nh
        );
    }


    private function ajustWidthHigherHeight()
    {
        $largura = $this->getWidth();
        $altura  = $this->getHeight();
        $w       = $this->getOriginalWidth();
        $h       = $this->getOriginalHeight();

        if( $w > $largura ) 
        { 
            $nw = $largura; $nh = ($h * $largura) / $w; 

            if( $nh > $altura ) 
            { 
                $nh = $altura; $nw = ($w * $altura) / $h; 
            } 
        } 
        else 
        { 
            $nw = $w; $nh = $h; 

            if( $nh > $altura ) 
            { 
                $nh = $altura; $nw = ($w * $altura) / $h; 
            } 
        } 

        return array(
            'width'  => $nw, 
            'height' => $nh
        );
    }

    public function ajustHeightHigherWidth()
    {
        $largura = $this->getWidth();
        $altura  = $this->getHeight();
        $w       = $this->getOriginalWidth();
        $h       = $this->getOriginalHeight();

        if( $h > $altura ) 
        { 
            $nh = $altura; $nw = ($w * $altura) / $h; 

            if( $nw > $largura ) 
            { 
                $nw = $largura; $nh = ($h * $largura) / $w; 
            } 
        } 
        else 
        { 
            $nh = $h; $nw = $w; 

            if( $nw > $largura ) 
            { 
                $nw = $largura; $nh = ($h * $largura) / $w; 
            }
        }

        return array(
            'width'  => $nw, 
            'height' => $nh
        );
    }
}