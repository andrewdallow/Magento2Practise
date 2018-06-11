<?php

namespace Mastering\SampleModule\Api\Data;

/**
 * Interface ItemInterface
 *
 * Long description for Class (if any)...
 *
 * @category   Mastering
 * @package    Mastering_SampleModule
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
interface ItemInterface
{
    /**
     * @return string
     */
    public function getName(): string;
    
    /**
     * @return string|null
     */
    public function getDescription(): ?string;
}
