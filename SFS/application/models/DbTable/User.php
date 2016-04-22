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

    function listUser(){
        return $this->fetchAll()->toArray();
    }

    function editUser($data,$id){
        $newData = array('username'=>$data['username'],'email'=>$data['email'],'password'=>$data['password'],'gender'=>$data['gender'],'country'=>$data['country'],'picture'=>$data['picture']);
        return $this->update($newData,"u_id=".$id);
    }

    function getUserById($id){
        return $this->find($id)->toArray();
    }

    function deleteUser($id){
         $this->delete('u_id='.$id);
    }

    function banUser($id,$isActive){
        if($isActive == 1){
            $isActive =array('is_active'=>0);
            return $this->update($isActive,"u_id=".$id);
        }else{
            $isActive =array('is_active'=>1);
            return $this->update($isActive,"u_id=".$id);

        }
    }

    function adminUser($id,$isAdmin){
        if($isAdmin == 1){
            $isAdmin =array('is_admin'=>0);
            return $this->update($isAdmin,"u_id=".$id);
        }else{
            $isAdmin =array('is_admin'=>1);
            return $this->update($isAdmin,"u_id=".$id);

        }
    }

    function searchUser($username){
        $select = $this->select()->from("users")->where("username like ".$username."%");
        $stmt = $this->query($select);
        return $stmt->fetchAll()->toArray();

    }

    function verify($username){
        $active = array('is_active'=>1);
        return $this->update($active,"username=".$username);
    }
}
