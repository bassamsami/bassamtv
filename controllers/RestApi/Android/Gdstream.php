<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gdstream extends CI_Controller {
    function __construct()
	{
		parent::__construct();
		include('Stream.class.php');
	}
    
    function getVInfo($url, $key) {
        $headers = [];

        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Pragma: no-cache';

        session_write_close();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'application/cache/gdata/cookies/gdrive~' . $key . '.txt');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_BUFFERSIZE, 8192);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_exec($ch);
        $fsize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        $ftype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        curl_close($ch);

        return ['fsize' => $fsize, 'ftype' => $ftype];
    }
    
    public function stream($key, $url) {
        $decoded_key = base64_decode(urldecode($key));
        $decoded_url = base64_decode(urldecode($url));

        $stream = new Stream();
        $stream->setKey($decoded_key);
        $stream->load($decoded_url);
        
        if($stream->isOk())
        {
            $stream->cros();
            
            if($stream->isT1())
            {
                if(empty($size))
                {
                    $vInfo = $this->getVInfo($decoded_url, $decoded_key);
                    
                    if(!empty($vInfo['fsize']))
                    {
                        $size = $vInfo['fsize'];
                    }
                }
                
                $stream->setMeta(['fsize'=>$size]);
            }
        
          $stream->start();
            exit;
        }
    }


}

