<?php

class Application_Model_DbTable_Reply extends Zend_Db_Table_Abstract
{
    protected $_name = 'reply';
    public function getRepliesByThread($threadId)
    {
        $select = $this->select()->from('reply')->join(array('u' => 'users'), 'reply.replier_id = u.u_id', array('u.username'))->where('reply.thread_id='.$threadId)->setIntegrityCheck(false);

        return $this->fetchAll($select);
    }
}
