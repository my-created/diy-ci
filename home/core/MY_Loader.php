<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Loader Class
 *
 * Loads framework components.
 *
 * @subpackage	Libraries
 * @category	Loader
 * @author		panbing
 */
class MY_Loader extends CI_Loader {


	public function __construct()
    {
         $this->_ci_ob_level  = ob_get_level();
         $this->_ci_library_paths = array(APPPATH, BASEPATH, LIBPATH);
         $this->_ci_helper_paths = array(APPPATH, BASEPATH, HELPTPATH);

         //$this->_ci_model_paths = array(APPPATH);     //model的默认路径

         $this->_ci_model_paths = array(FCPATH, MODELTPATH);        //修改 _ci_model_paths 为公共的/目标路径即可！

         $this->_ci_model_paths = array(APPPATH, FCPATH);    //指定可以从 APPPATH 和 FCPATH 这两个目录下获取我们的模型文件！

		 log_message('debug', "Loader Class Initialized");
    }
}
