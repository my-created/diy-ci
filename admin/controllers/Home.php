<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {


    /**
     *  首页
     */
    public function index()
    {
        header('Location: '.base_url('project/index'));
    }

}
