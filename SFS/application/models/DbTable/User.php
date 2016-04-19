<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'users';
	function addUser($data) {
    	$user = $this->createRow();
    	$user->username = $data['username'];
    	$user->email = $data['email'];
    	$user->password = md5($data['password']);
    	$user->gender = $data['gender'];
    	$user->country = $data['country'];
    	$user->picture = $data['picture'];
    	return $user->save();
    }	

}

