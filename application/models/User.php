<?php
class User
{
    private $_id;
    private $_name;
    private $_email;

    public function getId(){
        return $this->_id;
    }

    public function setId($id){
        $this->_id = $id;
        return $this;
    }

    public function getName(){
        return $this->_name;
    }

    public function setName($name){
        $this->_name = $name;
        return $this;
    }

    public function getEmail(){
        return $this->_email;
    }

    public function setEmail($email){
        $this->_email = $email;
        return $this;
    }
}