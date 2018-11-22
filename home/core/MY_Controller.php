<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 控制器基类，方便以后对控制器公共部分修改
 */
class MY_Controller extends CI_Controller {

    public function __construct()
    {
        date_default_timezone_set('PRC');// 所有转换时间的地方都需要默认时区，如果不设置，时间将会早8个小时。
        parent::__construct();
    }

}
