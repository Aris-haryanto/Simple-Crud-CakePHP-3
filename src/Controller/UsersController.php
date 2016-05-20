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
use Cake\View\Helper\HtmlHelper;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display(){
        $path = func_get_args();
        
        // echo '<pre>';
        // print_r($path);
        // echo '</pre>';
        
        $page = array();
        $param_1 = 0;

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }else if($count >= 2){
            $page[] = $path[0];
            $param_1 = $path[1];
        }else{
            $page[] = $path[0];
        }

        $query = $this->Users->find()
                    ->toArray();

        $getUser = $this->Users->find()
                    ->where(['id' => $param_1])
                    ->first();

        $data['get_data'] = $query;
        $data['get_user'] = $getUser;
        // $data['title'] = 'Halo';
        // $data['body'] = 'Selamat Pagi';
        $data['id'] = $param_1;

        $this->set($data);

        try {
            $this->render(implode('/', $page));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }

    public function add(){
        $nama = $this->request->data['nama'];
        $email = $this->request->data['email'];

        $addUsers = $this->Users->newEntity();
        $addUsers->nama = $nama;
        $addUsers->email = $email;

        if ($this->Users->save($addUsers)) {
            // The $article entity contains the id now
            $id = $addUsers->id;
            $this->redirect('/');
        }
    }

    public function update(){
        $id = $this->request->data['id'];
        $nama = $this->request->data['nama'];
        $email = $this->request->data['email'];

        $updateUsers = $this->Users->get($id);
        $updateUsers->nama = $nama;
        $updateUsers->email = $email;

        if ($this->Users->save($updateUsers)) {
            $this->redirect('/');
            // $this->redirect('/users/edit/'.$id);
        }
    }

    public function delete(){
        $id = $this->request->data['id'];
        
        $deleteUsers = $this->Users->get($id);

        if ($this->Users->delete($deleteUsers)) {
            $this->redirect('/');
            // $this->redirect('/users/edit/'.$id);
        }
    }
}
