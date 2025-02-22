<?php

namespace Denal05\Ad0e702ExerciseSeeEventObserverExecViaLog\Logger\Handler;

use Magento\Framework\Logger\Handler\Base as BaseHandler;
use Monolog\Logger as MonologLogger;

/**
 * Class ErrorHandler
 */
class ErrorHandler extends BaseHandler
{
    /**
     * Logging level
     *
     * @var int
     */
    protected $loggerType = MonologLogger::ERROR;

    /**
     * File name
     *
     * @var string
     */
    protected $fileName = '/var/log/Denal05_Ad0e702ExerciseSeeEventObserverExecViaLog/error.log';
}
