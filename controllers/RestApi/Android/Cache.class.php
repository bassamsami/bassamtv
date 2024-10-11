<?php

class Cache {

    protected $path;

    protected $file;

    protected $data;

    protected $key;

    protected $type;

    protected $error;

    public function __construct($k = '', $t = 'gdrive') {
        if (!empty($k)) {
            $this->key = $k;
        }
        $this->type = $t;
        $this->path = 'application/cache/gdata/cache/';
    }

    public function save($data) {

        if (!$this->hasError()) {
            if (is_array($data)) {
                $data = json_encode($data);
            }

            @file_put_contents($this->getFile() , serialize($data));
            return true;
        }

        return false;
    }
    
    protected function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function get($id = '') {
        if (!empty($id)) {
            $this->key = $id;
        }

        if ($this->isExist()) {
            $cachetime = 3600 * 4;
            if (time() - $cachetime < filemtime($this->getFile())){
                $data = @file_get_contents($this->getFile());
                if (!empty($data)) {
                    $data = @unserialize($data);
    
                    if (!empty($data)) {
                        if ($this->isJson($data)) {
                            $data = json_decode($data, true);
                        }
                        return $data;
                    }
                }
            }
        }
        return '';
    }

    public function cr() {
        $this->error = '';
        return $this;
    }

    public function delete($id = '') {
        if (!empty($id)) {
            $this->key = $id;
        }
        if ($this->isExist()) {
            unlink($this->getFile());
        }
        return true;
    }

    protected function getFile() {
        $this->k();
        return $this->path . $this->file;
    }

    public function setKey($k) {
        $this->key = $k;
    }

    protected function hasError() {
        if (!empty($this->error)) {
            return true;
        }
        return false;
    }

    protected function isExist() {
        return file_exists($this->getFile()) && !is_dir($this->getFile());
    }

    public function getError() {
        return $this->error;
    }
    
    protected function e($str) {
        $key = openssl_digest("_SEC_LOCK", 'SHA256', TRUE);
        $iv = substr($this->key, 0, openssl_cipher_iv_length("AES-128-CBC"));
        $enc = openssl_encrypt($str, "AES-128-CBC", $key, 0, $iv);
        return base64_encode($enc);
    }

    protected function k() {
        if (!empty($this->key) && empty($this->file)) {
            $this->file = $this->type . '~' . $this->e($this->key) . '.txt';
        }
    }

    public function clearAll() {
        $files = glob($this->path);
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        return true;
    }

    protected function check() {
        if (!file_exists($this->path)) {
            if ($this->makeDir()) {
                $this->error = 'Cache folder does not exist !';
            }
        }
    }

    function makeDir() {
        $ret = @mkdir($this->path, 0777);
        return $ret === true || is_dir($this->path);
    }

    public function __destruct() {
        $this->key = NULL;
        $this->data = NULL;
    }

}

