<?php


class Stream {
    
    protected $buffer = 256 * 1024;
    
    protected $url;
    
    protected $headers = [];
    
    protected $statusCode;
    
    protected $key = NULL;
    
    protected $isHit = false;
    
    protected $cookizFile;
    
    protected $meta;
    
    protected $debug;
    
    protected $q;
    
    protected $id;
    
    protected $host;
    
    protected $cache;
    
    protected $link;
    
    protected $error;
    
    protected $db;
    


    protected $config;
    protected $hs = false;
    protected $t = '_st2';
    protected $ios = false;


    public function __construct() {
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $this->start = $time;
        $this->debug = true;
        $this->statusCode = 403;
        $this->setT();
    }

    protected function _driveST() {
        $isOk = false;
        $i = 0;
        $this->initCache();
        $this->setKey();
        $sources = $this->cache->get();
        if (empty($sources)) {
            $this->cache->cr();
            if ($this->loadFromDB()) {
                if (!in_array($this->q, Helper::getDisabledQualities())) {
                    $sourcesData = $this->link->obj['data'];
                    $alt = $this->link->obj['is_alt'];
                    if (empty($sourcesData)) {
                        $this->link->refresh($alt);
                        if (!$this->link->isBroken()) {
                            if (!empty($this->link->obj['data'])) {
                                $sourcesData = json_decode($this->link->obj['data'], true);
                                if (isset($sourcesData['sources'])) {
                                    $sources = $sourcesData['sources'];
                                }
                            } else {
                                $this->startFromDL();
                            }
                        }
                    } else {
                        $sourcesData = json_decode($sourcesData, true);
                        if (isset($sourcesData['sources'])) {
                            $this->cache->save($sourcesData['sources']);
                            $sources = $sourcesData['sources'];
                        } else {
                            //something went wrong
                            $this->error = 'something went wrong !';
                        }
                    }
                } else {
                    $this->error = 'Current qulity format does not exist !';
                }
            } else {
                //link is does not exist
                $this->error = 'link is does not exist';
            }
        }
        if (!empty($sources)) {
       
            $file = array_key_exists($this->q, $sources) ? $sources[$this->q] : reset($sources);
            $this->url = $file['file'];
            $size = $file['size'];
            while ($i < 3) {
                $this->load();
                if (!$this->isOk()) {
                    if (!$this->loadFromDB()) {
                        break;
                    }

                    $alt = $this->link->obj['is_alt'];
                    $this->link->refresh($alt);
                    if (!$this->link->hasError()) {
                        if (!empty($this->link->obj['data'])) {
                            $sourcesData = json_decode($this->link->obj['data'], true);
                            if (isset($sourcesData['sources'])) {
                                $sources = $sourcesData['sources'];
                            }
                            $file = array_key_exists($this->q, $sources) ? $sources[$this->q] : reset($sources);
                            $this->url = $file['file'];
                            $size = $file['size'];
                            $isOk = true;
                            break;
                        } else {
                            $this->startFromDL();
                        }
                    }
                } else {
                    $isOk = true;
                    break;
                }
                $i++;
            }
        }
        if ($isOk) {
            if (!$this->isIOS()) $this->cros();
            if ($this->isT1()) {
                if (empty($size)) {
                    $vInfo = Helper::getVInfo($this->url, $this->id);
                    if (!empty($vInfo['fsize'])) {
                        $sources[$this->q]['size'] = $size = $vInfo['fsize'];
                        $this->cache->save($sources);
                    }
                }
                $this->setMeta(['fsize' => $size]);
            }
            $this->start();
            exit;
        } else {
            //broken
            if ($this->debug) {
                if (!empty($this->error)) {
                    die($this->error);
                } else if (!empty($this->link->getError())) {
                    die($this->link->getError());
                } else {
                    die('Unknown Error !');
                }
            } else {
                $this->startDefault();
            }
        }
    }

    protected function startDefault() {
        if (!$this->isDBInit()) {
            $this->initDB();
        }
        if (!empty($this->config['default_video'])) {
            $this->start($this->config['default_video']);
        } else {
            $this->_404();
        }
    }

    protected function getDL() {
        if (!empty($this->link->obj['main_link'])) {
            $gid = Helper::getDriveId($this->link->obj['main_link']);
            if (!empty($gid)) {
             
            }
        }
        return '';
    }

    protected function startFromDL() {
        $this->start($this->getDL());
    }

    protected function loadFromDB() {
        if (!$this->isDBInit()) {
            $this->initDB();
        }
        if (!$this->isLinkInit()) {
            $this->initLink();
        }
        if ($this->isExist()) {
            return true;
        }
        return false;
    }
    protected function initLink() {
        $link = new Link();
        if ($link->load($this->id, 'slug')) {
            $t = $link->obj['type'];
            if ($t == 'GDrive' || $t == 'Direct' || (!empty($link->obj['data']) && $link->obj['is_alt'])) {
                $this->link = $link;
            }
        }
    }
    
    protected function isExist() {
        if (isset($this->link) && !empty($this->link)) {
            return true;
        }
        return false;
    }
    protected function isLinkInit() {
        if (isset($this->link) && !empty($this->link)) {
            return true;
        }
        return false;
    }
    protected function initCache() {
        $this->cache = new Cache($this->id);
    }
    protected function initDB() {
        global $config;
        $db = new Database($config);
        FH::setConfig(Database::getConfig());
        $this->config = Database::getConfig();
        $this->db = $db;
    }
    protected function isDBInit() {
        if (isset($this->db) && !empty($this->db)) {
            return true;
        }
        return false;
    }
    
    protected function _404() {
        header('HTTP/1.1 404 Not Found');
        die('<h1>404 page not found !</h1>');
    }
    
    public function load($url = '') {
        if (!empty($url)) {
            $this->url = $url;
        }
        if (!empty($this->url)) {
            $this->checkDrive();
        }
    }
    
    public function isOk() {
        if (!empty($this->statusCode) && $this->statusCode != 403) return true;
        return false;
    }
    
    protected function checkDrive() {
        usleep(rand(900000, 1500000));
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookizFile);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36');
        curl_exec($ch);
        $this->statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }
    
    protected function sendHeader($header) {
        if ($this->debug) {
            var_dump($header);
        } else {
            header($header);
        }
    }
    
    public function setKey($k = '') {
        // $this->key = Helper::e($k);
        if (empty($k)) $k = $this->id;
        $this->key = $k;
        $this->cookizFile = 'application/cache/gdata/cookies/gdrive~' . $this->key . '.txt';
    }
    
    public function setMeta($d) {
        $this->meta = $d;
    }
    
    public function headerCallback($ch, $data) {
        if (preg_match('/HTTP\/[\d.]+\s*(\d+)/', $data, $matches)) {
            $status_code = $matches[1];
            if ($status_code == 200 || $status_code == 206 || $status_code == 403 || $status_code == 404) {
                $this->hs = true;
                $this->sendHeader(rtrim($data));
            }
        } else {
            $forward = array('content-type', 'content-length', 'accept-ranges', 'content-range');
            $parts = explode(':', $data, 2);
            if ($this->hs && count($parts) == 2 && in_array(trim(strtolower($parts[0])), $forward)) {
                $this->sendHeader(rtrim($data));
            }
        }
        return strlen($data);
    }
    
    public function bodyCallback($ch, $data) {
        if (true) {
            echo $data;
            flush();
        }
        return strlen($data);
    }
    
    public function start($url = '') {
        if (empty($url)) {
            $headers = [];
            header('Accept-Ranges: bytes');
            header('Developed-by: CodySeller');
            $headers[] = 'Connection: keep-alive';
            $headers[] = 'Cache-Control: no-cache';
            $headers[] = 'Pragma: no-cache';
            $range = isset($_SERVER['HTTP_RANGE']) ? $_SERVER['HTTP_RANGE'] : '';
            if ($this->isT1()) {
                $file = ['filesize' => $this->meta['fsize'], 'fileType' => 'video/mp4'];
                if ($file) {
                    $size = $file['filesize'];
                    header('Content-Type: ' . $file['fileType']);
                } else {
                    http_response_code(404);
                    return;
                }
                if (!empty($range)) {
                    list($start, $end) = explode('-', str_replace('bytes=', '', $range), 2);
                    $length = intval($size) - intval($start);
                    header('HTTP/1.1 206 Partial Content');
                    header(sprintf('Content-Range: bytes %d-%d/%d', $start, ($size - 1), $size));
                    header('Content-Length: ' . $length);
                    $headers[] = sprintf('Range: bytes=%d-', $start);
                    if ($start > 185731998) {
                        $time = microtime();
                        $time = explode(' ', $time);
                        $time = $time[1] + $time[0];
                        $finish = $time;
                        $total_time = round(($finish - $this->start), 4);
                        file_put_contents('application/cache/gdata/t.txt', 'Page generated in ' . $range . ' seconds.');
                    }
                } else {
                    header('Content-Length: ' . $size);
                }
            } else {
                if (!empty($range)) $headers[] = 'Range: ' . $range;
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
            curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookizFile);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_BUFFERSIZE, $this->buffer);
            curl_setopt($ch, CURLOPT_TIMEOUT, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36');
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_NOBODY, false);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            if (!$this->isT1()) {
                curl_setopt($ch, CURLOPT_HEADERFUNCTION, [$this, 'headerCallback']);
            }
            session_write_close();
            curl_exec($ch);
            curl_close($ch);
            return true;
        } else {
            header('Location: ' . $url);
            exit;
        }
    }
    
    public function isT1() {
        return $this->t == '_st1';
    }
    protected function firewall() {
        if (FIREWALL || !DIRECT_STREAM) {
            $domains = ALLOWED_DOMAINS;
            if (!is_array($domains)) $domains = [];
            $domains[] = Helper::getHost();
            if (!isset($_SERVER["HTTP_REFERER"])) {
                $this->_404();
                exit;
            }
            $referer = parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST);
            if (empty($referer) || !in_array($referer, $domains)) {
                $this->_404();
                exit;
            }
        }
    }
    
    public function cros() {
        if ($this->isT1()) {
            $this->t = '_st2';
        } else {
            $this->t = '_st1';
        }
    }
    protected function setT() {
        $os = $this->getOS();
        if (!(strpos($os, 'Windows') !== false || strpos($os, 'Android') !== false)) {
            $this->ios = true;
        }
        
    }
    protected function isIOS() {
        return $this->ios;
    }
    public function __destruct() {
    }
    
    function getOS() {

        $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);

        $os_platform = "Unknown OS Platform";

        $os_array = array(
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile'
        );

        

        foreach ($os_array as $regex => $value) if (preg_match($regex, $user_agent)) $os_platform = $value;

        return $os_platform;
    }
}
