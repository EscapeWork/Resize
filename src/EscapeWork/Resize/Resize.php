<?php namespace EscapeWork\Resize;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;

class Resize
{

    /**
     * Object variables
     */
    public
        $picture, 
        $cropCordinates = array(), 
        $quality = 100;

    /**
     * Sizes
     */
    protected 
    	$width  = 640, 
        $height = 480, 
        $originalWidth, 
        $originalHeight, 
        $minWidth, 
        $minHeight;

    /**
     * Accepted images 
     */
    protected $acceptedImages = array('image/jpg', 'image/jpeg', 'image/pjpg', 'image/pjpeg', 'image/png');
    
    public function __construct($picture, $width = null, $height = null)
    {
        $this->setPicture($picture);
        $this->setImageSizes();

        if (! is_null($width)) {
            $this->setWidth($width);
        }

        if (! is_null($height)){
            $this->setHeight($height);
        }
    }
    
    public function setPicture($picture) 
    {
        $this->picture = $picture;
        return $this;
    }

    public function setWidth($width)
    {
        $this->width = (int) $width;
        return $this;
    }

    public function setHeight($height)
    {
        $this->height = (int) $height;  
        return $this;
    }

    public function setQuality($quality)
    {
        $this->quality = (int) $quality;
        return $this;
    }

    public function setX($x)
    {
    	$this->cropCordinates['x'] = $x;
    	return $this;
    }

    public function setY($y)
    {
    	$this->cropCordinates['y'] = $y;
    	return $this;
    }

    public function setMinWidth($minWidth)
    {
    	$this->minWidth = $minWidth;
    	return $this;
    }

    public function setMinHeight($minHeight)
    {
    	$this->minHeight = $minHeight;
    	return $this;
    }

    public function getMinWidth()
    {
    	return $this->minWidth;
    }

    public function getMinHeight()
    {
    	return $this->minHeight;
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
    private function ajust(Ajustable $sizeAjust)
    {
        $sizes = $sizeAjust->setOriginalWidth($this->originalWidth)
                  ->setOriginalHeight($this->originalHeight)
                  ->ajust();
        
        $this->setWidth($sizes['width']);
        $this->setHeight($sizes['height']);

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
    	if (is_null($this->minWidth) && is_null($this->minHeight)) {
        	$this->ajust(new SizeAjust(
        		$this->getWidth(), 
        		$this->getHeight()
        	));
        } else {
        	$this->ajust(new SizeAjustMinimum(
        		$this->getMinWidth(), 
        		$this->getMinHeight()
        	));
        }

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

        $this->ajust(new SizeAjustCrop(
        	$this->getWidth(), 
    		$this->getHeight()
        ));

        $this->execute();
        $this->setCropCordinates($sizes);

        $this->setWidth($sizes['width']);
        $this->setHeight($sizes['height']);

        $this->cropImage();
    }

    /**
     * Setando as cordenadas do crop para deixar a imagem do tamanho exato 
     *
     * @access  public 
     * @param   array  $sizes
     * @return  void
     */
    public function setCropCordinates(array $sizes)
    {
        if ($this->cordinatesAlreadySetted()) {
        	return;
        }

        if ($this->getWidth() > $sizes['width']) {
            $widthLeft = ( $this->getWidth() - $sizes['width'] ) / 2;

            $this->cropCordinates['x'] = $widthLeft;
            $this->cropCordinates['y'] = 0;

            $this->setWidth( $sizes['width'] );
        } elseif($this->getHeight() > $sizes['height']) {
            $heightLeft = ( $this->getHeight() - $sizes['height'] ) / 2;

            $this->cropCordinates['x'] = 0;
            $this->cropCordinates['y'] = $heightLeft;

            $this->setHeight( $sizes['height'] );
        } else {
            $this->cropCordinates['x'] = 0;
            $this->cropCordinates['y'] = 0;
        }
    }

    /**
     * Checking if the coordinates are already setted
     */
    public function cordinatesAlreadySetted()
    {
    	return isset($this->cropCordinates['x']) && isset($this->cropCordinates['y']);
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
        $imagine->open($this->getPicture())
                ->crop( 
                    new Point( $this->cropCordinates['x'], $this->cropCordinates['y'] ), 
                    new Box( $this->getWidth(), $this->getHeight() ) 
                )
                ->save( $this->getPicture(), array(
                    'quality' => $this->getQuality()
                ));
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
        $imagine->open($this->getPicture())
                ->resize(new Box($this->getWidth(), $this->getHeight()))
                ->save($this->getPicture(), array(
                    'quality' => $this->getQuality()
                ));
    }

    /**
     * Setting the image dizes
     *
     * @throws ResizeException
     */
    public function setImageSizes()
    {
    	if (is_file($this->picture)) {
            $size = getimagesize($this->picture);

            $this->originalWidth  = $size[0];
            $this->originalHeight = $size[1];
        } else {
            throw new ResizeException('Imagem <strong>' . $this->picture . '</strong> não encontrada');
        }
    }

    /**
     * Fazendo upload e redimensionando imagens a partir de uma fixa e um array de tamanhos 
     * 
     * @param  string  $directory [diretório da imagem original]
     * @param  string  $img       [nome da imagem original]
     * @param  array   $sizes     [array com os tamanhos e prefixos para redimensionamentos]
     * @return boolean 
     */
    public static function make($directory, $img, array $sizes)
    {
        foreach ($sizes as $prefix => $size) {
            try {
                $newImg = $directory . $prefix . $img;

                $upload = new Upload( 
                    $directory . $img, 
                    $newImg  
                );

                $resize = new Resize($newImg, $size['width'], $size['height']);

                if (isset($size['crop']) && $size['crop'] === true) {
                    $resize->crop();
                } else {
                    $resize->resize();
                }
            } 
            catch(UploadException $e) {

            }
            catch (ResizeException $e) {

            }
        }
    }

    /**
     * Helper function to format the name removing special characters, accents e white spaces
     *
     * @static
     * @access  public 
     * @param   string $string
     * @return  string
     */
    public static function formatString($string, $encode = 'UTF-8')
    {
        $accents = array(
            'a' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
            'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
            'c' => '/&Ccedil;/',
            'c' => '/&ccedil;/',
            'e' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
            'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
            'i' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
            'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
            'n' => '/&Ntilde;/',
            'n' => '/&ntilde;/',
            'o' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
            'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
            'u' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
            'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
            'y' => '/&Yacute;|&Yuml;/',
            'y' => '/&yacute;|&yuml;/'
        );

        $specials = array('/', '\\', '|', '*', ':', '[', ']', '{', '}', "'", '"', ',', '%', '@', '&', '(', ')', '¬', '#', '!', '?', 'ª', 'º', '¨', '°');
        
        $string = str_replace($specials, '', $string);
        $string = preg_replace($accents, array_keys($accents), htmlentities($string, ENT_NOQUOTES, $encode));

        $string = trim( $string );

        $string = str_replace(' ', '-', $string);
        $string = str_replace('---', '-', str_replace(' ', '-', $string));
        $string = str_replace('_', '-', str_replace('--', '-', $string));
        $string = strtolower($string);

        $string = preg_replace($accents, array_keys($accents), $string);

        return $string;
    }
}