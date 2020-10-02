<?php

function smarty_function_optimizer($params, &$smarty){

    # --- Config
    
    $optimizer = [];
    empty($params['type']) ?            $optimizer['type'] = 'image' :              $optimizer['type'] = $params['type'];
    empty($params['src']) ?             $validation = false :                       $optimizer['src'] = $params['src'];
    empty($params['assign']) ?          $optimizer['assign'] = false :              $optimizer['assign'] = $params['assign'];
    empty($params['width']) ?           $optimizer['width'] = 'auto' :              $optimizer['width'] = (int) $params['width'];
    empty($params['height']) ?          $optimizer['height'] = 'auto' :             $optimizer['height'] = (int) $params['height'];
    empty($params['quality']) ?         $optimizer['quality'] = 75 :                $optimizer['quality'] = (int) $params['quality'];

    empty($params['prefix']) ?          $optimizer['prefix'] = null :               $optimizer['prefix'] = $params['prefix'];
    empty($params['affix']) ?           $optimizer['affix'] = null :                $optimizer['affix'] = $params['affix'];

    empty($params['notag']) ?           $optimizer['notag'] = false :                $optimizer['notag'] = $params['notag'];

    function returnImage($file, $tag) {
        if ($tag) {
            echo 'ma zwrocic sam link';
            #TODO: returns only link
        } else {
            #TODO: returns full <img> tag
            echo '<img src="'.$file.'">';
        }
    }

    #TODO: add: title, alt, notag

    // consts
    $allowed_extensions = ['jpg', 'jpeg', 'png'];

    # --- Boot

    // dir controller
    empty($params['dir']) ?             $optimizer['dir'] = 'uploads/optimizer' :   $optimizer['dir'] = $params['dir'];
    if (!file_exists($optimizer['dir'])) mkdir($optimizer['dir'] , 0777, true); // creating a folder where the file will be saved (if directory doesn't exists)

    // file controller
    $optimizer['file'] = end(explode('/', $optimizer['src'])); // get file name (with ext)
    $file = explode(".",$optimizer['file']); // split the file into name and extension
    $newFile = $optimizer['dir'].'/'.$file[0].'-'.$optimizer['width'].'x'.$optimizer['height'].'-'.$optimizer['quality'].'.'.$file[1]; // create a NEW FILE name

    // if file with the same name exists - plugin returns variable with link to smarty
    if (file_exists($newFile)) { $smarty->assign($optimizer['assign'], $newFile); return returnImage($newFile, $optimizer['notag']); }
    
    # --- Basic functions
    // functions contained in this file should be built into PHP
    // uncomment if your PHP doesn't support these functions
    require_once __DIR__.'/optimizer/optimizer.basic.php';

    # --- Functions

    require_once __DIR__.'/optimizer/optimizer.functions.php';

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
        
        return returnImage($newFile, $optimizer['notag']);

        #TODO: File mechanics


    } catch (Exception $e) {

        echo 'OPTIMIZER PLUGIN ERROR ['.$e->getCode().']: '.$e->getMessage();

    }

}
