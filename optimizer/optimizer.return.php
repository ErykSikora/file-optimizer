<?php

function returnImage(&$smarty, $assign, $file, $tag, $title, $alt) {

    if (!$tag) {
        !empty($title) ? $title = ' title="'.$title.'"' : $title = '';
        !empty($alt) ? $alt = ' alt="'.$alt.'"' : $alt = '';
        $file = '<img src="'.$file.'"'.$title.$alt.'>';
    }

    if (!empty($assign)) {
        $smarty->assign($assign, $file); return;
    } else {
        return $file;
    }

}
