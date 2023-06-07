<?php
class UploadedFile{
    public $path;
    public $mimeType;
    public $mimeSubtype;

    function __construct($path){
        $this->path = $path;

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $this->path);
        finfo_close($finfo);

        $mime_parts = explode('/', $mime);
        $this->mimeType = $mime_parts[0];
        $this->mimeSubtype = $mime_parts[1];
    }

    function isImage(){
        return $this->mimeType === 'image';
    }

    /**
     * the default value reduces the images' size about 4 times while not really affecting quality
     */
    function compressImageIfPossible($quality = 80){
        if(function_exists("imagecreatefrom$this->mimeSubtype")){
            $image = "imagecreatefrom$this->mimeSubtype"($this->path);

            switch($this->mimeSubtype){
                case "jpeg": case "webp": case "avif":
                "image$this->mimeSubtype"($image, $this->path, $quality);
                break;

                //Don't compress .png images because there's a bug in imagepng
                //we have this line because some of these functions (like imagebmp)
                //do compression by default
                case "bmp": case "gif": case "wbmp": case "xbm": case "png":
                "image$this->mimeSubtype"($image, $this->path);
                break;
            }
            imagedestroy($image);
        }
    }

}

?>
