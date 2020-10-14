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

    $count = count($file);

    switch($file[1]) {
        case 'png':
            $image = @imagecreatefrompng($src);
            break;
        case 'jpg':
        case 'jpeg':
            $image = @imagecreatefromjpeg($src);
            break;

    }

    # check if $file contains two elements (name and extension)
    if ($count >= 2 && $image) {

        $image_width = imagesx($image);
        $image_height = imagesy($image);
        $size = image_crop_type($width, $height, $image_width, $image_height);
        $thumb = imagecreatetruecolor($size['width'], $size['height']);

        if ($file[$count-1] == 'png') imagefill($thumb, 0, 0, imagecolorallocate($thumb, 255, 255, 255));

        # resize and crop
        imagecopyresampled($thumb, $image, 0 - $size['offset_width'] / 2, 0 - $size['offset_height'] / 2, 0, 0, $size['scale_width'], $size['scale_height'], $image_width, $image_height);
        imagejpeg($thumb, $newFile, $quality);
        imagedestroy($image);
        imagedestroy($thumb);
        return $newFile;

    } else {
        return false;
    }

}
