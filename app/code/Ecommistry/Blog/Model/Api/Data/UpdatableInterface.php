<?php

namespace Ecommistry\Blog\Model\Api\Data;

/**
 * Updatable Interface
 *
 * @category   Zend
 * @package    Zend_${Package}
 * @subpackage ${Subpackage}
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
interface UpdatableInterface
{
    public function getUpdatedTime();
    
    public function setUpdatedTime();
}
