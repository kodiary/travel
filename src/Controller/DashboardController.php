<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;


class DashboardController extends AppController
{

    
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('admin');
        if(!$this->request->session()->read('id'))
        $this->redirect('/admin/login');
    } 
    public function index()
    {
        
    }
    public function pages()
    {
        $this->loadModel('Admin');
            
            $q = $this->Admin->find()->where($arr)->first();
            if($q)
            $this->request->session()->write('id',$q->id);
            $this->redirect('/admin');
    }
    
}
