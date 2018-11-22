<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2018/11/22
 * Time: 15:31
 */
class Project extends MY_Controller {
    public function __construct(){
        parent::__construct();
//        $this->load->model('Clients_model', 'model');
        //检查是否登录
//        $this->check_logins();
    }

    /**
     * 显示页面
     */
    public function index()
    {
//        $nav = $this->load->view('common/agent_nav',array(),TRUE);
        $this->load->view('project/list',array());
    }

    /**
     * 页面显示ajax信息
     * @param $time_start string 时间开始
     * @param $time_end string 时间结束
     * @param $agent_name string 代理商名称
     * @return $return json
     */
    public function get_all_ajax_data(){
        $param['time_start'] = $this->input->post('time_start').":00:00:00";
        $param['time_end'] = $this->input->post('time_end').":23:59:59";
        $param['agent_name'] = $this->input->post('agent_name');
        $page = $this->input->post('page');
        $start_id = (intval($page)-1)*PAGE_NUM;
        $return['data'] = $this->model->agent_select_list($param,'all',$start_id);
        $return['count'] = $this->model->agent_select_list($param,'count','all');
        echo json_encode($return);
    }
    /**
     *显示创建页面
     */
    public function  create(){
        $this->parser->parse('agent/create', array());
    }

    /**
     * 添加新代理商
     */
    public function add(){
        $param['name'] = $this->input->post('name');
        $param['time'] = 1;
        $param['quantity'] = $this->input->post('quantity');
        $param['num'] = $this->input->post('num');
        $param['create_time']=date("Y-m-d");
        //拼接serial的存储变量
        $param_serial['quantity'] = $param['quantity'];
        $param_serial['time'] = date("Y-m-d",strtotime("+".intval($param['time'])." month"));
        $param_serial['cid'] = $this->model->agent_add($param);

        for($i =0;$i<intval($param['num']);$i++){
            //生成uuid
            $param_serial['new_name'] =  $param['name'].guid();
            //生成序列号
            $param_serial['serial'] = _build_serial("BJ", $param_serial['new_name']);
            //生成许可证数据
            $param_serial['data'] = build_license($param_serial);
            //信息存库
            $return = $this->se_model->serial_add($param_serial);
            //生成许可证
            $file_name = "license".$i.".dat";
            save_license($file_name,$param_serial['data'],$param_serial['cid']);
        }
        //本次许可证打包成zip 并删除临时文件
        $this->pack_zip($param_serial['cid']);
        redirect($_SERVER['HTTP_REFERER']);
    }

}