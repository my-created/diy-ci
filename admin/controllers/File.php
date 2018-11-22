<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 文件管理控制器，图片，文件，等资源
 * 资源控制，应当放后台，前台通过此接口访问资源
 */
class File extends MY_Controller {


    /**
     *  创建文件（上传）
     */
    public function create()
    {
        $this->logger->info('Home/index', ['username' => 'panbing']);
        $data = ['name' => 'admin'];
        // $this->load->view('Home/index', $data);
        echo '创建文件，此处应该返回 json 消息';
    }

    /**
     *  修改文件
     */
    public function update()
    {
        $this->logger->info('Home/index', ['username' => 'panbing']);
        $data = ['name' => 'admin'];
        // $this->load->view('Home/index', $data);
        echo '修改文件，此处应该返回 json 消息';
    }

    /**
     *  查看文件（下载）
     */
    public function read()
    {
        $this->logger->info('Home/index', ['username' => 'panbing']);
        $data = ['name' => 'admin'];
        // $this->load->view('Home/index', $data);
        echo '查看文件，此处直接返回文件，get，post，提价数据都应该支持，如果可能 json 提交也要支持';
    }

    /**
     *  删除文件
     */
    public function delete()
    {
        $this->logger->info('Home/index', ['username' => 'panbing']);
        $data = ['name' => 'admin'];
        // $this->load->view('Home/index', $data);
        echo '删除文件，此处应该返回 json 消息';

    }

}
