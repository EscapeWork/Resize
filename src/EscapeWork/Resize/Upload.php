<?php 
namespace EscapeWork\Resize;

class Upload
{

    public function __construct( $original, $newFile )
    {
        if( !is_file( $original ) )
        {
            throw new UploadException("File not found -> " . $original);
        }

        $this->copy( $original, $newFile );
    }

    private function copy( $original, $newFile )
    {
        if( !copy( $original, $newFile ) )
        {
            throw new Exception("Error copying file -> " . $original);
        }
    }
}