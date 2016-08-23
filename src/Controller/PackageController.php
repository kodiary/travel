<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PackageController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index($slug)
    {
        $model = TableRegistry::get('Packages');
        $q = $model->find()->where(['slug' =>$slug])->first();
        if($q)
        $this->set('pack',$q);
        
        $packCat = TableRegistry::get('PackageCategory');
        $pmodel = $packCat->find()->where(['id' =>$q->cat_id])->first();
        if($pmodel)
        $this->set('cat',$pmodel);
        
        $iteniery = TableRegistry::get('Iteniery');
        $imodel = $iteniery->find()->where(['pid' =>$q->id])->all();
        if($imodel)
        $this->set('ite',$imodel);
        
        $tags = TableRegistry::get('Tags');
        $ta = $tags->find()->where(['package_id'=>$q->cat_id])->all();
        $pcat = array();
        $tcat = array();
        foreach($ta as $t)
        {
            if($t->package_id)
            {
                $pcat[] = $t->package_id;
            }
            if($t->tour_id)
            {
                
                $tcat[] = $t->tour_id;
            }
        }
        $this->set('tcat',$tcat);
        $this->set('pcat',$pcat);
        $this->set('pslug',$slug);
    }
    public function enquire()
    {
        
        if(isset($_POST['cap'])&& $_POST['cap']=='')
        {
            $admin = TableRegistry::get('Admin')->find()->first();
            $admin_email = $admin->email;
            $msg = "Hello Admin,<br/>";
            $msg .= "New Enquiry for Package(".$_POST['p_id'].")<br/>";
            $msg .= "Name:".$_POST['name']."<br/>";
            $msg .= "Email:".$_POST['email']."<br/>";
            $msg .= "Message:".$_POST['message']."<br/>";
            $email = new Email('default');
            $email->from([$_POST['email'] => $this->request->webroot])
                ->emailFormat('both')
                ->to($admin_email)
                ->subject('Enquiry');
            if($email->send($msg))
            {
                echo "OK";
            }
                
            
        }
        die();
    }
    
}
