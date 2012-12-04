<?php 
/**
 * Classe pra fazer upload 
 *
 * @author  Luís Dalmolin <luis.nh@gmail.com>
 * @package EscapeWork\Resize
 */ 
 
namespace EscapeWork\Resize;

class Upload
{

    public function __construct( $original, $newFile )
    {
        if( !is_file( $original ) )
        {
            throw new Exception("File not found -> " . $original);
        }

        $this->copy( $original, $newFile );
    }

    public function copy( $original, $newFile )
    {
        if( !copy( $original, $newFile ) )
        {
            throw new Exception("Error copying file -> " . $original);
        }
    }
}