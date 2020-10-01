<?php

if(!function_exists('image_crop_type')) {
    function image_crop_type($thumb_width, $thumb_height, $image_width, $image_height) {

        $response = [];
        $response['image'] = $image_width.'x'.$image_height;
        $response['thumb'] = $thumb_width.'x'.$thumb_height;

        if ( $thumb_width == 'auto' || $thumb_height == 'auto' ) {
            $response['auto'] = true;
            if ( $thumb_width == 'auto' ) {
                $scale_ratio = $image_height / $thumb_height;
                $thumb_width = $image_width / $scale_ratio;
            } else {
                $scale_ratio = $image_width / $thumb_width;
                $thumb_height = $image_height / $scale_ratio;
            }


            $response['scale_width'] = $thumb_width;
            $response['scale_height'] = $thumb_height;

            $response['offset_width'] = 0;
            $response['offset_height'] = 0;
        } else {
            $response['auto'] = false;

            $original_aspect = $image_width / $image_height;
            $thumb_aspect = $thumb_width / $thumb_height;

            if ( $original_aspect >= $thumb_aspect )
            {
                // If image is wider than thumbnail (in aspect ratio sense)
                $new_height = $thumb_height;
                $new_width = $image_width / ($image_height / $thumb_height);
            } else {
                // If the thumbnail is wider than the image
                $new_width = $thumb_width;
                $new_height = $image_height / ($image_width / $thumb_width);
            }

            $response['scale_width'] = $new_width;
            $response['scale_height'] = $new_height;

            $response['offset_width'] = $new_width - $thumb_width;
            $response['offset_height'] = $new_height - $thumb_height;
        }

        $response['width'] = $thumb_width;
        $response['height'] = $thumb_height;

        return $response;
    }
}