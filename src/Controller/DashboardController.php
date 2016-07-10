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
    
    /* function related to page manager*/
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
    /* functions related to page manager ends */
    
    /* functions related to package category manager */
    public function packCat()
    {
        
        $this->loadModel('PackageCategory');
           
            $q = $this->PackageCategory->find()->all();
            if($q)
            $this->set('model', $q);
            
    }
    public function editpackCat($id)
    {
        $this->loadModel('PackageCategory');
        if($id)   { 
        $q = $this->PackageCategory->find()->where(['id'=>$id])->first();
            if($q)
            $this->set('model', $q);
            }
            
    }
    
    public function savepackCat($id)
    {
        $ptable = TableRegistry::get('PackageCategory');
        if(!$id)
        $pc = $ptable->newEntity();
        else
        {
            $pc = $ptable->get($id);
        }
        foreach($_POST as $k=>$p)
        {
            $pc->$k = $p;
        }
        //$page = $_POST;
        //$page->body = 'This is the body of the article';
        
        if ($ptable->save($pc)) {
            $this->Flash->success("Package Category saved successfully");
           $this->redirect('/dashboard/packCat');
        }
        else
        {
            $this->Flash->error("There was problem saving Package Category");
           $this->redirect('/dashboard/editpackCat/'.$id);
        }
        
            
    }
    
    public function deletepackCat($id)
    {
        $this->loadModel('PackageCategory');
        $entity = $this->PackageCategory->get($id);
        $result = $this->PackageCategory->delete($entity);
        $this->Flash->success("Package Category deleted successfully");
        $this->redirect('/dashboard/packCat');
    }
    /* functions related to package manager ends*/
    
    /* function related to page manager*/
    public function packages()
    { 
        $this->loadModel('Packages');
        $this->loadModel('PackageCategory');
        $this->set('cat',$this->PackageCategory);    
            $q = $this->Packages->find()->order('cat_id')->all();
            if($q)
            $this->set('model', $q);
            
    }
    public function editPackage($id)
    {
        $this->loadModel('Packages');
        $this->loadModel('PackageCategory');
        $this->set('cat',$this->PackageCategory);
        if($id)   { 
        $q = $this->Packages->find()->where(['id'=>$id])->first();
            if($q)
            $this->set('model', $q);
            }
            
    }
    
    public function savePackage($id)
    {
        $ptable = TableRegistry::get('Packages');
        if(!$id)
        $package = $ptable->newEntity();
        else
        {
            $package = $ptable->get($id);
        }
        foreach($_POST as $k=>$p)
        {
            $package->$k = $p;
        }
        //$page = $_POST;
        //$page->body = 'This is the body of the article';
        
        if ($ptable->save($package)) {
            $this->Flash->success("Package saved successfully");
           $this->redirect('/dashboard/packages');
        }
        else
        {
            $this->Flash->error("There was problem saving Package");
           $this->redirect('/dashboard/editPackage/'.$id);
        }
        
            
    }
    
    public function fileUpload()
    {
        $this->loadComponent('SimpleImage');
        if(isset($_FILES['myfile']['name']))
        {
            $name = $_FILES['myfile']['name'];
            if($name)
            {
                $arr_name = explode('.',$name);
                $ext = end($arr_name);
                $name = 'img'.rand(1,1000).'_'.date('Y_m_d_H_i_s').'.'.$ext;
                move_uploaded_file($_FILES['myfile']['tmp_name'],APP.'../webroot/img/package/tmp/'.$name);
                $this->SimpleImage->loader(APP.'../webroot/img/package/tmp/'.$name);
                $status = $this->SimpleImage->fit_to_width(800)->save(APP.'../webroot/img/package/resized/'.$name);
                die($name);
            }
            else
            {
                echo "error";die();
            }
        }
    }
    
    public function deletePackage($id)
    {
        $this->loadModel('Packages');
        $entity = $this->Packages->get($id);
        $result = $this->Packages->delete($entity);
        $this->Flash->success("Package deleted successfully");
        $this->redirect('/dashboard/packages');
    }
    /* functions related to page manager ends */
    
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
