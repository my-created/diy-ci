<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {


    /**
     *  首页
     */
    public function index()
    {
//        echo base_url('Project/index');
        header('Location: '.base_url('Project/index'));
    }

}
