<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Loader Class
 *
 * Loads framework components.
 * @subpackage	Libraries
 * @category	Loader
 * @author		EllisLab Dev Team
 */
class MY_Security extends CI_Security {

	public function __construct()
    {
        parent::__construct();
    }

    /**
     * getCsrfHash 获取自定义csrf hash
     *
     * @return void
     */
    public function getCsrfHash()
    {
        // 如果 csrf_off = true 那就不生成，其他都生成
        if (!config_item('csrf_off'))
        {
            // CSRF config
            foreach (array('csrf_expire', 'csrf_token_name', 'csrf_cookie_name') as $key)
            {
                if (NULL !== ($val = config_item($key)))
                {
                    $this->{'_'.$key} = $val;
                }
            }

            // Append application specific cookie prefix
            if ($cookie_prefix = config_item('cookie_prefix'))
            {
                $this->_csrf_cookie_name = $cookie_prefix.$this->_csrf_cookie_name;
            }

            // Set the CSRF hash
            $this->_csrf_set_hash();
        }

        $this->charset = strtoupper(config_item('charset'));

        log_message('info', 'MY_Security Class Initialized');
    }
}
