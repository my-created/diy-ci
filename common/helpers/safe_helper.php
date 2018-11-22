<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('csrf'))
{
        /**
         * csrf 生成 csrf
         *
         * @return array csrf 数组
         */
        function csrf()
        {
            $CI = &get_instance();
            // 如果自动以关闭为 false 并且 csrf 开启也为 false，则自己生成hash
            if (!config_item('csrf_off') && !config_item('csrf_protection')) {
                $CI->security->getCsrfHash();
            }
            return [
                'name' => $CI->security->get_csrf_token_name(),
                'hash' => $CI->security->get_csrf_hash()
            ];
        }
}

if ( ! function_exists('csrfVerify'))
{
        /**
         * csrfVerify 验证csrf
         *
         * @return void
         */
        function csrfVerify()
        {
            $CI = &get_instance();
            // 如果自动以关闭为 false 并且 csrf 开启也为 false，则自己生成hash
            if (!config_item('csrf_off') && !config_item('csrf_protection')) {
                $CI->security->getCsrfHash();
            }
            return $CI->security->csrf_verify();
        }
}

