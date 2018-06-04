<?php

namespace Training\SimpleGreeter\Block;

use Magento\Framework\View\Element\Template;

/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * @category   Zend
 * @package    Zend_Training
 * @subpackage SimpleGreeter
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Info extends Template
{
    private $dir;
    private $localeResolver;
    
    public function __construct(
        Template\Context $context,
        \Magento\Framework\Locale\Resolver $resolver,
        \Magento\Framework\Filesystem\DirectoryList $dir,
        array $data = []
    ) {
        $this->dir = $dir;
        $this->localeResolver = $resolver;
        parent::__construct($context, $data);
    }
    
    public function getDatetime()
    {
        return date('d/m/Y h:i:s a');
    }
    
    public function getStoreCode()
    {
        return $this->_storeManager->getStore()->getCode();
    }
    
    public function getLocale()
    {
        return $this->localeResolver->getLocale();
    }
    
    public function getBaseDirectory()
    {
        return $this->dir->getRoot();
    }
}