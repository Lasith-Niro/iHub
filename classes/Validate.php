<?php
class Validate {
    private $_passed = false,
            $_errors = array(),
            $_db = null;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = array()){
        foreach($items as $item => $rules ){
            foreach($rules as $rule => $rule_value){

                $value = trim($source[$item]);
                $item = escape($item);

                if($rule === 'required' && empty($value)){
                   $this->addError("{$item} is required <br> ");
                } else if(!empty($value)) {
                    switch($rule){
                        case 'regexEmail':
                            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                                $this->addError("{$item} must be valid email address.");
                            }
                            break;
                        case 'name':
                            if(!empty($value)){
                                $this->addError("You forgot your user name.");
                            }
                            break;
                        case 'regexPassword':
                            if(!preg_match("#[0-9]+#", $value)){
                                $this->addError("{$item} must be valid email address.");
                            } elseif(!preg_match("#[A-Z]+#", $value)){
                                $this->addError("{$item} must be valid email address.");
                            } elseif(!preg_match("#[a-z]+#", $value)){
                                $this->addError("{$item} must be valid email address.");
                            }  elseif(!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $value)){
                                $this->addError("{$item} must be valid email address.");
                            }
                            break;
                        case 'regexString':
                            if(!preg_match("/^[a-zA-Z]*$/", $value)){
                                $this->addError("{$item} must be valid {$item}.");
                            }
                            break;
                        case 'regexPhone':
                            if(!preg_match("#[0-9]+#", $value)){
                                $this->addError("{$item} must be valid phone number.");
                            }
                            break;
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                            }
                            break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("{$item} must be a maximum of {$rule_value} characters.");
                            }
                            break;
                        case 'matches':
                            if($value != $source[$rule_value]){
                                $this->addError("{$rule_value} must match {$item}");
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->get($rule_value,array($item, '=', $value));
                            if($check->count()){
                                $this->addError("{$item} already exist ");
                            }
                            break;
                    }
                }
            }
        }
        if(empty($this->_errors)){
            $this->_passed = true;
        }
        return $this;
    }
    private function addError($error){
        $this->_errors[] = $error;
    }
    public function errors(){
        return $this->_errors;
    }
    public function passed(){
        return $this->_passed;
    }
}
?>