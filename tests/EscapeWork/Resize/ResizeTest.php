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

    public function testCropImage()
    {
        $newImg = static::$dir . 'test-image-crop.jpg';
        $upload = new Upload( static::$dir . 'test-image.jpg', $newImg );

        $this->assertTrue( is_file( $newImg ) );

        $resize = new Resize( $newImg );
        $resize->setWidth(200)->setHeight(200)->crop();

        $this->assertTrue( is_file( $newImg ) );

        $size = getimagesize( $newImg );

        $this->assertEquals( 200, $size[0] );
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
}