<?php

namespace Training\ExtAttribute\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Training\ExtAttribute\Api\CountryRepositoryInterface;
use Training\ExtAttribute\Api\Data\CountryInterfaceFactory;

/**
 * Class InstallData
 *
 * Long description for Class (if any)...
 *
 * @category   Training
 * @package    Training_ExtAttribute
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var \Training\ExtAttribute\Api\Data\CountryInterfaceFactory
     */
    private $countryInterfaceFactory;
    /**
     * @var \Training\ExtAttribute\Api\CountryRepositoryInterface
     */
    private $countryRepository;
    
    public function __construct(
        CountryInterfaceFactory $countryInterfaceFactory,
        CountryRepositoryInterface $countryRepository
    ) {
        $this->countryInterfaceFactory = $countryInterfaceFactory;
        $this->countryRepository = $countryRepository;
    }
    
    /**
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface   $context
     *
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        $countries = [
            [
                'category_id'  => '11',
                'country_name' => 'New Zealand'
            ],
            [
                'category_id'  => '4',
                'country_name' => 'Australia'
            ],
            [
                'category_id'  => '21',
                'country_name' => 'Japan'
            ]
        ];
        foreach ($countries as $country) {
            $model = $this->countryInterfaceFactory->create();
            $model->setData($country);
            $this->countryRepository->save($model);
        }
        unset($model);
        $setup->endSetup();
    }
}
