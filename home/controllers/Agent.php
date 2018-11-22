<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends MY_Controller {


    /**
     *  首页
     */
    public function index()
    {
        $this->load->view('Agent/index',['csrf'=> csrf()]);
    }

    public function list()
    {
        csrfVerify();
        echo 'list';
    }



}
