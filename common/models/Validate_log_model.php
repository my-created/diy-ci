<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2018/11/21
 * Time: 18:14
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Validate_log_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /*
     * 批量插入内容
     */
    public function insert_multi($data, $table)
    {
        return $this->db->insert_batch($table, $data);
    }

    /*
     * 插入一条内容
     */
    public function insert_into($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    /*
     * 获取最后一次插入的id
     */
    public function insert_lastid()
    {
        return $this->db->insert_id();
    }
}