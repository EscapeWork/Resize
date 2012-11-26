<?php 
namespace EscapeWork\Resize;

use EscapeWork\Resize\SizeAjust;

class SizeAjustTest extends \PHPUnit_Framework_TestCase
{

    public function assettPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Resize\SizeAjust') );
    }

    public function testSetWidthAndHeightViaConstructor()
    {
        $width     = 200;
        $height    = 200;
        $sizeAjust = new SizeAjust($width, $height);
        
        $this->assertEquals($width, $sizeAjust->getWidth());
        $this->assertEquals($height, $sizeAjust->getHeight());
    }

    public function testSetWidth()
    {
        $width     = 200;
        $sizeAjust = new SizeAjust();
        $sizeAjust->setWidth($width);
        $this->assertEquals($width, $sizeAjust->getWidth());
    }

    public function testSetHeight()
    {
        $height    = 200;
        $sizeAjust = new SizeAjust();
        $sizeAjust->setHeight($height);
        $this->assertEquals($height, $sizeAjust->getHeight());
    }

    public function testSetWidthAndHeightViaNestedFunction()
    {
        $width     = 200;
        $height    = 200;
        $sizeAjust = new SizeAjust();
        $sizeAjust->setWidth($width)->setHeight($height);
        
        $this->assertEquals($width, $sizeAjust->getWidth());
        $this->assertEquals($height, $sizeAjust->getHeight());
    }

    public function testSetOriginalWidth()
    {
        $originalWidth = 200;
        $sizeAjust     = new SizeAjust();
        $sizeAjust->setOriginalWidth( $originalWidth );
        $this->assertEquals( $originalWidth, $sizeAjust->getOriginalWidth() );
    }

    public function testSetOriginalHeight()
    {
        $originalHeight = 200;
        $sizeAjust      = new SizeAjust();
        $sizeAjust->setOriginalHeight( $originalHeight );
        $this->assertEquals( $originalHeight, $sizeAjust->getOriginalHeight() );
    }

    public function testSetOriginalWidthAndOriginalHeightViaNestedFunction()
    {
        $originalWidth     = 200;
        $originalHeight    = 200;
        $sizeAjust = new SizeAjust();
        $sizeAjust->setOriginalWidth($originalWidth)->setOriginalHeight($originalHeight);
        
        $this->assertEquals($originalWidth, $sizeAjust->getOriginalWidth());
        $this->assertEquals($originalHeight, $sizeAjust->getOriginalHeight());
    }

    public function testSetAttrivutesAllViaConstructor()
    {
        $originalWidth  = 200;
        $originalHeight = 200;
        $width          = 200;
        $height         = 200;

        $sizeAjust = new SizeAjust(
            $width, 
            $height, 
            $originalWidth, 
            $originalHeight
        );

        $this->assertEquals( $width, $sizeAjust->getWidth() );
        $this->assertEquals( $height, $sizeAjust->getHeight() );
        $this->assertEquals( $originalWidth, $sizeAjust->getOriginalWidth() );
        $this->assertEquals( $originalHeight, $sizeAjust->getOriginalHeight() );
    }

    public function testSetAttrivutesAllViaNestedFunction()
    {
        $originalWidth  = 200;
        $originalHeight = 200;
        $width          = 200;
        $height         = 200;

        $sizeAjust = new SizeAjust();
        $sizeAjust->setWidth( $width )
                  ->setHeight( $height )
                  ->setOriginalWidth( $originalWidth )
                  ->setOriginalHeight( $originalHeight );

        $this->assertEquals($width, $sizeAjust->getWidth());
        $this->assertEquals($height, $sizeAjust->getHeight());
        $this->assertEquals($originalWidth, $sizeAjust->getOriginalWidth());
        $this->assertEquals($originalHeight, $sizeAjust->getOriginalHeight());
    }

    public function testAjustWidthEqualsHeight()
    {
        $originalWidth  = 500;
        $originalHeight = 500;
        $width          = 200;
        $height         = 200;

        $sizeAjust = new SizeAjust();
        $sizes = $sizeAjust->setWidth( $width )
                  ->setHeight( $height )
                  ->setOriginalWidth( $originalWidth )
                  ->setOriginalHeight( $originalHeight )
                  ->ajust();

        $this->assertTrue( is_array( $sizes ) );
        $this->assertTrue(
            $sizes['width'] == $sizes['height']
        );
    }
}