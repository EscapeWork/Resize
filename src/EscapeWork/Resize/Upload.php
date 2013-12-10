<?php namespace EscapeWork\Resize;

class Upload
{

    public function __construct( $original, $newFile )
    {
        if (! is_file($original)) {
            throw new UploadException("File not found -> " . $original);
        }

        $this->copy($original, $newFile);
    }

    private function copy($original, $newFile)
    {
        if (is_file($newFile)) {
            return;
        }

        if (! copy($original, $newFile)) {
            throw new UploadException("Error copying file -> " . $original);
        }
    }
}