<?php

namespace Mastering\SampleModule\Cron;

use Mastering\SampleModule\Model\Config;
use Mastering\SampleModule\Model\ItemFactory;


/**
 * Class AddItem
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
class AddItem
{
    /** @var \Mastering\SampleModule\Model\ItemFactory */
    private $itemFactory;
    /** @var \Mastering\SampleModule\Model\Config */
    private $config;
    
    public function __construct(ItemFactory $itemFactory, Config $config)
    {
        $this->itemFactory = $itemFactory;
        $this->config = $config;
    }
    
    public function execute()
    {
        if ($this->config->isEnabled()) {
            $this->itemFactory->create()
                ->setName('Scheduled item')
                ->setDescription('Created at ' . time())
                ->save();
        }
    }
}
