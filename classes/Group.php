<?php
class Group{
    private $_db,
            $_data;

    public function __construct($Group = null){
        $this->_db = DB::getInstance();
    }

    public function createGroup($fields = array()) {
        if(!$this->_db->insert('GroupDetails', $fields)){
            throw new Exception('There was a problem creating an group.');
        }
    }

    public function addUser($fields = array()){
        if(!$this->_db->insert('group_users', $fields)){
            throw new Exception('There was a problem creating an group.');
        }
    }

    public function getGroups($id){
        return $this->_db->getMe('GroupDetails', array('AdminID', '=', $id));

    }

    public function data(){
        return $this->_data;
    }

    public function getgID($fields = array()) {
        return $this->_db->getLastIndex('SELECT', $fields);
    }
}