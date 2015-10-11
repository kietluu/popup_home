<?php
/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 09/10/2015
 * Time: 09:23
 */
class Popup_Static_Model_Resource_Block_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract{
	public function _construct()
	{
		$this->_init('popup_static/block');
	}
}