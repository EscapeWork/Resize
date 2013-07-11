<?php namespace EscapeWork\Resize;

use Exception;

class SizeAjustMinimum implements Ajustable
{

    public
        $width, 
        $height, 
        $originalWidth, 
        $originalHeight;


    public function __construct($width = null, $height = null, $originalWidth = null, $originalHeight = null)
    {
        if (! is_null($width)) {
            $this->setWidth($width);
        }

        if (! is_null($height)) {
            $this->setHeight($height);
        }

        if (! is_null($originalWidth)) {
            $this->setOriginalWidth($originalWidth);
        }

        if (! is_null($originalHeight)) {
            $this->setOriginalHeight($originalHeight);
        }
    }

    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    public function setOriginalWidth($originalWidth)
    {
        $this->originalWidth = $originalWidth;

        return $this;
    }

    public function setOriginalHeight($originalHeight)
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
        if (is_null($this->getHeight())) {
        	return $this->ajustMinimumWidth();
        } 
        elseif (is_null($this->getWidth())) {
        	return $this->ajustMinimumHeight();
        } 
        else {
        	$sizes = $this->ajustMinimumWidth();
        	
        	if ($this->getHeight() < $sizes['height']) {
        		return $sizes;
        	}

        	return $this->ajustMinimumHeight();
        }
    }

    /**
     * Minimum width
     */
    private function ajustMinimumWidth()
    {
		$minWidth  = $this->getWidth();
		$w         = $this->getOriginalWidth();
		$h         = $this->getOriginalHeight();

        $nw = $minWidth;
        $nh = ($h * $minWidth) / $w;

        return array(
            'width'  => (int) $nw, 
            'height' => (int) $nh
        );
    }

    /**
     * Minimum height
     */
    public function ajustMinimumHeight()
    {
		$minHeight = $this->getHeight();
		$w         = $this->getOriginalWidth();
		$h         = $this->getOriginalHeight();

        $nh = $minHeight; 
        $nw = ($w * $minHeight) / $h;

        return array(
            'width'  => (int) $nw, 
            'height' => (int) $nh
        );
    }
}