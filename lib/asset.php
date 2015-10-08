<?php

/**
 * The Asset class aims to manage all the assest storaged by an administrator
 * @author andrew@itma.pl
 **/
class Asset {

    /**
    * Returns the list of the assets in the public directory
    * @param $dir string
    * @return array or false if not found
    **/
    public function getList($dir) {
        $public = __DIR__ . '/../public/' . $dir;
        $files = array();
        foreach (new DirectoryIterator($public) as $file) {
            if($file->isDot() || $file->isDir() || $file->getFilename() == 'index.php' || $file->getFilename() == 'readme.txt') continue;
             $files[] = array(
                'path' => $file->getPathname(),
                'filename' => $file->getFilename(),
                'mtime' => date('Y/m/d H:i:s', $file->getMTime()),
                'ext' => $file->getExtension(),
                'readable' => $file->isReadable(),
            );
        }
        return $files;
    }

    /**
    * Return the list of directories in the public directory
    * @return array or false if not found
    **/
    public function getDirList() {
        $public = __DIR__ . '/../public';
        $files = array();
        foreach (new DirectoryIterator($public) as $file) {
            if($file->isDir() && !$file->isDot()) {
                $counter = 0;
                foreach (new DirectoryIterator($public . '/' . $file->getFilename()) as $sub) {
                    if($sub->isDot() || $sub->isDir()) continue;
                        $counter++;
                }
                $files[] = array(
                    'dirname' => $file->getFilename(),
                    'files' => $counter,
                );
            }
        }
        return $files;
    }
}

?>