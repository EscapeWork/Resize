<?php 
namespace EscapeWork\Resize;

use EscapeWork\Resize\Upload;

class UploadTest extends \PHPUnit_Framework_TestCase
{
    public static $dir = 'tests/EscapeWork/Resize/img/';

    public function assettPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Resize\Upload') );
    }

    /**
     * @expectedException EscapeWork\Resize\UploadException
     */
    public function testInstantiateShoudThrowAnUploadException()
    {
        $upload = new Upload(null, null);
    }

    public function testCopyWithValidParameters()
    {
        $img = static::$dir . 'test-image.jpg';

        $upload = new Upload( $img, static::$dir . 'new-image.jpg' );
    }

    public static function tearDownAfterClass()
    {
        unlink( static::$dir . 'new-image.jpg' );
    }
}