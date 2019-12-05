<?php

namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Access Controller
 *
 * @property \App\Model\Table\AccessTable $Access
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class AccessController extends AppController {

    public function login() {
        $this->viewBuilder()->layout('login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                /** Registramos el Acceso del Usuario en el Log Accesses */
                $this->loadModel('Users');
                $logsAccess = $this->Users->LogsAccesses->newEntity();
                $data = [
                    'ip' => $this->request->clientIp(),
                    'income_date' => date('Y-m-d H:i:s'),
                    'additional_data' => $_SERVER['HTTP_USER_AGENT'],
                    'user_id' => $user['id']
                ];

                $this->Auth->setUser($user);
                /** Actualizamos los datos de acceso del Usuario */
                $this->Users->updateAll(
                        ['last_access' => date('Y-m-d H:i:s'), 'last_ip' => $this->request->clientIp()], ['id' => $user['id']]
                );
                if( $user['role_id'] == 3){
                    return $this->redirect(['controller' => 'participants', 'action' => 'index_ranking']);
                }
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Nombre de usuario o contraseña incorrectos, inténtelo nuevamente'));
        }
    }

    public function logout() {
        $this->Auth->user();
        /** Actualizamos los datos de acceso del Usuario */
        $this->loadModel('Users');
        $this->Users->LogsAccesses->updateAll(
                ['departure_date' => date('Y-m-d H:i:s')], ['id' => $this->Auth->user('id')]
        );
        return $this->redirect($this->Auth->logout());
    }

    public function password() {
        $this->loadModel('Users');
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
//            echo debug($user); exit();
            $user->password = (new DefaultPasswordHasher)->hash($this->request->data['password_new']);
            $user->last_change_password = date('Y-m-d H:i:s');
            $user->modified_by = $this->Auth->user('id');
            if ($this->Users->save($user)) {
                $this->Flash->success(__('La Contraseña se modifico correctamente.'));
                return $this->redirect('/');
            } else {
                $this->Flash->error(__('Lo sentimos, la contraseña no coinciden.'));
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function profile() {
        $this->viewBuilder()->layout('rcadmin');
        $this->loadModel('Users');
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user['modified_by'] = $this->Auth->user('id');
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El Perfil se guardo correctamente.'));
                return $this->redirect('/');
            }
            $this->Flash->error(__('El Perfil no pudo ser modificado. Por favor, inténtelo nuevamente.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

}
