<?php

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract {

	protected $_name = 'category';

	function addCategory($data) {

		$row       = $this->createRow();
		$row->name = $data[name];
		return $row->save();
	}

	function getCategories() {
		return $this->fetchAll()->toArray();
	}
}
