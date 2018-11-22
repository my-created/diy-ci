<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 表单验证示例类
 */
class Formyz extends MY_Controller {


    public function show()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        // echo 123;
        // $this->logger->info('Home/form', ['username' => 'panbing']);
        // $data = ['name' => 'panbing'];
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $data = ['csrf' => $csrf];
        // $this->tplblade->view('Formyz/show', $data);
        // return $this->tplblade->view('Formyz/show', $data);
        $name = ['name'=>'panbing'];
        $this->load->vars($name);
        $this->load->view('home/Formyz/show', $data);
    }

    public function create()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        // 验证
        if ($this->form_validation->run() == FALSE){
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $data = ['csrf' => $csrf];
            $name = ['name'=>'panbing'];
            $this->load->vars($name);
            $this->load->view('home/Formyz/show', $data);
        }else{
            $this->load->view('home/Formyz/success');
        }
    }

}
