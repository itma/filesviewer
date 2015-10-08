<?php

/**
 * The Asset helper class
 * @author andrew@itma.pl
 **/
class AssetHelper {

    /**
    * Return the icon
    * @param $ext string
    * @return array or false if not found
    **/
    public static function getIconByFiletype($ext) {

        $icons = array(
            'doc'   => 'fa fa-file-word-o',
            'odt'   => 'fa fa-file-word-o',
            'xls'   => 'fa fa-file-excel-o',
            'csv'   => 'fa fa-file-excel-o',
            'pdf'   => 'fa fa-file-pdf-o',
            'mp3'   => 'fa fa-file-sound-o',
            'wav'   => 'fa fa-file-sound-o',
            'mp4'   => 'fa fa-file-video-o',
            'txt'   => 'fa fa-file-text-o',
            'zip'   => 'fa fa-file-zip-o',
            'rar'   => 'fa fa-file-zip-o',
            'jpg'   => 'fa fa-file-photo-o',
            'gif'   => 'fa fa-file-photo-o',
            'png'   => 'fa fa-file-photo-o',
            'jpeg'  => 'fa fa-file-photo-o'
        );

        return isset($icons[$ext]) ? $icons[$ext] : 'fa file';
    }

}

?>