<?php

class Application_Model_DbTable_Forum extends Zend_Db_Table_Abstract
{
    protected $_name = 'forum';
    public function getForums()
    {
      $forums = $this->select()->from('forum')->join(array('c' => 'category'), 'forum.cat_id = c.cat_id', array('c.cat_name'))->order('cat_name')->setIntegrityCheck(false);

      return $this->fetchAll($forums);
    }
}
