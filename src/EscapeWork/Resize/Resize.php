<?php 
namespace EscapeWork\Resize;

use ResizeException;

class Resize
{

    /**
     * Variaveis de controle
     */
    public
        $picture, 
        $upload, 
        $width  = 640, 
        $height = 480, 
        $originalWidth, 
        $originalHeight;
    

    public function __construct( $picture, $sizes = array() )
    {
        $this->setPicture( $pic );

        if( is_file( $this->foto ) ) 
        {
            $size = getimagesize($pic);

            $this->originalWidth  = $size[0];
            $this->originalHeight = $size[1];
        } 
        else 
        {
            throw new ResizeException('A imagem inexistente <strong>' . $pic . '</strong> não existe');
        }
    }
    
    public function setPicture( $picture ) 
    {
        $this->picture = $picture;

        return $this;
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
    
    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }
     
     
    
    /**
     * Ajustando o tamanho da imagem para não distorcer
     *
     * @access public
     * @return void
     */ 
    public function ajust()
    {
        $largura = $this->width;
        $altura  = $this->height;
        $w       = $this->originalWidth;
        $h       = $this->originalHeight;
        
        # altura === largura 
        if ($h == $w) { 
            if ($w > $largura) { 
                $nw = $largura;  $nh = ($h * $largura)/$w; 

                if ($nh > $altura) { 
                    $nh = $altura; $nw = ($w * $altura)/$h; 
                } 
            } else if ($h > $altura) { 
                    $nh = $altura; $nw = ($w * $altura)/$h; 
            } else { 
                    $nw = $w; $nh = $h; 
            } 
        } 

        # largura maior que altura 
        if ($w > $h) { 
            if ($w > $largura) { 
                $nw = $largura; $nh = ($h * $largura)/$w; 

                if ($nh > $altura) { 
                    $nh = $altura; $nw = ($w * $altura)/$h; 
                } 
            } else { 
                $nw = $w; $nh = $h; 

                if ($nh > $altura) { 
                    $nh = $altura; $nw = ($w * $altura)/$h; 
                } 
            } 
        } 

        # altura maior que largura 
        if ($h > $w) { 
            if ($h > $altura) { 
                $nh = $altura; $nw = ($w * $altura)/$h; 

                if ($nw > $largura) { 
                    $nw = $largura; $nh = ($h * $largura)/$w; 
                } 
            } else { 
                $nh = $h; $nw = $w; 

                if ($nw > $largura) { 
                    $nw = $largura; $nh = ($h * $largura)/$w; 
                }
            } 
        } 
        
        $this->setWidth( $nw );
        $this->setHeight( $nh );
    }
    
    
    public function resize()
    {       
        
    }
    

    public function crop()
    {

    }
}