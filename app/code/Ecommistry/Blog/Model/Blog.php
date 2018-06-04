<?php

namespace Ecommistry\Blog\Model;

use Ecommistry\Blog\Model\Api\Data\BlogInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * @category   Zend
 * @package    Zend_Ecommistry
 * @subpackage Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Blog extends AbstractModel implements IdentityInterface, BlogInterface
{
    const CACHE_TAG = 'ecommistry_blog';
    
    protected function _construct()
    {
        $this->_init('Ecommistry\Blog\Model\ResourceModel\Blog');
    }
    
    public function getTitle()
    {
        // TODO: Implement getTitle() method.
    }
    
    public function setTitle()
    {
        // TODO: Implement setTitle() method.
    }
    
    public function getContent()
    {
        // TODO: Implement getContent() method.
    }
    
    public function setContent()
    {
        // TODO: Implement setContent() method.
    }
    
    public function getCreationTime()
    {
        // TODO: Implement getCreationTime() method.
    }
    
    public function setCreationTime()
    {
        // TODO: Implement setCreationTime() method.
    }
    
    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}