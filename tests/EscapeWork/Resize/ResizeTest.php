<?php 
namespace EscapeWork\Resize;

use EscapeWork\Resize\Resize;

class ResizeTest extends \PHPUnit_Framework_TestCase
{

    public function assettPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Resize\Resize') );
    }

    /**
     * @expectedException EscapeWork\Resize\ResizeException
     */
    public function testInstantiate()
    {
        $resize = new Resize(null, array());
    }
}