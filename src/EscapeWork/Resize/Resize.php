<?php namespace EscapeWork\Resize;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;

class Resize
{

    public
        $picture, 
        $width  = 640, 
        $height = 480, 
        $originalWidth, 
        $originalHeight, 
        $cropCordinates = array(), 
        $quality = 100;

    /**
     * Accepted images 
     */
    protected $acceptedImages = array('image/jpg', 'image/jpeg', 'image/pjpg', 'image/pjpeg', 'image/png');
    

    public function __construct( $picture, $sizes = array() )
    {
        $this->setPicture( $picture );

        if( is_file( $this->picture ) ) 
        {
            $size = getimagesize( $picture );

            $this->originalWidth  = $size[0];
            $this->originalHeight = $size[1];
        } 
        else 
        {
            throw new ResizeException('Imagem <strong>' . $this->picture . '</strong> não encontrada');
        }
    }
    
    public function setPicture( $picture ) 
    {
        $this->picture = $picture;

        return $this;
    }

    public function setWidth( $width ) 
    {
        $this->width = (int) $width;

        return $this;
    }

    public function setHeight( $height ) 
    {
        $this->height = (int) $height;  

        return $this;
    }

    public function setQuality( $quality )
    {
        $this->quality = (int) $quality;

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

    public function getQuality()
    {
        return $this->quality;
    }
     
     
    
    /**
     * Ajustando o tamanho da imagem para não distorcer
     *
     * @access private
     * @return void
     */ 
    private function ajust( Ajustable $sizeAjust )
    {
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
     * Fazendo o redimensionamento e salvando (proporcional)
     *
     * @access public 
     * @return void
     */
    public function resize()
    {
        $this->ajust( new SizeAjust() );

        $this->execute();
    }
    

    /**
     * Cropando a imagem 
     * 
     * @return void 
     */
    public function crop()
    {
        $sizes = array(
            'width'  => $this->getWidth(), 
            'height' => $this->getHeight(), 
        );

        $this->ajust( new SizeAjustCrop() );
        $this->execute();

        $this->setCropCordinates( $sizes );

        $this->setWidth( $sizes['width'] );
        $this->setHeight( $sizes['height'] );

        $this->cropImage();
    }


    /**
     * Setando as cordenadas do crop para deixar a imagem do tamanho exato 
     *
     * @access  public 
     * @param   array  $sizes
     * @return  void
     */
    public function setCropCordinates( array $sizes )
    {
        if( $this->getWidth() > $sizes['width'] )
        {
            $widthLeft = ( $this->getWidth() - $sizes['width'] ) / 2;

            $this->cropCordinates['x'] = $widthLeft;
            $this->cropCordinates['y'] = 0;

            $this->setWidth( $sizes['width'] );
        }
        elseif( $this->getHeight() > $sizes['height'] )
        {
            $heightLeft = ( $this->getHeight() - $sizes['height'] ) / 2;

            $this->cropCordinates['x'] = 0;
            $this->cropCordinates['y'] = $heightLeft;

            $this->setHeight( $sizes['height'] );
        }
        else
        {
            $this->cropCordinates['x'] = 0;
            $this->cropCordinates['y'] = 0;
        }
    }


    /**
     * Cropando a imagem 
     *
     * @access  private 
     * @return  void
     */
    private function cropImage()
    {
        $imagine = new Imagine();
        $imagine->open( $this->getPicture() )
                ->crop( 
                    new Point( $this->cropCordinates['x'], $this->cropCordinates['y'] ), 
                    new Box( $this->getWidth(), $this->getHeight() ) 
                )
                ->save( $this->getPicture(), array(
                    'quality' => $this->getQuality()
                ) );
    }


    /**
     * Executando o redimensionamento
     *
     * @access  private
     * @return  void
     */
    private function execute()
    {
        $imagine = new Imagine();
        $imagine->open( $this->getPicture() )
                ->resize( new Box( $this->getWidth(), $this->getHeight() ) )
                ->save( $this->getPicture(), array(
                    'quality' => $this->getQuality()
                ) );
    }
}