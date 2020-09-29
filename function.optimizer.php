<?php

function smarty_function_optimizer($params, &$smarty){

    //config
    $optimizer = [];
    empty($params['type']) ?        $optimizer['type'] = 'image' :          $optimizer['type'] = $params['type'];
    empty($params['file']) ?        $optimizer['file'] = false :            $optimizer['file'] = $params['file'];
    empty($params['assign']) ?      $optimizer['assign'] = false :          $optimizer['assign'] = $params['assign'];
    empty($params['width']) ?       $optimizer['width'] = 360 :             $optimizer['width'] = $params['width'];
    empty($params['height']) ?      $optimizer['width'] = 480 :             $optimizer['height'] = $params['height'];
    empty($params['quality']) ?     $optimizer['quality'] = 90 :            $optimizer['quality'] = $params['quality'];

    //validation

    #file exist


}
