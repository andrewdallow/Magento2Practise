<?php

namespace Ecommistry\Blog\Model\Api\Data;

/**
 * Blog API Interface
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
interface BlogInterface
{
    public function getId();
    
    public function setId($value);
    
    public function getTitle();
    
    public function setTitle($title);
    
    public function getContent();
    
    public function setContent($content);
    
    public function getCreationTime();
    
    public function setCreationTime();
    
}
