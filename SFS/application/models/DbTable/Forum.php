<?php

class Application_Model_DbTable_Forum extends Zend_Db_Table_Abstract
{
    protected $_name = 'forum';

    public function getForums()
    {
      $forums = $this->select()->from('forum')->join(array('c' => 'category'), 'forum.cat_id = c.cat_id', array('c.name'))->setIntegrityCheck(false);
      return $this->fetchAll($forums);
    }

    function addForums($data)
    {
      $row = $this->createRow();
      $row->name = $data['name'];
      $row->cat_id = $data['cat_id'];
      $row->is_locked = $data['is_locked'];
      return $row->save();
    }

    function listForums(){
      $forum = $this->select()->from('forum')->join(array('c' => 'category'), 'forum.cat_id = c.cat_id', array('c.name'))->setIntegrityCheck(false);
      return $this->fetchAll($forum);
    }

    function getSpecForum(){
    		return $this->fetchAll()->toArray();
    }

    function deleteForum($id){
      return $this->delete('id='.$id);
    }

    function getForumById($id) {
  		//this is to return the data in array by id
   		return $this->find($id)->toArray();
   	}

    function editForums($id, $data){
  		$newForum = array(
  			'name' => $data['name'],
        'cat_id' => $data['cat_id'],
        'is_locked' => $data['is_locked'],
  		);
  		return $this->update($newForum, "id=".$id);
  	}

}
