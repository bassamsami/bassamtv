<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class CacheModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    }

    function formatSize($size) {
        $units = explode(' ', 'B KB MB GB TB PB');
        $mod = 1024;
        for ($i = 0;$size > $mod;$i++) {
            $size /= $mod;
        }
        $endIndex = strpos($size, ".") + 3;
        return substr($size, 0, $endIndex) . ' ' . $units[$i];
    }

    function GetDirectorySize($path) {
        $bytestotal = 0;
        $path = realpath($path);
        if ($path !== false && $path != '' && file_exists($path)) {
            foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object) {
                $bytestotal += $object->getSize();
            }
        }
        return $bytestotal;
    }

    function clearDirectory($path) {
        if (!file_exists($path)) {
            return true;
        }
        if (!is_dir($path)) {
            return unlink($path);
        }
        foreach (scandir($path) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!$this->clearDirectory($path . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
        rmdir($path);
        return $this->formatSize($this->GetDirectorySize($path));
    }

    function getCache()
    {
        return $this->formatSize($this->GetDirectorySize('application/cache'));
    }

    function clear_cache() {
        $this->cache->clean();
        return $this->getCache();
    }

    function getCacheSize() {
        return $this->getCache();
    }
}