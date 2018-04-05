<?php

namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->viewBuilder()->layout('rcadmin');
        $roles = $this->Users->Roles->find('list', ['limit' => 200, 'conditions' => ['Roles.status' => 'A'], 'order' => 'name ASC']);
        $rolesList = ':[Todos]';
        foreach ($roles as $id => $rol) {
            $rolesList .= ';' . $id . ':' . $rol;
        }
        $this->set(compact('rolesList'));
    }

    /**
     * Data method
     *
     * @return \Cake\Http\Response|json
     */
    public function data() {
        $name = $this->request->getQuery('name');
        $username = $this->request->getQuery('username');
        $email = $this->request->getQuery('email');
        $address = $this->request->getQuery('address');
        $mobile = $this->request->getQuery('mobile');
        $phone = $this->request->getQuery('phone');
        $status = $this->request->getQuery('status');

        $limit = $this->request->getQuery('rows');
        $page = $this->request->getQuery('page');
        $sord = $this->request->getQuery('sord');
        $sidx = $this->request->getQuery('sidx');

        $conditions = [];
        if (!empty($name)) {
            $conditions['name ILIKE'] = '%' . $name . '%';
        }
        if (!empty($username)) {
            $conditions['username ILIKE'] = '%' . $username . '%';
        }
        if (!empty($email)) {
            $conditions['email ILIKE'] = '%' . $email . '%';
        }
        if (!empty($address)) {
            $conditions['address ILIKE'] = '%' . $address . '%';
        }
        if (!empty($mobile)) {
            $conditions['mobile'] = $mobile;
        }
        if (!empty($phone)) {
            $conditions['phone'] = $phone;
        }
        if (!empty($status)) {
            $conditions['status'] = $status;
        }

        $query = $this->Users->find('all', [
                    'fields' => [
                        'id',
                        'document', 'firstname', 'lastname', 'email',
                        'username', 'address', 'mobile', 'phone',
                        'last_access', 'last_ip', 'last_change_password', 'status',
                        'role_name' => 'Roles.name'
                    ],
                    'contain' => ['Roles']
                ])->where($conditions);

        try {
            $rows = $this->paginate($query, [
                'limit' => $limit,
                'page' => $page,
                'order' => ['Users.' . $sidx => $sord]
            ]);
        } catch (\Exception $e) {
            $rows = [];
        }

        $total = $query->count();
        $pages = (int) ($total / $limit);
        $total = ($total % $limit) ? $pages + 1 : $pages;
        $records = $query->count();

        $this->set(compact('rows', 'total', 'records'));
        $this->set('_serialize', ['rows', 'total', 'records']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data['error'] = 0;

            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user['status'] = empty($this->request->getData('status')) ? 'I' : $user['status'];
            $user['created_by'] = $this->Auth->user('id');
            if (!$this->Users->save($user)) {
                $data['error'] = 1;
                $data['message'] = 'El Usuario no se pudo registrar. Verifique los datos e inténtelo nuevamente';
            }

            $this->response->type('json');
            $this->response->body(json_encode($data));
            return $this->response;
        } else {
            $roles = $this->Users->Roles->find('list', ['limit' => 200, 'conditions' => ['Roles.status' => 'A'], 'order' => 'name ASC']);
            $this->viewBuilder()->layout('ajax');
            $this->set(compact('user', 'roles'));
            $this->set('_serialize', ['user']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data['error'] = 0;

            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user['status'] = empty($this->request->getData('status')) ? 'I' : $user['status'];
            $user['modified_by'] = $this->Auth->user('id');
            if (!$this->Users->save($user)) {
                $data['error'] = 1;
                $data['message'] = 'El Usuario no se pudo modificar. Verifique los datos e inténtelo nuevamente';
            }

            $this->response->type('json');
            $this->response->body(json_encode($data));
            return $this->response;
        } else {
            $roles = $this->Users->Roles->find('list', ['limit' => 200, 'conditions' => ['Roles.status' => 'A'], 'order' => 'name ASC']);
            $this->viewBuilder()->layout('ajax');
            $this->set(compact('user', 'roles'));
            $this->set('_serialize', ['user']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $data['error'] = 0;
        if ($this->request->is('post')) {
            $id = $this->request->getData('id');
            $existsDependents = $this->Users->LogsAccesses->find('all', [
                'conditions' => ['LogsAccesses.user_id' => $id]
            ])->count();

            if ($existsDependents > 0) {
                $data['error'] = 1;
                $data['message'] = 'El Usuario no puede ser eliminado porque tiene Registro de Accesos relacionados';
            } else {
                $user = $this->Users->get($id);
                if ($this->Users->delete($user)) {
                    $data['message'] = 'El Usuario ha sido eliminado correctamente';
                } else {
                    $data['error'] = 1;
                    $data['message'] = 'El Usuario no pudo ser eliminado. Consulte con el Administrador';
                }
            }
        }
        $this->response->type('json');
        $this->response->body(json_encode($data));
        return $this->response;
    }

    /**
     * Validate method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function validateEmail ()
    {
        $data = [
            'result' => 'false'
        ];
        if ($this->request->is('post')) {
            $conditions = ['email' => $this->request->getData('email')];
            if (!empty($this->request->getData('email_current'))) {
                $conditions[] = ['email <>' => $this->request->getData('email_current')];
            }
            $exists = $this->Users->find('all', [
                'conditions' => $conditions
            ])->count();
            if (!$exists) {
                $data['result'] = 'true';
            }
        }
        $this->response->type('json');
        $this->response->body(json_encode($data));
        return $this->response;
    }

    public function isAuthorized($user = null) {
        if ($this->request->param('action') === 'login') {
            return true;
        }
        if ($this->request->param('action') === 'logout') {
            return true;
        }
        return (bool)($user['role_id'] === 1);
    }

}
