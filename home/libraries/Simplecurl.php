<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 简单curl请求类
 * $sc = new SimpleCurl();
 * $sc->request();
 */
class SimpleCurl
{
      private $_url = '';
      private $_query_string = '';
      /**
       * _followlocation
       * TRUE 时将会根据服务器返回 HTTP 头中的 "Location: " 重定向。
       * （注意：这是递归的，"Location: " 发送几次就重定向几次，
       * 除非设置了 CURLOPT_MAXREDIRS，限制最大重定向次数。）。
       */
      private $_followlocation = true;
      private $_timeout = 30;
      private $_maxRedirects = 4;// 限制重定向最大次数
      private $_returnRaw = true;// 返回原生行数据

      private $auth = [];// 基本验证
      private $post = false;
      private $headers = [];
      private $data = '';// 请求数据，字符串形式。

      /**
       * 为了适应CI做的构造函数
       */
      public function __construct()
      {

      }

      /**
       * 初始化
       */
      public function init($url = '', $auth = [], $headers = [])
      {
            $this->_url = $url;
            $this->_auth = $auth;
            $this->headers = $headers;
            if ($headers) {
                  foreach ($headers as $key => $value) {
                        $this->headers[] = $key . ': ' . $value;
                  }
            }
      }

      /**
       * 设置特殊选项
       */
      public function setOption($followlocation = true, $timeOut = 30, $maxRedirecs = 4, $_returnRaw = true, $includeHeader = false, $noBody = false)
      {
            $this->_followlocation = $followlocation;
            $this->_timeout = $timeOut;
            $this->_maxRedirects = $maxRedirecs;
            $this->_includeHeader = $includeHeader;
            $this->_returnRaw = $_returnRaw;
      }

      /**
       *  对外执行的请求
       */
      public function request($_query_string = '', $method = 'GET', $data = '', $headers = [])
      {
            $this->_query_string = $_query_string;
            if ($method == 'POST') {
            $this->post = true;
            }
            if ($data) {
            $this->data = $data;
            }
            if ($headers) {
                foreach ($headers as $key => $value) {
                  $this->headers[] = $key . ': ' . $value;
                }
            }

            return $this->createCurl();
      }

      /**
       * 创建并执行请求
       */
      private function createCurl()
      {
            if ($this->auth) {
                  $this->headers[] = 'Authorization: Basic ' . base64_encode("{$auth[0]}:{$auth[1]}");
                  $this->headers[] = "{$auth[0]}:{$auth[1]}";
            }

            $c = curl_init();
            $options = [
            CURLOPT_URL => $this->_url . $this->_query_string,
            CURLOPT_HTTPHEADER => ['Expect:'],
            CURLOPT_TIMEOUT => $this->_timeout,
            CURLOPT_MAXREDIRS => $this->_maxRedirects,
            CURLOPT_RETURNTRANSFER => $this->_returnRaw,
            CURLOPT_FOLLOWLOCATION => $this->_followlocation,
            ];
            curl_setopt_array($c, $options);
            if ($this->headers) {
            curl_setopt($c, CURLOPT_HTTPHEADER, $this->headers);
            }
            if ($this->post) {
            curl_setopt($c, CURLOPT_POST, true);
            curl_setopt($c, CURLOPT_POSTFIELDS, $this->data);
            }
            $ret = curl_exec($c);
            $retCode = curl_getinfo($c, CURLINFO_HTTP_CODE);
            curl_close($c);

            return [
            'code' => $retCode,
            'body' => $ret,
            ];
      }
}
