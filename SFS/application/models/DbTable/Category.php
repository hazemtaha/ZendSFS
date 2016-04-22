<?php

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract {

  protected $_name = 'category';

	function addCategory($data) {

		$row = $this->createRow();
		$row->cat_name = $data['name'];
		return $row->save();
	}

	function getCategories() {
		return $this->fetchAll()->toArray();
  	}

	function deleteCategories($id){
		return $this->delete('cat_id='.$id);
   }

	function getCatsById($id) {
		//this is to return the data in array by id
 		return $this->find($id)->toArray();
 	}

	function editCategories($id, $data){
		$newCat = array(
			'cat_name' => $data['name'],
		);
		return $this->update($newCat, "cat_id=".$id);
	}

 }
