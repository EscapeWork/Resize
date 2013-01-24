<?php 
namespace EscapeWork\Resize;

use EscapeWork\Resize\SizeAjustCrop;

class SizeAjustCropTest extends \PHPUnit_Framework_TestCase
{

    public function assettPreConditions()
    {
        $this->assertTrue( class_exists('EscapeWork\Resize\SizeAjustCrop') );
    }

    public function testWidthHigherThenHeight()
    {
        $sizeAjust = new SizeAjustCrop();
        $sizeAjust->setWidth(320)
                  ->setHeight(200)
                  ->setOriginalWidth(1024)
                  ->setOriginalHeight(768);

        $sizes = $sizeAjust->ajust();

        $this->assertEquals(320, $sizes['width'], 'Width should be 320');
        $this->assertEquals(240, $sizes['height'], 'Height should be 240');
    }

    public function testHeightHigherThenWidth()
    {
        $sizeAjust = new SizeAjustCrop();
        $sizeAjust->setWidth(200)
                  ->setHeight(320)
                  ->setOriginalWidth(1024)
                  ->setOriginalHeight(768);

        $sizes = $sizeAjust->ajust();

        $this->assertEquals(427, $sizes['width'], 'Width should be 320');
        $this->assertEquals(320, $sizes['height'], 'Height should be 240');
    }

    public function testHeightEqualsWidth()
    {
        $sizeAjust = new SizeAjustCrop();
        $sizeAjust->setWidth(320)
                  ->setHeight(320)
                  ->setOriginalWidth(1024)
                  ->setOriginalHeight(768);

        $sizes = $sizeAjust->ajust();

        $this->assertEquals(427, $sizes['width'], 'Width should be 320');
        $this->assertEquals(320, $sizes['height'], 'Height should be 240');
    }
}