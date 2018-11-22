<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once ROOTPATH.'/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Formatter\JsonFormatter;

/**
 * 配置
 */
class Monolog
{
      /**
       * @var $CI  ci 超类，用于使用已经挂载的类，挂载其他类。
       */
      private $CI = null;

      /**
       * 为了适应CI做的构造函数
       */
      public function __construct()
      {
            // 实例化一个日志实例, 参数是 channel name
            $logger = new Logger('panbing');

            // StreamHandler_1
            $streamHander1 = new StreamHandler(APPPATH.'/logs/testLog1.log', Logger::INFO);
            // 设置日志格式为json
            $streamHander1->setFormatter(new JsonFormatter());
            // 入栈, 往 handler stack 里压入 StreamHandler 的实例
            $logger->pushHandler($streamHander1);

            // StreamHandler_2
            // 如果第三个参数为false, 则只会执行这个一个Handler. 默认是true
            $streamHander2 = new StreamHandler(APPPATH.'/logs/testLog2.log', Logger::INFO);
            // 入栈, 往 handler stack 里压入 StreamHandler 的实例
            $logger->pushHandler($streamHander2);

            /**
             * processor 日志加工程序，用来给日志添加额外信息.
             *
             * 这里调用了内置的 UidProcessor 类和 ProcessIdProcessor 类.
             * 在生成的日志文件中, 会在最后面显示这些额外信息.
             */
            $logger->pushProcessor(new UidProcessor());
            $logger->pushProcessor(new ProcessIdProcessor());
            $logger->pushProcessor(function ($record) {
            $record['message'] = 'Hello ' . $record['message'];
            return $record;
            });

            /**
             * 设置记录到日志的信息.
             *
             * 开始遍历 handler stack.
             * 先入后出, 后压入的最先执行. 所以先执行 FirePHPHandler, 再执行 StreamHandler
             * 如果设置了 ErrorLogHandler 的 $bubble = false, 会停止冒泡, StreamHandler 不会执行.
             * 第二个参数为数组格式, 通过使用使用上下文(context)添加了额外的数据.
             * 简单的处理器（比如StreamHandler）将只是把数组转换成字符串。而复杂的处理器则可以利用上下文的优点（如 FirePHP 则将以一种优美的方式显示数组）.
             */
            $logger->info('Welcome to a.', ['username' => 'panbing']);

            // 绑定日志类到 ci 超类
            $this->CI = &get_instance();
            $this->CI->logger = $logger;
      }




}
