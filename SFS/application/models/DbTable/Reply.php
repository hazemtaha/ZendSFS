<?php

class Application_Model_DbTable_Reply extends Zend_Db_Table_Abstract
{
    protected $_name = 'reply';
    public function getRepliesByThread($threadId)
    {
        $select = $this->select()->from('reply')->join(array('u' => 'users'), 'reply.replier_id = u.u_id', array('u.username'))->where('reply.thread_id='.$threadId)->setIntegrityCheck(false);

        return $this->fetchAll($select);
    }
    function getReplyDetails($id) {
        $select = $this->select()->from('reply')->join(array('u' => 'users'),'reply.replier_id = u.u_id',array('u.username'))->where("reply.id=".$id)->setIntegrityCheck(false);
        return $this->fetchAll($select);
    }
    function addReply($data) {
        $user = Zend_Auth::getInstance();
        $userObj = $user->getIdentity();
    	$rply = $this->createRow();
    	$rply->body = $data['body'];
    	$rply->thread_id = $data['thread_id'];
    	$rply->replier_id = $userObj->u_id;
    	$id = $rply->save();
        return $this->getReplyDetails($id);
    }
	function deleteReply($id) {
    	return $this->delete("id=$id");
    }
}
