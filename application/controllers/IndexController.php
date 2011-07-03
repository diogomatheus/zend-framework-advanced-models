<?php

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {
        // model
        $diogo = new User();
        $diogo->setName('Diogo Matheus')
              ->setEmail('dm.matheus@gmail.com');

        // mapper
        $userMapper = new Mapper_User();
        try{
            // insert user
            $userMapper->saveOrUpdate($diogo);
        }
        catch(Exception $e){
            $this->view->assign('message', $e->getMessage());
        }

        // get all users
        $this->view->assign('users', $userMapper->fetchAll());
    }

}

