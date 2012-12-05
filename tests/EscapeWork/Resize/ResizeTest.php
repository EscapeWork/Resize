<?php 
namespace EscapeWork\Resize;

use EscapeWork\Resize\Resize;

class ResizeTest extends \PHPUnit_Framework_TestCase
{

    public function assettPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Resize\Resize') );
    }
}