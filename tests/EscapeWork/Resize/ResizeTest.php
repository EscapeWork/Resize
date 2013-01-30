<?php 
namespace EscapeWork\Resize;

use EscapeWork\Resize\Resize;
use EscapeWork\Resize\Upload;

class ResizeTest extends \PHPUnit_Framework_TestCase
{
    public static $dir = 'tests/EscapeWork/Resize/img/';

    public function assettPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Resize\Resize') );
    }

    /**
     * @expectedException EscapeWork\Resize\ResizeException
     */
    public function testInstantiateShoudThrowAnResizeException()
    {
        $resize = new Resize(null, array());
    }

    public function testSetWidthAndHeightByConstructorShouldWork()
    {
        $resize = new Resize( static::$dir . 'test-image.jpg', 200, 200 );

        $this->assertEquals( 200, $resize->getWidth() );
        $this->assertEquals( 200, $resize->getHeight() );
    }

    public function testSetWidthByConstructorShouldWork()
    {
        $resize = new Resize( static::$dir . 'test-image.jpg', 200 );

        $this->assertEquals( 200, $resize->getWidth() );
    }

    public function testSetWidthShouldWork()
    {
        $resize = new Resize( static::$dir . 'test-image.jpg' );
        $resize->setWidth(200);

        $this->assertEquals( 200, $resize->getWidth() );
    }

    public function testSetHeightShouldWork()
    {
        $resize = new Resize( static::$dir . 'test-image.jpg' );
        $resize->setHeight(200);

        $this->assertEquals( 200, $resize->getHeight() );
    }

    public function testCropImageShouldWork()
    {
        $newImg = static::$dir . 'test-image-crop.jpg';
        $upload = new Upload( static::$dir . 'test-image.jpg', $newImg );

        $this->assertTrue( is_file( $newImg ) );

        $resize = new Resize( $newImg );
        $resize->setWidth(320)->setHeight(200)->crop();

        $this->assertTrue( is_file( $newImg ) );

        $size = getimagesize( $newImg );

        $this->assertEquals( 320, $size[0] );
        $this->assertEquals( 200, $size[1] );

        unlink( $newImg );
        $this->assertFalse( is_file( $newImg ) );
    }

    public function testResizeImage()
    {
        $newImg = static::$dir . 'test-image-resize.jpg';
        $upload = new Upload( static::$dir . 'test-image.jpg', $newImg );

        $this->assertTrue( is_file( $newImg ) );

        $resize = new Resize( $newImg );
        $resize->setWidth(300)->setHeight(400)->resize();

        $this->assertTrue( is_file( $newImg ) );

        $size = getimagesize( $newImg );
        
        $this->assertEquals( 300, $size[0] );
        $this->assertEquals( 225, $size[1] );

        unlink( $newImg );
        $this->assertFalse( is_file( $newImg ) );
    }

    public function testResizeByStaticFunctionShouldWork()
    {
        $img      = 'test-image.jpg';
        $original = static::$dir . $img;
        $sizes    = array(
            'mini-' => array(
                'width'  => 80, 
                'height' => 80, 
                'crop'   => true
            ), 
            'thumb-' => array(
                'width'  => 150, 
                'height' => 100, 
                'crop'   => false
            ), 
            'vga-' => array(
                'width'  => 640, 
                'height' => 480, 
                'crop'   => false
            ), 
        );

        Resize::make( static::$dir, $img, $sizes );

        $this->assertTrue( file_exists( static::$dir . 'mini-' . $img ) );
        $this->assertTrue( file_exists( static::$dir . 'thumb-' . $img ) );
        $this->assertTrue( file_exists( static::$dir . 'vga-' . $img ) );
        
        unlink( static::$dir . 'mini-' . $img );
        unlink( static::$dir . 'thumb-' . $img );
        unlink( static::$dir . 'vga-' . $img );

        $this->assertFalse( file_exists( static::$dir . 'mini-' . $img ) );
        $this->assertFalse( file_exists( static::$dir . 'thumb-' . $img ) );
        $this->assertFalse( file_exists( static::$dir . 'vga-' . $img ) );
    }
}