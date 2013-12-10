<?php
namespace EscapeWork\Resize;

use EscapeWork\Resize\Upload;

class UploadTest extends \PHPUnit_Framework_TestCase
{

    public static $dir = 'tests/EscapeWork/Resize/img/';

    public function assettPreConditions()
    {
        $this->assertTrue(class_exists('EscapeWork\Resize\Upload'));
    }

    /**
     * @expectedException EscapeWork\Resize\UploadException
     */
    public function test_instantiate_shoud_throw_an_upload_exception()
    {
        $upload = new Upload(null, null);
    }

    public function test_copy_with_valid_parameters()
    {
        $img = static::$dir . 'test-image.jpg';

        $upload = new Upload($img, static::$dir . 'new-image.jpg');
    }

    public function test_copy_with_existing_new_file()
    {
        $img = static::$dir . 'test-image.jpg';

        $upload = new Upload($img, $img);
    }

    public static function tearDownAfterClass()
    {
        unlink( static::$dir . 'new-image.jpg' );
    }
}