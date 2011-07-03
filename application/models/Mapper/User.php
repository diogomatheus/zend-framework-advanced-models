<?php
class Mapper_User
{
    private $_dbTable;

    public function saveOrUpdate(User $user)
    {
        // build array with user info
        $data = array(
            'user_id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail()
        );

        // id == null -> insert
        if (null === ($id = $user->getId())){
            unset($data['user_id']);

            // is unique name?
            if($this->isUniqueName($user->getName())){
                $this->getDbTable()->insert($data);
            }
            else {
                throw new Exception('This name is already being used.');
            }
        }
        // id != null -> update
        else {
            $this->getDbTable()->update($data, array('user_id = ?' => $id));
        }
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();

        // custom return
        $result = array();
        foreach($resultSet as $row){
            $user = new User();
            $user->setId($row->user_id)
                 ->setName($row->name)
                 ->setEmail($row->email);
            $result[] = $user;
        }
        
        return $result;
    }

    public function isUniqueName($name){
        $where = $this->getDbTable()
                      ->getDefaultAdapter()
                      ->quoteInto('name = ?', $name);
        
        return (count($this->getDbTable()->fetchAll($where)) == 0) ? true : false;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->_dbTable = new DbTable_User();
        }
        return $this->_dbTable;
    }
}