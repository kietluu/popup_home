<?php
/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 09/10/2015
 * Time: 09:22
 */
class Popup_Static_Model_Resource_Block extends Mage_Core_Model_Resource_Db_Abstract{
	protected function _construct()
	{
		$this->_init('popup_static/block', 'id');
	}
}