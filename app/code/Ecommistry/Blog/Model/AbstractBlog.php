<?php

namespace Ecommistry\Blog\Model;

use Ecommistry\Blog\Api\Data\BlogInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class BlogAbstract
 *
 * Long description for Class (if any)...
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
abstract class AbstractBlog extends AbstractModel implements
    IdentityInterface,
    BlogInterface
{
    
}
