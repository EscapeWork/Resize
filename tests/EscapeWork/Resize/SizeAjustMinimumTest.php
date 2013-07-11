<?php namespace EscapeWork\Resize;

use EscapeWork\Resize\SizeAjustMinimum;

class SizeAjustMinimumTest extends \PHPUnit_Framework_TestCase
{

    public function assettPreConditions()
    {
        $this->assertTrue(class_exists('EscapeWork\Resize\SizeAjustMinimum'));
    }

    /**
     * @testdox       SizeAjust::ajust
     * @dataProvider  providerWidth
     */
    public function testAjustMinWidth($minWidth, $originalWidth, $originalHeight, $width, $height)
    {
        $sizeAjust = new SizeAjustMinimum();
        $sizes = $sizeAjust->setWidth($minWidth)
                  ->setOriginalWidth($originalWidth)
                  ->setOriginalHeight($originalHeight)
                  ->ajust();

        $this->assertTrue(is_array($sizes));
        $this->assertEquals($width, $sizes['width'], "Width should be $width");
        $this->assertEquals($height, $sizes['height'], "Height should be $height");
    }

	public function providerWidth()
    {
    	return array(
    		array(382, 1024, 768, 382, 286), 
    		array(382, 768, 1024, 382, 509), 

    		array(200, 1024, 768, 200, 150), 
    		array(200, 768, 1024, 200, 266), 
    	);
    }

    /**
     * @testdox       SizeAjust::ajust
     * @dataProvider  providerHeight
     */
    public function testAjustMinHeight($minHeight, $originalWidth, $originalHeight, $width, $height)
    {
        $sizeAjust = new SizeAjustMinimum();
        $sizes = $sizeAjust->setHeight($minHeight)
                  ->setOriginalWidth($originalWidth)
                  ->setOriginalHeight($originalHeight)
                  ->ajust();

        $this->assertTrue(is_array($sizes));
        $this->assertEquals($width, $sizes['width'], "Width should be $width");
        $this->assertEquals($height, $sizes['height'], "Height should be $height");
    }

    public function providerHeight()
    {
    	return array(
    		array(487, 1024, 768, 649, 487), 
    		array(487, 768, 1024, 365, 487), 

    		array(300, 1024, 768, 400, 300), 
    		array(300, 768, 1024, 225, 300), 
    	);
    }

    /**
     * @testdox       SizeAjust::ajust
     * @dataProvider  providerWidthAndHeight
     */
    public function testAjustMinWidthAndHeight($minWidth, $minHeight, $originalWidth, $originalHeight, $width, $height)
    {
        $sizeAjust = new SizeAjustMinimum();
        $sizes = $sizeAjust->setWidth($minWidth)
        		  ->setHeight($minHeight)
                  ->setOriginalWidth($originalWidth)
                  ->setOriginalHeight($originalHeight)
                  ->ajust();

        $this->assertTrue(is_array($sizes));
        $this->assertEquals($width, $sizes['width'], "Width should be $width");
        $this->assertEquals($height, $sizes['height'], "Height should be $height");
    }

    public function providerWidthAndHeight()
    {
    	return array(
    		array(382, 487, 1024, 768, 649, 487), 
    		array(200, 300, 1024, 768, 400, 300), 

    		array(382, 487, 768, 1024, 382, 509), 
    		array(200, 300, 768, 1024, 225, 300), 
    	);
    }
}