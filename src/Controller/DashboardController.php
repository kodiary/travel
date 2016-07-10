<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;

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
        $this->redirect('/dashboard/pages');
    }

    public function pages()
    {
        $this->loadModel('Pages');
        $this->loadModel('PageCategory');
        $this->set('cat',$this->PageCategory);    
            $q = $this->Pages->find()->order('cat_id')->all();
            if($q)
            $this->set('model', $q);
            
    }
    public function editPage($id)
    {
        $this->loadModel('Pages');
        $this->loadModel('PageCategory');
        $this->set('cat',$this->PageCategory);
        if($id)   { 
        $q = $this->Pages->find()->where(['id'=>$id])->first();
            if($q)
            $this->set('model', $q);
            }
            
    }
    
    public function savePage($id)
    {
        $ptable = TableRegistry::get('Pages');
        if(!$id)
        $page = $ptable->newEntity();
        else
        {
            $page = $ptable->get($id);
        }
        foreach($_POST as $k=>$p)
        {
            $page->$k = $p;
        }
        //$page = $_POST;
        //$page->body = 'This is the body of the article';
        
        if ($ptable->save($page)) {
            $this->Flash->success("Page saved successfully");
           $this->redirect('/dashboard/pages');
        }
        else
        {
            $this->Flash->error("There was problem saving page");
           $this->redirect('/dashboard/editPage/'.$id);
        }
        
            
    }
    
    public function deletePage($id)
    {
        $this->loadModel('Pages');
        $entity = $this->Pages->get($id);
        $result = $this->Pages->delete($entity);
        $this->Flash->success("Page deleted successfully");
        $this->redirect('/dashboard/pages');
    }

    public function settings()
    {
      if(isset($_POST['submit']))  
      {
        $user = TableRegistry::get('Admin');
        $id = $this->request->session()->read('id');
        $query = $user->find()->where(['id' => $id])->first();
        if($_POST['old_password']==$query->password)
        {   
            if(isset($_POST['password'])&& $_POST['password']=='' ){
                $this->Flash->error(' Password cannot be blank');
            }
            else{
                $query = $user->query();
                $query->update()
                ->set(['password' => $_POST['password']])
                ->where(['id' => $id])
                ->execute();
            $this->Flash->success('Password Change successfull.');
            }
                
        }
        else
        {
            $this->Flash->error('Old Password didnot Match.');
        }
        
      }
    }
     public function changeemail(){
        $user = TableRegistry::get('Admin');
        $id = $this->request->session()->read('id');
        $query = $user->find()->where(['id' => $id])->first();
        $this->set('email', $query->email);
        if(isset($_POST['email'])){
          if(isset($_POST['email']) && $_POST['email']=='' ){
            $this->Flash->error('email cannot be blank');
        }
        else{
            $query = $user->query();
                $query->update()
                ->set(['email' => $_POST['email']])
                ->where(['id' => $id])
                ->execute();
                $this->Flash->success('email Change successfull.');
        }  
        }
        
        
        
     }

}
