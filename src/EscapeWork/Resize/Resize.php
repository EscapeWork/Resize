<?php 
namespace EscapeWork\Resize;

use ResizeException;
use SizeAjust;
use Redimensiona;

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
            $size = getimagesize( $pic );

            $this->originalWidth  = $size[0];
            $this->originalHeight = $size[1];
        } 
        else 
        {
            throw new ResizeException('Imagem <strong>' . $pic . '</strong> não encontrada');
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

    public function getPicture()
    {
        return $this->picture;
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
     * @access private
     * @return void
     */ 
    private function ajust()
    {
        $sizeAjust = new SizeAjust()
        $sizes = $sizeAjust->setOriginalWidth( $this->originalWidth )
                  ->setOriginalHeight( $this->originalHeight )
                  ->setWidth( $this->getWidth() )
                  ->setHeight( $this->getHeight() )
                  ->ajust();
        
        $this->setWidth( $sizes['width'] );
        $this->setHeight( $sizes['height'] );

        return $this;
    }
    
    
    /**
     * Fazendo o redimensionamento e salvando 
     *
     * @access public 
     * @return boolean
     */
    public function resize()
    {
        $this->ajust();

        return $this->crop();
    }
    

    public function crop()
    {
        $img = new Redimensiona();
        $img->carrega( $this->getPicture() );
        $valida = $img->valida();
        
        if( $valida == 'OK' ) 
        {
            $img->redimensionar( $this->getWidth(), $this->getHeight(), 'crop');  
            $img->grava( $this->foto, 100 );

            return true;
        }

        return false;
    }
}