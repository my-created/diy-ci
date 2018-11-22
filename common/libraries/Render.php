<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 配置
 */
class Render
{
      /**
       * @var $CI  ci 超类，用于使用已经挂载的类，挂载其他类。
       */
      private $CI = null;
      /**
       * @var $data  绑定的数据
       */
      private $data = [];

      /**
       * 为了适应CI做的构造函数
       */
      public function __construct()
      {
            // 绑定日志类到 ci 超类
            $this->CI = &get_instance();
            $this->CI->render = $this;
      }

      /**
       * bind 绑定数据
       * 如果第一个参数是string，那第一个参数为key
       * 如果是array 直接绑定
       *
       * @param  array|string $data 数据，也可以是key
       * @param  array|string $val  数据
       *
       * @return void
       */
      public function bind($data = [], $val = '')
      {
            if (is_array($data)  ) {
                  $this->data = array_merge($this->data, $data);
            }elseif (is_string($data) && isset($val)) {
                  $this->data = array_merge($this->data, [$data => $val]);
            }
      }

      /**
       * 渲染到HTML页面
       *
       * @param  mixed $tpl 模板名称
       * @param  mixed $data 渲染数据
       *
       * @return void
       */
      public function html($tpl, $data)
      {
            header("Content-type: text/html; charset=utf-8");
            $CI->load->view($tpl, $this->data);
      }

      public function json($data)
      {
            header('Content-type: charset=utf-8;application/json;');
            echo json_encode($this->data);
      }

      public function ajax($data)
      {
            $CI->load->view($tpl, $data);
      }

      public function auto($tpl, $data)
      {
            $CI->load->view($tpl, $data);
      }




}
