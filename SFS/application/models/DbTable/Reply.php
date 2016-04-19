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
        $select = $this->select()->from('reply')->join(array('u' => 'users'),'reply.u_id = u.id',array('u.username'))->where("comments.id=".$id)->setIntegrityCheck(false);
        return $this->fetchAll($select);
    }
    function addComment($data) {
        $user = Zend_Auth::getInstance();
        $userObj = $user->getIdentity();
    	$cmnt = $this->createRow();
    	$cmnt->body = $data['body'];
    	$cmnt->p_id = $data['p_id'];
    	$cmnt->u_id = $userObj->id;
    	$id = $cmnt->save();
        return $this->getCommentDetail($id);
    }
	function deleteComment($id) {
    	return $this->delete("id=$id");
    }
}
