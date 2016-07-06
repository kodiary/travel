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
    
}
