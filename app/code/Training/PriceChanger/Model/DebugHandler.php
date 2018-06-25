<?php

namespace Training\PriceChanger\Model;

use Monolog\Logger;
use Magento\Framework\Logger\Handler\Base;

/**
 * Class DebugHandler
 *
 * Long description for Class (if any)...
 *
 * @category   Training
 * @package    Training_PriceChanger
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class DebugHandler extends Base
{
    /** @var string */
    protected $fileName = '/var/log/custom_debug.log';
    /** @var int */
    protected $loggerType = Logger::DEBUG;
}
