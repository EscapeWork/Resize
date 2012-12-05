<?php 
namespace EscapeWork\Resize;

use EscapeWork\Resize\Upload;

class UploadTest extends \PHPUnit_Framework_TestCase
{

    public function assettPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Resize\Upload') );
    }
}