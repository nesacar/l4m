<?php

/**
 * Key value pair of presets with the name and dimensions to be used
 *
 * 'PRESET_NAME' => array(
 *   'width'  => INT, // in pixels
 *   'height' => INT, // in pixels
 *   'method' => STRING, // 'crop' or 'resize'
 *   'background_color' => '#000000', //  (optional) Used with resize
 * )
 *
 * eg   'presets' => array(
 *        '800x600' => array(
 *          'width' => 800,
 *          'height' => 600,
 *          'method' => 'resize',
 *          'background_color' => '#000000',
 *        )
 *      ),
 *
 */
return array(

    '63x84' => array(
        'width' => 63,
        'height' => 84,
        'method' => 'crop',
    ),
//    '120x90' => array(
//        'width' => 120,
//        'height' => 90,
//        'method' => 'crop',
//    ),
    'test' => array(
        'width' => 90,
        'height' => 120,
        'method' => 'crop',
    ),
    '215x287' => array(
        'width' => 215,
        'height' => 287,
        'method' => 'crop',
    ),
);
