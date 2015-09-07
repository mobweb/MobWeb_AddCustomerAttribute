<?php

$installer = $this;
$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

$entityTypeId     = $setup->getEntityTypeId('customer');
$attributeSetId   = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$setup->addAttribute('customer', 'custom_attribute_code', array(
	'type' => 'int',
	'input' => 'select',
	'frontend_input' => 'select',
	'source' => 'eav/entity_attribute_source_boolean',
	'label' => 'Custom Attribute Title',
	'global' => 1,
	'visible' => 1,
	'required' => 0,
	'user_defined' => 1,
	'default' => '0',
	'visible_on_front' => 0,
));

$setup->addAttributeToGroup(
	$entityTypeId,
	$attributeSetId,
	$attributeGroupId,
	'custom_attribute_code',
	'100'
);

$oAttribute = Mage::getSingleton('eav/config')->getAttribute('customer', 'custom_attribute_code');
$oAttribute->setData('used_in_forms', array('adminhtml_customer')); 
$oAttribute->save();

$setup->endSetup();