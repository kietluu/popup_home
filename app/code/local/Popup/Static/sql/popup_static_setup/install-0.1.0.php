<?php
/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 09/10/2015
 * Time: 09:10
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
	->newTable($installer->getTable('popup_static/block'))
	->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'identity'  => true,
		'unsigned'  => true,
		'nullable'  => false,
		'primary'   => true,
	), 'ID')
	->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
		'nullable'  => false,
	), 'Title')
	->addColumn('block_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'unsigned'  => true,
		'nullable'  => false,
	), 'Block ID')
	->addColumn('create_date', Varien_Db_Ddl_Table::TYPE_DATETIME, 0, array(
		'nullable'  => false,
	), 'Create Date')
	->addColumn('from_date', Varien_Db_Ddl_Table::TYPE_DATETIME, 0, array(
		'nullable'  => false,
	), 'Start Date')
	->addColumn('to_date', Varien_Db_Ddl_Table::TYPE_DATETIME, 0, array(
		'nullable'  => false,
	), 'End Date')
	->addColumn('expire_cookie', Varien_Db_Ddl_Table::TYPE_INTEGER, 0, array(
		'nullable'  => false,
	), 'Expire Cookie')
	->addColumn('time_hide', Varien_Db_Ddl_Table::TYPE_INTEGER, 0, array(
		'nullable'  => false,
	), 'Time hide popup');
$installer->getConnection()->createTable($table);



$installer->endSetup();