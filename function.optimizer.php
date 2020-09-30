<?php

function smarty_function_optimizer($params, &$smarty){

    //config
    $optimizer = [];
    empty($params['type']) ?            $optimizer['type'] = 'image' :              $optimizer['type'] = $params['type'];
    empty($params['src']) ?             $validation = false :                       $optimizer['src'] = $params['src'];
    empty($params['assign']) ?          $optimizer['assign'] = false :              $optimizer['assign'] = $params['assign'];
    empty($params['width']) ?           $optimizer['width'] = 'auto' :              $optimizer['width'] = (int) $params['width'];
    empty($params['height']) ?          $optimizer['height'] = 'auto' :             $optimizer['height'] = (int) $params['height'];
    empty($params['quality']) ?         $optimizer['quality'] = 75 :                $optimizer['quality'] = (int) $params['quality'];

    empty($params['prefix']) ?          $optimizer['prefix'] = null :               $optimizer['prefix'] = $params['prefix'];
    empty($params['affix']) ?           $optimizer['affix'] = null :                $optimizer['affix'] = $params['affix'];

    #TODO: add: title, alt, notag

    // set dir
    empty($params['dir']) ?             $optimizer['dir'] = 'uploads/optimizer' :   $optimizer['dir'] = $params['dir'];
    if (!file_exists($optimizer['dir'])) mkdir($optimizer['dir'] , 0777, true); // creating a folder where the file will be saved (if directory doesn't exists)

    // file controller
    $optimizer['file'] = end(explode('/', $optimizer['src'])); // get file name (with ext)
    $file = explode(".",$optimizer['file']); // split the file into name and extension
    $newFile = $optimizer['dir'].'/'.$file[0].'-'.$optimizer['width'].'-'.$optimizer['height'].'-'.$optimizer['quality'].'.'.$file[1]; // create a NEW FILE name

    // if file with the same name exists - plugin returns variable with link to smarty
    if (file_exists($newFile)) { $smarty->assign($optimizer['assign'], $newFile); return; }

    // const
    $allowed_extensions = ['jpg', 'jpeg', 'png'];
    
    # --- Functions
    
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

    # --- Mechanics

    try {

        if (!file_exists($optimizer['src'])) throw new Exception('File not found', 100); #FIXME: 
        #TODO: If overwrited file exits return this link

        # file correcting if starts with '/'
        if (strpos($optimizer['src'], '/') == 0) $optimizer['src'] = substr($optimizer['src'], 1);

        # getting file format
        $ext = getFileFormat($optimizer['src'], $allowed_extensions);
        if (!$ext) throw new Exception('Invalid file extension', 101);

        # saving a compressed file
        $created = createImage($optimizer['src'], $newFile, $optimizer['dir'], $file, $optimizer['width'], $optimizer['height'], $optimizer['quality']);
        if (!$created) throw new Exception('There is an error with the file extension', 102);
        
        #TODO: File mechanics


    } catch (Exception $e) {

        echo 'OPTIMIZER PLUGIN ERROR ['.$e->getCode().']: '.$e->getMessage();

    }

}
