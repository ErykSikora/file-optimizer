<?php

function smarty_function_optimizer($params, &$smarty){

    //config
    $optimizer = [];
    empty($params['type']) ?            $optimizer['type'] = 'image' :              $optimizer['type'] = $params['type'];
    empty($params['file']) ?            $validation = false :                       $optimizer['file'] = $params['file'];
    empty($params['assign']) ?          $optimizer['assign'] = false :              $optimizer['assign'] = $params['assign'];
    empty($params['width']) ?           $optimizer['width'] = 360 :                 $optimizer['width'] = (int) $params['width'];
    empty($params['height']) ?          $optimizer['height'] = 480 :                $optimizer['height'] = (int) $params['height'];
    empty($params['quality']) ?         $optimizer['quality'] = 90 :                $optimizer['quality'] = (int) $params['quality'];

    empty($params['prefix']) ?          $optimizer['prefix'] = null :               $optimizer['prefix'] = $params['prefix'];
    empty($params['affix']) ?           $optimizer['affix'] = null :                $optimizer['affix'] = $params['affix'];

    // set dir
    empty($params['dir']) ?             $optimizer['dir'] = 'uploads/optimizer' :   $optimizer['dir'] = $params['dir'];
    if (!file_exists( $optimizer['dir'] )) mkdir($optimizer['dir'] , 0777, true); // creating a folder where the file will be saved (if directory doesn't exists)

    // const
    $allowed_extensions = ['jpg', 'jpeg', 'png'];
    
    // functions
    function getFileFormat($file, $allowed){
        $pretend_format = end(explode('.',$file));
        if (in_array($pretend_format, $allowed)) {
            return $pretend_format;
        } else {
            return false;
        }
    }

    try {

        if (!file_exists($optimizer['file'])) throw new Exception('File not found', 100); #FIXME: 

        # file correcting if starts with '/'
        if (strpos($optimizer['file'], '/') == 0) $optimizer['file'] = substr($optimizer['file'], 1);

        # getting file format
        $ext = getFileFormat($optimizer['file'], $allowed_extensions);
        if (!$ext) throw new Exception('Invalid file extension', 101);

        #TODO: File mechanics

    } catch (Exception $e) {

        echo 'OPTIMIZER PLUGIN ERROR ['.$e->getMessage().'::'.$e->getCode().']';

    }

}
