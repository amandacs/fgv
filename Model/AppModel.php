<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    public function beforeSave($options = array()) {
        App::uses('CakeSession', 'Model/Datasource');
        /*$user = CakeSession::read('Auth.User');*/
        $user = CakeSession::read('Auth.User');
        /*$user = $user->setaIdUsuario($user);*/

        if (!isset($this->data[$this->alias]['id'])) {
            $this->data[$this->alias]['created_by'] = $user['id'];
            $this->data[$this->alias]['updated_by'] = $user['id'];
        } else {
            $user_id = isset($user['id']) ? $user['id'] : $this->data[$this->alias]['updated_by'];
            $this->data[$this->alias]['updated_by'] = $user_id;
        }
        return true;
    }

    /*public function  setaIdUsuario($user){
        if(!isset($user)){
            $user['created_by'] = $user['id'];
        }else{
            $user['updated_by'] = $user['id'];
        }
        return true;
    }*/
}
