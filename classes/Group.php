<?php
class Group{
    private $_db,
            $_data;

    public function __construct($Group = null){
        $this->_db = DB::getInstance();
    }

    public function createGroup($fields = array()) {
        if(!$this->_db->insert('userGroups', $fields)){
            throw new Exception('There was a problem creating an group.');
        }
    }

    public function data(){
        return $this->_data;
    }

    public function getTransactionID(){
        return $this->_data->transactionID;
    }

    public function getLastTransactionID($fields = array()) {
        return $this->_db->getLastIndex('SELECT', $fields);
    }
}