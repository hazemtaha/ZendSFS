<?php

class Application_Model_DbTable_Thread extends Zend_Db_Table_Abstract
{
    protected $_name = 'thread';
    public function listThreads()
    {
        $posts = $this->select()->from('thread')->join(array('u' => 'users'), 'thread.creator = u.u_id', array('u.username'))->order('creation_date')->setIntegrityCheck(false);

        return $this->fetchAll($posts);
    }
    public function getThreadsByForum($forumId)
    {
        $threads = $this->select()->from('thread')->join(array('u' => 'users'), 'thread.creator = u.u_id', array('u.username'))->joinLeft(array('r' => 'reply'), 'r.thread_id = thread.thread_id', array('count(r.id) as replies_no'))->group('thread.thread_id')->order('creation_date desc')->where("thread.forum_id=$forumId")->setIntegrityCheck(false);

        return $this->fetchAll($threads);
    }
    function getThreadById($threadId) {
        $threads = $this->select()->from('thread')->join(array('u' => 'users'),'thread.creator = u.u_id',array('u.username','u.signature','u.picture'))->where("thread.thread_id=".$threadId)->setIntegrityCheck(false);
        return $this->fetchAll($threads);
		// return $this->find($id)->toArray();
    }
    // public function getThreadDetails($threadId)
    // {
    //     $threads = $this->select()->from('thread')->join(array('u' => 'users'), 'thread.creator = u.u_id', array('u.username','u.signature'))->where('thread.thread_id='.$threadId)->setIntegrityCheck(false);
    //
    //     return $this->fetchAll($threads);
    // }
    function addThread($data) {
        $user = Zend_Auth::getInstance();
        $userObj = $user->getIdentity();
        $thread = $this->createRow();
        $thread->title = $data['title'];
        $thread->body = $data['body'];
        $thread->forum_id = $data['forum'];
        $thread->creator = $userObj->u_id;
        return $thread->save();
    }
    function deleteThread($threadId) {
        return $this->delete("thread_id=$threadId");
    }
    function editThread($data) {
        $newThread = array(
            'title'             => $data['title'],
            'body'              => $data['body'],
            'last_update_date'  => new Zend_Db_Expr('NOW()')
            );
        return $this->update($newThread,"thread_id=".$data['id']);
    }
    function toggleThreadPin($data) {
        $thread = array(
            'is_sticky' => $data['status']
            );
        return $this->update($thread,"thread_id=".$data['id']);  
    }
    function toggleThreadLock($data) {
        $thread = array(
            'is_locked' => $data['status']
            );
        return $this->update($thread,"thread_id=".$data['id']);  
    }
}
