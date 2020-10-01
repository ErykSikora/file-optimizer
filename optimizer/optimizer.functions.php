<?php

function getFileFormat($file, $allowed){
    $pretend_format = end(explode('.',$file));
    if (in_array($pretend_format, $allowed)) {
        return $pretend_format;
    } else {
        return false;
    }
}

function createImage($src, $newFile, $dir, $file, $width, $height, $quality) {
    
    $image = @imagecreatefromjpeg($src);
    
    # check if $file contains two elements (name and extension)
    if (count($file) == 2 && $image) {

        $image_width = imagesx($image);
        $image_height = imagesy($image);
        $size = image_crop_type($width, $height, $image_width, $image_height);
        $thumb = imagecreatetruecolor($size['width'], $size['height']);

        # resize and crop
        imagecopyresampled($thumb, $image, 0 - $size['offset_width'] / 2, 0 - $size['offset_height'] / 2, 0, 0, $size['scale_width'], $size['scale_height'], $image_width, $image_height);
        imagejpeg($thumb, $newFile, $quality);
        return $newFile;

    } else {
        return false;
    }

}
